<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        return $result = Todo::orderBy('id','desc')->get();
    }

    public function store(Request $request)
    {

        //return $request->all();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $todo = Todo::create($validatedData);
        //return $todo;
        return response()->json($todo, 201);
    }
    public function destroy($id){
        Todo::find($id)->delete();
    }
    public function edit($id){
        return Todo::find($id);
    }
    public function update($id, Request $request){
        //return $request->all();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        try {
            $todo = Todo::findOrFail($id);
            $todo->fill($validatedData)->save();

            return response()->json($todo, 200);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., not found), return a JSON response with an error message
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
