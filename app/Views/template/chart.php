<script>
    $(function() {
        // Jumlah Santri
        var areaChartData = {
            labels: <?= JSON_ENCODE($data_nama); ?>,
            datasets: [{
                label: 'Jumlah Santri per Tahun <?= date('Y'); ?>',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: <?= JSON_ENCODE($data_jml); ?>
            }, ]
        };

        var barChartCanvas = $('#bar').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp = areaChartData.datasets
        barChartData.datasets = temp

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })

        // Jumlah Hafalan
        $juz = [];
        for ($i = 1; $i <= 30; $i++) {
            $juz[$i - 1] = $i;
        }
        var aduan = {
            labels: $juz,
            datasets: [{
                label: 'Penduduk per Tahun',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: true,
                fill: false,
                lineTension: 0.1,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: <?= JSON_ENCODE($juz); ?>
            }, ]
        };
        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                    }
                }]
            }
        }

        var lineChartCanvas = $('#line').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        var lineChartData = $.extend(true, {}, aduan)

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })
    })
</script>