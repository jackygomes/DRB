
<script src="/vendor/chart.js/Chart.min.js"></script>

<script>

/* chart.js chart examples */

// chart colors
var colors = ['#0066cc','#e67300','#a6a6a6','#c3e6cb','#dc3545','#6c757d'];

/* 3 donut charts */
var donutOptions = {
cutoutPercentage: 85, 
legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};

// donut 1
var chDonutData1{{$surveyQuestion->id}} = {
    labels: @json($surveyQuestion->surveyAnswerOptions->pluck('answer_option')),
    datasets: [
    {
        backgroundColor: colors.slice(0,3),
        borderWidth: 0,
        data: @json($surveyQuestion->surveyAnswerOptions->pluck('hit_count'))
    }
    ]
};

var chDonut1{{$surveyQuestion->id}} = document.getElementById("chDonut1{{$surveyQuestion->id}}");
if (chDonut1{{$surveyQuestion->id}}) {
new Chart(chDonut1{{$surveyQuestion->id}}, {
    type: 'pie',
    data: chDonutData1{{$surveyQuestion->id}},
    options: donutOptions
});
}
</script>