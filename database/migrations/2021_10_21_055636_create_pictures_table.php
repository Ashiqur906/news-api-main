<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("imageable_id")->nullable();
            $table->string("imageable_type")->nullable();
            $table->string('name')->nullable();
            $table->string('file_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->boolean('featured')->default(0);
            $table->text('small')->nullable();
            $table->text('medium')->nullable();
            $table->text('full')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('attachment_meta')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->default('Yes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
