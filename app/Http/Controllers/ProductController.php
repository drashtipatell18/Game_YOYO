<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function CreateProduct()
    {
        $categories = Category::pluck('name', 'id');
        return view('product.create_product',compact('categories'));
    }

    public function StoreProduct(Request $request)
    {
        $imageNames = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Handle dimensions as a string (e.g. "10x5x2")
        $dimensions = null;
        if ($request->filled('length') || $request->filled('width') || $request->filled('height')) {
            $length = $request->input('length', 0);
            $width = $request->input('width', 0);
            $height = $request->input('height', 0);
            $dimensions = "{$length}x{$width}x{$height}";
        }

        // Combine key/value details
        $productDetails = [];
        if ($request->has('key') && $request->has('value')) {
            $keys = $request->input('key');
            $values = $request->input('value');
            for ($i = 0; $i < count($keys); $i++) {
                if (!empty($keys[$i]) && !empty($values[$i])) {
                    $productDetails[$keys[$i]] = $values[$i];
                }
            }
        }

        $skuPrefix = 'SKU';
        $datePart = date('Ymd');
        $randomPart = strtoupper(substr(uniqid(), -6));
        $sku = "{$skuPrefix}-{$datePart}-{$randomPart}";

        // Store product
        Product::create([
            'category_id' => $request->input('category_id'),
            'SKU' => $sku,
            'tags' => $request->input('tags'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => implode(',', $imageNames),
            'description' => $request->input('description'),
            'weight' => $request->input('weight'),
            'dimensions' => $dimensions,
            'status' => $request->input('status'),
            'release_date' => $request->input('release_date'),
           'platform' => is_array($request->input('platform')) 
            ? implode(',', $request->input('platform')) 
            : $request->input('platform'),

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('product')->with('success', 'Product created successfully.');
    }

    public function Product()
    {
        $products = Product::with('category')->get();
        return view('product.view_product', compact('products'));
    }

    public function EditProduct($id)
    {
        $product = Product::find($id);
        $categories = Category::pluck('name', 'id');
        $selectedPlatforms = $product->platform ? explode(',', $product->platform) : [];

        // Extract dimensions into length, width, height
        if ($product && $product->dimensions) {
            [$length, $width, $height] = explode('x', $product->dimensions);
            $product->length = $length;
            $product->width = $width;
            $product->height = $height;
        }

        return view('product.create_product', compact('product', 'categories','selectedPlatforms'));
    }

    public function DeleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product')->with('success', 'Product deleted successfully');
    }

    public function destroyImage(Request $request)
    {
        try {
            $imageName = $request->input('image_name');
            $productId = $request->input('product_id');

            $product = Product::findOrFail($productId);
            $currentImages = explode(',', $product->image);

            $updatedImages = array_filter($currentImages, function($img) use ($imageName) {
                return trim($img) !== trim($imageName);
            });

            $product->update([
                'image' => implode(',', array_map('trim', $updatedImages))
            ]);

            $imagePath = public_path('images/products/' . $imageName);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function UpdateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $currentImages = $product->image ? explode(',', $product->image) : [];
        $deletedImages = $request->input('deleted_images', '');
        $imageNames = [];

        if ($deletedImages) {
            $deletedImagesArray = explode(',', $deletedImages);
            $currentImages = array_diff($currentImages, $deletedImagesArray);
            foreach ($deletedImagesArray as $img) {
                $imagePath = public_path('images/products/' . trim($img));
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products'), $imageName);
                $currentImages[] = $imageName;
            }
        }

       $finalImages = array_merge($currentImages, $imageNames);
       $dimensions = null;
        if ($request->filled('length') || $request->filled('width') || $request->filled('height')) {
            $length = $request->input('length', 0);
            $width = $request->input('width', 0);
            $height = $request->input('height', 0);
            $dimensions = "{$length}x{$width}x{$height}";
        }

        $updateData = [
            'category_id' => $request->input('category_id'),
            'tags' => $request->input('tags'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => implode(',', $finalImages),
            'description' => $request->input('description'),
            'weight' => $request->input('weight'),
            'status' => $request->input('status'),
            'dimensions' => $dimensions,
            'release_date' => $request->input('release_date'),
            'platform' => is_array($request->input('platform')) 
            ? implode(',', $request->input('platform')) 
            : $request->input('platform'),
        ];

        $product->update($updateData);

        return redirect()->route('product')->with('success', 'Product updated successfully');
    }

    public function toggleStatus($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Toggle status
            $product->status = $product->status === 'active' ? 'inactive' : 'active';
            $product->save();

            return response()->json([
                'success' => true,
                'status' => $product->status,
                'message' => 'Status updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }



}
