<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Resources\Admin\FieldResource;
use App\Models\Category;
use App\Models\Field;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->with('fields')->get();

        return response()->json($categories);

    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->name;
        $category->active = $request->active;
        $category->save();
        return response()->json('ok');

    }

    public function show($id)
    {
        $cat = Category::findOrFail($id);

        return new CategoryResource($cat);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->name;
        $category->active = $request->active;
        $category->save();

        return response()->json('ok');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json('u fshij');
    }

    public function addSub(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if ($category->parent_id > 0){
            return response()->json('nuk');
        }

        Category::create([
            'parent_id' => $id,
            'name' => $request->name,
            'slug' => $request->name,
            'active' => $request->active,
        ]);

        return response()->json('ok');
    }

    public function addField(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $field = Field::findOrFail($request->field_id);
        $exist = $category->fields->contains($field);
        if (!$exist) {
            $category->fields()->attach($field->id);
            return response()->json('ok');
        }
        return response()->json('not');
    }
    public function detach(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $field = Field::findOrFail($request->field_id);

        $category->fields()->detach($field->id);

        return response()->json('ok');
    }

    public function fields($id)
    {
        $category = Category::findOrFail($id);
        if ($category->parent_id != 0) {
            $parent = Category::findOrFail($category->parent_id);
            $fields = $category->fields;
            $pf = $parent->fields;
            $mrg = $fields->merge($pf);
            return FieldResource::collection($mrg);
        }
        $fields = $category->fields;
        return FieldResource::collection($fields);
    }

    public function subs($id)
    {
        $category = Category::findOrFail($id);
        if ($category->parent_id = 0) {
            return response()->json();
        }
       return $category->children;

    }
}
