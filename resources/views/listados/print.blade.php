<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 10px; color: #2c3e50; padding: 0.5cm; }
        .header { text-align: center; border-bottom: 2px solid #1B2A4A; padding-bottom: 5px; margin-bottom: 8px; }
        .header .logo { text-align: center; margin-bottom: 3px; }
        .header .logo img { max-height: 40px; width: auto; }
        .header h1 { font-size: 14px; font-weight: 700; color: #1B2A4A; text-transform: uppercase; letter-spacing: 1px; }
        .header p { font-size: 9px; color: #6c757d; margin: 1px 0; }
        .header h2 { font-size: 11px; font-weight: 700; color: #1B2A4A; margin-top: 3px; }
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        th { background: #1B2A4A; color: white; font-size: 9px; padding: 4px 2px; border: 1px solid #1B2A4A; text-align: center; }
        td { border: 1px solid #d0d7de; padding: 4px 2px; font-size: 9px; }
        td.nombre { text-align: left; width: 40%; }
        td.num { text-align: center; width: 3%; }
        td.check { text-align: center; width: 2%; height: 20px; }
        .footer { margin-top: 10px; font-size: 9px; }
        .firmas { display: flex; justify-content: space-between; margin-top: 25px; }
        .firma { text-align: center; width: 40%; }
        .firma .linea { border-top: 1px solid #1B2A4A; width: 100%; margin-bottom: 3px; }
        .firma p { font-size: 9px; }
        .notas { margin-top: 8px; }
        .notas .linea-nota { border-bottom: 1px solid #d0d7de; height: 20px; }
        
        /* Botones (solo pantalla) */
        .no-print { text-align: center; margin-bottom: 15px; }
        .btn-imprimir { background: #1B2A4A; color: white; border: none; padding: 12px 35px; font-size: 15px; font-weight: bold; border-radius: 8px; cursor: pointer; margin: 0 5px; }
        .btn-cerrar { background: #6c757d; color: white; border: none; padding: 12px 35px; font-size: 15px; font-weight: bold; border-radius: 8px; cursor: pointer; margin: 0 5px; }
        
        @media print {
            .no-print { display: none !important; }
            body { padding: 0.3cm; }
            @page { size: letter; margin: 0.5cm; }
        }
    </style>
</head>
<body>

    <!-- BOTONES -->
    <div class="no-print">
        <button class="btn-imprimir" onclick="window.print()">
            🖨️ Imprimir Listado
        </button>
        <button class="btn-cerrar" onclick="window.close()">
            ❌ Cerrar
        </button>
    </div>

    <!-- ENCABEZADO -->
    <div class="header">
        @if(file_exists(public_path($config->logo ?? 'assets/img/logo.png')))
            <div class="logo">
                <img src="{{ asset($config->logo ?? 'assets/img/logo.png') }}" alt="Logo">
            </div>
        @endif
        <h1>{{ $config->nombre_escuela ?? 'Escuela Primaria' }}</h1>
        <p>C.C.T.: {{ $config->clave_centro_trabajo ?? '______' }} | Z.E.: {{ $config->zona_escolar ?? '___' }} | S.E.: {{ $config->sector_educativo ?? '___' }}</p>
        <p>{{ $config->direccion ?? 'Dirección de la escuela' }}</p>
        <h2>Lista de Alumnos - {{ $grado }}° "{{ $grupo }}"</h2>
        <p>Fecha: {{ date('d/m/Y') }}</p>
    </div>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No.</th>
                <th style="width: 37%;">Nombre del Alumno</th>
                @for($i = 1; $i <= 20; $i++)
                    <th style="width: 3%;">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach($alumnos as $index => $alumno)
            <tr>
                <td class="num">{{ $index + 1 }}</td>
                <td class="nombre">{{ $alumno->apellidos }} {{ $alumno->nombre }}</td>
                @for($i = 1; $i <= 20; $i++)
                    <td class="check"></td>
                @endfor
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTAL -->
    <div class="footer">
        <p><strong>Total de alumnos:</strong> {{ $alumnos->count() }}</p>
    </div>

    <!-- FIRMAS -->
    <div class="firmas">
        <div class="firma">
            <div class="linea"></div>
            <p>Maestro(a) de Grupo</p>
        </div>
        <div class="firma">
            <div class="linea"></div>
            <p>Director(a) de la Escuela</p>
        </div>
    </div>

    <!-- NOTAS -->
    <div class="notas">
        <p><strong>Notas:</strong></p>
        <div class="linea-nota"></div>
        <div class="linea-nota"></div>
    </div>

</body>
</html>