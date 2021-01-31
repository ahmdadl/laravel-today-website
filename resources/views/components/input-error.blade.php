@props(['for', 'rule' => 1, 'isAjax' => false])
<div class='pt-2'>
@unless($isAjax)
    @error($for)
        <template x-if="!{{$for}}.length">
            <p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }} x-cloak>{{ $message }}</p>
        </template>
    @enderror
@endunless

<p x-show='{{$for}}.length && {{ $rule }}' class='pt-2 text-sm text-blue-600 dark:text-blue-400' x-cloak>
    {{ $slot }}
</p>
</div>