<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = auth()->user()->todos;
        return view('todos.index', compact('todos'));
    }

    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todos.edit', compact('todo'));
    }

    public function store()
    {
        $categoryId = request('category');
        $description = request('description');
        $title = request('title');

        // Please validate the inputs

        $check = Todo::where('title', $title)->where('user_id', auth()->user()->id)->count();

        if ($check > 0) {
            return response()->json(["message" => "Todo exists", "error" => true]);
        }

        // Get Category
        $category = Category::findOrFail($categoryId);

        // Get User
        $user = User::findOrFail(auth()->user()->id);

        $todo = new Todo;
        $todo->title = $title;
        $todo->description = $description;
        $todo->is_complete = 0;
        $todo->start_date = \Carbon\Carbon::parse(request('startDate'))->format('Y-m-d');
        $todo->end_date = \Carbon\Carbon::parse(request('endDate'))->format('Y-m-d');

        // Now we save relationship
        $todo->user()->associate($user);

        $todo->category()->associate($category);

        $todo->save();

        return response()->json(["message" => "Successfully added", "error" => false]);
    }

    public function update()
    {
        $title = request('title');
        $description = request('description');
        $todoId = request('todo_id');
        $endDate = \Carbon\Carbon::parse(request('endDate'))->format('Y-m-d');
        $startDate = \Carbon\Carbon::parse(request('startDate'))->format('Y-m-d');
        $categoryId = request('category');

        $check = Todo::where('title', $title)->where('category_id', $categoryId)->where('id', '!=', $todoId)->count();


        if ($check == 0) {
            $todo = Todo::find($todoId);
            $todo->title = $title;
            $todo->description = $description;
            $todo->start_date = $startDate;
            $todo->end_date = $endDate;


            $sd = new \Carbon\Carbon($startDate);
            $ed = new \Carbon\Carbon($endDate);

            if (!$sd->isBefore($ed)) {
                return response()->json([
                    "error" => true,
                    "msg" => "End Date should be after start Date!"
                ]);
            }

            // Get Category
            $category = Category::findOrFail($categoryId);

            // Get User
            $user = User::findOrFail(auth()->user()->id);

            // Now we save relationship
            $todo->user()->associate($user);

            $todo->category()->associate($category);

            $todo->save();


            return response()->json([
                "error" => false,
                "message" => "Successfully Updated!"
            ]);
        } else {
            return response()->json([
                "error" => true,
                "message" => "Todo exists!"
            ]);
        }
    }


    public function destroy($id)
    {
        Todo::find($id)->delete();
        return response()->json([
            "error" => false,
            "message" => "Successfully deleted!"
        ]);
    }

    public function view($id)
    {
        $todo = Todo::find($id);
        return view('todos.view', compact('todo'));
    }

    public function complete($id)
    {
        $todo = Todo::find($id);
        $todo->is_complete = 1;
        //$todo->complete_date = \Carbon\Carbon::now();
        $todo->status = 'completed';
        $todo->save();

        return response()->json([
            "error" => false,
            "message" => "Successfully completed!"
        ]);
    }
}
