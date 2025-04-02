@extends('layouts.app')
@section('title', 'Task')
@section('content')
    <h1>Task </h1>
    <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                            <h5 class="card-title">{{ $task->title}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $task->description}}</p>
                        <ul class="list-unstyled">
                            <li><strong>Completed: </strong> {{$task->completed ? 'Yes' : 'No' }} </li>
                            <li><strong>Due Date: </strong>{{$task->due_date}}</li>
                            <li><strong>Author: </strong>{{$task->user->name}}</li>
                            <li><strong>Category: </strong>{{$task->category ? $task->category->category[app()->getLocale()] ?? $task->category->category['en'] : '' }}</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{route('task.edit', $task->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                            <a href="{{route('task.pdf', $task->id)}}" class="btn btn-sm btn-outline-warning">PDF</a>
                            <!-- Button trigger modal -->
                            @can('delete-task')
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Delete
                            </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete a Task</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           Are you sure to delete the task: {{ $task->title}} ?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
        </div>
    </div>
    </div>
@endsection