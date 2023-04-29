@if($type == 'Deposit')
    <span class="badge badge-pill bg-green-lt" style="background: rgba(86,154,84,.15)!important">
        <i class="fas fa-arrow-alt-circle-up" style="margin-right: 2px"></i>
        {{$type}}
    </span>
@else
    <span class="badge badge-pill bg-red-lt me-1" style="background-color: rgba(214,57,57,.15)!important">
        <i class="fas fa-arrow-alt-circle-down" style="margin-right: 2px"></i>
        {{$type}}
    </span>
@endif
