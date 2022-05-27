<!-- sidebar starts -->
<nav class="col-md-3 d-md-block sidebar">
    <div class="list-group">

        @foreach(get_menu() as $menuItem)
            <a href="{{ route($menuItem['route'])}}" class="list-group-item list-group-item-action {{$menuItem['isActive']}}" aria-current="true">
                <span>
                    <svg class="{{$menuItem['iconColor']}}"><use xlink:href="/apa/img/icons.svg#{{$menuItem['icon']}}"></use></svg>
                </span>
                {{$menuItem['name']}}
                @if ($menuItem['isActive'] != '' && $menuItem['route'] != 'admin')
                    <span class="badge bg-secondary rounded-pill ms-2">{{ count($datas)}}</span>
                @endif
            </a>
            @if (array_key_exists('sub', $menuItem))
                @foreach($menuItem['sub'] as $subMenuItem)
                <a href="{{ route($subMenuItem['route'])}}" class="list-group-item list-group-item-action {{$subMenuItem['isActive']}}" aria-current="true" style="padding-left:60px;">
                    <span>
                        <svg class="{{$subMenuItem['iconColor']}}"><use xlink:href="/apa/img/icons.svg#{{$subMenuItem['icon']}}"></use></svg>
                    </span>
                    {{$subMenuItem['name']}}
                    @if ($subMenuItem['isActive'] != '' && $subMenuItem['route'] != 'admin')
                        <span class="badge bg-secondary rounded-pill ms-2">{{ count($datas)}}</span>
                    @endif
                </a>
                @endforeach
            @endif
        @endforeach
    </div>
</nav>
<!-- sidebar ends -->
