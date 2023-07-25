                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">{{ config('app.name') }}</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">NX</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
                        @role('administrator')
                            <li class="menu-header"><i>Auth</i></li>
                            <li class="{{ Request::is('permissions*') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/permissions') }}"><i class="fas fa-key"></i> <span>Permissions</span></a></li>
                            <li class="{{ Request::is('roles*') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/roles') }}"><i class="fas fa-user-tag"></i> <span>Roles</span></a></li>
                            <li class="{{ Request::is('users*') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/users') }}"><i class="fas fa-users-cog"></i> <span>Users</span></a></li>
                        @endrole
                    </ul>
                    <ul class="sidebar-menu">
                            <li class="menu-header">Configuración</li>
                            <li class="{{ Request::is('companias') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/companias') }}"><i class="fas fa-building"></i> <span>Compañias</span></a></li>
                            <li class="{{ Request::is('ramos') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/ramos') }}"><i class="fas fa-th"></i> <span>Ramos</span></a></li>
                    </ul>
                </aside>
