<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function index()
    {
        $libr = Auth::user()->LIBRARY_READER_ID;

        $checkout = DB::table('user AS u')
            ->select('u.USER_NAME', 'c.COMIC_TITLE', 'c.COMIC_GENRE', 'c.COMIC_COVER', 'c.COMIC_ID', 'c.COMIC_PRICE', 's.SALES_TOTAL', 'u.LIBRARY_READER_ID', 's.SALES_ID')
            ->leftJoin('sales AS s', 'u.LIBRARY_READER_ID', '=', 's.LIBRARY_READER_ID')
            ->leftJoin('sales_detail AS sd', 's.SALES_ID', '=', 'sd.SALES_ID')
            ->leftJoin('comic AS c', 'sd.COMIC_ID', '=', 'c.COMIC_ID')
            ->where('s.SALES_STATUS', '=', 'Unpaid')
            ->where('u.LIBRARY_READER_ID', '=', $libr)
            ->get();

        return Inertia::render('Application/Checkout', [
            'checkout' => $checkout
        ]);
    }

    public function store(Request $request)
    {
        $librId = Auth::user()->LIBRARY_READER_ID;
        $name = Auth::user()->USER_NAME;
        $cartid = Auth::user()->CART_ID;
        $total = $request->input('SALES_TOTAL');
        $genre = $request->input('COMIC_GENRE');
        $title = $request->input('COMIC_TITLE');
        $comicId = $request->input('COMIC_ID');
        $salesid = $request->input('SALES_ID');

        $sales = Sales::find($salesid);

        $sales->SALES_STATUS = 'Paid';
        $sales->save();

        // Hapus data dari tabel CART_DETAIL
        DB::table('cart_detail')->where('CART_ID', $cartid)->delete();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $salesid,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $name,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return redirect()->route('libraryreader')->with('message', 'Terima kasih telah melakukan pembayaran');
    }
}
