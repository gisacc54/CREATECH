@extends('admin.layouts.main')

@push('css')
@endpush
@section('content')
    @include('admin.users.partials.update-page-title')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('element.update-user')}}</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/admin/users/{{$user->id}}/update">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.first-name')}}</label>
                                            <div >
                                                <input type="text" class="form-control @error('first_name')is-invalid @enderror" name="first_name" value="{{ old('first_name',$user->first_name) }}" placeholder="{{__('element.enter-first-name')}}">
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
                                                <input type="text" class="form-control @error('last_name')is-invalid @enderror" name="last_name" value="{{ old('last_name',$user->last_name) }}" placeholder="{{__('element.enter-last-name')}}">
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
                                                <input type="text" class="form-control @error('username')is-invalid @enderror" name="username" value="{{old('username',$user->username)}}" placeholder="{{__('element.enter-username')}}">
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
                                            <select type="text" class="form-select selector @error('gender')is-invalid @enderror" data-placeholder="{{__('element.select-gender')}}" id="select-gender" name="gender" value="{{old('gender',$user->gender)}}">
                                                <option value=""></option>
                                                <option value="Male" {{ old('gender',$user->gender) == 'Male'?'selected':'' }}>{{__('table.gender-male')}}</option>
                                                <option value="Female" {{ old('gender',$user->gender) == 'Female'?'selected':'' }}>{{__('table.gender-female')}}</option>
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
                                                <input class="form-control @error('dob')is-invalid @enderror" name="dob" placeholder="{{__('element.enter-dob')}}" id="datepicker-icon-prepend" value="{{$user->dob}}"/>
                                            </div>
                                            @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('element.role')}}</label>
                                            <select type="text" class="form-select selector @error('role_id')is-invalid @enderror" data-placeholder="{{__('element.select-role')}}" id="select-role" name="role_id" value="{{$user->role_id}}" {{ $user->id == auth()->user()->id?'disabled':'' }}>
                                                <option value=""></option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" {{ old('gender',$user->role_id) == $role->id?'selected':'' }}>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($user->id == auth()->user()->id)
                                                <input type="text" name="role_id" value="{{$user->role_id}}" style="display: none">
                                            @endif
                                            @error('role_id')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('element.status')}}</label>
                                            <select type="text" class="form-select selector @error('status')is-invalid @enderror" data-placeholder="{{__('element.select-status')}}" id="select-status" name="status" value="{{$user->status}}" {{ $user->id == auth()->user()->id?'disabled':'' }}>
                                                <option value=""></option>
                                                <option value="Active" {{ $user->status =="Active"?"selected":"" }}>Active</option>
                                                <option value="Disabled" {{ $user->status =="Disabled"?"selected":"" }}>Disable</option>
                                            </select>
                                            @if($user->id == auth()->user()->id)
                                                <input type="text" name="status" value="{{$user->status}}" style="display: none">
                                            @endif
                                            @error('status')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.phone-number')}}</label>
                                            <div >
                                                <input type="text" class="form-control @error('phone_number')is-invalid @enderror" name="phone_number" value="{{$user->phone_number}}" placeholder="{{__('element.enter-phone-number')}}">
                                                @error('phone_number')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label">{{__('element.email')}}</label>
                                            <div >
                                                <input type="email" class="form-control @error('email')is-invalid @enderror" name="email" value="{{$user->email}}" placeholder="{{__('element.enter-email')}}">
                                                @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="form-check">
                                    <input type="checkbox" name="close" class="form-check-input" @if(old('close')=='on') checked @endif>
                                    <span class="form-check-label"> {{__('element.dont-close-after-update')}} </span>
                                </label>
                                <div class="form-footer">
                                    <a href="{{ route('admin.users.management') }}" class="btn btn-light">{{ __('button.back') }}</a>
                                    <button type="submit" class="btn btn-primary float-end">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                        {{__('button.update-user-account')}}
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
