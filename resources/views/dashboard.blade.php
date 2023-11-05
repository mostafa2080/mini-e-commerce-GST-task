@php
    $id = Auth::user()->id;
    $userid = App\Models\User::find($id);
    $status = $userid->status;
@endphp



{{-- @if ($status == 'active')
    <h4>Your Account Is <span class="text-success">Active </span> </h4>
@else
    <h4>Your Account Is <span class="text-danger">InActive </span> </h4>
    <p class="text-danger"><b>Plz wait admin will check and approve your account</b></p>
@endif --}}


@if ($status == 'active')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
@endif
