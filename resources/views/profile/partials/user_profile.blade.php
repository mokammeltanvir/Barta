<!-- user_profile.blade.php -->

<!-- Cover Container -->
<section class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[350px] space-y-8 flex items-center flex-col justify-center">
    <!-- Profile Info -->
    <a href="{{ route('user.show', ['user' => $user]) }}" class="flex gap-4 justify-center flex-col text-center items-center">
        <!-- Avatar -->
        <div class="relative">
            <img class="w-32 h-32 rounded-full border-2 border-gray-800" src="{{ asset('uploads/avatar/' . $user->user_image) }}" alt="User Avatar" />
        </div>
        <!-- /Avatar -->
        <div>
            <h1 class="font-bold md:text-2xl">{{ $user->fname }} {{ $user->lname }}</h1>
            <!-- User Bio -->
            <div class="text-center">
                <p class="text-gray-700">{{ $user->bio }}</p>
            </div>
            <!-- /User Bio -->
        </div>
        <!-- / User Meta -->
    </a>
    <!-- /Profile Info -->

    <!-- Profile Stats -->
    <div class="flex flex-row gap-16 justify-center text-center items-center">
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
</section>
<!-- /Cover Container -->
