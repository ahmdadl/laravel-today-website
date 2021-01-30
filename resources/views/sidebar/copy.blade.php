<x-card icon='fas fa-copyright' p=''>
    @unless($provider)
    <div class="text-sm capitalize bg-orange-300 dark:bg-orange-500 alert">
        All these Posts are belong to its own writers
        <br>
        <strong class='text-xs uppercase'>See list below <i class='fas fa-arrow-down'></i></strong>
    </div>
    @else
    <div class='flex'>
        <div class='w-1/3 h-32 bg-center bg-cover rounded' style="background-image: url('{{$provider->image_url}}')">
        </div>
        <div class='w-2/3 ml-1 text-left'>
            <a href='{{$provider->url}}' target='_blank' class='text-lg font-bold text-red-600 capitalize dark:text-red-400 hover:underline'>{{$provider->title}}</a>
            <p class='text-left text-gray-500'>
                {{$provider->bio}}
            </p>
        </div>
    </div>
    @endunless
</x-card>