<?php namespace Frukt\Frushop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateFruktFrushopCartitems extends Migration
{
    public function up()
    {
        Schema::table('frukt_frushop_cartitems', function($table)
        {
            $table->string('offer_url')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('frukt_frushop_cartitems', function($table)
        {
            $table->dropColumn('offer_url');
        });
    }
}
