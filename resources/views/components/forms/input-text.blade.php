<div>

    @isset($label) 
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1"> {{ $label }} </label>
    @endisset

    <input 
    
    type="{{ $type }}" 
    name="{{$name}}" 
    {{-- @isset($placeholder) placeholder="{{ $placeholder }}"  @endisset --}}
    {{ $attributes->merge() }}
    {{-- value="{{$value}}" --}}
    class="form-input rounded-full px-4 py-3" />



 {{-- class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
    focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500
    disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
    invalid:border-pink-500 invalid:text-pink-600
    focus:invalid:border-pink-500 focus:invalid:ring-pink-500 mb-3"> --}}
</div>