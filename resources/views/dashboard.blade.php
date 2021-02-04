<div class="py-5">
    <div class='flex flex-wrap space-3'>
        <div class='w-1/3'>
            {!!Encore\Admin\Controllers\Dashboard::environment()!!}
        </div>
        <div class='w-1/3'>
            {!!Encore\Admin\Controllers\Dashboard::extensions()!!}
        </div>
        <div class='w-1/3'>
            {!!Encore\Admin\Controllers\Dashboard::dependencies()!!}
        </div>
    </div>
</div>
