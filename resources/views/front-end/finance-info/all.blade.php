@extends('front-end.main-layout')
@section('content')
<!-- Navigation -->

<section class="financial-statement" id="mainApp">
    <div class="container h-100">
        <h3>Financial Statements </h3>
        <p>We have curated data from different companies for you. </p>
        <form action="{{route('financefilter')}}" method="GET">
            <div class="form-group">
                <label for="exampleInputEmail1">Sector</label>
                <select class="form-control" id="exampleFormControlSelect1" v-model="chosen_sector" @change="onChange">
                    <option value='sector'>Choose sector...</option>
                    @foreach ($sectors as $sector)
                        <option value="{{$sector->id}}">{{$sector->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Company</label>
                <select class="form-control" id="exampleFormControlSelect1" name="company" v-model="chosen_company" @change="companyOnChange">
                    <option value=''>Choose company...</option>
                    <option v-for="company in companies" :value="company.id" >@{{company.name}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="frequency">Frequency:</label>
                @if(Request::get('frequency') == 'yearly')
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="frequency"  value="quarterly" onclick="show()">
                    <label class="form-check-label">Quarterly</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="frequency"  checked  value="yearly" onclick="hide()">
                    <label class="form-check-label">Yearly</label>
                </div>
                @elseif (Request::get('frequency') == 'quarterly')
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="frequency" checked value="quarterly"  onclick="show()">
                    <label class="form-check-label">Quarterly</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="frequency" value="yearly" onclick="hide()">
                    <label class="form-check-label">Yearly</label>
                </div>
                @else
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="frequency" value="quarterly"  onclick="show()">
                    <label class="form-check-label">Quarterly</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input"  name="frequency"  value="yearly" onclick="hide()">
                    <label class="form-check-label">Yearly</label>
                </div>
                @endif
            </div>

            <div class="form-group drb-hide" id="drb-hide-div">
                <label for="frequency">Quarterly:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="q1" value="q1" id="q1" {{Request::get('q1') == 'q1' ? 'checked' : ''}}>
                    <label class="form-check-label">Q1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="q2" value="q2" id="q2" {{Request::get('q2') == 'q2' ? 'checked' : ''}}>
                    <label class="form-check-label">Q2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="q3" value="q3" id="q3" {{Request::get('q3') == 'q3' ? 'checked' : ''}}>
                    <label class="form-check-label">Q3</label>
                </div>
                {{-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="q4" value="q4" id="q4" {{Request::get('q4') == 'q4' ? 'checked' : ''}}>                    <label class="form-check-label">Q4</label>
                </div> --}}
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form></br>
        <div class="row align-items-center h-100">
            <div class="col-md-12 text-center">
                @if($frequency == 'yearly')
                    @include('front-end.finance-info.yearlydata')
                @elseif($frequency == 'quarterly')
                    @include('front-end.finance-info.quarterlydata')
                @else
                    @include('front-end.finance-info.datatable')

                @endif

            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var app = new Vue({
    el: '#mainApp',
    data () {
        return {
        chosen_sector: null,
        companies: [],
        chosen_company: null,
        }
    },

    mounted:function(){
        if (localStorage.getItem('chosen_sector') == null)
        {
            this.chosen_sector = "sector"
        }else{
            this.chosen_sector = localStorage.getItem('chosen_sector');
        }
        this.getCompany();
        this.chosen_company = localStorage.getItem('chosen_company');
    },


    methods: {

        onChange: function(){
            localStorage.setItem('chosen_sector', this.chosen_sector);
            this.getCompany();
        },

        companyOnChange: function(){
            localStorage.setItem('chosen_company', this.chosen_company);
        },



        getCompany:function(){
            if(this.chosen_sector!=null){
                fetch('/api/getcompany/' + this.chosen_sector)
                .then(function(response) {
                    return response.json();
                })
                .then(response => (this.companies = (response)))
            }
        }
    },

    })
</script>
<script>
    var frequency = new URLSearchParams(window.location.search).get('frequency');
    if(frequency === 'yearly'){
        this.hide();
    }if(frequency === 'quarterly'){
        this.show();
    }

    function hide(){
        document.getElementById('drb-hide-div').style.display ='none';
        document.getElementById("q1").checked=false;
        document.getElementById("q2").checked=false;
        document.getElementById("q3").checked=false;
        document.getElementById("q4").checked=false;
    }

    function show(){
        document.getElementById('drb-hide-div').style.display = 'block';
    }
</script>
@endsection
