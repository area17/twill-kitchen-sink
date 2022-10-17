<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandProductsTables extends Migration
{
    public function up()
    {
        Schema::create('brand_products', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->integer('position')->unsigned()->nullable();
            $table->foreignIdFor(\App\Models\Brand::class);

            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('brand_product_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'brand_product');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('brand_product_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'brand_product');
        });

        Schema::create('brand_product_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'brand_product');
        });
    }

    public function down()
    {
        Schema::dropIfExists('brand_product_revisions');
        Schema::dropIfExists('brand_product_translations');
        Schema::dropIfExists('brand_product_slugs');
        Schema::dropIfExists('brand_products');
    }
}
