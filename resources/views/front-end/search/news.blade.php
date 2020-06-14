<section class="news" id ="news">
    <div class="container">
        {{-- <div class="dropdown show">
            <a class="btn dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Any time
            </a> --}}
            <div class="form-group ropdown show">
                <select class="form-control" id="exampleFormControlSelect1" v-model="selected_time_range" @click="getAllNews">
                  <option value="0">Any time</option>
                  <option value="1">Past 24 hours</option>
                  <option value="7">Past week</option>
                  <option value="30">Past month</option>
                  <option value="365">Past year</option>
                  <option value="custom">Custom range</option>
                 
                </select>
              </div>
        <div class="row" v-if="laravel">
            <div class="col-md-12">
                @if($allnews->count() == 0)
                    <h3>Your search  did not match any news.</h3>
                @else
                    @foreach($allnews as $news)
                        <div class="row">
                            <div class="col-md-2">
                                @if($news->image)
                                    <a href="{{route('news.single',$news->id)}}">
                                        <img src="{{ env('S3_URL') }}{{$news->image}}" class="mr-3 img-fluid news-index-img" alt="...">
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-10" style="text-align: left">
                                <a href="{{route('news.single',$news->id)}}"><h5 class="pt-3 pt-md-0">{{ $news->heading }}</h5></a>
                                <a href="{{route('news.single',$news->id)}}"><p class="text-justify">{{ implode(' ', array_slice(explode(' ', strip_tags($news->body) ), 0, 70))}}</p></a>
                                <a href="{{route('news.single',$news->id)}}">See More ></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endif    
            </div>
            <div class="col-md-12 mb-5">
                <div class="row justify-content-center">
                    {{ $allnews->links() }}
                </div>
            </div>
        </div>
    </div>

    <p v-if="selected_time_range == 'custom'">Show news from @{{this.custom_date_range_from}} to @{{this.custom_date_range_to}}</p>
    <div class="row" v-if="vue">
    <div class="col-md-12">

    <div class="row" v-for="news in allNews" :key="news.id">
              
                <div class="row">
                    <div class="col-md-2">
                        <a href="#" v-if="news.image">
                            <img :src="getImageUrl(news.image)" class="mr-3 img-flui  d news-index-img" alt="...">
                        </a>
                    </div>
                    <div class="col-md-10">
                        <a href="#"><h5 class="pt-3 pt-md-0">@{{ news.heading }}</h5></a>
                        <a href="#"><p class="text-justify word-break">@{{ news.body.slice(0, 500) }}</p></a>
                        <a :href="getNewsUrl(news.id)">See More ></a>
                    </div>
                </div>
            <hr>
            </div>

            <hr>
        </div>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customised date range</h5>
                <button type="button" class="close" @click="closeModal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form  method="GET">
                    <div class="form-group row">
                        <label for="example-date-input" class="col-4 col-form-label">From</label>
                        <div class="col-8">
                            <input class="form-control" type="date" v-model="custom_date_range_from">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-4 col-form-label">To</label>
                        <div class="col-8">
                            <input class="form-control" type="date" v-model="custom_date_range_to">
                        </div>
                    </div>
                </form>
                <button @click="customSearch">Filter</button>
            </div>
            
            </div>
        </div>
    </div>
</section>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var app = new Vue({
        el: '#news',
        data () {
            return {
                allNews: [],
                selected_time_range: 0,
                laravel: true,
                vue: false,
                url: "{{ env('S3_URL') }}",
                custom_date_range_to: null,
                custom_date_range_from: null
            }
        },

        watch: {
            selected_time_range: function (val){
                if(val == 'custom'){
                    $("#exampleModal").modal('show');
                }
            }
        },
      
        methods: {
            getNewsUrl: function(id){
                return '/single-news/' + id;
            },

            customSearch: function(){
                if(this.custom_date_range_from != null && this.custom_date_range_to != null){
                    fetch('/api/news/from/' + this.custom_date_range_from + '/to/' + this.custom_date_range_to)
                        .then(function(response) {
                            return response.json();
                        })
                        .then(response => (this.allNews = (response)))
                }
            },
            closeModal: function(){
                $("#exampleModal").modal('hide');
            },

            getAllNews: function(){
                    this.laravel = false,
                    this.vue = true,
                    console.log("calling get news");
                    if(this.selected_time_range == null){
                        range = 0;
                    }else if(this.selected_time_range != 'custom'){
                        range = this.selected_time_range;
                    }else{
                        range = 0;
                    }

                    fetch('/api/news/' + range)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(response => (this.allNews = (response)))
                },
            getImageUrl: function(input){
                return  this.url + input;
            }
        }
    })
</script>
@endsection