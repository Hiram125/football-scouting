@extends('layouts.app')

@section('content')
<div class="container my-5">

    <!-- Hero Section -->
    <div class="text-center mb-4">
        <h1 class="display-3 fw-bold homepage-title">Welcome to Football Scout</h1>
        <p class="lead text-muted">Manage players, track stats, and view performance ratings all in one place.</p>

        <!-- Direct Player Search Form -->
        <form action="{{ route('players.search') }}" method="GET" class="d-flex gap-2 justify-content-center mt-3">
            <input type="text" name="name" class="form-control form-control-lg" 
                   placeholder="Enter player name..." required>
            <button type="submit" class="btn btn-success btn-lg">🔍 Search</button>
        </form>

        <!-- View Players Button -->
        <div class="mt-3">
            <a href="{{ route('players.index') }}" class="btn btn-success btn-lg">
                ⚽ View All Players
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row g-4">
        <!-- Player Management -->
        <div class="col-md-4">
            <div class="card h-100 shadow feature-card">
                <div class="card-body text-center">
                    <h4 class="card-title">Player Dashboard</h4>
                    <p class="card-text">See all players, edit stats, and track performance with ease.</p>
                    <a href="{{ route('players.index') }}" class="btn btn-primary">Go to Dashboard</a>
                </div>
            </div>
        </div>

        <!-- Add New Player -->
        <div class="col-md-4">
            <div class="card h-100 shadow feature-card">
                <div class="card-body text-center">
                    <h4 class="card-title">Add New Player</h4>
                    <p class="card-text">Quickly add new players and fill in their abilities and match stats.</p>
                    <a href="{{ route('players.create') }}" class="btn btn-success">Add Player</a>
                </div>
            </div>
        </div>

        <!-- Performance Ratings -->
        <div class="col-md-4">
            <div class="card h-100 shadow feature-card">
                <div class="card-body text-center">
                    <h4 class="card-title">Player Ratings</h4>
                    <p class="card-text">Track player technical and physical abilities with professional rating badges.</p>
                    <a href="{{ route('players.index') }}" class="btn btn-warning text-dark">View Ratings</a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Custom Styles -->
<style>
/* Page background */
body {
    background: #e0f7f2; /* soft minty teal */
}

/* Homepage title */
.homepage-title {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    background: linear-gradient(90deg, #34ace0, #33d9b2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

/* Cards styling */
.feature-card {
    border-radius: 1rem;
    transition: transform 0.2s, box-shadow 0.2s;
}
.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
}

/* Search input styling */
input.form-control-lg {
    border-radius: 0.5rem;
    max-width: 400px;
}
button.btn-success {
    border-radius: 0.5rem;
}
</style>
@endsection