<div class="col-sm-6 col-lg-{{ $size??3 }} {{$addClass??""}}">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="subheader">{{ __($card['name']) }}</div>
                <div class="ms-auto lh-1">
                    <div class="dropdown">
                        <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('element.all-time')}}</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item active" href="#" >{{__('element.all-time')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h2 mb-3" id="{{$card['id']}}">
                <div class="spinner-border spinner-border-sm" role="status"></div>
            </div>
        </div>
    </div>
</div>
