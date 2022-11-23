@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('priorities.new_priority') }}</div>
                    <div class="card-body">

                        @include('tasks.error')

                        <form method="POST" action="{{ route('priorities.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('priorities.name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                            </div>
                            
                            <button class="btn btn-success">{{ __('priorities.add') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

