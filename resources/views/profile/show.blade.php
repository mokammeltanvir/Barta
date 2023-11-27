@extends('layouts.app')
@section('title', 'Profile')
@section('content')

    <!-- Cover Container -->
    <section
    class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[350px] space-y-8 flex items-center flex-col justify-center">
    <!-- Profile Info -->
    <div
      class="flex gap-4 justify-center flex-col text-center items-center">
      <!-- User Meta -->
      <div>
        <h1 class="font-bold md:text-2xl">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</h1>
        <!-- User Bio -->
        <div class="text-center">
            <p class="text-gray-700">{{ auth()->user()->bio }}</p>
        </div>
        <!-- /User Bio -->
      </div>
      <!-- / User Meta -->
    </div>
    <!-- /Profile Info -->

    <!-- Profile Stats -->
    <div
      class="flex flex-row gap-16 justify-center text-center items-center">
      <!-- Total Posts Count -->
      <div class="flex flex-col justify-center items-center">
        <h4 class="sm:text-xl font-bold">{{ $user->posts->count() }}</h4>
        <p class="text-gray-600">Posts</p>
      </div>

      <!-- Total Comments Count -->
      <div class="flex flex-col justify-center items-center">
        <h4 class="sm:text-xl font-bold">{{ $user->comments->count() }}</h4>

        <p class="text-gray-600">Comments</p>
      </div>
    </div>
    <!-- /Profile Stats -->

    <!-- Edit Profile Button (Only visible to the profile owner) -->
    @if (auth()->user() && auth()->user()->id === $user->id)
        <a
        href="{{ route('user.edit', auth()->user()->id) }}"
        type="button"
        class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5">
            <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
        </svg>

        Edit Profile
        </a>

    @endif
    <!-- /Edit Profile Button -->
  </section>
  <!-- /Cover Container -->

  <!-- Barta Create Post Card -->
  <form
    method="POST"
    enctype="multipart/form-data"
    class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
    <!-- Create Post Card Top -->
    <div>
      <div class="flex items-start /space-x-3/">
        <!-- Content -->
        <div class="text-gray-700 font-normal w-full">
          <textarea
            class="block w-full p-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
            name="barta"
            rows="2"
            placeholder="What's going on, Shamim?"></textarea>
        </div>
      </div>
    </div>

    <!-- Create Post Card Bottom -->
    <div>
      <!-- Card Bottom Action Buttons -->
      <div class="flex items-center justify-end">
        <div>
          <!-- Post Button -->
          <button
            type="submit"
            class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
            Post
          </button>
          <!-- /Post Button -->
        </div>
      </div>
      <!-- /Card Bottom Action Buttons -->
    </div>
    <!-- /Create Post Card Bottom -->
  </form>
  <!-- /Barta Create Post Card -->

    <!-- User Specific Posts Feed -->
    @foreach ($user->posts as $post)
        <!-- Barta Card -->
        <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Barta Card Top -->
            <header>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- User Info -->
                        <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                            <a href="{{ route('user.show', $post->user) }}" class="hover:underline font-semibold line-clamp-1">
                                {{ $post->user->fname }}
                            </a>
                            <a href="{{ route('user.show', $post->user) }}" class="hover:underline text-sm text-gray-500 line-clamp-1">
                                @if($post->user->username)
                                    {{ '@' . $post->user->username }}
                                @endif
                            </a>
                        </div>
                        <!-- /User Info -->
                    </div>

                    <!-- Card Action Dropdown -->
                    <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                        <!-- ... (existing code) ... -->
                    </div>
                    <!-- /Card Action Dropdown -->
                </div>
            </header>

            <!-- Content -->
            <a href="#">
                <div class="py-4 text-gray-700 font-normal">
                    <p>
                        {{ $post->post_content }}
                    </p>
                </div>
            </a>

            <!-- Date Created & View Stat -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                <span class="">{{ $post->created_at->diffForHumans() }}</span>
                <!-- You can add view stat logic here if needed -->
            </div>

            <!-- Barta Card Bottom -->
            <footer class="border-t border-gray-200 pt-2">
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-between">
                    <div class="flex gap-8 text-gray-600">
                        <!-- Comment Button -->
                        <button type="button" class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                            <span class="sr-only">Comment</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                            </svg>
                            <p>{{ $post->comments()->count() }}</p>
                        </button>
                        <!-- /Comment Button -->
                    </div>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </footer>
            <!-- /Barta Card Bottom -->
        </article>
        <!-- /Barta Card -->
    @endforeach
    <!-- User Specific Posts Feed -->

@endsection
