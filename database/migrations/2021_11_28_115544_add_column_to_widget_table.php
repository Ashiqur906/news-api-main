<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToWidgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
         
            $table->enum('limit_required', ['0', '1'])->after('data_limit');
            $table->enum('taxonomy', ['tag', 'category','post','tag-category'])->nullable()->after('limit_required');

        });
    }

    
    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
           $table->dropColumn(['limit_required','taxonomy']);
        });
    }
}
