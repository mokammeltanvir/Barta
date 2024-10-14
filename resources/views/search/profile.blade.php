<!-- search.profile.blade.php -->

@extends('layouts.app')
@section('title', 'Search')
@section('content')
    <!-- Search -->
    <div class="py-4">
        <h2 class="text-2xl font-bold mb-4">Search Results for "{{ $search }}"</h2>

        @if ($users->count() > 0)
            @foreach ($users as $searchedUser)
                <!-- Display User Profile Information -->
                @include('profile.partials.user_profile', ['user' => $searchedUser])
            @endforeach
        @else
            <p>No users found.</p>
        @endif
    </div>
@endsection
