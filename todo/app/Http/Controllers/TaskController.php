<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //select * from tasks;
        $tasks = Task::all();
        //$tasks = Task::orderby('title')->get();
   

       return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'min:10|string',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);
        //return redirect()->back()->withErrors()->withIpunts();

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->input('completed', false),
            'due_date' => $request->due_date,
            'user_id' => 1
        ]);

        return redirect()->route('task.show', $task->id)->with('success', 'Task created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //select * from tasks where id = $task;
        //$task = Task::find($task);

       return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //return ($task);

        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'min:10|string',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->input('completed', false),
            'due_date' => $request->due_date,
        ]);
        
        return redirect()->route('task.show', $task->id)->withSuccess('Task updated!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $id = $task->id;
        $task->delete();

        return redirect()->route('task.index')->withSuccess('Task number '.$id.' deleted!');
    }

    public function completed($completed){
       $tasks = Task::where('completed', $completed)->get();
       return view('task.index', ['tasks' => $tasks]);
    }

    public function query(){
        //SELECT * FROM tasks
        //$task = Task::all();
        //$task = Task::select()->get();
       //$task = Task::select('title', 'description')->get();

        //SELECT * FROM tasks LIMIT 1;
        //$task = Task::select()->first();

//ORDER BY        
        //SELECT * FROM tasks ORDER BY title DESC;
        $task = Task::select()->orderby('title', 'desc')->get();
        $task = Task::orderby('title', 'desc')->get();

//WHERE  
        //SELECT * FROM tasks WHERE user_id = 1;
        //$task = Task::select()->where('user_id','=' ,1)->get();
        //$task = Task::where('user_id','=' ,1)->get();
        //SELECT * FROM tasks WHERE title like "Task %";
        $task = Task::where('title','like', 'T__k %')->orderby('title', 'desc')->get();

        //select * from tasks where id = 1; (PK)
        //  $task = Task::where('id', 1)->get();
        //  $task = $task[0];
        //  $task = Task::where('id', 1)->first();
        $task = Task::find(1);

//AND
        //select * from tasks where user_id = 1 AND title LIKE 'T%';
        $task = Task::select()
                ->where('user_id', 1)
                ->where('title', 'like', 't%')
                ->get();

//OR
        //SELECT * FROM tasks WHERE user_id = 1 OR user_id = 3;
        //SELECT * FROM tasks WHERE user_id IN (1, 3);
        $task = Task::select()
        ->where('user_id', 1)
        ->orWhere('user_id', 3)
        ->get();

//INNER JOIN
        //SELECT * FROM tasks INNER JOIN users ON user_id = users.id
        $task = Task::select()
        ->join('users', 'users.id', 'user_id')
        //->where('user_id', '>', 5)
        //->orderby('name')
        ->get();

//OUTER JOIN
        //SELECT * FROM tasks RIGHT OUTER JOIN users ON user_id = users.id
        $task = Task::select()
        ->rightJoin('users', 'users.id', 'user_id')
        ->get();

//Agregats fonction
        // $task = Task::max('id');
        // $task = Task::sum('completed');

        $task = Task::select()->where('user_id','=' ,1)->count();


//group by requete brute
        $task = Task::select(DB::raw('count(*) as count_tasks'), 'user_id')
        ->groupBy('user_id')
        ->get();

// belongsTo 

        $task = Task::find(1);

        return $task->user;
    }
}
