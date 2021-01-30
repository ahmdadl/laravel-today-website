@props(['for', 'rule' => 1])


@error($for)
    <template x-show="!{{$for}}.length">
        <p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>{{ $message }}</p>
    </template>
@enderror

<p x-show='{{$for}}.length && {{ $rule }}' class='pt-2 text-sm text-blue-600 dark:text-blue-400'>
    {{ $slot }}
</p>
