@extends('layouts.app')
@section('container')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        @if(session()->has('status'))
            <div id="flash-message" class="p-4 mb-4 text-xl text-green-800 rounded-lg dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if(session()->has('loginError'))
            <div id="flash-message" class=" font-bold p-4 mb-4 text-xl text-red-500 rounded-lg dark:bg-gray-800 dark:text-green-400" role="alert">
                {{ session('loginError') }}
            </div>           
        @endif
        <div class="w-full rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                    Log in to your account
                </h1>
                <form class="space-y-4 md:space-y-6" action="/login" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror border border-gray-300 text-gray-900 rounded-lg
                         focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                          dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com" autofocus required value="{{ old('email') }}">
                          @error('email')
                              <div class="text-red-400 invalid-feedback">{{ $message }}</div>
                          @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @error('g-recaptcha-response')
                            <div class="text-red-400 invalid-feedback">{{ $message }}</div>
                        @enderror
                    <div class=" flex items-start ml-3 text-sm justify-between">
                        <div class="flex items-start"> 
                            <div class="ml-3 text-sm"></div>
                        </div>
                        <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" >Login</button>
                    <p class="text-sm font-light text-black dark:text-gray-400">
                        Don’t have an account yet? <a href="/register" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Register Now!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>
@endsection
