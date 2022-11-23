@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('priorities.edit_priority') }}</div>
                    <div class="card-body">

                        @include('tasks.error')
                        
                        <form method="POST" action="{{ route('priorities.update', $priority->id) }}">
                            @csrf
                            @method("PUT")
                            <div class="mb-3">
                                <label class="form-label">{{ __('priorities.name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $priority->name }}">
                            </div>
                            
                            <button class="btn btn-success">{{ __('priorities.save') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

