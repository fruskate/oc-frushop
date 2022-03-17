<?php namespace Frukt\Frushop\Classes;

use Frukt\Frushop\Models\Offer;
use Session;

class CartHelper
{

    public static function cartIconInfo()
    {
        $sessionCart = Session::get('cart', ['items' => array()]);

        $quantity = 0;
        $total = 0;

        foreach ($sessionCart['items'] as $item) {
            $quantity += $item['quantity'];
            $total += $item['price'] * $item['quantity'];
        }

        return [
            'quantity' => $quantity,
            'total'    => $total
        ];
    }

    public static function addItem($offerId, $quantity)
    {
        $sessionCart = Session::get('cart', ['items' => array()]);

        if (isset($sessionCart['items'][$offerId])) {
            $sessionCart['items'][$offerId]['quantity'] += $quantity;
            $sessionCart['items'][$offerId]['total'] += $quantity * $sessionCart['items'][$offerId]['price'];
        } else {
            $offer = Offer::find($offerId);

            $sessionCart['items'][$offerId] = [
                'id'       => $offerId,
                'title'    => $offer->product->title,
                'quantity' => $quantity,
                'price'    => $offer->price,
                'total'    => $offer->price * $quantity
            ];
        }

        Session::put('cart', $sessionCart);
    }

    public static function getItems()
    {
        return Session::get('cart', ['items' => array()]);
    }

    public static function removeItem($offerId)
    {
        $sessionCart = Session::get('cart', ['items' => array()]);
        unset($sessionCart['items'][$offerId]);
        Session::put('cart', $sessionCart);
    }

    public static function addQuantity($offerId)
    {
        $sessionCart = Session::get('cart', ['items' => array()]);

        $sessionCart['items'][$offerId]['quantity'] += 1;
        $sessionCart['items'][$offerId]['total'] += $sessionCart['items'][$offerId]['price'];

        Session::put('cart', $sessionCart);
    }

    public static function removeQuantity($offerId)
    {
        $sessionCart = Session::get('cart', ['items' => array()]);

        $sessionCart['items'][$offerId]['quantity'] -= 1;
        $sessionCart['items'][$offerId]['total'] -= $sessionCart['items'][$offerId]['price'];

        Session::put('cart', $sessionCart);
    }

    public static function cartItemInfo($offerId)
    {
        $sessionCart = Session::get('cart', ['items' => array()]);

        return $sessionCart['items'][$offerId];
    }


}
