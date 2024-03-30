<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ 'Hello '.ucfirst(Auth::user()->firstname).'. '."You're logged in!" }}
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('new_post.form') }}">New post</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('post.all') }}">My Posts</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('post.recent') }}">Recent posts</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('post.popular') }}">Popular posts</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('profile.view') }}">My profile</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('profile.edit') }}">Edit profile</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('profile.question_and_answer') }}">Change security question and answer</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('password.confirm') }}">Change password</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
