<div class="w-full md:w-1/2 my-4 justify-self-center">
    <input {{ $attributes->merge(['class' => 'w-full px-4 py-2 rounded-full border border-slate-200 focus:outline-none focus:border-blue-300 border-solid']) }}>
    @error($attributes->get('name'))
        <span class="text-red-400">
            {{ $message }}
        </span>
    @enderror
</div>