@extends('layouts.app')

@section('content')
<div class="container my-5">

    <!-- Dashboard Header: Title + Home Button -->
    <div class="card mb-4 shadow-sm p-3" style="background-color: #d8f0d8; border-radius: 1rem;">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="fw-bold mb-0" style="color: #2e7d32;">Players Dashboard</h1>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('home') }}" class="btn btn-success btn-lg shadow-sm">
                    🏠 Home
                </a>
                <a href="{{ route('players.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    ➕ Add New Player
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($players as $player)
            @php
                $technical = round(($player->passing + $player->dribbling + $player->shooting)/3);
                $physical = round(($player->pace + $player->strength)/2);
                $overall = round(($technical + $physical)/2);

                if ($overall >= 80) $classification = 'Elite';
                elseif ($overall >= 60) $classification = 'Pro';
                elseif ($overall >= 40) $classification = 'Intermediate';
                else $classification = 'Beginner';
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0 hover-shadow">
                    <!-- Card Header: Name + Position + Club + Edit -->
                    <div class="position-relative text-center p-3" style="background-color: #f0fff0; border-bottom: 1px solid #cce5cc;">
                        <span class="badge bg-dark position-absolute top-0 end-0 m-2 fs-6">
                            {{ $overall }} ★
                        </span>
                        <h5 class="card-title mb-0">{{ $player->name }}</h5>
                        <p class="text-muted mb-1">{{ $player->position }}</p>
                        <p class="text-muted"><small>{{ $player->club ?? 'No Club' }}</small></p>

                        <!-- Edit Button -->
                        <a href="{{ route('players.edit', $player->id) }}" class="btn btn-sm btn-primary mt-2">
                            ✏️ Edit Player
                        </a>
                    </div>

                    <!-- Stats -->
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">
                            <strong>Matches:</strong> {{ $player->matches ?? 0 }} |
                            <strong>Goals:</strong> {{ $player->goals ?? 0 }} |
                            <strong>Assists:</strong> {{ $player->assists ?? 0 }}
                        </li>
                    </ul>

                    <!-- Card Body: View + Delete -->
                    <div class="card-body text-center">
                        <a href="{{ route('players.show', $player->id) }}" 
                           class="btn btn-sm btn-info me-1 mb-1"
                           data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           title="Rating: {{ $overall }} | Classification: {{ $classification }}">
                            👁 View
                        </a>

                        <div class="btn-group mb-1">
                            <button type="button" class="btn btn-sm btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                🗑 Delete
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="px-3 py-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Are you sure you want to delete this player?')">
                                            Confirm Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($players->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No players found. <a href="{{ route('players.create') }}" class="alert-link">Add a new player</a>.
                </div>
            </div>
        @endif
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
</script>

<style>
/* Hover effect on player cards */
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: all 0.3s ease-in-out;
}

/* Soft background for entire dashboard */
body {
    background: #f0f8f5; /* subtle minty green shade */
}

/* Header title */
h1.fw-bold {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
}

/* Buttons hover */
.btn-lg:hover, .btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: all 0.2s ease-in-out;
}

/* Cards styling */
.card {
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
</style>
@endsection