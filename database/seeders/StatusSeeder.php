<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Order Received',
            'Order Confirmed',
            'Processing',
            'Out for Delivery',
            'paid',
            'delivered',
            'Cancelled',
        ];

        foreach ($statuses as $status) {
            Status::factory()->create([
                'name' => $status,
            ]);
        }
    }
}
