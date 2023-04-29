@extends('admin.layouts.main')

@push('css')
@endpush
@section('content')
    @include('admin.users.partials.create-page-title')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('element.create-new-user')}}</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/admin/users/create" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.first-name')}}</label>
                                            <div >
                                                <input type="text" class="form-control @error('first_name')is-invalid @enderror" name="first_name" value="{{old('first_name')}}" placeholder="{{__('element.enter-first-name')}}" autocomplete="off">
                                                @error('first_name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.last-name')}}</label>
                                            <div >
                                                <input type="text" class="form-control @error('last_name')is-invalid @enderror" name="last_name" value="{{old('last_name')}}" placeholder="{{__('element.enter-last-name')}}">
                                                @error('last_name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.username')}}</label>
                                            <div >
                                                <input type="text" class="form-control @error('username')is-invalid @enderror" name="username" value="{{old('username')}}" placeholder="{{__('element.enter-username')}}" autocomplete="off">
                                                @error('username')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('element.gender')}}</label>
                                            <select type="text" class="form-select selector @error('gender')is-invalid @enderror" data-placeholder="{{__('element.select-gender')}}" id="select-gender" name="gender" value="{{old('gender')}}">
                                                <option value=""></option>
                                                <option value="Male">{{__('table.gender-male')}}</option>
                                                <option value="Female">{{__('table.gender-female')}}</option>
                                            </select>
                                            @error('gender')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('element.dob')}}</label>
                                            <div class="input-icon">
                                                <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                                </span>
                                                <input class="form-control @error('dob')is-invalid @enderror" name="dob" placeholder="{{__('element.enter-dob')}}" id="datepicker-icon-prepend" value="{{old('dob')}}"/>
                                            </div>
                                            @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('element.role')}}</label>
                                            <select type="text" class="form-select selector @error('role_id')is-invalid @enderror" data-placeholder="{{__('element.select-role')}}" id="select-role" name="role_id" value="{{old('role_id')}}">
                                                <option value=""></option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.phone-number')}}</label>
                                            <div >
                                                <input type="text" class="form-control @error('phone_number')is-invalid @enderror" name="phone_number" value="{{old('phone_number')}}" placeholder="{{__('element.enter-phone-number')}}">
                                                @error('phone_number')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.email')}}</label>
                                            <div >
                                                <input type="email" class="form-control @error('email')is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="{{__('element.enter-email')}}">
                                                @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.password')}}</label>
                                            <div >
                                                <input type="password" class="form-control @error('password')is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="{{__('element.enter-password')}}">
                                                @error('password')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.confirm-password')}}</label>
                                            <div >
                                                <input type="password" class="form-control @error('password_confirmation')is-invalid @enderror" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="{{__('element.enter-confirm-password')}}">
                                                @error('password_confirmation')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="form-check">
                                    <input type="checkbox" name="close" class="form-check-input" @if(old('close')=='on') checked @endif>
                                    <span class="form-check-label"> {{__('element.dont-close-after-create')}} </span>
                                </label>
                                <div class="form-footer">
                                    <a href="{{ route('admin.users.management') }}" class="btn btn-light">{{ __('button.back') }}</a>
                                    <button type="submit" class="btn btn-primary float-end">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                        {{__('button.create-user-account')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}"></script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            window.Litepicker && (new Litepicker({
                element: document.getElementById('datepicker-icon-prepend'),
                buttonText: {
                    previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                    nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                },
            }));
        });
        // @formatter:on
    </script>
@endpush
