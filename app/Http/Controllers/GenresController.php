<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use App\Models\ComicChapter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GenresController extends Controller
{
    public function index()
    {
        return Inertia::render('Application/Genres', [
            'activePage' => 'genres',
        ]);
    }

    public function genreaction()
    {
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        $ComicListAction = Comic::where('COMIC_GENRE', 'action')->get();
        return Inertia::render('Application/Genres/GenresAction', [
            'activePage' => 'genres',
            'ComicListAction' => $ComicListAction,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter
        ]);
    }

    public function genrefantasy()
    {
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        $ComicListFantasy = Comic::where('COMIC_GENRE', 'fantasy')->get();
        return Inertia::render('Application/Genres/GenresFantasy', [
            'activePage' => 'genres',
            'ComicListFantasy' => $ComicListFantasy,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter
        ]);
    }

    public function genreAdventure()
    {
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        $ComicListAdventure = Comic::where('COMIC_GENRE', 'Adventure')->get();
        return Inertia::render('Application/Genres/GenresAdventure', [
            'activePage' => 'genres',
            'ComicListAdventure' => $ComicListAdventure,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter
        ]);
    }

    public function genreMystery()
    {
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        $ComicListMystery = Comic::where('COMIC_GENRE', 'Mystery')->get();
        return Inertia::render('Application/Genres/GenresMystery', [
            'activePage' => 'genres',
            'ComicListMystery' => $ComicListMystery,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter
        ]);
    }

    public function genreSuperhero()
    {
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        $ComicListSuperhero = Comic::where('COMIC_GENRE', 'Superhero')->get();
        return Inertia::render('Application/Genres/GenresSuperhero', [
            'activePage' => 'genres',
            'ComicListSuperhero' => $ComicListSuperhero,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter
        ]);
    }

    public function genreRomance()
    {
        $CombinedData = ComicChapter::getCombinedData();
        $Chapter = Chapter::all();
        $ComicListRomance = Comic::where('COMIC_GENRE', 'Romance')->get();
        return Inertia::render('Application/Genres/GenresRomance', [
            'activePage' => 'genres',
            'ComicListRomance' => $ComicListRomance,
            'CombinedData' => $CombinedData,
            'Chapter' => $Chapter
        ]);
    }
}
