@extends('layouts.app')
@section('title', 'Home')
@section('content')
<!-- Create Post -->

<!-- Barta Create Post Card -->
<form method="POST" action="{{ route('posts.store') }}"  class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
    @csrf
    <!-- Create Post Card Top -->
    <div>
        <div class="flex items-start space-x-3">
            <!-- User Avatar (Placeholder, replace with your actual avatar logic) -->
            <div class="bg-gray-300 w-10 h-10 rounded-full"></div>
            <!-- /User Avatar -->

          <div class="text-gray-700 font-normal w-full">
    <textarea
        class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
        name="post_content"
        rows="2"
        placeholder="What's going on?"
    ></textarea>
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
                    class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white"
                >
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

<!-- Posts -->

<!-- Newsfeed -->
<section id="newsfeed" class="space-y-6">

    @foreach ($posts as $post)
  <!-- Barta Card -->
   <article
   class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
   <!-- Barta Card Top -->
   <header>
     <div class="flex items-center justify-between">
       <div class="flex items-center space-x-3">
         <!-- User Info -->
         <div class="text-gray-900 flex flex-col min-w-0 flex-1">
           <a
             href="{{ route('profile.show', $post->user) }}"
             class="hover:underline font-semibold line-clamp-1">
                {{ $post->user->fname }}
           </a>

           <a
             href="{{ route('profile.show', $post->user) }}"
             class="hover:underline text-sm text-gray-500 line-clamp-1">
                {{ '@' . $post->user->username }}
           </a>
         </div>
         <!-- /User Info -->
       </div>

       @if(auth()->user() && auth()->user()->id === $post->user_id)
       <!-- Card Action Dropdown -->
       <div
         class="flex flex-shrink-0 self-center"
         x-data="{ open: false }"        >

         <div class="relative inline-block text-left">
           <div>
             <button
               @click="open = !open"
               type="button"
               class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
               id="menu-0-button"
             >
               <span class="sr-only">Open options</span>
               <svg
                 class="h-5 w-5"
                 viewBox="0 0 20 20"
                 fill="currentColor"
                 aria-hidden="true"
               >
                 <path
                   d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"
                 ></path>
               </svg>
             </button>
           </div>
           <!-- Dropdown menu -->
           <div
             x-show="open"
             @click.away="open = false"
             class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
             role="menu"
             aria-orientation="vertical"
             aria-labelledby="user-menu-button"
             tabindex="-1"
           >
           @if(auth()->user() && auth()->user()->id === $post->user_id)
             <a
               href="{{ route('posts.edit', $post) }}"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
               role="menuitem"
               tabindex="-1"
               id="user-menu-item-0"
               >Edit</a
             >
             @endif
             @if(auth()->user() && auth()->user()->id === $post->user_id)

             <form method="POST" action="{{ route('posts.delete', $post) }}">
                 @csrf
                 @method('DELETE')
             <button
             type="submit"
             class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
             role="menuitem"
             tabindex="-1"
             id="user-menu-item-1"
             onclick="showDeleteConfirmation('{{ route('posts.delete', $post) }}')"
          >
              Delete
          </button>
         </form>
         @endif


           </div>
         </div>

       </div>
       <!-- /Card Action Dropdown -->
       @endif
     </div>
   </header>

   <!-- Content -->
   <div class="py-4 text-gray-700 font-normal">
   <p>{{ $post->post_content }}</p>
   </div>

   <!-- Date Created & View Stat -->
   <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
    <span class="">{{ $post->created_at->diffForHumans() }}</span>
     <span class="">•</span>
     <span>3 comments</span>
     <span class="">•</span>
     <span>450 views</span>
   </div>

   <hr class="my-6" />

   <!-- Barta Create Comment Form -->
   <form
     action=""
     method="POST">
     <!-- Create Comment Card Top -->
     <div>
       <div class="flex items-start /space-x-3/">
         <!-- User Avatar -->
         <!-- <div class="flex-shrink-0">-->
         <!--              <img-->
         <!--                class="h-10 w-10 rounded-full object-cover"-->
         <!--                src="https://avatars.githubusercontent.com/u/831997"-->
         <!--                alt="Ahmed Shamim" />-->
         <!--            </div> -->
         <!-- /User Avatar -->

         <!-- Auto Resizing Comment Box -->
         <div class="text-gray-700 font-normal w-full">
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
             name="comment"
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

            @endforeach

          </section>
          <!-- /Newsfeed -->


@endsection

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

