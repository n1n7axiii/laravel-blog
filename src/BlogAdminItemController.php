<?php namespace N1n7aXIII\Blog;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use N1n7aXIII\Blog\Models\BlogItem;
use N1n7aXIII\Blog\Models\BlogCategory;
use N1n7aXIII\Blog\Requests\BlogItemRequest;

use Illuminate\Http\Request;

class BlogAdminItemController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
     * @param BlogCategory $category
	 * @return Response
	 */
	public function create(BlogCategory $category)
	{
		return view('blog::admin.item.create', compact('category'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param BlogCategory $category
     * @param BlogItemRequest $request
	 * @return Response
	 */
	public function store(BlogCategory $category, BlogItemRequest $request)
	{
		$item = new BlogItem;
        $item->category()->associate($category);
        $this->storeOrUpdateItem($category, $item, $request);
        return redirect()->route('admin.blog.category.show', $category->id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
     * @param  BlogCategory $category
	 * @param  BlogItem $item
	 * @return Response
	 */
	public function edit(BlogCategory $category, BlogItem $item)
	{
		return view('blog::admin.item.edit', compact('category', 'item'));
	}

	/**
	 * Update the specified resource in storage.
	 *
     * @param BlogCategory $category
	 * @param BlogItem $item
     * @param BlogItemRequest $request
	 * @return Response
	 */
	public function update(BlogCategory $category, BlogItem $item, BlogItemRequest $request)
	{
        $this->storeOrUpdateItem($category, $item, $request);
        return redirect()->route('admin.blog.category.show', $category->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
     * @param  BlogCategory $category
	 * @param  BlogItem $item
	 * @return Response
	 */
	public function destroy(BlogCategory $category, BlogItem $item)
	{
        $this->deleteThumbnail($item);
        $item->delete();
        if (\Request::ajax())
            return '';
        return redirect()->route('admin.blog.category.show', $category->id);
	}

    protected function storeOrUpdateItem($category, $item, Request $request)
    {
        $item->title = $request->get('title');
        $item->alias = (str_replace(' ', '-', strtolower($request->get('alias')))) ?: str_replace(' ', '-', strtolower($request->get('title')));
        $item->short_description = $request->get('short_description');
        $item->content = $request->get('content');
        if (!$item->position)
            $item->position = $category->items()->count() + 1;
        $item->highlight = ($request->has('highlight')) ? 1 : 0;
        $item->save();

        $img_dir = config('blog.thumb_path').'/';
        $image = $request->file('thumbnail');
        if ($image && $image->isValid())
        {
            if (isset($item->thumbnail) && $item->thumbnail)
                $this->deleteThumbnail($item);
            $img_name = 'blog-'.$item->id.'-thumb.'.$image->getClientOriginalExtension();
            $img_thumb = \Image::make($image)->fit(config('blog.thumb_width'), config('blog.thumb_height'));
            $img_thumb->save($img_dir.$img_name, 80);
            $item->thumbnail = $img_name;
        }

        $item->save();
    }

    protected function deleteThumbnail($item)
    {
        if ($item->thumbnail && file_exists(config('blog.thumb_path').'/'.$item->thumbnail))
            unlink(config('blog.thumb_path').'/'.$item->thumbnail);
    }

}
