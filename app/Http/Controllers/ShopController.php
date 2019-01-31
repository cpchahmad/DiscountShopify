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
        $shop = App\Shop::where('name', session('shopurl'))->first();
        return view('dashboard')->with([
            'shop' => $shop,
            'offer_count' => App\Discount::where([
                'shop_id' => $shop->id
            ])->count(),
            'offers' => App\Discount::where([
                'shop_id' => $shop->id
            ])->get()
        ]);
       }

       public function createDiscount(){
        $shopify = App::make('ShopifyAPI', [
               'API_KEY' => env('SHOPIFY_APIKEY'),
               'API_SECRET' => env('SHOPIFY_SECRET'),
               'SHOP_DOMAIN' => session('shopurl'),
               'ACCESS_TOKEN' => session('accessToken')
        ]);
           $products = $shopify->call([
               'URL' => '/admin/products.json?limit=250',
               'METHOD' => 'GET'
           ]);
           $collections = $shopify->call([
               'URL' => '/admin/smart_collections.json',
               'METHOD' => 'GET'
           ]);
           return view('create_discount')->with([
               'products' => $products->products,
               'collections' => $collections->smart_collections,
               'shop' => App\Shop::where('name', session('shopurl'))->first()
           ]);
       }

       public function saveDiscount(Request $request){
        $discount_type = $request->input('offer_type');
        $insert = new App\Discount();

        $insert->offer_name = $request->input('offer_name');
        $insert->shop_id = $request->input('shop_id');
        $insert->offer_type = $request->input('offer_type');

        if ($request->has('products')) {
            $products = json_encode($request->input('products'));
            $insert->products = $products;
        }
        if ($request->has('collections')) {
           $collections = json_encode($request->input('collections'));
            $insert->collections = $collections;
        }

        if($discount_type == 'vd'){
            $discounts = [];
            foreach ($request->min_qty as $index=>$item) {
               $discount = ([$request->min_qty[$index], $request->min_qty_value[$index],$request->min_qty_type[$index]]);
               array_push($discounts,$discount);
            }
            $discounts = json_encode($discounts);
            $insert->conditions = $discounts;
            $insert->save();
            if($insert){
                return redirect(route('dashboard'))->with('success','Successfully Added!!');
            }
        }
        dd($insert);
       }

	   
       public function calculateDiscount (){
        $json = '{"token":"96eaf726f57ff7ea1577605fe2beecd1","note":null,"attributes":{},"original_total_price":352391,"total_price":352391,"total_discount":0,"total_weight":48578.0645,"item_count":123,"items":[{"id":12219447443519,"properties":null,"quantity":45,"variant_id":12219447443519,"key":"12219447443519:86cc31e39ff520ebe81f8173f0bff53b","title":"Fashion Brand Men Sports Watch - Black","price":3874,"original_price":3874,"discounted_price":3874,"line_price":174330,"original_line_price":174330,"total_discount":0,"discounts":[],"sku":"2580587-black","grams":454,"vendor":"bluecore55","taxable":false,"product_id":1310696177727,"gift_card":false,"url":"\/products\/fashion-brand-men-sports-watch?variant=12219447443519","image":"https:\/\/cdn.shopify.com\/s\/files\/1\/0021\/2562\/7455\/products\/product-image-204545653.jpg?v=1530888654","handle":"fashion-brand-men-sports-watch","requires_shipping":true,"product_type":"","product_title":"Fashion Brand Men Sports Watch","product_description":"Item Type: Dual Display Wristwatches,Quartz WristwatchesCase Thickness: 16mmBand Length: 26cmFeature: Back Light,Water Resistant,Shock Resistant,Stop Watch,Complete Calendar,ChronographWater Resistance Depth: 3BarCase Shape: RoundMovement: Dual DisplayBrand Name: GOLDENHOURClasp Type: BuckleCase Material: Stainless SteelBoxes \u0026amp; Cases Material: No packageStyle: SportDial Diameter: 45mmBand Material Type: NylonGender: MenModel Number: GH-103CDial Window Material Type: HardlexBand Width: 22mm\nPlease allow 10-17 days for shipping. Only available for a LIMITED TIME, so get yours TODAY!","variant_title":"Black","variant_options":["Black"]},{"id":12219456979007,"properties":null,"quantity":22,"variant_id":12219456979007,"key":"12219456979007:d359a9a0d3157372f428d11daa57bf3b","title":"Fashion montre femme quartz watch - watch box \/ China","price":2000,"original_price":2000,"discounted_price":2000,"line_price":44000,"original_line_price":44000,"total_discount":0,"discounts":[],"sku":"5427042-watch-box-china","grams":454,"vendor":"bluecore55","taxable":false,"product_id":1310700011583,"gift_card":false,"url":"\/products\/fashion-montre-femme-quartz-watch?variant=12219456979007","image":"https:\/\/cdn.shopify.com\/s\/files\/1\/0021\/2562\/7455\/products\/product-image-509904859.jpg?v=1530888744","handle":"fashion-montre-femme-quartz-watch","requires_shipping":true,"product_type":"","product_title":"Fashion montre femme quartz watch","product_description":"Boxes \u0026amp; Cases Material: No packageCase Material: Stainless SteelClasp Type: BuckleBand Material Type: PUBrand Name: GenviviaBand Length: 21cmMovement: QuartzDial Window Material Type: GlassDial Diameter: 38mmStyle: Fashion \u0026amp; CasualBand Width: 5mmFeature: NoneModel Number: Women WatchesWater Resistance Depth: No waterproofCase Thickness: 5mmCase Shape: RoundDress Wristwatches 2017 Hot Bracelet: Men and Women\'s 2017 Clocks RelojesItem Type: Quartz WristwatchesGender: Women\nPlease allow 10-17 days for shipping. Only available for a LIMITED TIME, so get yours TODAY!","variant_title":"watch box \/ China","variant_options":["watch box","China"]},{"id":12219454324799,"properties":null,"quantity":33,"variant_id":12219454324799,"key":"12219454324799:c1406269582ffca5d39e77321d7a4ca1","title":"High Quality Fashion Leather Strap Rose Gold Women Watch - Black Rose Gold","price":2136,"original_price":2136,"discounted_price":2136,"line_price":70488,"original_line_price":70488,"total_discount":0,"discounts":[],"sku":"6308249-black-rose-gold","grams":454,"vendor":"bluecore55","taxable":false,"product_id":1310699356223,"gift_card":false,"url":"\/products\/high-quality-fashion-leather-strap-rose-gold-women-watch?variant=12219454324799","image":"https:\/\/cdn.shopify.com\/s\/files\/1\/0021\/2562\/7455\/products\/product-image-275761174.jpg?v=1530888731","handle":"high-quality-fashion-leather-strap-rose-gold-women-watch","requires_shipping":true,"product_type":"","product_title":"High Quality Fashion Leather Strap Rose Gold Women Watch","product_description":"Case Shape: RectangleBrand Name: LVPAIClasp Type: Hidden ClaspMovement: QuartzDial Window Material Type: GlassBoxes \u0026amp; Cases Material: PaperBand Material Type: AlloyDial Diameter: 38mmStyle: Fashion \u0026amp; CasualCase Thickness: 6.5mmFeature: NoneModel Number: LP041Water Resistance Depth: No waterproofBand Width: 16mmBand Length: 24.2cmCase Material: Alloy3. Watch: Wristwatch Clock4. Material: Alloy Stainless Steel5. Movement: Quartz Watch6.Hot Search Word: Women watch Business Whatch7. Gender: Women Female Lady Girl8.Top Search Words: Quartz Watch Women Watch9.Top Search Words: Hot Sale Women Cheap Luxury Watches Watch 100pcs10.Top Search Words: Women Wristwatch Gift Dress Watches New Arrive Hot saleItem Type: Quartz WristwatchesGender: Women\nPlease allow 10-17 days for shipping. Only available for a LIMITED TIME, so get yours TODAY!","variant_title":"Black Rose Gold","variant_options":["Black Rose Gold"]},{"id":12219493646399,"properties":null,"quantity":7,"variant_id":12219493646399,"key":"12219493646399:495275dd11d988e53e9a510a8bbfb076","title":"CMK Luxury Stainless Steel Men\'s Watch - white men","price":2227,"original_price":2227,"discounted_price":2227,"line_price":15589,"original_line_price":15589,"total_discount":0,"discounts":[],"sku":"15460607-white-men","grams":454,"vendor":"bluecore55","taxable":false,"product_id":1310720131135,"gift_card":false,"url":"\/products\/new-fashion-stainless-steel-watch-for-men?variant=12219493646399","image":"https:\/\/cdn.shopify.com\/s\/files\/1\/0021\/2562\/7455\/products\/product-image-633589566.jpg?v=1530889295","handle":"new-fashion-stainless-steel-watch-for-men","requires_shipping":true,"product_type":"Stainless Steel Watch for Men","product_title":"CMK Luxury Stainless Steel Men\'s Watch","product_description":"\n\n\nBrand Name: CMK\n\nCase Shape: Round\n\nBand Width: 18mm\n\nBand Material Type: Leather\n\nDial Diameter: 40mm\n\nStyle: Fashion \u0026amp; Casual\n\nCase Thickness: 8.8mm\n\nClasp Type: Buckle\n\nCase Material: Stainless Steel\n\nBoxes \u0026amp; Cases Material: No package\n\nMovement: Quartz\n\nFeature: None\n\nWater Resistance Depth: No waterproof\n\nModel Number: sanjiaoxing\n\nBand Length: 22cm\n\nDial Window Material Type: Glass\n\nClasp Type: Leather Deployment Bucket\n\nPlease allow 10-17 days for shipping. Only available for a LIMITED TIME, so get yours TODAY!","variant_title":"white men","variant_options":["white men"]},{"id":13361978769471,"properties":null,"quantity":16,"variant_id":13361978769471,"key":"13361978769471:9f4ca2ccc9d2c7a06f230f5e4c4d9d2e","title":"Bella + Canvas 3001 Unisex Short Sleeve Jersey (1 Variants) - Red","price":2999,"original_price":2999,"discounted_price":2999,"line_price":47984,"original_line_price":47984,"total_discount":0,"discounts":[],"sku":"","grams":0,"vendor":"the-dev-studio","taxable":true,"product_id":1517931135039,"gift_card":false,"url":"\/products\/copy-of-copy-of-bella-canvas-3001-unisex-short-sleeve-jersey-1-variants?variant=13361978769471","image":"https:\/\/cdn.shopify.com\/s\/files\/1\/0021\/2562\/7455\/products\/red_ae7506ba-731a-4e86-bde7-28d6c726d16f.PNG?v=1538047664","handle":"copy-of-copy-of-bella-canvas-3001-unisex-short-sleeve-jersey-1-variants","requires_shipping":true,"product_type":"","product_title":"Bella + Canvas 3001 Unisex Short Sleeve Jersey (1 Variants)","product_description":"The Bella+Canvas 3001 t-shirt feels soft and light, with just the right amount of stretch. It\'s comfortable and the unisex cut is flattering for both men and women. We can\'t compliment this shirt enough – it\'s one of our crowd favorites. And it\'s sure to be your next favorite too!\n\n100% combed and ring-spun cotton*\nFabric weight: 4.2 oz (142 g\/m2)\n30 single\nTear-away label\nShoulder-to-shoulder taping\nSide-seamed\n\n*Heather colors are 52% combed and ring-spun cotton\/48% polyester. Athletic and Black Heather are 90% combed and ring-spun cotton\/10% polyester. Ash color is 99% Airlume combed and ring-spun cotton and 1% poly. Prism colors are 99% Airlume combed and ring-spun cotton and 1% poly\nThis product is made on demand. No minimums.\n---\nThe male model is wearing a size M. He\'s 6.2 feet (190 cm) tall, chest circumference 37.7\" (96 cm), waist circumference 33.4\" (85 cm). \nThe female model is wearing a size M. She\'s 5.8 feet (178 cm) tall, chest circumference 34.6\" (88 cm), waist circumference 27.16\" (69 cm), hip circumference 37.7\" (96cm).","variant_title":"Red","variant_options":["Red"]}],"requires_shipping":true,"currency":"USD"}';
        $cart = json_decode($json, true);
        $prodcuts = [];
        foreach ($cart['items'] as $item){
            array_push($prodcuts, $item['product_id']);
        }
           $discounts = App\Discount::where(function ($query) use($prodcuts) {
               for ($i = 0; $i < count($prodcuts); $i++){
                   $query->orwhere('products', 'like',  '%' . $prodcuts[$i] .'%');
               }
           })->get();

            $discounts_price = 0;

           foreach ($cart['items'] as $item) {
               foreach ($discounts as $discount) {
                   $products = json_decode($discount->products, true);
                   $collections = json_decode($discount->collections, true);
                   $rules = json_decode($discount->conditions, true);
                   $rules = array_reverse($rules);
                   if (in_array($item['product_id'], $products)) {
                      $item_qty = $item['quantity'];
                      $price = $item['price'];
                      foreach($rules as $rule){
                          if($item_qty >= $rule['0']){
                              echo $item['product_title'].'('.$item_qty.')'.'('.$price.')'.' - '.$discount->offer_name.' '.$discount->conditions.'<br>';
                              $discount_price = 0;
                              if($rule['2'] == 'percent'){
                                  $discount_price = $item_qty * ($price * ($rule['1']/100));
                              }elseif ($rule['2'] == 'off'){
                                  $discount_price = $item_qty * $rule['1'];
                              }elseif ($rule['2'] == 'fixed'){
                                  $discount_price = $item_qty * ($price - $rule['1']);
                              }
                              $discounts_price = $discounts_price + $discount_price;
                              echo '<hr>';
                                break;
                          }
                      }
                   }
               }
           }

//           echo $discounts_price;

           $shopify = App::make('ShopifyAPI', [
               'API_KEY' => env('SHOPIFY_APIKEY'),
               'API_SECRET' => env('SHOPIFY_SECRET'),
               'SHOP_DOMAIN' => session('shopurl'),
               'ACCESS_TOKEN' => session('accessToken')
           ]);

           // CREATE A PRICE RULE FOR DISCOUNT
           $result = $shopify->call([
               'METHOD' => 'POST',
               'URL' => '/admin/price_rules.json',
               'DATA' => [
                   'price_rule' => [
                       "title" => "discountappcode",
                       "target_type" => "line_item",
                       "target_selection" => "entitled",
                       "allocation_method" => "across",
                       "value_type" => "fixed_amount",
                       "value" => "-".$discounts_price/100,
                       "customer_selection" => "all",
                       "entitled_product_ids" => $prodcuts,
                       "starts_at" => "2017-01-19T17:59:10Z"
                   ]
               ]
           ]);
//
           $today = date('YmdHi');
           $startDate = date('YmdHi', strtotime('2012-03-14 09:06:00'));
           $range = $today - $startDate;
           $rand = rand(0, $range);
//
//
           $price_rule_id = $result->price_rule->id;
           $result = $shopify->call([
               'METHOD' => 'POST',
               'URL' => 'price_rules/' . $price_rule_id . '/discount_codes.json',
               'DATA' => [
                   'discount_code' => [
                       "id" => $price_rule_id,
                       "code" => 'bulk_'.$rand
                   ]
               ]
           ]);

           dd($result);

    }

       public function installScript(){
           $shopify = App::make('ShopifyAPI', [
               'API_KEY' => env('SHOPIFY_APIKEY'),
               'API_SECRET' => env('SHOPIFY_SECRET'),
               'SHOP_DOMAIN' => session('shopurl'),
               'ACCESS_TOKEN' => session('accessToken')
           ]);
//                $assets = $shopify->call([
//                'METHOD' => 'POST',
//                'URL' => '/admin/script_tags.json',
//                'DATA' => '{
//                    "script_tag": {
//                      "event": "onload",
//                      "src": "https://ahmadnaeem.co/indexx.js",
//                      "display_scope": "all"
//                    }
//                  }'
//            ]);
           $assets = $shopify->call([
               'METHOD' => 'GET',
               'URL' => '/admin/script_tags.json'
           ]);
                dd($assets);
       }

       public function logout(){
           session()->flush();
           return redirect(route('index'));
       }
}
