@guest
    @foreach ($themes->javascript->where('is_active',true)->where('is_guest',true) as $item)
        @if($item->is_editable == 1)
            <script type="text/javascript">
                {!!$item->file!!}
            </script>
        @else
            {!!$item->file!!}
        @endif
    @endforeach
@endguest
@auth
    @foreach ($themes->javascript->where('is_active',true)->where('is_auth',true) as $item)
        @if($item->is_editable == 1)
            <script type="text/javascript">
                {!!$item->file!!}
            </script>
        @else
            {!!$item->file!!}
        @endif
    @endforeach
@endauth
<script src="{{ asset('app/js/myScript.js') }}"></script>
