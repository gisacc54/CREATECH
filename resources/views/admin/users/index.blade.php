@extends('admin.layouts.main')

@section('content')
    @include('admin.users.partials.page-title')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('element.users-list')}}</h3>
                        </div>
                        <div class="card-body card-body-table p-0">
                            <livewire:users-table />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
