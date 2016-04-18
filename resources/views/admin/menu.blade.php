@foreach (config('admin.menu') as $key => $menu)

    @if (count($menu['children']))
        <li class="{{ isset($curMenu) && $curMenu == $key ? 'active ' : '' }}treeview">
            <a href="">
                <i class="fa {{ $menu['icon'] or 'fa-link' }}"></i>
                <span>{{ $menu['text'] }}</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @foreach($menu['children'] as $subKey => $subMenu)
                    <li>
                        <a href="{{ $subMenu['href'] }}">{{ $subMenu['text'] }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        <li class="{{ isset($curMenu) && $curMenu == $key ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-link"></i>
                <span>{{ $menu['text'] }}</span>
            </a>
        </li>
    @endif

@endforeach