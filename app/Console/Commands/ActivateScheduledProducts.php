<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ActivateScheduledProducts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'products:activate-scheduled';

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

        // Activate products whose release_date has passed
        $updatedCount = Product::where('status', 'inactive')
            ->where('release_date', '<=', $now)
            ->update(['status' => 'active']);

        $this->info("Activated {$updatedCount} products");

        // Log the activity
        Log::info("Product activation cron job executed", [
            'activated_count' => $updatedCount,
            'executed_at' => $now->toDateTimeString()
        ]);

        return Command::SUCCESS;
    }
}
