@extends('layouts.app')

@section('title',isset($task)? 'Edit Task' : 'Add Task')


@section('content')


    <form method="POST" action="{{ isset($task) ? route('tasks.update',['task'=> $task->id]) : route('tasks.store')}}" >

        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="@error('title') border border-red-500 @enderror" value="{{ $task->title ?? old('title')}}">
            @error('title')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea id="description"  name="description" class="@error('description') border border-red-500 @enderror" rows="5">{{$task->description ?? old('description')}}</textarea>
            @error('description')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea id="long_description"  class="@error('long_description') border border-red-500 @enderror" name="long_description" rows="10">{{$task->long_description ?? old('long_description')}}</textarea>
            @error('long_description')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <button class="btn" type="submit">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
            <a href="{{route('tasks.index')}}" class="btn">Cancel</a>
        </div>
    </form>

@endsection
