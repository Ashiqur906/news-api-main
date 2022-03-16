<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_widgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('layout_id');
            $table->unsignedBigInteger('widget_id');
            $table->string('widget_space_id')->nullable();
            $table->json('widget_settings')->nullable();
            $table->boolean('status')->default('0')->comment('0 = Inactive 1 = Active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('layout_id')->references('id')->on('layouts');
            $table->foreign('widget_id')->references('id')->on('widgets');

            $table->unique(['layout_id', 'widget_id', 'widget_space_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_widgets');
    }
}
