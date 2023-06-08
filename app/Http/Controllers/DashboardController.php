<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use App\Models\ComicChapter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $comicList = Comic::orderBy('COMIC_RELEASE', 'desc')->get();
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        return Inertia::render('Application/Dashboard', [
            'ComicList' => $comicList,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter,
            'activePage' => 'dashboard',
        ]);
    }
}