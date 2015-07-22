<?php namespace N1n7aXIII\Blog\Requests;

use App\Http\Requests\Request;

class BlogItemRequest extends Request {

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
                'title' => 'required|unique:blog_items',
                'alias' => 'unique:blog_items',
                'thumbnail' => 'image|max:10000',
            ];

        // For other (PUT, PATCH) methods.
        return [
            'title' => 'required|unique:blog_items,title,'.$this->route()->getParameter('n1n7a_blog_item')->id,
            'alias' => 'unique:blog_items,alias,'.$this->route()->getParameter('n1n7a_blog_item')->id,
            'thumbnail' => 'image|max:10000',
        ];
    }

}
