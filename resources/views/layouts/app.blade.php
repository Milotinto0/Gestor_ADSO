<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>@yield('title','Gestor ADSO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* ============================================
   NAVBAR ESTILO BREEZE (aislado con prefijo)
   ============================================ */
        .breeze-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            margin: -24px -1rem 1.5rem;
            padding: 0 1rem;
        }

        .breeze-nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        /* --- Logo --- */
        .breeze-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #1f2937;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .breeze-logo svg {
            width: 28px;
            height: 28px;
            color: var(--azul-acento);
        }

        /* --- Links centrales --- */
        .breeze-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            flex: 1;
            margin-left: 1rem;
        }

        .breeze-links a {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.85rem;
            border-radius: 6px;
            color: #4b5563;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease;
            border-bottom: 2px solid transparent;
        }

        .breeze-links a:hover {
            color: #1f2937;
            background-color: #f9fafb;
        }

        .breeze-links a.activo {
            color: var(--azul-acento);
            border-bottom-color: var(--azul-acento);
            background-color: transparent;
        }

        /* --- Zona derecha --- */
        .breeze-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .breeze-link-simple {
            color: #4b5563;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: all 0.15s ease;
        }

        .breeze-link-simple:hover {
            color: #1f2937;
            background-color: #f9fafb;
        }

        /* --- Dropdown de usuario --- */
        .breeze-user {
            position: relative;
        }

        .breeze-user-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: none;
            border: 1px solid transparent;
            padding: 0.4rem 0.7rem;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            color: #374151;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .breeze-user-btn:hover {
            background-color: #f9fafb;
            border-color: #e5e7eb;
        }

        .breeze-user-name {
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .breeze-user-rol {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.15rem 0.5rem;
            border-radius: 999px;
            font-weight: 700;
            color: #fff;
            line-height: 1.4;
        }

        .rol-administrador {
            background-color: #5B9BD5;
        }

        .rol-instructor {
            background-color: #7BB88A;
        }

        .rol-aprendiz {
            background-color: #E5A85C;
        }

        .breeze-chevron {
            width: 16px;
            height: 16px;
            color: #9ca3af;
            transition: transform 0.2s ease;
        }

        .breeze-user.abierto .breeze-chevron {
            transform: rotate(180deg);
        }

        /* --- Menú desplegable --- */
        .breeze-dropdown {
            position: absolute;
            top: calc(100% + 6px);
            right: 0;
            min-width: 200px;
            background-color: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            padding: 0.4rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px);
            transition: all 0.15s ease;
            z-index: 100;
        }

        .breeze-user.abierto .breeze-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .breeze-dropdown a,
        .breeze-dropdown button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.55rem 0.75rem;
            border-radius: 6px;
            color: #374151;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background-color 0.15s ease;
        }

        .breeze-dropdown a:hover,
        .breeze-dropdown button:hover {
            background-color: #f3f4f6;
            color: #1f2937;
        }

        .breeze-dropdown form {
            margin: 0;
            padding-top: 0.25rem;
            border-top: 1px solid #f3f4f6;
            margin-top: 0.25rem;
        }

        /* --- Responsive --- */
        @media (max-width: 640px) {
            .breeze-nav-inner {
                gap: 0.5rem;
            }

            .breeze-links {
                margin-left: 0;
            }

            .breeze-links a span {
                display: none;
            }

            .breeze-user-name {
                display: none;
            }
        }

        :root {
            --blanco-hueso: #FAF9F6;
            --azul-claro: #E8F1F8;
            --azul-borde: #B8D4E8;
            --azul-acento: #5B9BD5;
            --azul-hover: #4A87BD;
            --texto: #2C3E50;
            --error-fondo: #FDECEA;
            --error-borde: #F5B7B1;
            --error-texto: #C0392B;
            --ok-fondo: #E6F4EA;
            --ok-borde: #A8D5BA;
            --ok-texto: #2E7D4F;
        }

        * {
            box-sizing: border-box;
        }

        body {
            max-width: 980px;
            margin: 24px auto;
            padding: 0 1rem;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: var(--blanco-hueso);
            color: var(--texto);
            line-height: 1.5;
        }

        nav {
            display: flex;
            gap: 0.75rem;
            padding: 0.85rem 1.1rem;
            background-color: #fff;
            border: 1px solid var(--azul-borde);
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        nav a {
            color: var(--azul-acento);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.4rem 0.7rem;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        nav a:hover {
            background-color: var(--azul-claro);
        }

        .flash {
            background-color: var(--ok-fondo);
            border-left: 4px solid var(--ok-borde);
            color: var(--ok-texto);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .contenedor {
            background: #fff;
            border: 1px solid var(--azul-borde);
            border-radius: 12px;
            padding: 2rem 2.25rem;
            box-shadow: 0 4px 16px rgba(91, 155, 213, 0.08);
        }

        h1 {
            color: var(--azul-acento);
            font-size: 1.6rem;
            border-bottom: 2px solid var(--azul-claro);
            padding-bottom: 0.75rem;
            margin: 0 0 1.5rem;
        }

        /* --- Formularios --- */
        .formulario .campo {
            margin-bottom: 1.25rem;
            display: flex;
            flex-direction: column;
        }

        .campo label {
            margin-bottom: 0.4rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .campo input {
            padding: 0.65rem 0.85rem;
            border: 1px solid var(--azul-borde);
            border-radius: 8px;
            background-color: var(--azul-claro);
            color: var(--texto);
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .campo input:focus {
            outline: none;
            border-color: var(--azul-acento);
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(91, 155, 213, 0.15);
        }

        .error-campo {
            margin-top: 0.3rem;
            font-size: 0.8rem;
            color: var(--error-texto);
        }

        .alerta-errores {
            background-color: var(--error-fondo);
            border-left: 4px solid var(--error-borde);
            color: var(--error-texto);
            padding: 0.9rem 1.1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alerta-errores ul {
            margin: 0.5rem 0 0;
            padding-left: 1.2rem;
        }

        /* --- Botones --- */
        .acciones {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.75rem;
        }

        .btn-guardar,
        .btn-primario {
            flex: 1;
            padding: 0.75rem 1.2rem;
            background-color: var(--azul-acento);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s ease;
        }

        .btn-guardar:hover,
        .btn-primario:hover {
            background-color: var(--azul-hover);
        }

        .btn-cancelar {
            padding: 0.75rem 1.2rem;
            background-color: var(--azul-claro);
            color: var(--azul-acento);
            border: 1px solid var(--azul-borde);
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            text-align: center;
            transition: all 0.2s ease;
        }

        .btn-cancelar:hover {
            background-color: #dbe8f2;
        }

        /* --- Encabezado con botón a la derecha --- */
        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .encabezado h1 {
            margin: 0;
            border-bottom: none;
            padding-bottom: 0;
        }

        .btn-nuevo {
            flex: 0 0 auto;
            padding: 0.55rem 1rem;
            font-size: 0.9rem;
        }

        /* --- Formulario de filtros --- */
        .formulario-filtros {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 1.25rem;
            align-items: end;
            padding: 1.25rem 1.5rem;
            background-color: var(--azul-claro);
            border: 1px solid var(--azul-borde);
            border-radius: 10px;
            margin-bottom: 1.75rem;
        }

        .formulario-filtros .campo {
            margin-bottom: 0;
        }

        .acciones-filtros {
            display: flex;
            gap: 0.85rem;
            padding-bottom: 1px;
        }

        .acciones-filtros .btn-primario,
        .acciones-filtros .btn-cancelar {
            flex: 0 0 auto;
            padding: 0.65rem 1.4rem;
            font-size: 0.9rem;
            min-width: 105px;
        }

        @media (max-width: 720px) {
            .formulario-filtros {
                grid-template-columns: 1fr;
            }

            .acciones-filtros {
                justify-content: flex-end;
            }
        }

        /* --- Tabla --- */
        .tabla-wrap {
            display: flex;
            justify-content: center;
            margin-top: 0.75rem;
        }

        .tabla {
            width: 100%;
            max-width: 880px;
            margin: 0 auto;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid var(--azul-borde);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
        }

        .tabla thead th {
            text-align: left;
            padding: 0.9rem 1.1rem;
            background-color: var(--azul-claro);
            color: var(--texto);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            border-bottom: 1px solid var(--azul-borde);
        }

        .tabla tbody td {
            padding: 0.85rem 1.1rem;
            border-bottom: 1px solid #eef4f9;
            font-size: 0.92rem;
            color: var(--texto);
            vertical-align: middle;
        }

        .tabla tbody tr:last-child td {
            border-bottom: none;
        }

        .tabla tbody tr:hover {
            background-color: #f6fafd;
        }

        .col-id {
            width: 60px;
            text-align: center;
            color: #7a8a99;
            font-weight: 600;
        }

        .col-acciones {
            text-align: right;
            white-space: nowrap;
            width: 220px;
        }

        /* --- Botones mini dentro de la tabla --- */
        .btn-mini {
            display: inline-block;
            padding: 0.45rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-left: 0.35rem;
            border: 1px solid transparent;
            line-height: 1.2;
        }

        .btn-mini:first-child {
            margin-left: 0;
        }

        .btn-ver {
            background-color: #eef4f9;
            color: #3a6b95;
            border-color: #cfe0ee;
        }

        .btn-ver:hover {
            background-color: #dbe8f2;
        }

        .btn-editar {
            background-color: #eaf3fb;
            color: #2c5f8a;
            border-color: #b8d4e8;
        }

        .btn-editar:hover {
            background-color: #d3e6f5;
        }

        .btn-peligro {
            background-color: #fdecea;
            color: #c0392b;
            border-color: #f5b7b1;
        }

        .btn-peligro:hover {
            background-color: #f9d4cf;
        }

        .form-inline {
            display: inline;
        }

        /* --- Sin resultados / resumen --- */
        .sin-resultados {
            text-align: center;
            padding: 2.5rem 1rem;
            color: #7a8a99;
            font-style: italic;
            background-color: var(--azul-claro);
            border-radius: 10px;
            border: 1px dashed var(--azul-borde);
        }

        .resumen {
            margin-top: 1.1rem;
            font-size: 0.85rem;
            color: #7a8a99;
            text-align: center;
        }

        .paginacion {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .paginacion svg {
            width: 18px;
            height: 18px;
        }

        /* ============================================
   VISTAS DE PERFIL
   ============================================ */
        .perfil-grid {
            display: grid;
            gap: 1.5rem;
        }

        .perfil-card {
            background-color: var(--azul-claro);
            border: 1px solid var(--azul-borde);
            border-radius: 10px;
            padding: 1.5rem 1.75rem;
        }

        .perfil-card.perfil-peligro {
            background-color: #fdf3f2;
            border-color: #f5b7b1;
        }

        .perfil-header {
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(91, 155, 213, 0.2);
        }

        .perfil-header h2 {
            font-size: 1.15rem;
            color: var(--azul-acento);
            margin: 0 0 0.3rem;
        }

        .perfil-header p {
            font-size: 0.85rem;
            color: #6b7c8c;
            margin: 0;
        }

        .perfil-peligro .perfil-header h2 {
            color: var(--error-texto);
        }

        .perfil-peligro .perfil-header {
            border-bottom-color: rgba(192, 57, 43, 0.15);
        }

        .aviso-verificacion {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #6b7c8c;
        }

        .btn-link {
            background: none;
            border: none;
            color: var(--azul-acento);
            text-decoration: underline;
            cursor: pointer;
            font-family: inherit;
            font-size: inherit;
            padding: 0;
        }

        .ok-msg {
            color: var(--ok-texto);
            margin-top: 0.4rem;
            font-size: 0.85rem;
        }

        .ok-inline {
            color: var(--ok-texto);
            font-size: 0.9rem;
            font-weight: 600;
            align-self: center;
        }

        .btn-peligro-grande {
            padding: 0.75rem 1.2rem;
            background-color: #c0392b;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s ease;
            font-family: inherit;
        }

        .btn-peligro-grande:hover {
            background-color: #a93226;
        }

        /* --- Modal --- */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.45);
            z-index: 200;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-overlay.abierto {
            display: flex;
        }

        .modal-box {
            background-color: #fff;
            border-radius: 12px;
            padding: 1.75rem 2rem;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-box h3 {
            margin: 0 0 0.5rem;
            font-size: 1.15rem;
            color: var(--texto);
        }

        .modal-box p {
            margin: 0 0 1.25rem;
            font-size: 0.9rem;
            color: #6b7c8c;
        }
    </style>
</head>

<body>
    <header class="breeze-nav">
        <div class="breeze-nav-inner">
            {{-- Logo a la izquierda --}}
            <a href="{{ route('aprendices.index') }}" class="breeze-logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Gestor ADSO</span>
            </a>

            {{-- Links centrales --}}
            <div class="breeze-links">
                <a href="{{ route('aprendices.index') }}"
                    class="{{ request()->routeIs('aprendices.*') ? 'activo' : '' }}">
                    Aprendices
                </a>
                @auth
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'activo' : '' }}">
                    Dashboard
                </a>
                @endauth
            </div>

            {{-- Zona derecha --}}
            <div class="breeze-right">
                @guest
                <a href="{{ route('login') }}" class="breeze-link-simple">Iniciar sesión</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="breeze-link-simple">Registrarse</a>
                @endif
                @endguest

                @auth
                <div class="breeze-user">
                    <button type="button" class="breeze-user-btn" onclick="this.parentElement.classList.toggle('abierto')">
                        <span class="breeze-user-name">{{ Auth::user()->name }}</span>
                        <span class="breeze-user-rol rol-{{ Auth::user()->role }}">
                            {{ Auth::user()->role }}
                        </span>
                        <svg class="breeze-chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div class="breeze-dropdown">
                        <a href="{{ route('profile.edit') }}">Perfil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </header>

    @if(session('ok'))
    <div class="flash">{{ session('ok') }}</div>
    @endif

    @yield('content')
</body>

</html>