<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite doesn't support modifying check constraints directly via Schema::table()->change() for Enums consistently.
        // We will recreate the table structure to include 'pending'.
        
        // 1. Create new table
        Schema::create('guinea_pigs_temp', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->text('description');
            // Adding 'pending' to allowed values
            $table->enum('status', ['available', 'hotel', 'adopted', 'pending'])->default('available');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        // 2. Copy data
        DB::statement('INSERT INTO guinea_pigs_temp (id, name, age, category_id, description, status, image_path, created_at, updated_at) SELECT id, name, age, category_id, description, status, image_path, created_at, updated_at FROM guinea_pigs');

        // 3. Drop old table
        Schema::drop('guinea_pigs');

        // 4. Rename new table
        Schema::rename('guinea_pigs_temp', 'guinea_pigs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We won't revert data loss potential, just basic reverse structure
         Schema::create('guinea_pigs_temp', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->enum('status', ['available', 'hotel', 'adopted'])->default('available');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        // We can't copy back blindly because 'pending' values would violate the constraint.
        // Converting 'pending' to 'available' for rollback
        DB::statement("INSERT INTO guinea_pigs_temp (id, name, age, category_id, description, status, image_path, created_at, updated_at) SELECT id, name, age, category_id, description, CASE WHEN status = 'pending' THEN 'available' ELSE status END, image_path, created_at, updated_at FROM guinea_pigs");

        Schema::drop('guinea_pigs');
        Schema::rename('guinea_pigs_temp', 'guinea_pigs');
    }
};
