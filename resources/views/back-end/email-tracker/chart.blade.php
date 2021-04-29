@extends('back-end.admin-layout')

@section('content')
    <div class="row">
        <div class="col-12 text-right">
            <a href="{{route('email.tracker.index')}}" class="btn btn-sm btn-primary text-white">Trackers</a>
        </div>
    </div>
    <div style="height: 75vh; display: flex; align-items: center;">
        <canvas id="myChart" height="130"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($emailStat['title']) !!},
                datasets: [{
                    label: 'Email Tracking Analytic Last For 25 Emails',
                    data: {!! json_encode($emailStat['ratio']) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgb(75, 192, 192, 0.2)',
                    borderWidth: 1,
                    fill:true,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        scaleLabel:{
                            display:true,
                            labelString: 'Email Open Ratio'
                        },
                        ticks: {
                            max: 100,
                            min: 0,
                            stepSize: 10,
                            callback: function(value) {
                                return (value  + '%');
                            }
                        }
                    }],
                    xAxes: [{
                        scaleLabel:{
                            display:true,
                            labelString: 'Emails'
                        },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }]
                }
            }
        });
    </script>
@endsection