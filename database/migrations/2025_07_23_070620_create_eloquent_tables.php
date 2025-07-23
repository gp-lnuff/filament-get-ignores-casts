<?php

use App\Models\SomeParent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('some_parents', function (Blueprint $table) {
            $table->id();
            $table->enum('some_field', [0, 1, 2, 3]);
            $table->boolean('other_field')->default(false);
            $table->timestamps();
        });

        Schema::create('some_children', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SomeParent::class)->nullable()->constrained();
            $table->boolean('child_field')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('eloquent_tables');
    }
};
