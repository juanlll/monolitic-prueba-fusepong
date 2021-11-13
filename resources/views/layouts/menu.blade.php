
<li class="side-menus {{ Request::is('companies*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('companies.index') }}"><i class="fas fa-building"></i><span>Compañias</span></a>
</li>

<li class="side-menus {{ Request::is('projects*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fas fa-book"></i><span>Proyectos</span></a>
</li>

<li class="side-menus {{ Request::is('userStories*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('userStories.index') }}"><i class="fas fa-user"></i><span>Historias De Usuario</span></a>
</li>

<li class="side-menus {{ Request::is('tickets*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('tickets.index') }}"><i class="fas fa-tag"></i><span>Tickets</span></a>
</li>


