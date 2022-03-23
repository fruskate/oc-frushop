<?php namespace Frukt\Frushop\Components;

use Cms\Classes\ComponentBase;
use Frukt\Frushop\Classes\CartHelper;
use Frukt\Frushop\Models\Offer;
use FruktAuth;

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
        $user = FruktAuth::getUser();

        if ($user) {
            $user->cart_items()->where('offer_id', post('offer_id'))->delete();

            return [
                //'#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
                '#cartItem'.post('offer_id') => '',
                //'#totalCartPrice' => CartHelper::getTotalCartPrice(),
            ];
        } else {
            CartHelper::removeItem(post('offer_id'));

            return [
                '#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
                '#cartItem'.post('offer_id') => '',
                '#totalCartPrice' => CartHelper::getTotalCartPrice(),
            ];
        }



    }

    public function onAddQuantity()
    {
        $user = FruktAuth::getUser();

        if ($user) {
            $user->cart_items()->where('offer_id', post('offer_id'))->increment('quantity');
            $item = $user->cart_items()->where('offer_id', post('offer_id'))->first();

            return [
                //'#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
                '#cartItem'.post('offer_id') => $this->renderPartial($this.'::make_cart_item_for_user', ['item' => $item]),
                //'#totalCartPrice' => CartHelper::getTotalCartPrice(),
            ];
        } else {
            CartHelper::addQuantity(post('offer_id'));
            $item = CartHelper::cartItemInfo(post('offer_id'));

            return [
                '#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
                '#cartItem'.post('offer_id') => $this->renderPartial($this.'::make_cart_item', ['item' => $item]),
                '#totalCartPrice' => CartHelper::getTotalCartPrice(),
            ];
        }
    }

    public function onRemoveQuantity()
    {
        $user = FruktAuth::getUser();

        if ($user) {
            $user->cart_items()->where('offer_id', post('offer_id'))->decrement('quantity');
            $item = $user->cart_items()->where('offer_id', post('offer_id'))->first();

            return [
                //'#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
                '#cartItem'.post('offer_id') => $this->renderPartial($this.'::make_cart_item_for_user', ['item' => $item]),
                //'#totalCartPrice' => CartHelper::getTotalCartPrice(),
            ];

        } else {
            CartHelper::removeQuantity(post('offer_id'));
            $item = CartHelper::cartItemInfo(post('offer_id'));

            return [
                '#cartIcon' => $this->renderPartial('@make_cart_icon', ['item' => CartHelper::cartIconInfo()]),
                '#cartItem'.post('offer_id') => $this->renderPartial($this.'::make_cart_item', ['item' => $item]),
                '#totalCartPrice' => CartHelper::getTotalCartPrice(),
            ];
        }

    }
}
