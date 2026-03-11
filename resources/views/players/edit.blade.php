@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Edit Player</h1>

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

    <form action="{{ route('players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Player Info Header -->
        <div class="row mb-4">
            <div class="col-md-4 text-center">
                <img src="{{ $player->photo ?? 'https://via.placeholder.com/200x200?text=Player' }}" 
                     class="img-fluid rounded-circle shadow mb-2" style="width:200px;height:200px;object-fit:cover;" alt="Player Photo">
                <input type="file" name="photo" class="form-control">
            </div>
            <div class="col-md-8 d-flex flex-column justify-content-center">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $player->name) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age', $player->age) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Position</label>
                        <select name="position" class="form-control" required>
                            @foreach(['GK','CB','RB','LB','CM','RW','LW','ST'] as $pos)
                                <option value="{{ $pos }}" {{ old('position', $player->position) == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Club</label>
                        <input type="text" name="club" class="form-control" value="{{ old('club', $player->club) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Comments</label>
                        <input type="text" name="comments" class="form-control" value="{{ old('comments', $player->comments) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Attributes 0-100 -->
        <div class="row mb-3">
            @foreach(['pace','shooting','passing','dribbling','strength'] as $attr)
                <div class="col-md-2">
                    <label class="form-label">{{ ucfirst($attr) }}</label>
                    <input type="number" name="{{ $attr }}" class="form-control" min="0" max="100" value="{{ old($attr, $player->$attr) }}" required>
                </div>
            @endforeach
        </div>

        <!-- Match Stats -->
        <div class="row mb-3">
            @foreach(['matches'=>'Matches Played','goals'=>'Goals','assists'=>'Assists','minutes_played'=>'Minutes Played'] as $field=>$label)
                <div class="col-md-3">
                    <label class="form-label">{{ $label }}</label>
                    <input type="number" name="{{ $field }}" class="form-control" min="0" value="{{ old($field, $player->$field) }}">
                </div>
            @endforeach
        </div>

        <!-- Submit Buttons -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary me-2">Update Player</button>
            <a href="{{ route('players.show', $player->id) }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>
@endsection