<?php namespace N1n7aXIII\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class BlogItem extends Model {

    public function category()
    {
        return $this->belongsTo('N1n7aXIII\Blog\Models\BlogCategory', 'category_id');
    }

    public function thumbnail()
    {
        return asset(config('blog.thumb_asset_url').'/'.$this->thumbnail);
    }

    public function getFileUrl()
    {
        return asset(config('blog.file_asset_url'));
    }

}
