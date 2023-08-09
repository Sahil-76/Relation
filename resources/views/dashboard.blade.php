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
                    {{-- {{ __("You're logged in!") }} --}}
                    <a href="{{ route('permissions.index') }}" style="color: blue; text-decoration: none; margin-right: 10px;">Permissions</a>
                    <a href="{{ route('rolls.index') }}" style="color: blue; text-decoration: none; margin-right: 10px;">Roles</a>
                    <a href="{{ route('users.index') }}" style="color: blue; text-decoration: none; margin-right: 10px;">Users</a>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
