<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use App\Models\ComicChapter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComicsController extends Controller
{
    public function index()
    {
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        return Inertia::render('Application/Comics', [
            // 'ComicList' => $ComicList,
            'ComicList' => Comic::orderByDesc('COMIC_RELEASE')->paginate(10),
            'activePage' => 'genres',
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter,
            'activePagebawah' => 'pagination',
        ]);
    }
}