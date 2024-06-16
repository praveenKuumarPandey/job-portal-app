<label for="" class="mb-2 block text-sm text-slate-900 font-medium" for="{{ $for }}">
    {{ $slot }} @if($required) <span>*</span> @endif
</label>