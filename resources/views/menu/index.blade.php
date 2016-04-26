@foreach(config('admin.menu') as $key => $menu)
    @if(count($menu['children']))
        <li class="treeview">
            <a href="#">
                <i class="fa {{ $menu['icon'] or 'fa-dashboard' }}"></i> <span>{{ $menu['text'] }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @foreach($menu['children'] as $subKey => $subMenu)
                    <li><a href="{{ $subMenu['href'] }}"><i class="fa fa-cog"></i> {{ $subMenu['text'] }}</a></li>
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a href="#">
                <i class="fa {{ $menu['icon'] or 'fa-dashboard' }}"></i> <span>{{ $menu['text'] }}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
        </li>
    @endif
@endforeach