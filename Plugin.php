<?php namespace Frukt\Frushop;

use Frukt\Frushop\Models\Offer;
use System\Classes\PluginBase;
use Frukt\Frushop\Components\Shop as ComponentShop;
use Frukt\Frushop\Components\CartIcon as ComponentCartIcon;
use Frukt\Frushop\Components\Cart as ComponentCart;

class Plugin extends PluginBase
{
    public $require = ['Frukt.Users'];

    public function registerComponents()
    {
        return [
            ComponentShop::class => 'shop',
            ComponentCartIcon::class => 'cartIcon',
            ComponentCart::class => 'cart'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Настройки магазина',
                'description' => 'Управление настройками магазина.',
                'category'    => 'Frushop',
                'icon'        => 'icon-globe',
                'class'       => 'Frukt\Frushop\Models\Settings',
                'order'       => 500,
                'keywords'    => 'settings'
            ]
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                // A local method, i.e $this->makeTextAllCaps()
                'realQuantity' => [$this, 'getRealQuantity'],
            ],
        ];
    }

    public function getRealQuantity($offerId)
    {
        $offer = Offer::find($offerId);

        if (!$offer) {
            return 0;
        }

        return $offer->quantity;
    }
}
