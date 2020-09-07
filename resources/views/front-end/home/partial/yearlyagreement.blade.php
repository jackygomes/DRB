<div class="modal fade" id="yearlyexampleModal{{ $subscriptionplan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agreement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form  method="post" action="{{ route('subscribe.plan') }}">
                @csrf
                <input type="hidden" name="price" value="{{ $subscriptionplan->price_per_year }}">
                <input type="hidden" name="plan_id" value="{{ $subscriptionplan->id }}">
                <input type="hidden" name="type" value="yearly">
                <input type="hidden" name="user_limit" value="{{ $subscriptionplan->user_limit }}">
                <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" id="exampleChecky{{ $subscriptionplan->id }}" @change="isShowButton($event)">
                    <label class="form-check-label" for="exampleChecky{{ $subscriptionplan->id }}">I’ve read and accept the <a class="text-warning" href="/terms-conditions" target="_blank">Terms & Conditions</a>, <a class="text-warning" href="/refund-policy" target="_blank">Refund Policy</a> and <a class="text-warning" href="/privacy-policy" target="_blank">Privacy Policy</a></label>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" :disabled="!isButton">Confirm</button>
            </form>
          
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" :disabled="!isButton">Confirm</button>
        </form>
        </div> --}}
      </div>
    </div>
  </div>


{{--offline modal--}}

<div class="modal fade" id="yearlyexampleModalOffline{{ $subscriptionplan->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-12" id="exampleModalLabel">Agreement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('subscribe.plan') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="price" value="{{ $subscriptionplan->price_per_year }}">
                    <input type="hidden" name="plan_id" value="{{ $subscriptionplan->id }}">
                    <input type="hidden" name="type" value="yearly">
                    <input type="hidden" name="user_limit" class="form-control" value="{{ $subscriptionplan->user_limit }}">

                    <div class="row text-left">
                        <div class="col-10 offset-1">
                            <div class="text-left bankinfo">
                                <p class="mb-2">Please Deposit BDT {{ $subscriptionplan->price_per_year }} (BDT {{ $subscriptionplan->price_per_year }} is the amount of the package that you chose) in the following bank account:</p>
                                <p>Bank: The City Bank Limited</p>
                                <p>Account Name: Data Resources BD Ltd.</p>
                                <p>Account Number: 1322908881001</p>
                                <p class="mt-2">For <span style="font-weight: 600">Payment through Cheque</span>, please deposit the cheque and send us the copy of the bank received deposit slip</p>
                                <p class="mt-2">For <span style="font-weight: 600">Payment through Cash</span>, please write “Cash Deposit: Your full Name” in the description box and send us the copy of the bank received deposit slip</p>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Upload the deposit slip image: jpg, png, pdf, 3mb max</label>
                                <input type="file" name="check_image" class="form-control-file" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheckm{{ $subscriptionplan->id }}"
                               @change="isShowButton($event)">
                        <label class="form-check-label" for="exampleCheckm{{ $subscriptionplan->id }}">I’ve read and
                            accept the <a class="text-warning" href="/terms-conditions" target="_blank">Terms &
                                Conditions</a>, <a class="text-warning" href="/refund-policy" target="_blank">Refund
                                Policy</a> and <a class="text-warning" href="/privacy-policy" target="_blank">Privacy
                                Policy</a></label>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" :disabled="!isButton">Confirm</button>
                </form>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" :disabled="!isButton">Confirm</button>
            </form>
            </div> --}}
        </div>
    </div>
</div>
