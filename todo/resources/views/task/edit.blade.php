@extends('layouts.app')
@section('title', 'Edit Task')
@section('content')
<h1>Edit Task</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Task</h5>
            </div>

            <div class="card-body">
                <form method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title)}}">
                        @if($errors->has('title'))
                            <div class="text-danger mt-2">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control">{{old('description', $task->description)}}</textarea>
                        @if($errors->has('description'))
                            <div class="text-danger mt-2">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="completed" class="form-check-label">Completed</label>
                        <input type="checkbox" id="completed" name="completed" value="1" class="form-check-input" {{old('completed', $task->completed)? 'checked' : ''}}>
                        @if($errors->has('completed'))
                            <div class="text-danger mt-2">
                                {{ $errors->first('completed') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date)}}">
                        @if($errors->has('due_date'))
                            <div class="text-danger mt-2">
                                {{ $errors->first('due_date') }}
                            </div>
                        @endif
                    </div>
                    <input type="submit" value="Update" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection