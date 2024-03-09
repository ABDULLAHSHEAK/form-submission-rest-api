<?php

namespace App\Http\Controllers;


use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // show all form data
    public function index()
    {
        $data = Form::all();
        if ($data->count() > 0) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'Fail',
                'data' => 'No data found',
            ], 400);
        }
    }

    // create a new data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15',
            'email' => 'required|email',
            'roll' => 'required|numeric',
        ]);
        $form = Form::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'roll' => $request->input('roll'),
        ]);

        if ($form) {
            return response()->json([
                'status' => 'success',
                'massage' => 'Form created successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'fail',
                'massage' => "Something went wrong",
            ],404);
        };
    }

    // show single data
    public function show($id)
    {
        $data = Form::findOrFail($id);
        if ($data->count() > 0) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'Fail',
                'data' => 'No data found',
            ], 400);
        }
    }

    // edit data
    public function edit($id)
    {
        $data = Form::findOrFail($id);
        if ($data->count() > 0) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'Fail',
                'massage' => 'No data found',
            ], 404);
        }
    }

    // update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:15',
            'email' => 'required|email',
            'roll' => 'required|numeric',
        ]);

        $form = Form::findOrFail($id);

        $form->update([
            'name' => $request->name,
            'email' => $request->email,
            'roll' => $request->roll,
        ]);

        // Check if the update was successful
        if ($form->wasChanged()) {
            return response()->json([
                'status' => 'success',
                'message' => "Form Update Successful",
            ], 200);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'No changes were made or something went wrong',
            ], 404);
        }
    }

    //delete data
    public function destroy($id){
        $delete = Form::findOrFail($id);
        $delete->delete();
        if($delete){
            return response()->json([
                'status' => 'success',
                'massage' => "Data Deleted Successfully",
            ], 200);
        }else{
            return response()->json([
                'status' => 'fail',
                'massage' => "Something went wrong",
            ], 404);
        }
    }
}
