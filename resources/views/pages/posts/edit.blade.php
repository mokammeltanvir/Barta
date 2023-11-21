@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
 <!-- Edit Post Card -->
 <form method="POST" enctype="multipart/form-data" action="{{ route('posts.update', $post) }}" class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
    @method('PUT')
    @csrf
    <!-- Edit Post Card Top -->
 <div>
     <div class="flex items-start /space-x-3/">
         <!-- User Avatar (You can replace this with the current user's avatar) -->
         <div class="flex-shrink-0">
             <img
                 class="h-10 w-10 rounded-full object-cover"
                 src="https://avatars.githubusercontent.com/u/831997"
                 alt="Ahmed Shamim"
             />
         </div>
         <!-- Content -->
         <div class="text-gray-700 font-normal w-full">
            <textarea
            class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
            name="post_content"
            rows="2"
            placeholder="Edit your post..."
        > {{ $post->post_content }}</textarea>

         </div>
     </div>
 </div>

 <!-- Edit Post Card Bottom -->
 <div>
     <!-- Card Bottom Action Buttons -->
     <div class="flex items-center justify-end">
         <div>
             <!-- Update Button -->
             <button
                 type="submit"
                 class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white"
             >
                 Update
             </button>
             <!-- /Update Button -->
         </div>
     </div>
     <!-- /Card Bottom Action Buttons -->
 </div>
 <!-- /Edit Post Card Bottom -->
</form>
<!-- /Edit Post Card -->
@endsection
