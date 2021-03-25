<div class="col-md-12 subscribe">
    <div class="col-12 col-md-4 offset-md-4 subscribe_form">
        <div style="color: #101c53;">
            <h1>DRB Newsletters</h1>
            <h5>Your Daily Scoop oF Financial News</h5>
        </div>
        <form action="{{route('subscribe')}}" method="post">
            @csrf
            <div class="input-group">
                <input type="email" class="form-control rounded-0" name="email" placeholder="Enter your email">
                <span class="input-group-btn">
                    <button class="btn btn-warning rounded-0" type="submit">Subscribe</button>
                </span>
            </div>
        </form>
    </div>
</div>