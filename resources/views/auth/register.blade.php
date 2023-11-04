
<!DOCTYPE html>
<html class="html h-full bg-white">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
      <title>Barta | Register</title>
    @include('layouts.inc.style')
  </head>
  <body class="h-full">

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <a href="/" class="text-center text-6xl font-bold text-gray-900">
            <h1>Barta</h1>
        </a>
        <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Create a new account
        </h1>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" method="POST" action="{{ route('register') }}">
            @csrf <!-- CSRF protection -->
            <!--First Name -->
            <div>
                <label for="fname" class="block text-sm font-medium leading-6 text-gray-900">
                    First Name
                </label>
                <div class="mt-2">
                    <input value="{{ old('fname') }}" id="fname" name="fname" type="text" autocomplete="fname" placeholder="Enter Your First Name" required
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
                @error('fname') <!-- Display validation error for 'name' field -->
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!--Last Name -->
            <div>
                <label for="lname" class="block text-sm font-medium leading-6 text-gray-900">
                    Last Name
                </label>
                <div class="mt-2">
                    <input value="{{ old('lname') }}" id="lname" name="lname" type="text" autocomplete="lname" placeholder="Enter Your Last Name ( optional )"
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
                @error('lname') <!-- Display validation error for 'name' field -->
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">
                    Username
                </label>
                <div class="mt-2">
                    <input value="{{ old('username') }}" id="username" name="username" type="text" autocomplete="username" placeholder="Username" required
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
                @error('username') <!-- Display validation error for 'username' field -->
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                    Email address
                </label>
                <div class="mt-2">
                    <input value="{{old('email')}}" id="email" name="email" type="email" autocomplete="email" placeholder="yourmail@mail.com" required
                        class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
                @error('email') <!-- Display validation error for 'email' field -->
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                    Password
                </label>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" placeholder="••••••••" required
                        class="block w-full rounded-md border-0 p-2 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
                </div>
                @error('password') <!-- Display validation error for 'password' field -->
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Register
                </button>
            </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-500">
            Already a member?
            <a
              href="{{ route('login') }}"
              class="font-semibold leading-6 text-black hover:text-black"
              >Sign In</a
            >
          </p>
    </div>
</div>




</body>
</html>
