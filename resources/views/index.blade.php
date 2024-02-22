@extends('layouts.app')



    @section('title','The list of tasks')



    @section('content')

        <nav class="mb-4 mt-4"><a class="btn link" href="{{route('tasks.create')}}">Add Task!</a></nav>
        @forelse($tasks as $task)
<div>
    💬<a @class(['text-xl','mb-4','line-through'=>$task->completed]) href="{{route('tasks.show',['task'=>$task->id])}}">{{$task->title}}</a>
</div>
        @empty
        <div class="no-data">>No data found! </div>
        @endforelse

        @if($task->count())
             <nav class="mt-4">
                 {{$tasks->links()}}
             </nav>
        @endif

    @endsection

