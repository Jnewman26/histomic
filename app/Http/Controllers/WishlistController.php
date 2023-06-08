<?php

namespace App\Http\Controllers;

use App\Models\WishlistDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistId = Auth::user()->WISHLIST_ID;

        $Wishlist = DB::table('wishlist_detail AS wd')
            ->select('wd.WISHLIST_ID', 'u.USER_NAME', 'c.*')
            ->leftJoin('comic AS c', 'wd.comic_id', '=', 'c.comic_id')
            ->leftJoin('library_writer AS lw', 'c.LIBRARY_WRITER_ID', '=', 'lw.LIBRARY_WRITER_ID')
            ->leftJoin('user AS u', 'lw.user_id', '=', 'u.user_id')
            ->where('wd.COMIC_ID', '=', DB::raw('c.COMIC_ID'))
            ->where('c.LIBRARY_WRITER_ID', '=', DB::raw('lw.LIBRARY_WRITER_ID'))
            ->where('lw.USER_ID', '=', DB::raw('u.USER_ID'))
            ->where('wd.WISHLIST_ID', '=', $wishlistId)
            ->get();
        return Inertia::render('Application/Wishlist', [
            'Wishlist' => $Wishlist,
            'activePage' => 'wishlist',
        ]);
    }

    public function wishlistindex(Request $request)
    {
        $comicId = $request->input('comicId');
        $wishlistId = Auth::user()->WISHLIST_ID;

        $existingEntry = WishlistDetail::where('COMIC_ID', $comicId)
            ->where('WISHLIST_ID', $wishlistId)
            ->first();

        if ($existingEntry) {
            // Hapus entri jika sudah ada
            $existingEntry->delete();

            return Redirect::route('index')->with('message', 'Successfully removed from wishlist');
        }

        $wishlistDetail = new WishlistDetail();
        $wishlistDetail->COMIC_ID = $comicId;
        $wishlistDetail->WISHLIST_ID = $wishlistId;

        $wishlistDetail->save();

        return Redirect::route('index')->with('message', 'Comic Added to Wishlist Successfully');
    }

    public function removewish(Request $request)
    {
        $comicId = $request->input('comicId');
        $wishlistId = Auth::user()->WISHLIST_ID;

        $wishlistDetail = WishlistDetail::where('COMIC_ID', $comicId)
            ->where('WISHLIST_ID', $wishlistId)
            ->firstOrFail();

        $wishlistDetail->delete();

        return redirect()->route('index')->with('message', 'Comic Removed from Wishlist Successfully');
    }
}
