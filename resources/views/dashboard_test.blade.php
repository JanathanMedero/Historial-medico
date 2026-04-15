<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Médico - Responsivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 250px;
        }

        body { overflow-x: hidden; background-color: #f8f9fa; }

        /* Estilos del Sidebar */
        #sidebar-wrapper {
            min-height: 100vh;
            width: var(--sidebar-width);
            margin-left: -var(--sidebar-width);
            transition: margin .25s ease-out;
            position: fixed;
            z-index: 1000;
        }

        /* En pantallas medianas/grandes, el sidebar se muestra por defecto */
        @media (min-width: 768px) {
            #sidebar-wrapper { margin-left: 0; position: sticky; top: 0; }
            #page-content-wrapper { min-width: 0; width: 100%; }
            body.sb-sidenav-toggled #sidebar-wrapper { margin-left: -var(--sidebar-width); }
        }

        /* En móviles, cuando se activa, se desliza sobre el contenido */
        @media (max-width: 767.98px) {
            body.sb-sidenav-toggled #sidebar-wrapper { margin-left: 0; }
            .overlay {
                display: none;
                position: fixed;
                width: 100vw;
                height: 100vh;
                background: rgba(0,0,0,.5);
                z-index: 999;
            }
            body.sb-sidenav-toggled .overlay { display: block; }
        }

        .sidebar-heading { padding: 1.5rem 1.25rem; font-size: 1.2rem; font-weight: bold; }
        .nav-link { color: rgba(255,255,255,.75); padding: 1rem 1.25rem; }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,.1); }
        .nav-link.active { color: #fff; background: #0d6efd; }

        /* Ajuste del acordeón para que luzca bien en el sidebar */
        .accordion-button::after { filter: invert(1); }
        .accordion-item { border: none; }
    </style>
</head>
<body>
<div class="overlay" id="sidebarOverlay"></div>

<div class="d-flex" id="wrapper">
    <div class="bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom border-secondary text-primary">
            <i class="bi bi-heart-pulse-fill me-2"></i>MedApp
        </div>
        <div class="nav flex-column">
            <a href="#" class="nav-link active">
                <i class="bi bi-house-door me-2"></i> Inicio
            </a>
            <a href="/pacientes" class="nav-link border-bottom border-secondary">
                <i class="bi bi-people me-2"></i> Pacientes
            </a>

            <div class="accordion accordion-flush" id="accSidebar">
                <div class="accordion-item bg-dark">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-dark text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#menuConfig">
                            <i class="bi bi-person-gear me-2"></i> Mi Cuenta
                        </button>
                    </h2>
                    <div id="menuConfig" class="accordion-collapse collapse" data-bs-parent="#accSidebar">
                        <div class="accordion-body p-0">
                            <a href="#" class="nav-link ps-5 small text-info">Configuración</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="nav-link ps-5 small text-danger bg-transparent border-0 w-100 text-start">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="page-content-wrapper" class="flex-grow-1">
        <nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom sticky-top">
            <div class="container-fluid">
                <button class="btn btn-primary" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>

                <div class="ms-auto d-flex align-items-center">
                    <div class="text-end">
                        <small class="text-muted d-block d-sm-inline">Bienvenido,</small>
                        <span class="fw-bold">{{ Auth::user()->name ?? 'Dr. García' }}</span>
                    </div>
                    <i class="bi bi-person-circle fs-3 ms-3 text-secondary"></i>
                </div>
            </div>
        </nav>

        <main class="container-fluid p-3 p-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @yield('content')
                    <h2 class="h4">Panel de Control</h2>
                    <p class="text-muted">Esta vista se adapta a teléfonos, tablets y computadoras.</p
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebarToggle = document.querySelector('#sidebarToggle');
        const overlay = document.querySelector('#sidebarOverlay');

        const toggleMenu = () => {
            document.body.classList.toggle('sb-sidenav-toggled');
        };

        sidebarToggle.addEventListener('click', e => {
            e.preventDefault();
            toggleMenu();
        });

        // Cerrar al hacer clic en el overlay (útil en móviles)
        overlay.addEventListener('click', toggleMenu);
    });
</script>
</body>
</html>
