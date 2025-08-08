<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivateScheduledProducts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'products:activate-scheduled {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     */
    protected $description = 'Activate products whose release date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now('Asia/Kolkata');
        $isDryRun = $this->option('dry-run');

        try {
            // First, let's check what products match our criteria
            $productsToActivate = DB::table('products')
                ->where('status', 'inactive')
                ->where('release_date', '<=', $now)
                ->get(['id', 'name', 'status', 'release_date']);

            $this->info("Found {$productsToActivate->count()} products to activate");

            if ($productsToActivate->isEmpty()) {
                $this->info("No products need activation at this time.");
                Log::info("Product activation cron job executed - no products to activate", [
                    'executed_at' => $now->toDateTimeString()
                ]);
                return Command::SUCCESS;
            }

            // Show details of products that will be activated
            if ($this->option('verbose') || $isDryRun) {
                $this->table(
                    ['ID', 'Name', 'Current Status', 'Release Date'],
                    $productsToActivate->map(function ($product) {
                        return [
                            $product->id,
                            $product->name ?? 'N/A',
                            $product->status,
                            $product->release_date
                        ];
                    })->toArray()
                );
            }

            if ($isDryRun) {
                $this->info("Dry run completed. No changes made.");
                return Command::SUCCESS;
            }

            // Perform the update with transaction for safety
            DB::beginTransaction();

            $updatedCount = DB::table('products')
                ->where('status', 'inactive')
                ->where('release_date', '<=', $now)
                ->update([
                    'status' => 'active',
                    'updated_at' => $now
                ]);

            DB::commit();

            $this->info("Successfully activated {$updatedCount} products");

            // Verify the update worked
            $verifyCount = DB::table('products')
                ->where('status', 'active')
                ->where('release_date', '<=', $now)
                ->where('updated_at', '>=', $now->subMinute())
                ->count();

            if ($verifyCount !== $updatedCount) {
                $this->warn("Warning: Expected {$updatedCount} updates but found {$verifyCount} recently updated active products");
            }

            // Log the activity
            Log::info("Product activation cron job executed successfully", [
                'activated_count' => $updatedCount,
                'executed_at' => $now->toDateTimeString(),
                'timezone' => 'Asia/Kolkata'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            $this->error("Error during product activation: " . $e->getMessage());

            Log::error("Product activation cron job failed", [
                'error' => $e->getMessage(),
                'executed_at' => $now->toDateTimeString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
