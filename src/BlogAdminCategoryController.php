<?php namespace N1n7aXIII\Blog;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use N1n7aXIII\Blog\Models\BlogCategory;
use N1n7aXIII\Blog\Requests\BlogCategoryRequest;

use Illuminate\Http\Request;

class BlogAdminCategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $categories = BlogCategory::all();
		return view('blog::admin.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('blog::admin.category.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param BlogCategoryRequest $request
	 * @return Response
	 */
	public function store(BlogCategoryRequest $request)
	{
		$category = new BlogCategory;
        $this->storeOrUpdateCategory($category, $request);
        return redirect()->route('admin.blog.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  BlogCategory $category
	 * @return Response
	 */
	public function show(BlogCategory $category)
	{
        return view('blog::admin.category.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  BlogCategory $category
	 * @return Response
	 */
	public function edit(BlogCategory $category)
	{
        return view('blog::admin.category.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  BlogCategory $category
     * @param  BlogCategoryRequest $request
	 * @return Response
	 */
	public function update(BlogCategory $category, BlogCategoryRequest $request)
	{
        $this->storeOrUpdateCategory($category, $request);
        return redirect()->route('admin.blog.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  BlogCategory $category
	 * @return Response
	 */
	public function destroy(BlogCategory $category)
	{
        $this->deleteThumb($category);
        $category->delete();
        if (\Request::ajax())
            return '';
        return redirect()->route('admin.blog.index');
	}

    protected function storeOrUpdateCategory(BlogCategory $category, $request)
    {
        $category->name = $request->get('name');
        $category->alias = (str_replace(' ', '-', strtolower($request->get('alias')))) ?: str_replace(' ', '-', strtolower($request->get('name')));
        if (!$category->position)
            $category->position = (BlogCategory::all()->count()) + 1;
        $category->save();

        $img_dir = config('blog.thumb_path').'/';
        if (!file_exists($img_dir))
            mkdir($img_dir, 0777, true);

        if ($request->hasFile('thumbnail'))
        {
            $thumb = $request->file('thumbnail');
            if ($thumb->isValid())
            {
                $img_name = 'cat-'.$category->id.'-thumb.'.$thumb->getExtension();
                $img = \Image::make($thumb)->fit(config('blog.category_thumb_width'), config('blog.category_thumb_height'));
                if (file_exists($img_dir.$category->thumbnail))
                    unlink($img_dir.$category->thumbnail);
                $category->thumbnail = $img_name;
                $img->save($img_dir.$img_name, 80);
            }
        }
        if ($request->has('description'))
            $category->description = $request->get('description');
        $category->save();
        return true;
    }

    protected function deleteThumb(BlogCategory $category)
    {
        if ($category->thumbnail && file_exists(config('blog.thumb_path').'/'.$category->thumbnail))
            unlink(config('blog.thumb_path').'/'.$category->thumbnail);
    }

}
