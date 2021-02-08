<div class='w-full py-5'>
    <div class='grid grid-cols-2 gap-4 sm:grid-cols-3'>
        <div class='px-5 py-2 text-white bg-red-500 rounded-md'>
            <h1 class='text-6xl font-bold'>{{ $users }}</h1>
            <p class='font-semibold text-gray-400'>Members</p>
        </div>
        <div class='px-5 py-2 text-white bg-blue-500 rounded-md'>
            <h1 class='text-6xl font-bold'>{{ $posts }}</h1>
            <p class='font-semibold text-gray-400'>Posts</p>
        </div>
        <div class='px-5 py-2 text-white bg-green-500 rounded-md'>
            <h1 class='text-6xl font-bold'>{{ $providers }}</h1>
            <p class='font-semibold text-gray-400'>Providers</p>
        </div>
    </div>

    <div class='grid grid-cols-1 gap-2'>
        <div class='relative' style='height: 33rem'>
            <canvas id="postsOverTime" width="200" height="200"></canvas>
        </div>
        <div class='relative' style='height: 33rem'>
            <canvas id="providersPosts" width="200" height="200"></canvas>
        </div>
        <div class='relative' style='height: 33rem'>
            <canvas id="providersPopular" width="200" height="200"></canvas>
        </div>
        <div class='relative' style='height: 33rem'>
            <canvas id="postsLikes" width="200" height="200"></canvas>
        </div>
        <div class='relative' style='height: 33rem'>
            <canvas id="PopularPosts" width="200" height="200"></canvas>
        </div>
    </div>

    {{-- <hr class='my-5 border-gray-400 w-80' /> --}}

    {{-- <div class='grid grid-cols-1 gap-3 sm:grid-cols-2'>
        <div class='text-white bg-gray-700'>
            <h2 class='p-3 m-0 text-2xl font-semibold bg-green-700'>Top Popular Posts</h2>
            <div class=''>
                <ul class='list-none'>
                    @foreach($postsLikes->take(10) as $post)
                        <li class='flex justify-between p-2 space-x-3 border-b border-gray-600'>
                            <span>{{$post->title}}</span>
                            <span class='text-2xl font-semibold likesCount'>{{$post->liked}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div> --}}
</div>

<script>
    $(function () {
        createChart(
            'postsOverTime',
            {!! json_encode($postsChart->map(
                fn ($x) => $x->created_at->format('d M Y'))
            ) !!},
            {{ $postsChart->map(fn ($x) => $x->count) }},
          'Posts',
          'Posts over Time'
        );
        createChart(
            'postsLikes',
            {!! json_encode($postsLikes->map(fn ($x) => \Str::limit($x->title, 10))) !!},
            {{ $postsLikes->map(fn ($x) => $x->likes_count) }},
            'Likes',
            'Posts Likes',
        );
        createChart(
            'providersPosts',
            {!! json_encode($providersPosts->map(fn ($x) => \Str::title(str_replace("-", " ", $x->slug)))) !!},
            {{ $providersPosts->map(fn ($x) => $x->posts_count) }},
            'posts',
            'Posts per Provider'
        );
        createChart(
            'providersPopular',
            {!! json_encode($providersPopular->map(fn ($x, $inx) => \Str::title(str_replace("-", " ", $inx)))->values()) !!},
            {!! json_encode($providersPopular->values()) !!},
            'Likes',
            'providers posts Likes',
        );
        createChart(
            'PopularPosts',
            {!! json_encode($popularPosts->map(fn ($x) => \Str::limit($x->title, 11))) !!},
            {{ $popularPosts->map(fn ($x) => $x->likes_count) }},
            'likes',
            'Popular Posts'
        );

        // $('.likesCount').each(function () {
        //     $(this).text(formatNum($(this).text()))
        // });
    });

function random_rgb() {
    // mutible by 350 to make the color always lighter
    var o = Math.round, r = Math.random, s = 350;
    return o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s);
}
function formatNum (num) {
    var si = [
        { value: 1, symbol: "" },
        { value: 1E3, symbol: "k" },
        { value: 1E6, symbol: "M" },
        { value: 1E9, symbol: "G" },
        { value: 1E12, symbol: "T" },
        { value: 1E15, symbol: "P" },
        { value: 1E18, symbol: "E" }
    ];
    var rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    var i;
    for (i = si.length - 1; i > 0; i--) {
        if (num >= si[i].value) {
        break;
        }
    }
    return (num / si[i].value).toFixed(1).replace(rx, "$1") + si[i].symbol;
}

function createChart(id, labels, data, label, text, updateTooltip) {
    if (typeof updateTooltip === 'undefined') {
        updateTooltip = (x) => x;
    }

    var ctx = document.getElementById(id).getContext('2d');
    var bg = random_rgb();
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                fill: false,
                label,
                data,
                backgroundColor: 'rgb('+ bg +')',
                borderColor: 'rgb('+ bg +', 0.3)'
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                    }
                }],
                xAxes: [{
                    ticks: {
                        // callback: xAxisTxt,
                    }
                }]
            },
            defaults: {
                global: {
                    defaultColor: 'rgba(255, 0, 0, 1)',
                },
            },
            title: {
                display: true,
                text
            },
            tooltips: {
                callbacks: {
                    label: function (item, data) {
                        let label = item.label || '';

                        if (label) {
                            label += ': ';
                        }

                        label += formatNum(item.value);
                        
                        return updateTooltip(label);
                    }
                }
            }
        }
    });
}
</script>

<style>
    .content-wrapper {
        background: inherit;
        color: #fff;
    }
</style>