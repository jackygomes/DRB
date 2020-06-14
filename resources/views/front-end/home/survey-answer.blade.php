
<div class="row mt-2 text-center">
    <div class="col-md-12">
        <h4>{{$surveyQuestion->question}}</h4>
    </div>

    @if($surveyQuestion->surveyAnswerOptions)
        <div class="col-md-12 text-left">
            <div class="row">
                @foreach ($surveyQuestion->surveyAnswerOptions as $surveyAnswerOption)
                    <div class="col-md-2">
                        <label class="h5 pt-2" for="{{$surveyQuestion->id}}">{{ $surveyAnswerOption->answer_option }}</label>
                    </div>
                    <div class="col-md-10">
                        <div class="progress progress-height my-2" >
                            <div class="progress-bar bg-warning" role="progressbar" style="background-color:{{$surveyAnswerOption->color}} !important  ; width: {{ $surveyAnswerOption->hit_percent }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                <label class="h5 pt-2" for="{{$surveyQuestion->id}}"> {{ $surveyAnswerOption->hit_count ?  round($surveyAnswerOption->hit_percent) . '%' : '0%' }}</label>
                            </div>
                        </div>
                    </div>   
                @endforeach
            </div> 
        </div>
    @endif
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_inline_share_toolbox mx-auto"></div>
</div>