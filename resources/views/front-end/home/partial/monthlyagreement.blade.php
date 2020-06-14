<div class="modal fade" id="monthlyexampleModal{{ $subscriptionplan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input type="hidden" name="price" value="{{ $subscriptionplan->price_per_month }}">
                <input type="hidden" name="plan_id" value="{{ $subscriptionplan->id }}">
                <input type="hidden" name="type" value="monthly">
                <input type="hidden" name="user_limit" value="{{ $subscriptionplan->user_limit }}">
                <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" id="exampleCheckm{{ $subscriptionplan->id }}" @change="isShowButton()">
                    <label class="form-check-label" for="exampleCheckm{{ $subscriptionplan->id }}">I’ve read and accept the <a class="text-warning" href="/terms-conditions" target="_blank">Terms & Conditions</a>, <a class="text-warning" href="/refund-policy" target="_blank">Refund Policy</a> and <a class="text-warning" href="/privacy-policy" target="_blank">Privacy Policy</a></label>
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
  