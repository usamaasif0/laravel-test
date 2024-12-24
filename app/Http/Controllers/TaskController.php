<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $tasks = Task::where('user_id', Auth::user()->id)->get();
            if(!$tasks){
                return response()->json(['Tasks Not Available'], 404);
            }
            return response()->json(['tasks' => $tasks], 200);
        }catch(Exception $e){
            return response()->json(['Tasks Not Available'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'user_id' => 'required',
                'title' => 'required|max:500',
                'description' => 'nullable',
                'status' => 'required',
            ]);

            $task = Task::create($validated);
            return response()->json(['message'=> 'Task created successfully', 'task' => $task], 201);
        }catch(Exception $e){
            return response()->json(['Task Not Available'], 404);
        }    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $task = Task::where('user_id', Auth::user()->id)->where('id', $id)->first();
            if(!$task){
                return response()->json(['Task Not Available'], 404);
            }
            return response()->json(['task' => $task], 200);
        }catch(Exception $e){
            return response()->json(['Task Not Available'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $validated = $request->validate([
                'user_id' => 'required',
                'title' => 'required|max:500',
                'description' => 'nullable',
                'status' => 'required',
            ]);

            $task = Task::where('user_id', Auth::user()->id)->where('id', $id)->first();
            if(!$task){
                return response()->json(['Task Not Available'], 404);
            }
            $task->update($validated);
            return response()->json(['message'=> 'Task updated successfully', 'task' => $task], 201);
        }catch(Exception $e){
            return response()->json(['Task Not Available'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $task = Task::where('user_id', Auth::user()->id)->where('id', $id)->delete();
            if(!$task){
                return response()->json(['Task Not Available'], 404);
            }
            return response()->json(['Task Deleted' => $task], 200);
        }catch(Exception $e){
            return response()->json(['Task Not Available'], 404);
        }
    }
}
