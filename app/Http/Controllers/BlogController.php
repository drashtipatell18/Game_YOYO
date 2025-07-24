<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
class BlogController extends Controller
{
    public function ViewBlog()
    {
        $blog = Blog::with('user')->get();
        return view('blog.view_blog', compact('blog'));
    }

    public function CreateBlog()
    {
        $user = User::pluck('name', 'id');
        return view('blog.create_blog', compact('user'));
    }

    public function StoreBlog(Request $request)
    {
        $imageNames = []; // array to collect image names
        $videoName = '';

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $name = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/blogs'), $name);
                $imageNames[] = $name;
            }
        }

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $videoName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('videos/blogs'), $videoName);
        }

        Blog::create([
            'user_id' => $request->input('user_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => json_encode($imageNames), // save as JSON
            'video' => $videoName,
        ]);

        return redirect()->route('blog')->with('success', 'Blog created successfully');
    }

    public function EditBlog($id)
    {
        $blog = Blog::find($id);
        $user = User::pluck('name', 'id');
        return view('blog.create_blog', compact('blog', 'user'));
    }

    public function UpdateBlog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Decode existing images (stored as JSON in DB)
        $existingImages = $blog->image ? json_decode($blog->image, true) : [];
        $newImages = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $name = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/blogs'), $name);
                $newImages[] = $name;
            }
        }

        // Merge new images with existing (or replace, depending on requirement)
        $allImages = !empty($newImages) ? array_merge($existingImages, $newImages) : $existingImages;

        // Handle video
        $videoName = $blog->video; // default to existing video
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $videoName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('videos/blogs'), $videoName);
        }

        $blog->update([
            'user_id' => $request->input('user_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => json_encode($allImages),
            'video' => $videoName,
        ]);

        return redirect()->route('blog')->with('success', 'Blog updated successfully');
    }


    public function DestroyBlog($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('blog')->with('success', 'Blog deleted successfully');
    }

    public function destroyImage(Request $request)
    {
        try {

            $blogId = $request->input('blog_id');
            $imageName = $request->input('image_name');

            // Find the blog
            $blog = Blog::findOrFail($blogId);

            // Get current images array
            $currentImages = json_decode($blog->image, true) ?? [];

            if (!in_array($imageName, $currentImages)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found in blog record'
                ], 404);
            }

            // Remove image from array
            $updatedImages = array_filter($currentImages, function($img) use ($imageName) {
                return $img !== $imageName;
            });

            // Update the blog record
            $blog->update([
                'image' => json_encode(array_values($updatedImages))
            ]);

            // Delete the physical file
            $imagePath = public_path('images/blogs/' . $imageName);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully',
                'remaining_images' => array_values($updatedImages)
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Image deletion failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image. Please try again.'
            ], 500);
        }
    }

    // Similar method for video deletion
    public function destroyVideo(Request $request)
    {
        try {

            $blogId = $request->input('blog_id');

            // Find the blog
            $blog = Blog::findOrFail($blogId);

            // Get current video
            $currentVideo = $blog->input('video');

            if (!$currentVideo) {
                return response()->json([
                    'success' => false,
                    'message' => 'No video found for this blog'
                ], 404);
            }

            // Update the blog record to remove video
            $blog->update(['video' => null]);

            // Delete the physical file
            $videoPath = public_path('videos/blogs/' . $currentVideo);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }

            return response()->json([
                'success' => true,
                'message' => 'Video deleted successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Video deletion failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete video. Please try again.'
            ], 500);
        }
    }
}
