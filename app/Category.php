<?php

namespace App;

use Baum\Node;
use App\Scopes\ActiveScope;
use App\Traits\Uploader;

/**
* Category
*/
class Category extends Node
{
    use Uploader;

    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'categories';

    public function listings()
    {
        return $this->hasMany('App\Listing');
    }

    public function brands()
    {
        return $this->hasManyThrough('App\Brand', 'App\Listing');
    }

    protected static function boot()
    {
        parent::boot();

        if (\Request::segment(1) != 'admin') {
            static::addGlobalScope(new ActiveScope);
        }
    }

    public function reviews()
    {
        $reviews = collect([]);
        $listings = Listing::categorized($this)->get();
        $listings->each(function ($item, $key) use ($reviews) {
            if ($item->reviews) {
                foreach ($item->reviews as $r) {
                    $reviews->push($r);
                }
            }
        });

        return $reviews;
    }

    public function reviews2()
    {
        return $this->hasManyThrough('App\Review', 'App\Listing');
    }

    public function scopePopular($query)
    {
        return $query->where('popular', 1);
    }

    public function getDefaultPictureAttribute()
    {
        return 'default.jpg';
    }

    public static function getMainCategories()
    {
        return (Category::where('parent_id', null)->orderBy('name')->get());
    }

    public function getListings($filter, $limit = 20)
    {
        $data = Listing::categorized($this)->has('reviews')->filter($filter)->paginate($limit);

        return $data;
    }

    public function getTitleAttribute()
    {
        $title = ($this->meta_title) ? $this->meta_title : $this->name;

        if ($this->getLevel()) {
            $title .= ' kategorijos atsiliepimai';
        }

        return $title;
    }

    //////////////////////////////////////////////////////////////////////////////

    //
    // Below come the default values for Baum's own Nested Set implementation
    // column names.
    //
    // You may uncomment and modify the following fields at your own will, provided
    // they match *exactly* those provided in the migration.
    //
    // If you don't plan on modifying any of these you can safely remove them.
    //

    // /**
    //  * Column name which stores reference to parent's node.
    //  *
    //  * @var string
    //  */
    // protected $parentColumn = 'parent_id';

    // /**
    //  * Column name for the left index.
    //  *
    //  * @var string
    //  */
    // protected $leftColumn = 'lft';

    // /**
    //  * Column name for the right index.
    //  *
    //  * @var string
    //  */
    // protected $rightColumn = 'rgt';

    // /**
    //  * Column name for the depth field.
    //  *
    //  * @var string
    //  */
    // protected $depthColumn = 'depth';

    // /**
    //  * Column to perform the default sorting
    //  *
    //  * @var string
    //  */
    // protected $orderColumn = null;

    // /**
    // * With Baum, all NestedSet-related fields are guarded from mass-assignment
    // * by default.
    // *
    // * @var array
    // */
    protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth', 'MAX_FILE_SIZE');

    //
    // This is to support "scoping" which may allow to have multiple nested
    // set trees in the same database table.
    //
    // You should provide here the column names which should restrict Nested
    // Set queries. f.ex: company_id, etc.
    //

    // /**
    //  * Columns which restrict what we consider our Nested Set list
    //  *
    //  * @var array
    //  */
    // protected $scoped = array();

    //////////////////////////////////////////////////////////////////////////////

    //
    // Baum makes available two model events to application developers:
    //
    // 1. `moving`: fired *before* the a node movement operation is performed.
    //
    // 2. `moved`: fired *after* a node movement operation has been performed.
    //
    // In the same way as Eloquent's model events, returning false from the
    // `moving` event handler will halt the operation.
    //
    // Please refer the Laravel documentation for further instructions on how
    // to hook your own callbacks/observers into this events:
    // http://laravel.com/docs/5.0/eloquent#model-events
}
