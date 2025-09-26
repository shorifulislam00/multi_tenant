<div class="app-sidebar  sidebar-shadow">
    <div class="app-header__logo">

        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu p-2">



                @can('dashboard_view')

                    <li class="app-sidebar__heading">
                        <a href="{{route('admin.dashboard')}}" class="{{ Request::routeIs('admin.dashboard') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            Dashboard
                        </a>
                    </li>

				@endcan

                {{-- account module start --}}
                @if(Auth()->user()->hasAnyPermission([2,3,4,5,6]))
                    <li class="app-sidebar__heading">Accounts </li>

                    <li class="{{ Request::routeIs('account.*') ? 'mm-active' : '' }}">
                        <a href="#" {{ Request::routeIs('account.*') ? 'area-expanded="true"' : '' }}>
                            <i style="color:red; font-weight:bold;font-size:1.5rem;" class="metismenu-icon pe-7s-credit"></i>
                            <strong>Account</strong>
                            <i style="color: rgb(198, 36, 36); font-weight:bold;" class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>

                        <ul class="{{ Request::routeIs('account.*') ? 'mm-show' : '' }}">
                            @if(Auth()->user()->hasAnyPermission([2,3,4]))
                                <li>
                                    <a href="{{ route('account.index') }}" class="{{ Request::routeIs('account.index') ? 'mm-active' : '' }}">
                                        <i style="color:red; font-weight:bold;font-size:1.5rem; " class="metismenu-icon pe-7s-cash"></i>
                                        <strong>List</strong>
                                    </a>
                                </li>
                            @endif

                            @if(Auth()->user()->hasAnyPermission([5]))

                                <li>
                                    <a href="{{ route('account.balance.report') }}" class="{{ Request::routeIs('account.balance.report') ? 'mm-active' : '' }}">
                                        <strong> Balance </strong>
                                    </a>
                                </li>
                            @endif

                            @if(Auth()->user()->hasAnyPermission([6]))

                                <li>
                                    <a href="{{ route('account.ledger') }}" class="{{ Request::routeIs('account.ledger') ? 'mm-active' : '' }}">
                                        <strong> Ledger </strong>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                @endif


                {{-- flat rent module start --}}
                @if(Auth()->user()->hasAnyPermission([7,8,9]))
                    <li class="app-sidebar__heading">Flat Rent Module</li>


                    @if(Auth()->user()->hasAnyPermission([7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]))

                        <li>
                            <a href="{{route('flatrent.index')}}" class="{{ Request::routeIs('flatrent.index') ? 'mm-active' : '' }}">
                                <i style="color:red; font-weight:bold;font-size:1.5rem; " class="metismenu-icon   pe-7s-culture"></i>
                            <strong> Rent </strong>
                            </a>
                        </li>
                    @endif

                    <li class="{{ Request::routeIs('bill*') ? 'mm-active' : '' }}">
                        <a href="#" {{ Request::routeIs('bill*') ? 'area-expanded="true"' : '' }}>
                            <i style="color:red; font-weight:bold;font-size: 20px;" class="metismenu-icon fas fa-calculator"></i>
                            <strong>Bill</strong>
                            <i style="color: rgb(198, 36, 36); font-weight:bold;" class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>

                        <ul class="{{ Request::routeIs('bill*') ? 'mm-show' : '' }}">

                            @if(Auth()->user()->hasAnyPermission([10]))
                                <li style="mb-2">
                                    <a href="{{ route('bill.index') }}" class="{{ Request::routeIs('bill.index') ? 'mm-active' : '' }}">
                                        <strong>Generate</strong>
                                    </a>
                                </li>
                            @endif

                            @if(Auth()->user()->hasAnyPermission([11,13]))
                                <li style="mb-2">
                                    <a href="{{ route('bill.list') }}" class="{{ Request::routeIs('bill.list') ? 'mm-active' : '' }}">
                                        <strong>List</strong>
                                    </a>
                                </li>
                            @endif

                            @if(Auth()->user()->hasAnyPermission([12]))
                                <li style="mb-2">
                                    <a href="{{ route('bill.print') }}" class="{{ Request::routeIs('bill.print') ? 'mm-active' : '' }}">
                                        <strong>Print</strong>
                                    </a>
                                </li>
                            @endif

                            @if(Auth()->user()->hasAnyPermission([13,14,15]))
                                <li style="mb-2">
                                    <a href="{{ route('bill-category.index') }}" class="{{ Request::routeIs('bill-category.index') ? 'mm-active' : '' }}">
                                        <strong>Category</strong>
                                    </a>
                                </li>
                            @endif

                            @if(Auth()->user()->hasAnyPermission([16,17,18]))
                                <li style="mb-2">
                                    <a href="{{ route('bill-payment-list.index') }}" class="{{ Request::routeIs('bill-payment-list.index') ? 'mm-active' : '' }}">
                                        <strong>Payment</strong>
                                    </a>
                                </li>
                            @endif

                             @if(Auth()->user()->hasAnyPermission([20]))
                                <li style="mb-2">
                                    <a href="{{ route('bill.ledger') }}" class="{{ Request::routeIs('bill.ledger') ? 'mm-active' : '' }}">
                                        <strong>Ledger</strong>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- flat rent module end --}}

                {{-- settings module start --}}
                @if(Auth()->user()->hasAnyPermission([21, 22, 23]))

                    <li class="app-sidebar__heading">Settings</li>

                    @if(Auth()->user()->hasAnyPermission([21, 22, 23]))
                        <li>
                            <a href="{{route('house.index')}}" class="{{ Request::routeIs('house.index') ? 'mm-active' : '' }}">
                                <i style="color:red;font-size:20px; font-weight:bold;" class="metismenu-icon fas fa-sitemap"></i>
                            <strong> Houses</strong>
                            </a>
                        </li>
                    @endif

                    @if(Auth()->user()->hasAnyPermission([24, 25, 26]))

                        <li>
                            <a href="{{route('floor.index')}}" class="{{ Request::routeIs('floor.index') ? 'mm-active' : '' }}">
                                <i style="color:red; font-size:20px; font-weight:bold;" class="metismenu-icon fas fa-shopping-basket"></i>
                            <strong> Floors</strong>
                            </a>
                        </li>
                    @endif

                    @if(Auth()->user()->hasAnyPermission([27, 28, 29]))
                    <li>
                        <a href="{{route('flat.index')}}" class="{{ Request::routeIs('flat.index') ? 'mm-active' : '' }}">
                            <i style="color:red; font-weight:bold; font-size:23px;" class="metismenu-icon  pe-7s-home"></i>
                        <strong> Flats</strong>
                        </a>
                    </li>
                    @endif



                    <li>
                        <a href="{{ Request::routeIs('user.*') }}" class="{{ Request::routeIs('user.*') ? 'mm-active' : '' }}">
                            <i style="color:red; font-weight:bold;font-size:20px; " class="metismenu-icon fas fa-users"></i>
                            <strong>User</strong>
                            <i style="color: rgb(235, 17, 28); font-weight:bold;" class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>

                        <ul class="{{ Request::routeIs('user.*') ? 'mm-show' : '' }}">

                             @if(Auth()->user()->hasAnyPermission([30]))
                                <li>
                                    <a href="{{ route('user.create') }}" class="{{ Request::routeIs('user.create') ? 'mm-active' : '' }}">
                                        <i style="color:red; font-weight:bold;font-size:1.5rem; " class="metismenu-icon pe-7s-cash"></i>
                                        <strong>New</strong>
                                    </a>
                                </li>
                            @endif

                             @if(Auth()->user()->hasAnyPermission([ 30, 31, 32]))
                            <li>
                                <a href="{{ route('user.index') }}" class="{{ Request::routeIs('user.index') ? 'mm-active' : '' }}">
                                    <i style="color:red; font-weight:bold;font-size:1.5rem; " class="metismenu-icon pe-7s-cash"></i>
                                    <strong>List</strong>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                @endif

                {{-- settings module end --}}
            </ul>
        </div>
    </div>
</div>
