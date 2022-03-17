<?php namespace Frukt\Frushop\Models;

use Model;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    use \October\Rain\Database\Traits\Sluggable;

    public $slugs = ['slug' => 'title'];

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'frukt_frushop_products';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsToMany = [
        'categories' => [
            Category::class,
            'table' => 'frukt_frushop_category_product'
        ]
    ];

    public $hasMany = [
        'offers' => Offer::class,
    ];

    public $attachMany = [
        'images' => \System\Models\File::class,
    ];

    public function scopeFilterCategories($query, $filtered) {
        return $query->whereHas('categories', function($q) use ($filtered) {
            $q->whereIn('category_id', $filtered);
        });
    }
}
