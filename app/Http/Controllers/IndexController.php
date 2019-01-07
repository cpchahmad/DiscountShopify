<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Session;
use Oseintow\Shopify\Shopify;
use RocketCode\Shopify\API;
use Mail;


class IndexController extends Controller
{
    public function auth(Request $request){
        $shop = $request->shop;
        $timestamp = $request->timestamp;
        $hmac = $request->hmac;
        $accesstoken = $request->accessToken;
        session()->flush();
        session()->regenerate();
        if (App\Shop::where('name',$shop)->exists()) {
            $current = App\Shop::where('name', $shop)->first();
            session(['shopurl' => $current->name]);
            session(['accessToken' => $current->access_token]);
            return redirect()->route('dashboard');
        } else {
            $sshop = new App\Shop();
            $sshop->name = $shop;
            $sshop->access_token=$accesstoken;
            $sshop->hmac=$hmac;
            $sshop->status=1;
            $sshop->save();
            if ($sshop) {
                $current = App\Shop::where('name', $shop)->first();
                session(['shopurl' => $current->name]);
                session(['accessToken' => $current->access_token]);
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('index');
            }
        }
    }
}
