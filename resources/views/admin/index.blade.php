<div class='w-full py-5'>
    <div class='grid grid-cols-2 gap-4 sm:grid-cols-3'>
        <div class='px-5 py-2 text-white bg-red-600 rounded-md'>
            <h1 class='text-6xl font-bold'>{{ $users }}</h1>
            <p class='font-semibold text-gray-400'>Members</p>
        </div>
        <div class='px-5 py-2 text-white bg-blue-600 rounded-md'>
            <h1 class='text-6xl font-bold'>{{ $posts }}</h1>
            <p class='font-semibold text-gray-400'>Posts</p>
        </div>
        <div class='px-5 py-2 text-white bg-green-600 rounded-md'>
            <h1 class='text-6xl font-bold'>{{ $providers }}</h1>
            <p class='font-semibold text-gray-400'>Providers</p>
        </div>
    </div>

    <div class='grid grid-cols-1 gap-2 md:grid-cols-2'>
        <div class='relative' style='height: 35rem'>
            <canvas id="myChart" width="200" height="200"></canvas>
        </div>
    </div>
</div>

<script>
    $(function () {
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($postsChart->map(fn ($x) => $x->created_at->format('d M Y'))) !!},
                datasets: [{
                    label: 'posts',
                    data: {{$postsChart->map(fn ($x) => $x->count)}},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        ...Array(58).fill(0).map(x => "#" + ((1<<24)*Math.random() | 0).toString(16))
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
            }
        });
    });

</script>
