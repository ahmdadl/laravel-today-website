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
            <canvas id="postsLikes" width="200" height="200"></canvas>
        </div>
    </div>

    <hr class='my-3 border-gray-400 w-80' />
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
          {{$postsChart->count()}},
          'Posts over Time'
        );
        createChart(
            'postsLikes',
            {!! json_encode($postsLikes->map(fn ($x) => \Str::limit($x->title, 10))) !!},
            {{ $postsLikes->map(fn ($x) => $x->liked) }},
            'Likes',
            {{$postsLikes->count()}},
            'Posts Likes'
        );
        createChart(
            'providersPosts',
            {!! json_encode($providersPosts->map(fn ($x) => \Str::title(str_replace("-", " ", $x->slug)))) !!},
            {{ $providersPosts->map(fn ($x) => $x->posts_count) }},
            'posts',
            {{$providersPosts->count()}},
            'Posts per Provider'
        );
    });


function createChart(id, labels, data, label, count, text) {
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
                        // callback: (x) => x.substr(0, 20) + '...'
                    }
                }]
            },
            defaults: {
                global: {
                    defaultColor: 'rgba(255, 0, 0, 1)'
                } 
            },
            title: {
                display: true,
                text
            }
        }
    });
}
function random_rgb() {
    // mutible by 350 to make the color always lighter
    var o = Math.round, r = Math.random, s = 350;
    return o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s);
}
</script>

<style>
    .content-wrapper {
        background: inherit;
        color: #fff;
    }
</style>