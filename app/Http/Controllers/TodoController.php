<?php

namespace App\Http\Controllers;

use \Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    // get all Todos
    public function index()
    {
        try {
            $todos = Todo::all();
            return response()->json($todos, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Todos not found', $e->getMessage()], 404);
        }
    }

    // get single Todo
    public function getOneTodo($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            return response()->json($todo, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Todo not found', $e->getMessage()], 404);
        }
    }

    // create Todo
    public function store(TodoRequest $request)
    {
        try {
            $status = $request->has('status') ? $request->status : 'open';

            $todoData = array_merge($request->validated(), ['status' => $status]);

            $todo = Todo::create($todoData);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }
        return response()->json(['message' => 'Todo created'], 201);
    }

    // update Todo
    public function update(TodoRequest $request, $id)
    {
        try {
            $todo = Todo::findOrFail($id);

            if ($request->has('title')) {
                $todo->title = $request->title;
            }

            if ($request->has('description')) {
                $todo->description = $request->description;
            }

            if ($request->has('status')) {
                $request->validate([
                    'status' => 'required|in:open,in-progress,completed',
                ]);
                $todo->status = $request->status;
            }

            $todo->save();
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }
        return response()->json(['message' => 'Todo updated'], 200);
    }

    // delete Todo
    public function delete($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            $todo->delete();

            return response()->json(['message' => 'Todo deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Todo not found', $e->getMessage()], 404);
        }
    }
}
