@extends('manager.layouts.main')

@push('css')
    <style>
        .card-cover:before {
            background: #f2f3f4;
        }
    </style>
@endpush
@section('content')
    @include('manager.account.partials.page-title')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-4">
                    <div class="col-md-12">
                        <a class="card card-link" href="#">
                            <div class="card-cover card-cover-blurred text-center">
                                <span class="avatar avatar-xl avatar-thumb avatar-rounded" id="imagePreview" style="background-image: url({{ asset($user->profile_image) }})">
                                </span>

                            </div>
                            <div class="card-body text-center">
                                <div class="card-title mb-1">{{ $user->first_name." ".$user->last_name }}</div>
                                <div class="text-muted">{{ $user->role->name }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/book-2 -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" /><path d="M19 16h-12a2 2 0 0 0 -2 2" /><path d="M9 8h6" /></svg>
                                        Basic info
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="2" /><polyline points="3 7 12 13 21 7" /></svg>
                                        E-Mail: <strong class="ms-3">{{ $user->email }}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                        Telephone: <strong class="ms-3">{{ $user->phone_number }}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar-event -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><rect x="8" y="15" width="2" height="2" /></svg>
                                        Date of Birth: <strong class="ms-3">{{ $user->dob." ( Age: ". Carbon\Carbon::parse($user->dob)->age .")" }}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/friends -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="7" cy="5" r="2" /><path d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5" /><circle cx="17" cy="5" r="2" /><path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4" /></svg>
                                        Gender: <strong class="ms-3">@include('layouts.includes._gender',['user'=>$user])</strong>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>
                                        Status: <strong class="ms-3">@include('admin.layouts.includes._status',['user'=>$user])</strong>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/clock -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>
                                        Registered At: <strong>{{ App\Helper\FunctionHelper::formatDate($user->created_at) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row row-cards">
                        <div class="col-12">
                            @include('manager.account.partials.change-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    @error('imageUpload')
    <script>
        Notify.error('{{ $message }}')
    </script>
    @enderror
@endpush
