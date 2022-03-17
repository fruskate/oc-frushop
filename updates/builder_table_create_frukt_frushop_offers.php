<?php namespace Frukt\Frushop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktFrushopOffers extends Migration
{
    public function up()
    {
        Schema::create('frukt_frushop_offers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('product_id')->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('is_active')->default(1);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('frukt_frushop_offers');
    }
}