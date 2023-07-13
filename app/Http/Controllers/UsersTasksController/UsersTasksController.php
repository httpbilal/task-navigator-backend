<?php
namespace App\Http\Controllers\UsersTasksController;

use App\Http\Controllers\Controller;
use App\Models\UsersTasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersTasksController extends Controller
{
    public function index()
    {
        $usersTasks = UsersTasks::all();
        return response()->json(['users_tasks' => $usersTasks]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $usersTasks = UsersTasks::create([
            'user_id' => $request->input('user_id'),
            'task_id' => $request->input('task_id'),
        ]);

        return response()->json(['users_tasks' => $usersTasks], 201);
    }

    public function show(UsersTasks $usersTasks)
    {
        return response()->json(['users_tasks' => $usersTasks]);
    }

    public function update(Request $request, UsersTasks $usersTasks)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $usersTasks->user_id = $request->input('user_id');
        $usersTasks->task_id = $request->input('task_id');
        $usersTasks->save();

        return response()->json(['users_tasks' => $usersTasks]);
    }

    public function destroy(UsersTasks $usersTasks)
    {
        $usersTasks->delete();
        return response()->json(['message' => 'Users tasks deleted successfully']);
    }
}
