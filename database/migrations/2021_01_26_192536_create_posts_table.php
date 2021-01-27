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
            // $table
            //     ->foreignId("user_id")
            //     ->constrained()
            //     ->onDelete("cascade");
            $table->string("provider_slug");
            $table->string("category_slug");
            $table->string("title");
            $table->string("slug")->nullable();
            $table->string("content")->default("");
            $table->string("url");
            $table->string("image")->nullable();
            $table->timestamps();
            $table->dateTime("scraped_at")->useCurrent();

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
