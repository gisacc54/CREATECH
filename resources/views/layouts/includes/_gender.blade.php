@if($user->gender == 'Male')
    <span class="badge badge-pill bg-cyan-lt" style="background: rgba(12,163,173,0.15)!important;">
        <i class="fas fa-male" style="margin-right: 2px"></i>
        {{__('table.gender-male')}}
    </span>
@else
    <span class="badge badge-pill bg-pink-lt me-1" style="background-color: rgba(218,90,238,0.15)!important">
        <i class="fas fa-female" style="margin-right: 2px"></i>
        {{__('table.gender-female')}}
    </span>
@endif
