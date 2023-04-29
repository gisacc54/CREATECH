<div class="text-center text-muted mt-3 text-sm-center">
    <small>
        <ul>
            @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                    <li class="language-item"><a href="{{ route('lang.switch', $lang) }}" class="text-muted">{{$language['display']}}</a></li>
                @else
                    <li class="language-item text-black">{{$language['display']}}</li>
                @endif
            @endforeach

        </ul>
    </small>
</div>
