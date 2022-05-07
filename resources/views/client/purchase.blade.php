@extends('layouts.app')

@section('content')
<div>
    <div class="bg-blue-100 h-32">
        <div class="flex">
            <span class="text-blue-400 text-center w-full text-2xl mt-8">
                PURCHASE
            </span>
        </div>
        <div class="flex mx-4 justify-between">
            <div>
                <span class="text-blue-400">Current balance</span>
                <br>
                <span class="text-blue-400 text-3xl">
                    ${{ $currentBalance }}
                </span>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('purchase.store') }}" class="m-4 text-gray-700">
        @csrf
        <div class="flex flex-wrap justify-center">
            <div class="w-full md:w-1/2">
                <label class="block mb-1 text-blue-300">Amount</label>
                <input name="amount" value="{{ old('amount') }}" class="w-full h-10 px-3 tex-blue-400 text-base placeholder-blue-400 border rounded-lg focus:outline-none focus:shadow-outline" type="number" min="0" step="0.01" />
                @error('amount')
                    <span class="text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap justify-center">
            <div class="w-full md:w-1/2">
                <label class="block mb-1 text-blue-300">Date</label>
                <input name="datetime" value="{{ old('datetime') }}" class="w-full h-10 px-3 tex-blue-400 text-base placeholder-blue-400 border rounded-lg focus:outline-none focus:shadow-outline" type="date" max="{{ now()->format('Y-m-d') }}" />
                @error('datetime')
                    <span class="text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="flex flex-wrap justify-center">
            <div class="w-full md:w-1/2">
                <label class="block mb-1 text-blue-300">Description</label>
                <input name="description" value="{{ old('description') }}" class="w-full h-10 px-3 tex-blue-400 text-base placeholder-blue-400 border rounded-lg focus:outline-none focus:shadow-outline" type="text" />
                @error('description')
                    <span class="text-red-400">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="flex justify-center mt-12">
            <button class="w-full md:w-1/2 bg-blue-400 text-white p-4">
                ADD PURCHASE
            </button>
        </div>
    </form>
</div>
@endsection