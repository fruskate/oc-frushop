<?php namespace Frukt\Frushop\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    use \October\Rain\Database\Traits\NestedTree;

    use \October\Rain\Database\Traits\Sluggable;

    public $slugs = ['slug' => 'title'];

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'frukt_frushop_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsToMany = [
        'products' => [
            \Frukt\Frushop\Models\Product::class,
            'table' => 'frukt_frushop_category_product'
        ]
    ];

    public $attachOne = [
        'cover' => \System\Models\File::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
