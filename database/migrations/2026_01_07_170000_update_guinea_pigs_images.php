<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\GuineaPig;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $guineaPigs = GuineaPig::all();
        foreach ($guineaPigs as $pig) {
            // Assign random image from 1.jpg to 10.jpg
            // Assuming these files are located in 'guinea_pigs' or 'images' directory in storage/public
            // User requested 'images' folder. 
            // Stored path typically relative to 'public' disk root.
            $randomImage = 'images/' . rand(1, 10) . '.jpg';
            $pig->update(['image_path' => $randomImage]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No structured rollback possible for random data assignment without backup.
    }
};
