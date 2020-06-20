<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OptionResource;
use App\Models\Field;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($field_id)
    {
        $field = Field::findOrFail($field_id);

        $options = $field->options;

        return OptionResource::collection($options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $field_id)
    {
        $field = Field::findOrFail($field_id);

        $option = new Option;
        $option->field_id = $field->id;
        $option->value = $request->value;

        $field->options()->save($option);
        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($field_id, $id)
    {
        $option = Option::findOrFail($id);
        if ($option->field_id = $field_id){
            return new OptionResource($option);
        }
        return response()->json('ups');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $field_id, $id)
    {
        $field = Field::findOrFail($field_id);
        $option = Option::findOrFail($id);
        $option->update([
           'field_id' => $field->id,
           'value' => $request->value,
        ]);

        return response()->json('ok');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($field_id, $id)
    {
        $field = Field::findOrFail($field_id);
        $option = Option::findOrFail($id);
        if ($option->field_id == $field->id) {
            $option->delete();
        }
        return response()->json('ok');
    }
}
