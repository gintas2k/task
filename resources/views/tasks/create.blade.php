@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('tasks.new_task') }}</div>
                    <div class="card-body">

                        @include('tasks.error')

                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('tasks.name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('tasks.description') }}</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('tasks.status') }}</label>
                                <select name="status" class="form-select">
                                    <option value="0">{{ __('tasks.created') }}</option>
                                    <option value="1">{{ __('doing.status') }}</option>
                                    <option value="2">{{ __('tasks.done') }}</option>
                                    <option value="3">{{ __('tasks.canceled') }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('tasks.priority') }}</label>
                                <select name="priority_id" class="form-select">
                                @foreach($priorities as $priority)
                                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('tasks.user') }}</label>
                                <select name="user_id" class="form-select">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            
                            <button class="btn btn-success">{{ __('tasks.add') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
