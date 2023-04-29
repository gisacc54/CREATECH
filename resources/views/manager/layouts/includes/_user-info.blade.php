<div class="d-flex py-1 align-items-center">
    <span class="avatar me-2" style="background-image: url({{ $user->profile_image_thumbnail}})"></span>
    <div class="flex-fill">
        <div class="font-weight-medium"><a href="/admin/account/{{ $user->id }}" class="text-decoration-none text-black">{{$user->first_name}} {{$user->last_name}}</a></div>
        <div class="text-muted"><a href="#" class="text-reset">{{$user->email}}</a></div>
    </div>
</div>
