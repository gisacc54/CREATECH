<div class="modal modal-blur fade" id="buy-airtime-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('staff.buy') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3 ">
                        <label class="form-label">{{__('element.phone-number')}}</label>
                        <div >
                            <input type="text" class="form-control @error('phone_number')is-invalid @enderror" name="phone_number" value="{{old('phone_number',auth()->user()->phone_number)}}" placeholder="{{__('element.enter-phone-number')}}">
                            @error('phone_number')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Amount</div>
                        <input type="number" name="amount" class="form-control @error('amount')is-invalid @enderror" value="{{ old('amount') }}">
                        @error('amount')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <label class="form-check">
                        <input type="checkbox" name="credit_card" class="form-check-input" @if(old('credit_card')=='on') checked @endif>
                        <span class="form-check-label"> Use Credit Card </span>
                    </label>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/phone-call -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>
                        By Airtime
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
