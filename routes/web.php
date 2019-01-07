<?php
use Oseintow\Shopify\Facades\Shopify;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



Route::get("/install", function() {
    if (isset($_GET['shop'])) {
        $url = $_GET['shop'];
        $shopUrl = $url;
        $scope = ["read_price_rules", "write_price_rules", "read_product_listings", "write_products", "read_products", "read_customers","write_orders", "read_orders", "read_themes", "write_themes", "read_script_tags", "write_script_tags"];
        $redirectUrl = 'http://discount.test/auth';
        $shopify = Shopify::setShopUrl($shopUrl);
        return redirect()->to($shopify->getAuthorizeUrl($scope, $redirectUrl));
    } else {
        return redirect(route('index'));
    }
})->name('install');
Route::get('/authtoken', 'IndexController@auth');
Route::get("auth", function(\Illuminate\Http\Request $request) {
    $shopUrl = $_GET['shop'];
    $accessToken = Shopify::setShopUrl($shopUrl)->getAccessToken($request->code);
    $shop = $request->shop;
    $timestamp = $request->timestamp;
    $signature = $request->signature;
    $code = $request->code;
    $hmac = $request->hmac;
    return redirect()->action(
        'IndexController@auth', ['shop' => $shop, 'hmac' => $hmac, 'timestamp' => $timestamp, 'signature' => $signature, 'code' => $code, 'accessToken' => $accessToken]
    );
});

Route::group(['middleware' => 'isShop'], function () {
    Route::get('/dashboard', 'ShopController@dashboard')->name('dashboard');
});
