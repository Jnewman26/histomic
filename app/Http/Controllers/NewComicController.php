<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewComicController extends Controller
{
    public function index()
    {
        return Inertia::render('Application/NewComic', [

        ]);
    }

    public function save(Request $request, string $COMIC_ID)
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
    
        return redirect('/newcomic');
    }
}
