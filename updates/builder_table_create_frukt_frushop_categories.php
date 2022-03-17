<?php namespace Frukt\Frushop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktFrushopCategories extends Migration
{
    public function up()
    {
        Schema::create('frukt_frushop_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_active')->default(1);
            $table->text('desc')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('frukt_frushop_categories');
    }
}