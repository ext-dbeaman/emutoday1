<?php

namespace emutoday\Http\Requests;

use emutoday\Http\Requests\Request;

class StoreStoryRequest extends Request
{
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
        $rules = $this->rules;
        $storytype = $this->input('story_type');
        if ($storytype == 'external') {
            $rules['title'] = 'required';
            $rules['external_link'] = 'required';
        } else {
            $rules['title'] = 'required';
            $rules['slug'] = 'required';
            $rules['content'] = 'required';
        }
        return $rules;
    }

    //     return [
    //            'title' => ['required'],
    //             'slug' => ['required'],
    //             'story_type' => ['required'],
    //             'content' => ['required_unless:story_type,storyexternal'],
    //             'published_at' => ['date_format:Y-m-d H:i:s']
    //
    //     ];
    // }
}
