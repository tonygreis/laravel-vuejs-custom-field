<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\FieldPost;
use App\Models\Post;
use Illuminate\Http\Request;

trait CategoryFieldTrait {
    public function createPostFieldsValues(Post $post, Request $request)
    {
        $postValues = [];

        if (empty($post)) {
            return $postValues;
        }

        // Delete all old PostValue entries, if exist
        $oldPostValues = FieldPost::with(['field'])->where('post_id', $post->id)->get();
        if ($oldPostValues->count() > 0) {
            foreach ($oldPostValues as $oldPostValue) {
                $oldPostValue->delete();
            }
        }

        // Get Category's Fields details
        $category = Category::findOrFail($post->category_id);
        $fields = $category->fields;
        if ($category->parent_id != 0) {
            $parent = Category::findOrFail($category->parent_id);
            $fields = $parent->fields->merge($fields);
        }
        if ($fields->count() > 0) {
            foreach ($fields as $field) {
                if ($request->filled($field->id)) {
                    if ($field->type === 'text') {
                        // Get the input
                        $input = $request->input( $field->id);
                            $postValueInfo = [
                                'post_id'   => $post->id,
                                'field_id'  => $field->id,
                                'option_id' => null,
                                'value'     => $input,
                            ];

                            $newPostValue = new FieldPost($postValueInfo);
                            $newPostValue->save();
                    } else {
                        // Get the input
                        $input = $request->input( $field->id);
                        $postValueInfo = [
                            'post_id'  => $post->id,
                            'field_id' => $field->id,
                            'option_id' => $input,
                            'value'    => null,
                        ];

                        $newPostValue = new FieldPost($postValueInfo);
                        $newPostValue->save();
                    }
                }
            }
        }

        return $postValues;
    }
}
