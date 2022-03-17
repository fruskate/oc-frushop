<?php namespace Frukt\Frushop\Models;

use Model;

/**
 * Model
 */
class Offer extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'frukt_frushop_offers';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'product' => Product::class,
    ];
}
