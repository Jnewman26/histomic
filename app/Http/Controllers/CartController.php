<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\Sales;
use App\Models\SalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartId = Auth::user()->CART_ID;

        $CartList = DB::table('cart_detail as cd')
            ->select('cd.CART_ID', 'u.USER_NAME', 'c.*')
            ->leftJoin('comic as c', 'cd.comic_id', '=', 'c.comic_id')
            ->leftJoin('library_writer as lw', 'c.LIBRARY_WRITER_ID', '=', 'lw.LIBRARY_WRITER_ID')
            ->leftJoin('user as u', 'lw.user_id', '=', 'u.user_id')
            ->where([
                ['cd.COMIC_ID', '=', DB::raw('c.COMIC_ID')],
                ['c.LIBRARY_WRITER_ID', '=', DB::raw('lw.LIBRARY_WRITER_ID')],
                ['lw.USER_ID', '=', DB::raw('u.USER_ID')],
                ['cd.CART_ID', '=', $cartId]
            ])
            ->get();

        return Inertia::render('Application/Cart', [
            'CartList' => $CartList,
            'activePage' => 'cart',
        ]);
    }

    public function cartindex(Request $request)
    {
        $comicId = $request->input('comicId');
        $cartId = Auth::user()->CART_ID;

        // Periksa apakah entri sudah ada sebelum menambahkannya
        $existingEntry = CartDetail::where('COMIC_ID', $comicId)
            ->where('CART_ID', $cartId)
            ->first();

        if ($existingEntry) {
            // Hapus entri jika sudah ada
            $existingEntry->delete();

            return Redirect::route('cart')->with('message', 'Successfully removed from cart');
        }

        // Buat instance baru dari model CartDetail
        $CartDetail = new CartDetail();

        // Set nilai kolom COMIC_ID dan CART_ID
        $CartDetail->COMIC_ID = $comicId;
        $CartDetail->CART_ID = $cartId;

        // Simpan data ke dalam tabel CART_detail
        $CartDetail->save();

        return Redirect::route('cart')->with('message', 'Comic Added to Cart Successfully');
    }

    public function store(Request $request)
    {

        $currentDate = now();
        $librId = Auth::user()->LIBRARY_READER_ID;
        $total = $request->input('COMIC_PRICE');
        $genre = $request->input('COMIC_GENRE');
        $cover = $request->input('COMIC_COVER');
        $title = $request->input('COMIC_TITLE');
        $comicId = $request->input('COMIC_ID');

        // dd($comicId);

        // sales_id
        $salesId = DB::selectOne('SELECT generate_sales_id(?) AS sales_id', [$currentDate])->sales_id;

        $post = $request->all();
        $post['SALES_ID'] = $salesId;
        $post['LIBRARY_READER_ID'] = $librId;
        $post['SALES_TOTAL'] = $total + 250000;
        $post['SALES_DATE'] = $currentDate;
        $post['SALES_STATUS'] = 'Unpaid';
        Sales::create($post);

        $post = $request->all();
        $post['COMIC_ID'] = $comicId;
        $post['SALES_ID'] = $salesId;
        $post['TESTIMONY_ID'] = $salesId;
        // $post['TESTIMONY_DESC'] = '0';
        // $post['STAR_TESTIMONY'] = '0';
        SalesDetail::create($post);

        return redirect()->route('checkout')->with('message', 'Silahkan melakukan pembayaran');
    }
}
