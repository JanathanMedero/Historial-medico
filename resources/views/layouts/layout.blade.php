<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Historial Medico')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    @stack('styles')
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
    <a class="navbar-brand ps-3" href="{{ url('/home') }}">Historial Médico</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <div class="ms-auto d-flex align-items-center">
    <span class="navbar-text text-white me-2">
        <span class="d-none d-md-inline">Bienvenido:</span>

        <span class="fw-bold d-none d-sm-inline">
            {{ Auth::user()->name }}
        </span>
    </span>

        <ul class="navbar-nav me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Configuración</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>

                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Inicio
                    </a>

                    <a class="nav-link {{ request()->routeIs('pacientes.index') ? 'active' : '' }}" href="{{ route('pacientes.index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Pacientes
                    </a>
                    <a class="nav-link {{ request()->routeIs('citas.index') ? 'active' : '' }}" href="{{ route('citas.index') }}">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar"></i></div>
                        Citas médicas
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Layouts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Static Navigation</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">

        @yield('content')



        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Historial Médico 2026</div>
                </div>
            </div>
        </footer>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                // Alterna la clase que controla la visibilidad
                document.body.classList.toggle('sb-sidenav-toggled');

                // Opcional: Guardar el estado en localStorage
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Obtener el elemento del calendario
        const calendarEl = document.getElementById('calendar');

        // 2. Verificar que el elemento exista para evitar ReferenceError
        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es', // Calendario en español
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                // 3. Cargar las citas pasadas desde el controlador
                events: '/api/citas',

                // 4. Lógica al hacer clic en una cita
                eventClick: function(info) {
                    // Extraer propiedades extendidas
                    const props = info.event.extendedProps;

                    // Mapear datos al Modal
                    document.getElementById('det-paciente').innerText = info.event.title;
                    document.getElementById('det-paciente').innerText = props.paciente_nombre || 'No asignado';
                    document.getElementById('det-motivo').innerText = props.motivo_consulta || 'No asignado';
                    document.getElementById('det-estado').innerText = props.estado_actual || 'Sin especificar';
                    document.getElementById('det-plan').innerText = props.plan || 'Sin plan definido';
                    document.getElementById('det-fecha').innerText = info.event.start.toLocaleString();
                    document.getElementById('det-notas').innerText = props.notas || 'Sin observaciones';

                    // 5. Mostrar el Modal de Bootstrap
                    const modalElement = document.getElementById('modalCita');
                    if (modalElement) {
                        const myModal = new bootstrap.Modal(modalElement);
                        myModal.show();
                    }
                }
            });

            // 6. Renderizar el calendario
            calendar.render();
        } else {
            console.error("Error: No se encontró el contenedor <div id='calendar'></div>");
        }
    });
</script>

</body>
</html>
