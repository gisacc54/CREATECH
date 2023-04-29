<form method="post" action="{{ route('staff.account.credit-card') }}">
    @csrf
{{--    @if($errors->any())--}}
{{--        {{ implode('', $errors->all('<div>:message</div>')) }}--}}
{{--    @endif--}}
    <div class="mb-3">
        <div class="form-label">Card number</div>
        <input type="text" name="account" value="{{ old('account',$creditCard->account) }}" class="form-control @error('account')is-invalid @enderror" data-mask="0000 0000 0000 0000" data-mask-visible="true" autocomplete="off"/>
        @error('account')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-label">Card name</div>
        <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ old('name',$creditCard->name) }}">
        @error('name')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="row">
        <div class="col-8">
            <div class="mb-3">
                <label class="form-label">Expiration date</label>
                <div class="row g-2">
                    <div class="col">
                        <select class="form-select @error('month')is-invalid @enderror" name="month">
                            @for($i=1;$i<=12;$i++)
                                <option value="{{$i}}" {{ $creditCard->month==$i?"selected":'' }}>{{$i}}</option>
                            @endfor
                        </select>
                        @error('month')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col">
                        <select class="form-select @error('year')is-invalid @enderror" name="year">
                            @for($i=2023;$i<=2030;$i++)
                                <option value="{{$i}}" {{ $creditCard->year==$i?"selected":'' }}>{{$i}}</option>
                            @endfor
                        </select>
                        @error('year')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <div class="form-label @error('cvv')is-invalid @enderror">CVV</div>
                <input type="number" name="cvv" class="form-control" value="{{ old('cvv',$creditCard->cvv) }}">
                @error('cvv')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="mt-2">
        <button class="btn btn-primary w-100">
            <!-- Download SVG icon from http://tabler-icons.io/i/credit-card -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="3" /><line x1="3" y1="10" x2="21" y2="10" /><line x1="7" y1="15" x2="7.01" y2="15" /><line x1="11" y1="15" x2="13" y2="15" /></svg>
            Add
        </button>
    </div>

</form>
