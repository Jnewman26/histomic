<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicChapter extends Model
{
    use HasFactory;

    protected $table = 'chapter';

    public function comic()
    {
        return $this->belongsTo(Comic::class, 'COMIC_ID', 'COMIC_ID');
    }

    public static function getCombinedData()
    {
        $CombinedData = ComicChapter::leftJoin('comic as c', 'c.COMIC_ID', '=', 'chapter.COMIC_ID')
            ->leftJoin('user as u', 'u.LIBRARY_WRITER_ID', '=', 'c.LIBRARY_WRITER_ID')
            ->select(
                'c.COMIC_ID',
                'c.LIBRARY_WRITER_ID',
                'c.COMIC_TITLE',
                'c.COMIC_GENRE',
                'c.COMIC_COVER',
                'c.COMIC_RELEASE',
                'c.COMIC_STATUS',
                'c.COMIC_PRICE',
                'chapter.CHAPTER_ID',
                'chapter.CHAPTER_NAME',
                'chapter.CHAPTER_DESC',
                'chapter.CHAPTER_RELEASE',
                'u.USER_NAME'
            )
            ->get();

        return $CombinedData;
    }
}
