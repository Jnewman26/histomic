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
        $cartid = Auth::user()->CART_ID;
        $total = $request->input('SALES_TOTAL');
        $genre = $request->input('COMIC_GENRE');
        $title = $request->input('COMIC_TITLE');
        $comicId = $request->input('COMIC_ID');
        $salesid = $request->input('SALES_ID');

        // Lakukan validasi input jika diperlukan

        // Temukan penjualan berdasarkan ID
        $sales = Sales::find($salesid);

        // Update status penjualan
        $sales->SALES_STATUS = 'Paid';
        $sales->save();

        // Hapus data dari tabel CART_DETAIL
        DB::table('cart_detail')->where('CART_ID', $cartid)->delete();

        return redirect()->route('libraryreader')->with('message', 'Terima kasih telah melakukan pembayaran');
    }
}
