{{--Left sidebar--}}
<nav class="mt-2">

    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
        data-accordion="false">


        @canany([
          'permission.show',
          'roles.show',
          'user.show'
       ])
            <li class="nav-item has-treeview">
                <a href="#"
                   class="nav-link {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'active':''}}">
                    <i class="fas fa-users-cog"></i>
                    <p>
                        @lang('cruds.userManagement.title')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview"
                    style="display: {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'block':'none'}};">
                    @can('permission.show')
                        <li class="nav-item">
                            <a href="{{ route('permissionIndex') }}"
                               class="nav-link {{ Request::is('permission*') ? "active":'' }}">
                                <i class="fas fa-key"></i>
                                <p> @lang('cruds.permission.title_singular')</p>
                            </a>
                        </li>
                    @endcan

                    @can('roles.show')
                        <li class="nav-item">
                            <a href="{{ route('roleIndex') }}"
                               class="nav-link {{ Request::is('role*') ? "active":'' }}">
                                <i class="fas fa-user-lock"></i>
                                <p> @lang('cruds.role.fields.roles')</p>
                            </a>
                        </li>
                    @endcan

                    @can('user.show')
                        <li class="nav-item">
                            <a href="{{ route('userIndex') }}"
                               class="nav-link {{ Request::is('user*') ? "active":'' }}">
                                <i class="fas fa-user-friends"></i>
                                <p> @lang('cruds.user.title')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
        @can('api-user.view')
            <li class="nav-item">
                <a href="{{ route('api-userIndex') }}" class="nav-link {{ Request::is('api-users*') ? "active":'' }}">
                    <i class="fas fa-cog"></i>
                    <sub><i class="fas fa-child"></i></sub>
                    <p> API Users</p>
                </a>
            </li>
        @endcan

        @can('company.show')
        <li class="nav-item">
            <a href="{{ route('companyIndex') }}" class="nav-link {{ Request::is('company*') ? "active":'' }}">
                <i class="fas fa-building"></i>
                <p>@lang('cruds.company.title')</p>
            </a>
        </li>
        @endcan
        @can('branch.show')
        <li class="nav-item">
            <a href="{{ route('branchIndex') }}" class="nav-link {{ Request::is('branch*') ? "active":'' }}">
                <i class="fas fa-code-branch"></i>
                <p>@lang('cruds.branch.title')</p>
            </a>
        </li>
        @endcan
    </ul>

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @can('manager.show')
        <li class="nav-item">
            <a href="{{ route('menegerIndex') }}" class="nav-link {{ Request::is('meneger*') ? "active":'' }}">
                <i class="fas fa-user-shield" aria-hidden="true"></i>
                <p>
                    @lang('cruds.manager.title')
                </p>
            </a>
        </li>
        @endcan
        @can('cashier.show')
        <li class="nav-item">
            <a href="{{ route('cashierIndex') }}" class="nav-link {{ Request::is('cashier*') ? "active":'' }}">
                <i class="fas fa-cash-register" aria-hidden="true"></i>
                <p>
                    @lang('cruds.cashier.title')
                </p>
            </a>
        </li>
        @endcan
{{--        @can('category.show')--}}
{{--        <li class="nav-item">--}}
{{--            <a href="/category" class="nav-link {{ Request::is('category*') ? "active":'' }}">--}}
{{--                <i class="fa fa-list-alt" aria-hidden="true"></i>--}}
{{--                <p>--}}
{{--                    @lang('cruds.category.title')--}}
{{--                </p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        @endcan--}}
        @can('import.show')
            <li class="nav-item">
                <a href="{{ route('importIndex') }}" class="nav-link {{ Request::is('import*') ? "active":'' }}">
                    <i class="fas fa-box-open"></i>
                    @lang('cruds.import.title')
                </a>
            </li>
        @endcan


            <li class="nav-item has-treeview">
                <a href="{{ route('products.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>Products</p>
                </a>
            </li>

        <li class="nav-item has-treeview">
            <a href="" class="nav-link">
                <i class="fas fa-palette"></i>
                <p>
                    @lang('global.theme')
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none">
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'default']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p class="text">Default {{ auth()->user()->theme == 'default' ? '✅':'' }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'light']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-white"></i>
                        <p>Light {{ auth()->user()->theme == 'light' ? '✅':'' }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('userSetTheme',[auth()->id(),'theme' => 'dark']) }}" class="nav-link">
                        <i class="nav-icon fas fa-circle text-gray"></i>
                        <p>Dark {{ auth()->user()->theme == 'dark' ? '✅':'' }}</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    {{--    @can('card.main')--}}

    {{--    @endcan--}}
</nav>
