<?php

namespace App\Http\Controllers\TaskController;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\TaskDeleting;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json(['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'priority' => 'required|in:high,medium,low',
            'due_date' => 'required|date',
            'project_id' => 'required|exists:projects,id', // Validation for project_id
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $task = Task::create($validator->validated());

        return response()->json(['task' => $task, 'message' => 'Task created successfully'], 201);
    }

    public function show($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        return response()->json(['task' => $task]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'assignees' => 'nullable|exists:users,id',
            'priority' => 'nullable|in:high,medium,low',
            'due_date' => 'nullable|date',
            'project_id' => 'nullable|exists:projects,id', // Validation for project_id
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->update($validator->validated());

        return response()->json(['task' => $task, 'message' => 'Task updated successfully']);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        event(new TaskDeleting($task));
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
