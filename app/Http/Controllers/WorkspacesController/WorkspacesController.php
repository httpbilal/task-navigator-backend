<?php

namespace App\Http\Controllers\WorkspacesController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workspace;
use Illuminate\Support\Facades\Validator;


class WorkspacesController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::all();
        return response()->json(['workspaces' => $workspaces]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'owner' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $workspace = Workspace::create($request->all());

        return response()->json(['workspace' => $workspace, 'message' => 'Workspace created successfully'], 201);
    }

    public function show($id)
    {
        $workspace = Workspace::with('ownerUser')->find($id);
        if (!$workspace) {
            return response()->json(['error' => 'Workspace not found'], 404);
        }
        return response()->json(['workspace' => $workspace]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'owner' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $workspace = Workspace::find($id);
        if (!$workspace) {
            return response()->json(['error' => 'Workspace not found'], 404);
        }

        $dataToUpdate = $validator->validated();
        $workspace->update($dataToUpdate);

        return response()->json(['workspace' => $workspace, 'message' => 'Workspace updated successfully']);
    }


    public function destroy($id)
    {
        $workspace = Workspace::find($id);
        if (!$workspace) {
            return response()->json(['error' => 'Workspace not found'], 404);
        }

        $workspace->delete();

        return response()->json(['message' => 'Workspace deleted successfully']);
    }
}
