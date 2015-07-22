<?php namespace N1n7aXIII\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model {

    public function items()
    {
        return $this->hasMany('N1n7aXIII\Blog\Models\BlogItem', 'category_id');
    }

    public function thumbnail()
    {
        return asset(config('blog.thumb_asset_url').'/'.$this->thumbnail);
    }

}
