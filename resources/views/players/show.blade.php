@extends('layouts.app')

@section('content')
<div class="container my-5">

    <!-- Player Profile Header -->
    <div class="row mb-4">
        <div class="col-md-12 d-flex flex-column justify-content-center text-center">
            <!-- Styled Player Name -->
            <h1 class="display-4 fw-bold player-name">{{ $player->name }}</h1>
            <h4 class="text-muted">{{ $player->position }}</h4>
            <p class="mt-3"><strong>Age:</strong> {{ $player->age }} | <strong>Club:</strong> {{ $player->club ?? 'N/A' }}</p>
            
            <!-- Action Buttons -->
            <div class="mt-3">
                <a href="{{ route('players.edit', $player->id) }}" class="btn btn-primary btn-lg me-2">
                    ✏️ Edit Player
                </a>
                <a href="{{ route('players.index') }}" class="btn btn-secondary btn-lg">
                    ⬅ Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Player Ratings Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Player Ratings</h4>
        </div>
        <div class="card-body">

            @php
                $technical = round(($player->passing + $player->dribbling + $player->shooting)/3);
                $physical = round(($player->pace + $player->strength)/2);
                $overall = round(($technical + $physical)/2);

                if ($overall >= 80) {
                    $classification = 'Elite';
                } elseif ($overall >= 60) {
                    $classification = 'Pro';
                } elseif ($overall >= 40) {
                    $classification = 'Intermediate';
                } else {
                    $classification = 'Beginner';
                }
            @endphp

            <!-- Ratings badges -->
            <ul class="list-group mb-4">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Technical
                    <span class="badge bg-primary fs-6">{{ $technical }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Physical
                    <span class="badge bg-success fs-6">{{ $physical }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Overall
                    <span class="badge bg-dark fs-6">{{ $overall }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Classification
                    <span class="badge bg-warning text-dark fs-6">{{ $classification }}</span>
                </li>
            </ul>

            <!-- Ability Breakdown -->
            <h5 class="mb-3">Ability Breakdown</h5>
            @foreach(['Passing'=>'passing','Dribbling'=>'dribbling','Shooting'=>'shooting','Pace'=>'pace','Strength'=>'strength'] as $label=>$field)
                <div class="mb-2">
                    <label class="fw-bold">{{ $label }}</label>
                    <div class="progress">
                        <div class="progress-bar 
                                    @if($label=='Passing') bg-info 
                                    @elseif($label=='Dribbling') bg-success 
                                    @elseif($label=='Shooting') bg-danger 
                                    @elseif($label=='Pace') bg-warning 
                                    @else bg-secondary @endif" 
                             role="progressbar" 
                             style="width: {{ $player->$field }}%">
                            {{ $player->$field }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Match Statistics Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Match Statistics</h4>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->matches ?? 0 }}</h5>
                        <p class="mb-0">Matches Played</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->goals ?? 0 }}</h5>
                        <p class="mb-0">Goals</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->assists ?? 0 }}</h5>
                        <p class="mb-0">Assists</p>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <h5>{{ $player->minutes_played ?? 0 }}</h5>
                        <p class="mb-0">Minutes Played</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Comments</h4>
        </div>
        <div class="card-body">
            <p>{{ $player->comments ?? 'No comments provided' }}</p>
        </div>
    </div>

</div>

<!-- Custom Styles -->
<style>
/* Page background */
body {
    background: #f0f8f5; /* soft minty shade */
}

/* Player name styling */
.player-name {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    background: linear-gradient(90deg, #34ace0, #33d9b2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

/* Cards styling */
.card {
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
</style>
@endsection
