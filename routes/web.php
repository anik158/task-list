<?php

use App\Http\Requests\TaskRequest;
use \App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use GuzzleHttp\Client;

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

    $tasks = Task::latest()->paginate(10);
    return view('index',['tasks'=>$tasks]);
})->name('tasks.index');




//Route::get('/tasks', function () {
//
//    $response = Http::get('/api/tasks');
//
//    dd($response->json());
//    //$response = $client->request('GET', 'tasks');
//    $tasks = json_decode($response->getBody()->getContents(), true)['data'];
//    dd($tasks);
//
//    //return view('index', ['tasks' => $tasks]);
//})->name('tasks.index');




//Routing to create page
Route::view('tasks/create','create-task')->name('tasks.create');

//Routing to single post page
Route::get('/tasks/{task}',function(Task $task){
    return view('show',['task'=>$task]);
})->name('tasks.show');


//Routing to single post page after adding a task
Route::post('/tasks',function(TaskRequest $request){

//    $data = $request->validated();
//
//    $task = new Task;
//    $task->title = $data['title'];
//    $task->description = $data['description'];
//    $task->long_description = $data['long_description'];

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])->with('success','Task created successfully');
})->name('tasks.store');


//Routing to single post page for update
Route::get('/tasks/{task}/edit',function(Task $task){
    return view('edit-task',['task'=>$task]);
})->name('tasks.edit');


//Routing to single post page after updating a post
Route::put('/tasks/{task}',function(Task $task, TaskRequest $request){

//    $data = $request->validate(
//        [
//            'title' => 'required|max:255',
//            'description' => 'required',
//            'long_description' => 'required|max:255',
//        ]
//    );
//
//    $task->title = $data['title'];
//    $task->description = $data['description'];
//    $task->long_description = $data['long_description'];
//
//    $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])->with('success','Task updated successfully');
})->name('tasks.update');

//Route to delete a task
Route::delete('/tasks/{task}',function(Task $task){
    $task->delete();

    return redirect()->route('tasks.index')->with('success','Task deleted successfully');
})->name('tasks.destroy');

//Route for completing or not completing task
Route::put('tasks/{task}/toggle-complete',function (Task $task){
    $task->toggleComplete();

    return redirect()->back()->with('success','Task updated successfully');
})->name('tasks.toggle-complete');


Route::fallback(function (){
   return 'Page does not exist';
});
