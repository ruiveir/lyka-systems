<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route("dashboard")}}">
        <div class="sidebar-brand-icon">
            Lyka
        </div>
        <div class="sidebar-brand-text ml-1">Systems</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{Route::is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Recursos Humanos
    </div>

    <li class="nav-item {{Route::is('clients.*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('clients.index')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Estudantes</span></a>
    </li>

    <li class="nav-item {{Route::is('agents.*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('agents.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Agentes</span></a>
    </li>

    <li class="nav-item {{Route::is('universities.*') ? 'active' : ''}}">
        <a class="nav-link" href="{{route('universities.index')}}">
            <i class="fas fa-fw fa-university"></i>
            <span>Universidades</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Ferramentas admin.
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if (Route::is('payments.*') || Route::is('charges.*') || Route::is('conta.*')) { echo 'active'; } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinance" aria-expanded="true" aria-controls="collapseFinance">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Finanças</span>
        </a>
        <div id="collapseFinance" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Páginas principais:</h6>
                <a class="collapse-item {{Route::is('payments.*') ? 'active' : ''}}" href="{{route('payments.index')}}">Pagamentos</a>
                <a class="collapse-item {{Route::is('charges.*') ? 'active' : ''}}" href="{{route('charges.index')}}">Cobranças</a>
                <a class="collapse-item" href="#">Relatório e Contas</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Outras Páginas:</h6>
                <a class="collapse-item {{Route::is('conta.*') ? 'active' : ''}}" href="{{route("conta.index")}}">Conta bancária</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php if (Route::is('libraries.*') || Route::is('contacts.*') || Route::is('agenda.*') || Route::is('produtostock.*') || Route::is('users.*') || Route::is('listagens.*') || Route::is('provider.*')) { echo 'active'; } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDiversos" aria-expanded="true" aria-controls="collapseDiversos">
            <i class="fas fa-fw fa-folder"></i>
            <span>Diversos</span>
        </a>
        <div id="collapseDiversos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Páginas principais:</h6>
                <a class="collapse-item {{Route::is('produtostock.*') ? 'active' : ''}}" href="{{route('produtostock.index')}}">Produtos Stock</a>
                <a class="collapse-item {{Route::is('listagens.*') ? 'active' : ''}}" href="{{route('listagens.index')}}">Listagens</a>
                <a class="collapse-item {{Route::is('libraries.*') ? 'active' : ''}}" href="{{route('libraries.index')}}">Biblioteca</a>
                <a class="collapse-item {{Route::is('users.*') ? 'active' : ''}}" href="{{route('users.index')}}">Administradores</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Outras Páginas:</h6>
                <a class="collapse-item {{Route::is('provider.*') ? 'active' : ''}}" href="{{route('provider.index')}}">Fornecedores</a>
                <a class="collapse-item {{Route::is('agenda.*') ? 'active' : ''}}" href="{{route('agenda.index')}}">Agenda</a>
                <a class="collapse-item {{Route::is('contacts.*') ? 'active' : ''}}" href="{{route('contacts.index')}}">Lista telefónica</a>
                <a class="collapse-item {{Route::is('bugreport.*') ? 'active' : ''}}" href="{{route('bugreport.index')}}">Relatório de erros</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>Notificações</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
