<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public static function getPages($onlyActive=null)
    {
        $cacheKey = 'pages';
        if ($onlyActive) {
            $cacheKey = 'pages.active';
        }
        return \Cache::remember($cacheKey, 1440, function () use ($onlyActive) {
            $page = Page::orderBy('position');

            if ($onlyActive) {
                $page->ofActive();
            }

            return $page->orderBy('position')->orderBy('updated_at', 'asc')->get();
        });
    }

    public static function rebuild()
    {
        \Cache::forget('pages');
        \Cache::forget('pages.active');
        $pages = Page::getPages();

        foreach ($pages as $k => $c) {
            if (($k+1) != $c->position) {
                $c->position = ($k+1);
                $c->save();
            }
        }
    }

    public function setPosition($position)
    {
        $this->position = ($this->position > $position) ? $position-1 : $position;
        $this->save();

        $this->rebuild();
    }

    public function scopeOfActive($query)
    {
        return $query->where('active', 1);
    }
}
