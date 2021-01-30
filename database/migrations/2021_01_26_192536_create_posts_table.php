<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("posts", function (Blueprint $table) {
            $table->id();
            $table->string("provider_slug");
            $table->string("category_slug");
            $table->string("title");
            $table->string("slug")->nullable()->index();
            // $table->string("content")->default("");
            $table->string("url");
            $table->string("image")->nullable();
            $table->timestamps();
            $table->dateTime("scraped_at")->useCurrent();
            $table->unsignedInteger('liked')->default(0);
            $table->string('author')->nullable();
            $table->string('author_img')->nullable();
            $table->string('author_url')->nullable();

            $table
                ->foreign("category_slug")
                ->references("slug")
                ->on("categories")
                ->onDelete("cascade");

            $table
                ->foreign("provider_slug")
                ->references("slug")
                ->on("providers")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("posts");
    }
}
