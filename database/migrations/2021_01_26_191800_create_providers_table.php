<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("providers", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("user_id")
                ->constrained()
                ->onDelete("cascade");
            $table->string("title")->unique();
            $table
                ->string("slug")
                ->unique()
                ->nullable()
                ->index();
            $table->string("url");
            $table->string("request_url");
            // $table->string('image')->nullable();
            $table->string('bio', 140)->nullable();
            // $table->unsignedBigInteger('author_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("providers");
    }
}
