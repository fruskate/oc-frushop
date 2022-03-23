<?php namespace Frukt\Frushop\Models;

use Frukt\Users\Models\User;
use Model;

/**
 * Model
 */
class CartItem extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    protected $fillable = ['user_id', 'offer_id', 'quantity', 'offer_url'];
    /**
     * @var string The database table used by the model.
     */
    public $table = 'frukt_frushop_cartitems';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'user' => User::class,
        'offer' => Offer::class,
    ];

    public function getTotalAttribute()
    {
        return $this->quantity * $this->offer->price;
    }
}
