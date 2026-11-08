<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tutores - {{ $grado }}° {{ $grupo }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 10px; color: #2c3e50; padding: 0.5cm; }
        .header { text-align: center; border-bottom: 2px solid #1B2A4A; padding-bottom: 5px; margin-bottom: 8px; }
        .header img { max-height: 40px; }
        .header h1 { font-size: 14px; font-weight: 700; color: #1B2A4A; text-transform: uppercase; }
        .header p { font-size: 9px; color: #6c757d; margin: 1px 0; }
        .header h2 { font-size: 11px; font-weight: 700; color: #1B2A4A; margin-top: 3px; }
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        th { background: #1B2A4A; color: white; font-size: 9px; padding: 4px 2px; border: 1px solid #1B2A4A; text-align: center; }
        td { border: 1px solid #d0d7de; padding: 4px 2px; font-size: 9px; }
        td.num { text-align: center; width: 5%; }
        td.nombre { text-align: left; width: 40%; }
        td.alumno { text-align: left; width: 35%; }
        td.firma { text-align: center; width: 20%; height: 25px; }
        .footer { margin-top: 10px; font-size: 9px; }
        .firmas { display: flex; justify-content: space-between; margin-top: 30px; }
        .firma-linea { text-align: center; width: 40%; }
        .firma-linea .linea { border-top: 1px solid #1B2A4A; width: 100%; margin-bottom: 3px; }
        
        .no-print { text-align: center; margin-bottom: 15px; }
        .btn { background: #1B2A4A; color: white; border: none; padding: 10px 30px; font-size: 14px; font-weight: bold; border-radius: 6px; cursor: pointer; margin: 0 5px; }
        
        @media print {
            .no-print { display: none !important; }
            body { padding: 0.3cm; }
            @page { size: letter; margin: 0.5cm; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button class="btn" onclick="window.print()">🖨️ Imprimir Lista</button>
        <button class="btn" onclick="window.close()" style="background: #6c757d;">❌ Cerrar</button>
    </div>

    <div class="header">
        @if(file_exists(public_path($config->logo ?? 'assets/img/logo.png')))
            <img src="{{ asset($config->logo ?? 'assets/img/logo.png') }}" alt="Logo">
        @endif
        <h1>{{ $config->nombre_escuela ?? 'Escuela Primaria' }}</h1>
        <p>C.C.T.: {{ $config->clave_centro_trabajo ?? '______' }} | Z.E.: {{ $config->zona_escolar ?? '___' }} | S.E.: {{ $config->sector_educativo ?? '___' }}</p>
        <p>{{ $config->direccion ?? 'Dirección de la escuela' }}</p>
        <h2>Lista de Tutores - Grupo {{ $grado }}° "{{ $grupo }}" ({{ $filtro == 'regulares' ? 'Solo Regulares' : 'Todos' }})</h2>
        <p>Fecha: {{ date('d/m/Y') }} | Total de tutores: {{ $tutores->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nombre del Tutor</th>
                <th>Alumno a su cargo</th>
                <th>Firma / Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tutores as $index => $tutor)
                @php
                    // Buscamos a los alumnos de este grupo que pertenecen a este tutor
                    $alumnosDelTutor = $alumnos->filter(function($alumno) use ($tutor) {
                        return $alumno->tutores->contains($tutor->id);
                    });
                @endphp
                @foreach($alumnosDelTutor as $alumno)
                <tr>
                    @if($loop->first)
                        <td class="num" rowspan="{{ $alumnosDelTutor->count() }}">{{ $index + 1 }}</td>
                        <td class="nombre" rowspan="{{ $alumnosDelTutor->count() }}">{{ $tutor->apellidos }} {{ $tutor->nombre }}</td>
                    @endif
                    <td class="alumno">{{ $alumno->apellidos }} {{ $alumno->nombre }}</td>
                    <td class="firma"></td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="firmas">
        <div class="firma-linea">
            <div class="linea"></div>
            <p>Maestro(a) de Grupo</p>
        </div>
        <div class="firma-linea">
            <div class="linea"></div>
            <p>Director(a) de la Escuela</p>
        </div>
    </div>

</body>
</html>
