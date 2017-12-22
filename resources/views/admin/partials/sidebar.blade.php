<nav id="sidebar-nav">
  @foreach($global->menus as $group)
  <ul class="list-nav nav-group-{{$group['group']}}" style="display:none">
   {{--  <li class="separator">
      <div>
        <span>overview</span>
      </div>
    </li> --}}
    @foreach($group['collection'] as $menu)
    <li class="active">
      <a href="javascript:;"> <i class="{{ $menu['icon'] }}"></i>{{ $menu['label'] }} <span class="pull-right"><i class="ion-ios-arrow-down"></i>{{-- <i class="ion-ios-arrow-down arrow-down"></i> --}}</span></a>
      @if(!empty($menu['submenus']))
      <ul class="nav-sub">
        @foreach($menu['submenus'] as $submenu)
         <li><a href="{{ admin_url($submenu['uri']) }}"><span>{{ $submenu['label'] }}</span></a></li>
        @endforeach
      </ul>
      @endif
    </li>
    @endforeach
  </ul>
  @endforeach
</nav>