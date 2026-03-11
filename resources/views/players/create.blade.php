@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Add New Player</h1>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Player Info -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" value="{{ old('age') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Position</label>
                <select name="position" class="form-control" required>
                    <option value="">Select Position</option>
                    @foreach(['GK','CB','RB','LB','CM','RW','LW','ST'] as $pos)
                        <option value="{{ $pos }}" {{ old('position')==$pos ? 'selected' : '' }}>{{ $pos }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Club & Photo -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Club</label>
                <input type="text" name="club" class="form-control" value="{{ old('club') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Player Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>
        </div>

        <!-- Attributes (0-100) -->
        <div class="row mb-3">
            <div class="col-md-2">
                <label class="form-label">Pace</label>
                <input type="number" name="pace" class="form-control" min="0" max="100" value="{{ old('pace') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Shooting</label>
                <input type="number" name="shooting" class="form-control" min="0" max="100" value="{{ old('shooting') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Passing</label>
                <input type="number" name="passing" class="form-control" min="0" max="100" value="{{ old('passing') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Dribbling</label>
                <input type="number" name="dribbling" class="form-control" min="0" max="100" value="{{ old('dribbling') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Strength</label>
                <input type="number" name="strength" class="form-control" min="0" max="100" value="{{ old('strength') }}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Comments</label>
                <input type="text" name="comments" class="form-control" value="{{ old('comments') }}">
            </div>
        </div>

        <!-- Match Stats -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Matches Played</label>
                <input type="number" name="matches" class="form-control" min="0" value="{{ old('matches') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Goals</label>
                <input type="number" name="goals" class="form-control" min="0" value="{{ old('goals') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Assists</label>
                <input type="number" name="assists" class="form-control" min="0" value="{{ old('assists') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Minutes Played</label>
                <input type="number" name="minutes_played" class="form-control" min="0" value="{{ old('minutes_played') }}">
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mb-3">
            <button type="submit" class="btn btn-success me-2">Add Player</button>
            <a href="{{ route('players.index') }}" class="btn btn-secondary">Back</a>
        </div>

    </form>
</div>
@endsection