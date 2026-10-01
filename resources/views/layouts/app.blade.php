<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title','Gestor ADSO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --blanco-hueso: #FAF9F6;
            --azul-claro:   #E8F1F8;
            --azul-borde:   #B8D4E8;
            --azul-acento:  #5B9BD5;
            --azul-hover:   #4A87BD;
            --texto:        #2C3E50;
            --error-fondo:  #FDECEA;
            --error-borde:  #F5B7B1;
            --error-texto:  #C0392B;
            --ok-fondo:     #E6F4EA;
            --ok-borde:     #A8D5BA;
            --ok-texto:     #2E7D4F;
        }

        * { box-sizing: border-box; }

        body {
            max-width: 980px;
            margin: 24px auto;
            padding: 0 1rem;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: var(--blanco-hueso);
            color: var(--texto);
            line-height: 1.5;
        }

        /* --- Navegación --- */
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

        /* --- Mensajes flash --- */
        .flash {
            background-color: var(--ok-fondo);
            border-left: 4px solid var(--ok-borde);
            color: var(--ok-texto);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        /* --- Contenedores genéricos de página --- */
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
            grid-template-columns: 1fr 1fr auto;
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

        /* --- Paginación --- */
        .paginacion {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .paginacion svg {
            width: 18px;
            height: 18px;
        }
    </style>
</head>
<body>

    <nav>
        <a href="/aprendices">Aprendices</a>
    </nav>

    @if(session('ok'))
        <div class="flash">{{ session('ok') }}</div>
    @endif

    @yield('content')

</body>
</html>