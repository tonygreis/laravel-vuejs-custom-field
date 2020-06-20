<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\FieldResource;
use App\Models\Category;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = Field::all();

        return FieldResource::collection($fields);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $field = new Field;
        $field->name = $request->name;
        $field->type = $request->type;
        $field->max = $request->max;
        $field->default = $request->default;
        $field->help = $request->help;
        $field->required = $request->required;
        $field->active = $request->active;

        $field->save();

        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $field = Field::findOrFail($id);

        return new FieldResource($field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $field = Field::findOrFail($id);

        $field->name = $request->name;
        $field->type = $request->type;
        $field->max = $request->max;
        $field->default = $request->default;
        $field->help = $request->help;
        $field->required = $request->required;
        $field->active = $request->active;

        $field->save();

        return response()->json('ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $field = Field::findOrFail($id);
        $field->delete();

        return response()->json('ok');
    }

    public function type()
    {
        $types = Field::FIELD_TYPE;

        return response()->json($types);
    }

    public function attach(Request $request,$id)
    {
        $category = Category::findOrFail($request->category_id);
        $field = Field::findOrFail($id);
        $exist = $field->categories->contains($category);
        if (!$exist) {
            $field->categories()->attach($category);
            return response()->json('ok');
        }
        return response()->json('not');
    }
}
