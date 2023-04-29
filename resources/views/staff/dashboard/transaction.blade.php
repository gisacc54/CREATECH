@extends('staff.layouts.main')

@section('content')
    @include('staff.dashboard.partials._t_page-title')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transactions</h3>
                        </div>
                        <div class="card-body card-body-table p-0">
                            <livewire:transaction-table />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
