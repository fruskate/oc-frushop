<?php namespace Frukt\Frushop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration104 extends Migration
{
    public function up()
    {
        Schema::create('frukt_frushop_category_product', function($table)
        {
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->primary(['category_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::drop('frukt_frushop_category_product');
    }
}