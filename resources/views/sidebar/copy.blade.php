<x-card icon='fas fa-copyright' p=''>
    @unless($provider)
    <div class="text-sm capitalize bg-orange-300 dark:bg-orange-500 alert">
        All these Posts are belong to its own writers
        <br>
        <strong class='text-xs uppercase'>See list below <i class='fas fa-arrow-down'></i></strong>
    </div>
    @else
    {{-- @php $provider->loadMissing('owner') @endphp --}}
    <div class='flex'>
        <img class='object-cover w-1/3 bg-center rounded h-28 lazyload' data-src="{{$owner?->image_url}}" />
        <div class='w-2/3 ml-1 text-left'>
            <a href='{{$owner?->url}}' target='_blank' class='text-lg font-bold text-red-600 capitalize dark:text-red-400 hover:underline'>{{$owner?->name}}</a>
            <p class='text-left text-gray-500'>
                {{$provider->bio}}
            </p>
        </div>
    </div>
    @endunless
</x-card>