<section class="footer-main py-5">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-md-2">
                <h1><a href="#home">DRB</a></h1>
            </div>
            <div class="col-md-4">
                <ul class="list-unstyled">
                    <li>Phone: +880 1720 227189</li>
                    <li>Email: info@dataresources-bd.com</li>
                    <li>Web: www.dataresources-bd.com</li>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="list-unstyled text-small">
                  <li><a class="text-light" href="/#who-we-are">About Us</a></li>
                  <li><a class="text-light" href="/terms-conditions">Terms & Condition</a></li>
                  <li><a class="text-light" href="/refund-policy">Refund Policy</a></li>
                  <li><a class="text-light" href="/privacy-policy">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <label>Stay Updated</label>
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
            <div class="col-md-12 border-top border-light mt-5 text-center">
                <img class="img-fluid ssl-banner" src="/img/ssl.png">
            </div>
            <div class="col-md-12 text-center mt-3">
                <img class="img-fluid pci-banner" src="/img/pci.png">
            </div>
            <div class="col-md-12 mt-5">
                <div class="text-center w-100">
                    <span><a href="https://www.techynaf.com" target="_blank">Copyright &copy; Data Resources Bangladesh 2019 
                                                                    <br><span class="small">Made with <span class="text-danger">&hearts;</span> by Techynaf Technologies Limited</span></a></span>
                </div>
            </div>
        </div>
    </div>
</section>

