<div>
    <select size="{{$size}}" {{$ddtype}} @if ($ddtype=='multiple' ) name="{{$name}}[]" @else name="{{$name}}" @endif
        id="{{$name}}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ">
        @foreach($optionList as $option)
        <option value="{{ $option->id }}">{{ $option->skill_name }}</option>
        @endforeach
    </select>
    @error($name)
    <div class="mt-1 text-xs text-red-500">
        {{ $message}}
    </div>
    @enderror
</div>