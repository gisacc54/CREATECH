@extends('auth.layouts.main')
@section('site-tile',' | Login')
@section('content')
    <form class="card card-md" action="{{ route('login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Login into your account</h2>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number">
            </div>
            <div class="mb-2">
                <label class="form-label">
                    Password
                    <span class="form-label-description">
                      <a href="{{ route('password.request') }}">Forgotten password?</a>
                    </span>
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password" id="password" class="form-control"  placeholder="Enter Password"  autocomplete="off">
                    <span class="input-group-text">
                          <a href="#" id="show-hide-btn" class="link-secondary" >
                              <svg id="show" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                              <svg id="hide" style="display: none;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" /><path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341" /></svg>
                          </a>
                        </span>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input"/>
                    <span class="form-check-label">Remember me</span>
                </label>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M20 12h-13l3 -3m0 6l-3 -3" /></svg>
                    Login
                </button>
            </div>
        </div>
    </form>
    <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="{{ route('register')}}" tabindex="-1">Sign up</a>
    </div>
@endsection
@push('js')
    @error('phone_number')
    <script>
        Notify.error("{{ $message }}")
    </script>
    @enderror

    @error('password')
    <script>
        Notify.error("{{ $message }}")
    </script>
    @enderror    <script>
        $(document).ready(function () {
            $('#show').on('click',function () {
                $('#show').hide()
                $('#hide').show()
                $("#password").attr('type','text')

            })
            $('#hide').on('click',function () {
                $('#hide').hide()
                $('#show').show()
                $("#password").attr('type','password')
            })
        })
    </script>
@endpush
