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

    public function show($id)
    {
        $usertask = UsersTasks::find($id);
        if (!$usertask) {
            return response()->json(['error' => 'NO assignment found'], 404);
        }
        return response()->json(['users_tasks' => $usertask]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $usersTask = UsersTasks::find($id);

        if (!$usersTask) {
            return response()->json(['error' => 'Users task not found'], 404);
        }

        $usersTask->user_id = $request->input('user_id');
        $usersTask->task_id = $request->input('task_id');
        $usersTask->save();

        return response()->json(['users_task' => $usersTask]);
    }



    public function destroy($id)
    {
        $usersTask = UsersTasks::find($id);

        if (!$usersTask) {
            return response()->json(['error' => 'Users task not found'], 404);
        }

        $usersTask->delete();
        return response()->json(['message' => 'Users task deleted successfully']);
    }

    public function getUserAssignedTasks($userId)
    {
        $userTasks = UsersTasks::where('user_id', $userId)->get();

        if ($userTasks->isEmpty()) {
            return response()->json(['message' => 'No tasks assigned to this user'], 200);
        }

        return response()->json(['user_assigned_tasks' => $userTasks], 200);
    }

    public function getTaskAssignedUsers($taskId)
    {
        $taskUsers = UsersTasks::where('task_id', $taskId)->get();

        if ($taskUsers->isEmpty()) {
            return response()->json(['message' => 'No users assigned to this task'], 200);
        }

        return response()->json(['task_assigned_users' => $taskUsers], 200);
    }


}
