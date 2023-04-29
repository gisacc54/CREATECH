@if($user->status == 'Active')
    <span class="badge badge-pill bg-green-lt" style="background: rgba(86,154,84,.15)!important">
        <i class="fas fa-check-circle" style="margin-right: 2px"></i>
        {{__('table.status-active')}}
    </span>
@else
    <span class="badge badge-pill bg-red-lt me-1" style="background-color: rgba(214,57,57,.15)!important">
        <i class="fas fa-times-circle" style="margin-right: 2px"></i>
        {{__('table.status-disabled')}}
    </span>
@endif
