<?php namespace Frukt\Frushop\Components;

use Cms\Classes\ComponentBase;
use Frukt\Frushop\Classes\CartHelper;
use Frukt\Frushop\Models\Offer;

/**
 * Cart Component
 */
class Cart extends ComponentBase
{
    public $cart;

    public function componentDetails()
    {
        return [
            'name'        => 'Отображение корзины',
            'description' => 'Показывает все позиции корзины...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->cart = CartHelper::getItems();
    }

    public function onRemoveFromCart()
    {
        CartHelper::removeItem(post('offer_id'));

        return [
            '#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
            '#cartItem'.post('offer_id') => '',
            '#totalCartPrice' => CartHelper::getTotalCartPrice(),
        ];
    }

    public function onAddQuantity()
    {
        CartHelper::addQuantity(post('offer_id'));
        $item = CartHelper::cartItemInfo(post('offer_id'));

        return [
            '#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
            '#cartItem'.post('offer_id') => $this->renderPartial($this.'::make_cart_item', ['item' => $item]),
            '#totalCartPrice' => CartHelper::getTotalCartPrice(),
        ];
    }

    public function onRemoveQuantity()
    {
        CartHelper::removeQuantity(post('offer_id'));
        $item = CartHelper::cartItemInfo(post('offer_id'));

        return [
            '#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
            '#cartItem'.post('offer_id') => $this->renderPartial($this.'::make_cart_item', ['item' => $item]),
            '#totalCartPrice' => CartHelper::getTotalCartPrice(),
        ];
    }
}
