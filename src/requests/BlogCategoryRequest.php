<?php namespace N1n7aXIII\Blog\Requests;

use App\Http\Requests\Request;

class BlogCategoryRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // For create method.
        if ($this->method() == 'POST')
            return [
                'name' => 'required|unique:blog_categories',
                'alias' => 'unique:blog_categories',
                'thumbnail' => 'image|max:10000',
            ];

        // For other (PUT, PATCH) methods.
        return [
            'name' => 'required|unique:blog_categories,name,'.$this->route()->getParameter('n1n7a_blog_category')->id,
            'alias' => 'unique:blog_categories,alias,'.$this->route()->getParameter('n1n7a_blog_category')->id,
            'thumbnail' => 'image|max:10000',
        ];
    }

}
