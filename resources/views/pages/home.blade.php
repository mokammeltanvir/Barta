@extends('layouts.app')
@section('title', 'Home')
@section('content')
<!-- Create Post -->
@include('pages.posts.create')
<!-- Posts -->
@include('pages.posts.index')
@endsection
