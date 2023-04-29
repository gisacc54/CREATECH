<form method="POST" action="{{ route('staff.account.change.password',$user->id) }}">
    @csrf
    <div class="form-group mb-3 ">
        <label class="form-label">Current Password</label>
        <div >
            <input type="password" class="form-control @error('current_password')is-invalid @enderror" name="current_password" value="{{old('current_password')}}" placeholder="Enter Current Password" autocomplete="off">
            @error('current_password')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>
    <div class="form-group mb-3 ">
        <label class="form-label">{{__('element.password')}}</label>
        <div >
            <input type="password" class="form-control @error('password')is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="{{__('element.enter-password')}}" autocomplete="off">
            @error('password')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>
    <div class="form-group mb-3 ">
        <label class="form-label">{{__('element.confirm-password')}}</label>
        <div >
            <input type="password" class="form-control @error('password_confirmation')is-invalid @enderror" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="{{__('element.enter-confirm-password')}}">
            @error('password_confirmation')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="form-footer">
        <button type="submit" class="btn btn-primary float-end">
            <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
            Change Password
        </button>
    </div>
</form>
