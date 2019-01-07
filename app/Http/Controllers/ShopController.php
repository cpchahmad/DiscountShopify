<?php

namespace App\Http\Controllers;
use App;
use Session;
use Oseintow\Shopify\Shopify;
use RocketCode\Shopify\API;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public $shopify;
    private $shopURL;
    private $accessToken;

    public function __construct()
    {

    }
    public function dashboard(){
        $shopify = App::make('ShopifyAPI', [
            'API_KEY' => env('SHOPIFY_APIKEY'),
            'API_SECRET' => env('SHOPIFY_SECRET'),
            'SHOP_DOMAIN' => session('shopurl'),
            'ACCESS_TOKEN' => session('accessToken')
        ]);

        return view('dashboard');
       }

       public function createDiscount(){
        return view('create_discount');
       }
}
