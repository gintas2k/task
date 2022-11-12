<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    private  $validationRules=[
        'name'=>['required', 'min:3', 'max:64'],
        'description'=>['max:512']
    ];

    private $validationMessages=[
        'name.required'=>'Užduoties <b>pavadinimas</b> yra privalomas ',
        'name.min'=>'<b>Pavadinimas</b> turi būti ne trumpesnis nei 3 simboliai',
        'name.max'=>'<b>Pavadinimas</b> turi būti ne ilgesnis nei 64 simboliai',
        'description.max'=>'<b>Aprašymas</b> turi būti ne ilgesnis nei 512 simbolių'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->session()->get('task_search',null);
        $filter_priority=$request->session()->get('task_filter_priority',null);

        $tasks=Task::search($search)->FromPriority($filter_priority)->with('priority')->get();
        //$tasks = Task::all();
        $priorities = Priority::all();

        return view('tasks.index', [
            'tasks'=>$tasks,
            'search'=>$search,
            'filter_priority'=>$filter_priority,
            'priorities'=>$priorities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = Priority::all();
        $users = User::all();
        return view('tasks.create',[
            'priorities' => $priorities,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->priority_id = $request->priority_id;
        $task->user_id = $request->user_id;

    /* echo "<pre>";
            print_r($task);
        echo "</pre>"; */
        
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $priorities = Priority::all();
        $users = User::all();
        return view("tasks.edit", [
            'task' => $task,
            'priorities' => $priorities,
            'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->priority_id = $request->priority_id;
        $task->user_id = $request->user_id;
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function search(Request $request){
        $request->session()->put('task_search',$request->search);
        return redirect()->route('tasks.index');
    }

    public function reset(Request $request){
        $request->session()->put('task_search', null);
        $request->session()->put('task_filter_priority', null);
        return redirect()->route('tasks.index');
    }

    public function filter(Request $request){
        $request->session()->put('task_filter_priority',$request->filter_priority);
        return redirect()->route('tasks.index');
    }

}
