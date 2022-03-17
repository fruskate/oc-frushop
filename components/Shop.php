<?php namespace Frukt\Frushop\Components;

use Cms\Classes\ComponentBase;
use Frukt\Frushop\Classes\CartHelper;
use Frukt\Frushop\Models\Category;
use Frukt\Frushop\Models\Offer;
use Frukt\Frushop\Models\Product;
use Frukt\Frushop\Models\Settings;

/**
 * Shop Component
 */
class Shop extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Магазин',
            'description' => 'Отображает категории и товары'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public $categories;
    public $category;
    public $products;
    public $product;

    public function onRun()
    {
        if ($this->page->id == 'shop-index') {
            $this->categories = Category::active()->whereNUll('parent_id')->get();
        } elseif ($this->page->id == 'shop-category') {
            $this->category = Category::where('slug', $this->param('cat_slug'))->active()->first();

            if (!$this->category) {
                return \Response::make($this->controller->run('404')->getContent(), 404);
            }

            $allParentAndSelfCategories = $this->category->getAllChildrenAndSelf();


            $arrayCategories = array();
            foreach ($allParentAndSelfCategories as $item) {
                $arrayCategories[] = $item->id;
            }

            //trace_log($arrayCategories);

            $this->products = Product::whereHas('categories', function ($query) use ($arrayCategories) {
                $query->whereIn('category_id', $arrayCategories);
            })->get();

            $this->page->breadcrumbs = $this->generateBreadcrumbs($this->category);
        } elseif ($this->page->id == 'shop-product') {
            $this->category = Category::where('slug', $this->param('cat_slug'))->active()->first();

            if (!$this->category) {
                return \Response::make($this->controller->run('404')->getContent(), 404);
            }

            $this->product = Product::where('slug', $this->param('product_slug'))->first();

            if (!$this->product) {
                return \Response::make($this->controller->run('404')->getContent(), 404);
            }

            $this->page->breadcrumbs = $this->generateBreadcrumbs($this->category, $this->product);
        }
    }

    private function generateBreadcrumbs($category, $product = false)
    {
        $arBreadcrumbs = array();

        $arBreadcrumbs[] = [
            'name' => 'Каталог',
            'link' => '/shop'
        ];

        $categories = $category->getParents();

        foreach ($categories as $cat) {
            $arBreadcrumbs[] = [
                'name' => $cat->title,
                'link' => '/shop/c/' . $cat->slug
            ];
        }

        if ($product) {
            $arBreadcrumbs[] = [
                'name' => $category->title,
                'link' => '/shop/c/' . $category->slug
            ];
            $arBreadcrumbs[] = [
                'name' => $product->title,
                'link' => false
            ];
        } else {
            $arBreadcrumbs[] = [
                'name' => $category->title,
                'link' => false
            ];
        }


        return $arBreadcrumbs;
    }

    public function onAddToCart()
    {
        CartHelper::addItem(post('offer_id'), post('quantity'));
        $data = CartHelper::cartIconInfo();

        return [
            '#offer' . post('offer_id') => '<div class="alert alert-success">Успешно добавлено</div>',
            '#cartIconQuantity'         => $data['quantity'],
            '#cartIconTotal'            => $data['total'],
        ];
    }
}
