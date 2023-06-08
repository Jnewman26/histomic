<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ComicChapter;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LibraryWriterController extends Controller
{
    public function index()
    {

        $LibraryWriterId = Auth::user()->LIBRARY_WRITER_ID;
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();

        $LibraryWriter = DB::table('user AS u')
            ->leftJoin('library_reader AS lr', 'u.LIBRARY_READER_ID', '=', 'lr.LIBRARY_READER_ID')
            ->leftJoin('sales AS s', 'u.LIBRARY_READER_ID', '=', 's.LIBRARY_READER_ID')
            ->leftJoin('sales_detail AS sd', 's.SALES_ID', '=', 'sd.SALES_ID')
            ->leftJoin('comic AS c', 'sd.COMIC_ID', '=', 'c.COMIC_ID')
            ->leftJoin('library_writer AS lw', 'c.LIBRARY_WRITER_ID', '=', 'lw.LIBRARY_WRITER_ID')
            ->leftJoin(DB::raw('(SELECT u.USER_NAME, lw.USER_ID FROM `user` u, library_writer lw WHERE u.USER_ID = lw.USER_ID) AS subq'), 'lw.USER_ID', '=', 'subq.USER_ID')
            ->select('u.USER_NAME', 'c.COMIC_TITLE', 'c.COMIC_ID', 'c.COMIC_GENRE', 'c.COMIC_COVER')
            ->whereNotNull('c.COMIC_TITLE')
            ->where('lw.LIBRARY_WRITER_ID', $LibraryWriterId)
            ->get();

            $comic = Comic::where('LIBRARY_WRITER_ID', $LibraryWriterId)->get();

        return Inertia::render('Application/LibraryWriter', [
            'LibraryWriter' => $LibraryWriter,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter,
            'activePage' => 'librarywriter',
            'comic' => $comic
        ]);
    }

    public function edit($COMIC_ID)
    {
        $comic = Comic::find($COMIC_ID);
        return Inertia::render('Application/EditComic', [
            'comic' => $comic
        ]);
    }
    
    public function update(Request $request, string $COMIC_ID)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'price' => 'required',
        ]);
    
        Comic::where('COMIC_ID', $COMIC_ID)
            ->update([
                'COMIC_TITLE' => $request->title,
                'COMIC_GENRE' => $request->genre,
                'COMIC_PRICE' => $request->price,
            ]);
    
        // Redirect to the desired page after updating the comic
        return redirect('/librarywriter');
    }
}