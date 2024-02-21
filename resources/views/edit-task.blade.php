@extends('layouts.app')

@section('title','Add Task')

@section('styles')
    <style>
        .error-message{
            color: red;
            font-size:.8rem;
        }
    </style>
@endsection
@section('content')


    <form method="POST" action="{{route('tasks.update',['id'=>$task->id])}}">

        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" value="{{$task->title}}" name="title">
            @error('title')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5">{{$task->description}}</textarea>
            @error('description')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Long Description</label>
            <textarea id="long_description" name="long_description" rows="10">{{$task->long_description}}</textarea>
            @error('long_description')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div>
            <button type="submit">Edit task</button>
        </div>
    </form>

@endsection
