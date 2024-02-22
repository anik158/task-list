<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Get all tasks
Route::get('/tasks', function () {
    $tasks = Task::latest()->paginate(10);
    return ['data' => $tasks];
})->name('tasks.index');

// Get a single task
Route::get('/tasks/{task}', function (Task $task) {
    return ['data' => $task];
})->name('tasks.show');

// Create a new task
Route::post('/tasks', function (Request $request) {
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'long_description' => $request->long_description,
    ]);

    return [
        'message' => 'Success',
        'data' => [
            'id' => $task->id,
            'title' => $task->title,
        ]
    ];
})->name('tasks.store');

// Update a task
Route::put('/tasks/{task}', function (Task $task, Request $request) {
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'long_description' => $request->long_description,
    ]);

    return [
        'message' => 'Success',
        'data' => [
            'id' => $task->id,
            'title' => $task->title,
        ]
    ];
})->name('tasks.update');

// Delete a task
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return ['message' => 'Success'];
})->name('tasks.destroy');

// Toggle task completion
Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();
    return [
        'message' => 'Success',
        'data' => [
            'id' => $task->id,
            'title' => $task->title,
        ]
    ];
})->name('tasks.toggle-complete');
