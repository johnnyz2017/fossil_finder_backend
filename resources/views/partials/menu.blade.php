<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
    <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
    <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
    </svg>
    <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
    <use xlink:href="assets/brand/coreui-pro.svg#signet"></use>
    </svg>
    </div>

    
    <ul class="c-sidebar-nav ps ps--active-y">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="/">
        Dashboard
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        Logout
        </a>
    </li>


    <li class="c-sidebar-nav-title">Theme</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="colors.html">
    <svg class="c-sidebar-nav-icon">
    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop1"></use>
    </svg> Colors</a></li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="typography.html">
    <svg class="c-sidebar-nav-icon">
    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
    </svg> Typography</a></li>
   
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 664px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 337px;"></div></div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-unfoldable"></button>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>