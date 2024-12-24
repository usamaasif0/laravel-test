<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MyTasks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $task_id = $request->route('id');

        $task = Task::where('id', $task_id)->first();
        
        $logged_user_id = Auth::user()->id;
        if ($logged_user_id != $task?->user_id) {
            return response()->json(['message' => 'User has no permission to update this record'], 403);
        }
        

        return $next($request);
    }
}
