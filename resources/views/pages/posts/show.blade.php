@extends('layouts.app')
@section('title', 'Post')
@section('content')

   <!-- Content -->
   <div class="py-4 text-gray-700 font-normal">
    <p>
      🎉🥳 Turning 20 today! 🎂
      <br />
      One of the best things in my life has been my love affair with
      <a
        href="#laravel"
        class="text-black font-semibold hover:underline"
        >#Laravel</a
      >
      <br />
      <br />
      Keep me in your prayers 😌
    </p>
  </div>

  <!-- Date Created & View Stat -->
  <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
    <span class="">6 minutes ago</span>
    <span class="">•</span>
    <span>450 views</span>
  </div>

@endsection
