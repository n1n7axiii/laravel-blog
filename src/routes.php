<?php

/*
 * todo
 * the middleware auth.admin is from another dependent package.
 * the javascript and layouts.master-admin is also from another dependent package.
 * The administrator package should include summernote js for text editor.
 */

Route::bind('n1n7a_blog_category', function ($value)
{
    return \N1n7aXIII\Blog\Models\BlogCategory::where('alias', $value)->orWhere('id', $value)->first();
});
Route::bind('n1n7a_blog_item', function ($value)
{
    return \N1n7aXIII\Blog\Models\BlogItem::where('alias', $value)->orWhere('id', $value)->first();
});


/* For Admin */
if (config('blog.admin_route'))
{
    Route::group(['prefix' => config('blog.admin_path'), 'namespace' => 'N1n7aXIII\Blog', 'middleware' => 'auth.admin'], function ()
    {
        Route::get('blog', ['as' => 'admin.blog.index', 'uses' => 'BlogAdminCategoryController@index']);
        Route::get('blog/category/create', ['as' => 'admin.blog.category.create', 'uses' => 'BlogAdminCategoryController@create']);
        Route::post('blog/category/store', ['as' => 'admin.blog.category.store', 'uses' => 'BlogAdminCategoryController@store']);
        Route::get('blog/category/{n1n7a_blog_category}', ['as' => 'admin.blog.category.show', 'uses' => 'BlogAdminCategoryController@show']);
        Route::get('blog/category/edit/{n1n7a_blog_category}', ['as' => 'admin.blog.category.edit', 'uses' => 'BlogAdminCategoryController@edit']);
        Route::put('blog/category/update/{n1n7a_blog_category}', ['as' => 'admin.blog.category.update', 'uses' => 'BlogAdminCategoryController@update']);
        Route::delete('blog/category/destroy/{n1n7a_blog_category}', ['as' => 'admin.blog.category.destroy', 'uses' => 'BlogAdminCategoryController@destroy']);

        Route::get('blog/{n1n7a_blog_category}/item/create', ['as' => 'admin.blog.item.create', 'uses' => 'BlogAdminItemController@create']);
        Route::post('blog/{n1n7a_blog_category}/item/store', ['as' => 'admin.blog.item.store', 'uses' => 'BlogAdminItemController@store']);
        Route::get('blog/{n1n7a_blog_category}/item/edit/{n1n7a_blog_item}', ['as' => 'admin.blog.item.edit', 'uses' => 'BlogAdminItemController@edit']);
        Route::put('blog/{n1n7a_blog_category}/item/update/{n1n7a_blog_item}', ['as' => 'admin.blog.item.update', 'uses' => 'BlogAdminItemController@update']);
        Route::delete('blog/{n1n7a_blog_category}/item/destroy/{n1n7a_blog_item}', ['as' => 'admin.blog.item.destroy', 'uses' => 'BlogAdminItemController@destroy']);
    });
}

if (config('blog.public_route'))
{
    Route::group(['prefix' => config('blog.public_path'), 'namespace' => 'N1n7aXIII\Blog\Controllers'], function ()
    {
        Route::get('/', ['as' => 'blog.index', 'uses' => 'BlogController@index']);
        Route::get('/{n1n7a_blog_category}', ['as' => 'blog.show.category', 'uses' => 'BlogController@showCategory']);
        Route::get('/{n1n7a_blog_category}/{n1n7a_blog_item}', ['as' => 'blog.show.item', 'uses' => 'BlogController@showBlog']);
    });
}