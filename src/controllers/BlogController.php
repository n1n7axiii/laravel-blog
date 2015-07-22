<?php namespace N1n7aXIII\Blog\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use N1n7aXIII\Blog\Models\BlogItem;
use N1n7aXIII\Blog\Models\BlogCategory;

class BlogController extends Controller {

    public function __construct()
    {
        $this->layout_master_exists = view()->exists('layouts.master');
    }

    public function index()
    {
        $categories = BlogCategory::all();
        $layout_master_exists = $this->layout_master_exists;
        return view('blog::index', compact('categories', 'layout_master_exists'));
    }

    public function showCategory(BlogCategory $category)
    {
        $layout_master_exists = $this->layout_master_exists;
        $blogs = $category->items()->paginate(config('blog.blog_per_page'));
        return view('blog::category', compact('category', 'blogs', 'layout_master_exists'));
    }

    public function showBlog(BlogCategory $category, BlogItem $blog)
    {
        $layout_master_exists = $this->layout_master_exists;
        return view('blog::blog', compact('category', 'blog', 'layout_master_exists'));
    }

}