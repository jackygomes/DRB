<div class="col-md-12 subscribe">
    <div class="col-12 col-md-4 offset-md-4 subscribe_form">
        <div style="color: #101c53;" class="text-center">
            <h1>DRB Newsletters</h1>
            <h5>Your Daily Scoop oF Financial News</h5>
        </div>
        <form action="{{route('subscribe')}}" method="post">
            @csrf
            <div class="input-group">
                <input type="email" class="form-control rounded-left" name="email" placeholder="Enter your email">
                <span class="input-group-btn">
                    <button class="btn btn-warning" style="border-radius: 0 3px 3px 0;" type="submit">Subscribe</button>
                </span>
            </div>
        </form>
    </div>
</div>