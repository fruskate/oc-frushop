<?php namespace Frukt\Frushop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktFrushopCartitems extends Migration
{
    public function up()
    {
        Schema::create('frukt_frushop_cartitems', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('offer_id')->nullable()->unsigned();
            $table->smallInteger('quantity')->unsigned()->default(1);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('frukt_frushop_cartitems');
    }
}
