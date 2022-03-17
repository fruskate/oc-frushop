<?php namespace Frukt\Frushop\Components;

use Cms\Classes\ComponentBase;
use Frukt\Frushop\Classes\CartHelper;
use Frukt\Frushop\Models\Offer;

/**
 * Cart Component
 */
class CartIcon extends ComponentBase
{
    public $info;

    public function componentDetails()
    {
        return [
            'name' => 'Корзина',
            'description' => 'Отображает корзину магазина...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->info = CartHelper::cartIconInfo();
    }
}
