@extends('layouts.app')
@section('title', 'Home')
@section('content')
<!-- Create Post -->
<form method="POST" action="{{ route('posts.store') }}" class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3" enctype="multipart/form-data">
    @csrf
    <!-- Create Post Card Top -->
    <div>
        <div class="flex items-start space-x-3">
            <!-- User Avatar -->
            <div class="flex-shrink-0">
                <img
                  class="h-10 w-10 rounded-full object-cover"
                  src="{{ asset('uploads/avatar/' . auth()->user()->user_image) }}"
                  alt="User Avatar" />
              </div>
            <!-- /User Avatar -->
            <div class="text-gray-700 font-normal w-full">
                <textarea class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0" name="post_content" rows="2" placeholder="What's going on?"></textarea>
            </div>
        </div>
    </div>

    <!-- Create Post Card Bottom -->
    <div>
        <div class="flex items-center justify-between">
            <div class="flex gap-4 text-gray-600">
            <!-- Upload Picture Button -->
            <div>
                <input
                  type="file"
                  name="post_image"
                  id="post_image"
                  class="hidden" />

                <label
                  for="post_image"
                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                  <span class="sr-only">Picture</span>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                  </svg>
                </label>
              </div>
            </div>
              <!-- /Upload Picture Button -->
            <div>
                <!-- Post Button -->
                <button type="submit" class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                    Post
                </button>
                <!-- /Post Button -->
            </div>
        </div>
    </div>
    <!-- /Create Post Card Bottom -->
</form>
<!-- /Create Post -->

<!-- Posts -->
<section id="newsfeed" class="space-y-6">
    @foreach ($posts as $post)

        <!-- Post Card -->
        <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Post Card Top -->
            <header>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- User Avatar -->
                  <div class="flex-shrink-0">
                    <img
                      class="h-10 w-10 rounded-full object-cover"
                      src="{{ asset('uploads/avatar/' . $post->user->user_image) }}"
                      alt="Al Nahian" />
                  </div>
                <!-- /User Avatar -->
                        <!-- User Info -->
                        <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                            <a href="{{ route('user.show', $post->user) }}" class="hover:underline font-semibold line-clamp-1">
                                {{ $post->user->fname }}
                            </a>
                            <a href="{{ route('user.show', $post->user) }}" class="hover:underline text-sm text-gray-500 line-clamp-1">
                                {{ '@' . $post->user->username }}
                            </a>
                        </div>
                    </div>

                    @if(auth()->user() && auth()->user()->id === $post->user_id)
                        <!-- Card Action Dropdown -->
                        <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                            <div class="relative inline-block text-left">
                                <div>
                                    <button @click="open = !open" type="button" class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600">
                                        <span class="sr-only">Open options</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Dropdown menu -->
                                <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <a href="{{ route('posts.edit', $post) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1" onclick="showDeleteConfirmation('{{ route('posts.destroy', $post) }}')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Card Action Dropdown -->
                    @endif
                </div>
            </header>

            <!-- Content -->
            <a href="{{ route('posts.show', $post) }}">
            <div class="py-4 text-gray-700 font-normal">
                <img
                      src="{{ asset('uploads/posts/' . $post->post_image) }}"
                      class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72"
                      alt="" />
                <p>{{ $post->post_content }}</p>
            </div>

            <!-- Date Created & View Stat -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                <span>{{ $post->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span>{{ $post->comments->count() }} comments</span>
                <span>•</span>
                <span>450 views</span>
            </div>
            </a>

            <hr class="my-6" />

            <!-- Comment Section -->
<div class="space-y-4">

<!-- Barta Create Comment Form -->
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
<!-- Create Comment Card Top -->
<div>
  <div class="flex items-start /space-x-3/">

    <!-- Auto Resizing Comment Box -->
    <div class="text-gray-700 font-normal w-full">
        <input type="hidden" name="post_id" value="{{ $post->id }}">
      <textarea
        x-data="{
              resize () {
                  $el.style.height = '0px';
                  $el.style.height = $el.scrollHeight + 'px'
              }
          }"
        x-init="resize()"
        @input="resize()"
        type="text"
        name="content"
        placeholder="Write a comment..."
        class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900"></textarea>
    </div>
  </div>
</div>

<!-- Create Comment Card Bottom -->
<div>
  <!-- Card Bottom Action Buttons -->
  <div class="flex items-center justify-end">
    <button
      type="submit"
      class="mt-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
      Comment
    </button>
  </div>
  <!-- /Card Bottom Action Buttons -->
</div>
<!-- /Create Comment Card Bottom -->
</form>
<!-- /Barta Create Comment Form -->

<!-- /Barta Card Bottom -->
</article>
<!-- /Barta Card -->


        </article>
        <!-- /Post Card -->
    @endforeach
</section>

<script>
    function showDeleteConfirmation(deleteUrl) {
        // Show a confirmation dialog
        if (confirm('Are you sure you want to delete this post?')) {
            // If the user clicks "OK", redirect to the delete URL
            window.location.href = deleteUrl;
        }
        // If the user clicks "Cancel", do nothing
    }
</script>

@endsection
