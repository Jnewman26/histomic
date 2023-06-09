<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use App\Models\ComicChapter;
use App\Models\WishlistDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        $ComicList = Comic::all();

        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();

        $ComicListAction = Comic::where('COMIC_GENRE', 'action')->take(12)->get();
        $ComicListFantasy = Comic::where('COMIC_GENRE', 'fantasy')->take(12)->get();
        $ComicListAdventure = Comic::where('COMIC_GENRE', 'Adventure')->take(12)->get();
        $ComicListMystery = Comic::where('COMIC_GENRE', 'Mystery')->take(12)->get();
        $ComicListSuperhero = Comic::where('COMIC_GENRE', 'Superhero')->take(12)->get();
        $ComicListRomance = Comic::where('COMIC_GENRE', 'Romance')->take(12)->get();

        $wishlistId = null;
        if (Auth::check()) {
            $wishlistId = Auth::user()->WISHLIST_ID;
        }

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

        // conditional owner and writer
        $LibraryReaderId = null;
        if (Auth::check()) {
            $LibraryReaderId = Auth::user()->WISHLIST_ID;
        }
        $LibraryWriterId = null;
        if (Auth::check()) {
            $LibraryWriterId = Auth::user()->WISHLIST_ID;
        }

        $LibraryReader = DB::table('user AS u')
            ->leftJoin('library_reader AS lr', 'u.LIBRARY_READER_ID', '=', 'lr.LIBRARY_READER_ID')
            ->leftJoin('sales AS s', 'u.LIBRARY_READER_ID', '=', 's.LIBRARY_READER_ID')
            ->leftJoin('sales_detail AS sd', 's.SALES_ID', '=', 'sd.SALES_ID')
            ->leftJoin('comic AS c', 'sd.COMIC_ID', '=', 'c.COMIC_ID')
            ->leftJoin('library_writer AS lw', 'c.LIBRARY_WRITER_ID', '=', 'lw.LIBRARY_WRITER_ID')
            ->leftJoin(DB::raw('(SELECT u.USER_NAME, lw.USER_ID FROM `user` u LEFT JOIN library_writer lw ON u.USER_ID = lw.USER_ID) AS subq'), 'lw.USER_ID', '=', 'subq.USER_ID')
            ->select('u.USER_NAME', 'c.COMIC_TITLE', 'c.COMIC_GENRE', 'c.COMIC_COVER', 'c.COMIC_ID', 's.SALES_ID')
            ->whereNotNull('c.COMIC_TITLE')
            ->where('lr.LIBRARY_READER_ID', '=', $LibraryReaderId)
            ->where('s.SALES_STATUS', '=', 'Paid')
            ->get();

        $LibraryWriter = DB::table('user AS u')
            ->leftJoin('library_reader AS lr', 'u.LIBRARY_READER_ID', '=', 'lr.LIBRARY_READER_ID')
            ->leftJoin('sales AS s', 'u.LIBRARY_READER_ID', '=', 's.LIBRARY_READER_ID')
            ->leftJoin('sales_detail AS sd', 's.SALES_ID', '=', 'sd.SALES_ID')
            ->leftJoin('comic AS c', 'sd.COMIC_ID', '=', 'c.COMIC_ID')
            ->leftJoin('library_writer AS lw', 'c.LIBRARY_WRITER_ID', '=', 'lw.LIBRARY_WRITER_ID')
            ->leftJoin(DB::raw('(SELECT u.USER_NAME, lw.USER_ID FROM `user` u, library_writer lw WHERE u.USER_ID = lw.USER_ID) AS subq'), 'lw.USER_ID', '=', 'subq.USER_ID')
            ->select('c.COMIC_ID')
            ->whereNotNull('c.COMIC_TITLE')
            ->where('lw.LIBRARY_WRITER_ID', '=', $LibraryWriterId)
            ->get();

        return Inertia::render('Application/Index', [
            'ComicList' => $ComicList,
            'ComicListAction' => $ComicListAction,
            'ComicListFantasy' => $ComicListFantasy,
            'ComicListAdventure' => $ComicListAdventure,
            'ComicListMystery' => $ComicListMystery,
            'ComicListSuperhero' => $ComicListSuperhero,
            'ComicListRomance' => $ComicListRomance,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter,
            'Wishlist' => $Wishlist,
            'LibraryReader' => $LibraryReader,
            'LibraryWriter' => $LibraryWriter
        ]);
    }
}
