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

    public function tasksAssignedToUser($user_id)
    {
        $usertasks = UsersTasks::where('user_id', $user_id)->get();

        if ($usertasks->isEmpty()) {
            return response()->json(['error' => 'No assignments found'], 404);
        }

        return response()->json(['tasks' => $usertasks]);
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
    }