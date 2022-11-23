@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('tasks.tasks_list') }}</div>
                <div class="card-body">
                    <form action="{{ route('tasks.search') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="search" placeholder="{{ __('tasks.search_placeholder') }}" value="{{ $search }}">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success">{{ __('tasks.search') }}</button>
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>
                    </form>
                    <hr>
                    <form action="{{ route('task.filter') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <select class="form-select" name="filter_priority">
                                    <option value=""  {{ ($filter_priority==null)?'selected':'' }}>-</option>
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->id }}"  {{ ($priority->id==$filter_priority)?'selected':'' }}>{{ $priority->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success">{{ __('tasks.filter') }}</button>
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('tasks.search.reset') }}" class="btn btn-warning">{{ __('tasks.clear') }}</a>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('tasks.name') }}</th>
                            <th>{{ __('tasks.description') }}</th>
                            <th>{{ __('tasks.status') }}</th>
                            <th>{{ __('tasks.priority') }}</th>
                            <th>{{ __('tasks.user') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    @switch($task->status)
                                        @case(0)
                                        {{ __('tasks.created') }}
                                        @break
                                        @case(1)
                                        {{ __('tasks.doing') }}
                                        @break
                                        @case(2)
                                        {{ __('tasks.done') }}
                                        @break
                                        @case(3)
                                        {{ __('tasks.canceled') }}
                                        @break
                                    @endswitch
                                </td>
                                <td>{{ $task->priority->name }}</td>
                                <td>{{ $task->user->name }}</td>
                                <td style="width: 100px;">
                                    <a class="btn btn-warning" href="{{ route('tasks.edit', $task->id) }}" >{{ __('tasks.edit') }}</a>
                                </td>

                                <td style="width: 100px;">
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger" onclick="return confirm('Really want to delete?');">{{ __('tasks.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

