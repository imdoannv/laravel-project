<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('img2')->nullable()->change();
            $table->string('img3')->nullable()->change();
            $table->string('img1')->default('default_image.jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('img2')->nullable(false)->change();
            $table->string('img3')->nullable(false)->change();
            $table->string('img1')->change();
        });
    }
}

