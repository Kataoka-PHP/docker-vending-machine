<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductMaster;
use App\SalesLog;
use App\Stock;

class ProductMastersController extends Controller
{
    /**
     * 投入金額及び商品の一覧を表示する
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input_amount = $request->session()->get('input_amount');
        $product_masters = ProductMaster::with('stocks')->get();
        return view('index', ['product_masters' => $product_masters, 'input_amount' => (int)$input_amount]);
    }

    /**
     * 投入金額の処理を行う
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function processInputAmount(Request $request)
    {
        if (isset($_POST['returned_amount'])) {
            $request->session()->put('input_amount', 0);
            $request->session()->flash('return_of_change', 'おつりが返却されました');
            return redirect('/');
        } else {
            $input_amount = 0;
            if (isset($_POST['10yen'])) {
                $input_amount = 10;
            } elseif (isset($_POST['50yen'])) {
                $input_amount = 50;
            } elseif (isset($_POST['100yen'])) {
                $input_amount = 100;
            } elseif (isset($_POST['500yen'])) {
                $input_amount = 500;
            } elseif (isset($_POST['1000yen'])) {
                $input_amount = 1000;
            } elseif (isset($_POST['2000yen'])) {
                $input_amount = 2000;
            }
            $request->session()->increment('input_amount', $input_amount);
            $total_input_amount = $request->session()->get('input_amount');
            if ($total_input_amount < 9999) {
                $messageKey = 'input_amount_message';
                $flashMessage = $input_amount.'円が投入されました';
            } else {
                $request->session()->put('input_amount', 9999);
                $messageKey = 'input_amount_error_message';
                $input_limit_amount = 9999;
                $flashMessage = '投入金額の上限は、￥'.$input_limit_amount.'です';
            }
            return redirect('/')->with($messageKey, $flashMessage);
        }
    }

    /**
     * 購入商品の処理を行う
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function processProductPurchase(Request $request)
    {
        $input_amount = $request->session()->get('input_amount');
        if ($input_amount >= $request->product_price) {
            $sales_log = new SalesLog;
            $sales_log->product_master_id = $request->id;
            $sales_log->purchase_price = $request->product_price;
            $sales_log->purchase_time = $request->purchase_time;
            $sales_log->save();
            Stock::where('id', $request->id)->decrement('stock');
            //二重送信防止
            $request->session()->regenerateToken();
            $request->session()->decrement('input_amount', $request->product_price);
            $message_key = $request->product_name.'を購入しました';
            $request->session()->flash('product_purchase_success_message', $message_key);
            return redirect('processRemainingAmount');
        } else {
            $message_key = '投入金額が不足しています';
            return redirect('/')->with('product_purchase_error_message', $message_key);
        }
    }

    /**
     * 残額によって処理を変える
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function processRemainingAmount(Request $request)
    {
        $input_amount = $request->session()->get('input_amount');
        $cheapest_products = ProductMaster::min('price');
        $request->session()->reflash();
        if ($input_amount > 0 && $input_amount < $cheapest_products) {
            $request->session()->put('input_amount', 0);
            $message_key = '残額が返却されました';
            return redirect('/')->with('returned_amount_message', $message_key);
        } else {
            return redirect('/');
        }
    }
}
