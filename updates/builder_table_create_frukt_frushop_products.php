<?php namespace Frukt\Frushop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktFrushopProducts extends Migration
{
    public function up()
    {
        Schema::create('frukt_frushop_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('desc')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('is_active')->default(1);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('frukt_frushop_products');
    }
}
