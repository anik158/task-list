<?php

use \App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::get('/',function (){
   return redirect()->route('tasks.index');
});

//Routing to Index page
Route::get('/tasks', function (){
    $tasks = Task::latest()->get();
    return view('index',['tasks'=>$tasks]);
})->name('tasks.index');


//Routing to create page
Route::view('tasks/create','create-task')->name('tasks.create');

//Routing to single post page
Route::get('/tasks/{id}',function($id){
    $task = Task::findOrFail($id);
    return view('show',['task'=>$task]);
})->name('tasks.show');


//Routing to single post page after adding a task
Route::post('/tasks',function(Request $request){

    $data = $request->validate(
        [
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'required|max:255',
        ]
    );

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show',['id'=>$task->id])->with('success','Task created successfully');
})->name('tasks.store');


//Routing to single post page for update
Route::get('/tasks/{id}/edit',function($id){
    $task = Task::findOrFail($id);
    return view('edit-task',['task'=>$task]);
})->name('tasks.edit');


//Routing to single post page after updating a post
Route::put('/tasks/{id}',function($id, Request $request){

    $data = $request->validate(
        [
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'required|max:255',
        ]
    );

    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show',['id'=>$task->id])->with('update','Task updated successfully');
})->name('tasks.update');


Route::fallback(function (){
   return 'Page does not exist';
});
