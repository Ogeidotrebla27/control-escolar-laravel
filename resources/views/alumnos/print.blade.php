<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Alumno</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #2c3e50; padding: 0.8cm; line-height: 1.4; }
        .header { display: flex; align-items: center; border-bottom: 3px solid #1B2A4A; padding-bottom: 6px; margin-bottom: 10px; }
        .header .logo { width: 12%; text-align: center; }
        .header .logo img { max-height: 50px; width: auto; }
        .header .info { width: 88%; padding-left: 10px; }
        .header .info h1 { font-size: 14px; font-weight: 700; color: #1B2A4A; text-transform: uppercase; margin: 0; }
        .header .info p { font-size: 9px; color: #6c757d; margin: 1px 0; }
        .separador { border-top: 1px solid #1B2A4A; margin: 6px 0 8px 0; opacity: 0.3; }
        
        .datos-principales { display: flex; margin-bottom: 10px; }
        .datos-principales .foto { width: 15%; text-align: center; }
        .datos-principales .foto img { width: 2.5cm; height: 3.0cm; object-fit: cover; border: 2px solid #1B2A4A; border-radius: 3px; padding: 2px; }
        .datos-principales .info { width: 85%; padding-left: 12px; }
        .datos-principales .info .nombre { font-size: 16px; font-weight: 700; color: #1B2A4A; margin: 0; }
        
        .cuerpo { display: flex; gap: 15px; }
        .col { width: 50%; }
        .seccion { margin-bottom: 8px; }
        .seccion .titulo { font-size: 9px; font-weight: 700; text-transform: uppercase; color: #1B2A4A; border-bottom: 1.5px solid #1B2A4A; padding-bottom: 2px; margin-bottom: 4px; }
        .seccion .campo { display: flex; padding: 1px 0; font-size: 9px; }
        .seccion .campo .label { width: 40%; color: #6c757d; }
        .seccion .campo .valor { width: 60%; font-weight: 600; color: #1B2A4A; }
        
        .tutor-item { background: #f8fafc; padding: 3px 6px; margin-bottom: 2px; border-radius: 3px; font-size: 9px; }
        .tutor-item .nombre { font-weight: 700; }
        
        /* Estilos para la Bitácora */
        .bitacora-item { border-left: 3px solid #1B2A4A; padding-left: 8px; margin-bottom: 8px; background: #f9f9f9; padding: 5px 8px; }
        .bitacora-fecha { font-size: 8px; color: #6c757d; }
        .bitacora-cat { font-size: 8px; font-weight: bold; text-transform: uppercase; margin-bottom: 2px; }
        .cat-conducta { color: #dc3545; }
        .cat-felicitacion { color: #28a745; }
        .cat-logro { color: #e0a800; }
        .cat-otro { color: #1B6FA0; }
        .bitacora-desc { font-size: 9px; }
        
        .firmas { margin-top: 20px; padding-top: 10px; border-top: 2px solid #1B2A4A; display: flex; justify-content: space-around; }
        .firma { text-align: center; width: 40%; }
        .firma .linea { border-top: 1px solid #1B2A4A; width: 100%; margin: 25px auto 5px; }
        .firma .nombre { font-size: 10px; font-weight: 700; }
        .firma .cargo { font-size: 8px; color: #6c757d; }
        .pie { margin-top: 10px; padding-top: 4px; border-top: 1px solid #dee2e6; display: flex; justify-content: space-between; font-size: 7px; color: #adb5bd; }
                @media print {
            .no-print {
                display: none !important;
            }
            @page { size: letter; margin: 0.5cm; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <!-- BOTONES (Solo se ven en pantalla, no se imprimen) -->
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="background: #1B2A4A; color: white; border: none; padding: 12px 30px; font-size: 15px; font-weight: bold; border-radius: 6px; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            🖨️ Imprimir Documento
        </button>
        <button onclick="window.close()" style="background: #6c757d; color: white; border: none; padding: 12px 30px; font-size: 15px; font-weight: bold; border-radius: 6px; cursor: pointer; margin-left: 10px;">
            ❌ Cerrar
        </button>
    </div>
    <!-- ENCABEZADO INSTITUCIONAL (SIEMPRE SE MUESTRA) -->
    <!-- ENCABEZADO INSTITUCIONAL -->
    <div class="header">
        <div class="logo">
            @php
                $config = App\Models\Configuracion::first();
                $logoPath = $config->logo ?? 'assets/img/logo.png';
            @endphp
            @if(file_exists(public_path($logoPath)))
                <img src="{{ asset($logoPath) }}" alt="Logo">
            @endif
        </div>
        <div class="info">
            <h1>{{ $config->nombre_escuela ?? 'Escuela Primaria' }}</h1>
            <p>C.C.T.: {{ $config->clave_centro_trabajo ?? '______' }} | Z.E.: {{ $config->zona_escolar ?? '___' }}</p>
            <p>{{ $config->direccion ?? 'Dirección' }}</p>
            <p style="font-size: 9px; font-style: italic;">"{{ $config->lema ?? 'Educación para el futuro' }}"</p>
        </div>
    </div>

    <div class="separador"></div>

    <div class="separador"></div>

    <!-- DATOS DEL ALUMNO (SOLO SI NO ES 'historial') -->
        <!-- DATOS MÍNIMOS (Si es solo historial) -->
    @if($tipo == 'historial')
        <div style="margin-bottom: 15px; padding: 10px; background: #f8fafc; border-left: 4px solid #1B2A4A; border-radius: 4px;">
            <p style="font-size: 14px; font-weight: bold; color: #1B2A4A; margin-bottom: 4px;">
                {{ $alumno->apellidos }} {{ $alumno->nombre }}
            </p>
            <p style="font-size: 10px; color: #2c3e50;">
                <strong>CURP:</strong> {{ $alumno->curp }} | 
                <strong>Grupo:</strong> {{ $alumno->grado }}° "{{ $alumno->grupo }}" | 
                <strong>Matrícula:</strong> {{ $alumno->matricula ?? '—' }}
            </p>
        </div>
    @endif

    @if($tipo != 'historial')
        <div class="datos-principales">
            <div class="foto">
                @if($alumno->foto && file_exists(public_path($alumno->foto)))
                    <img src="{{ public_path($alumno->foto) }}" alt="Foto">
                @endif
            </div>
            <div class="info">
                <p class="nombre">{{ $alumno->nombre }} {{ $alumno->apellidos }}</p>
                <p style="font-size: 10px; color: #6c757d;">{{ $alumno->grado }}° "{{ $alumno->grupo }}" - Turno {{ $alumno->turno }}</p>
                <p style="font-size: 9px; margin-top: 4px;"><strong>CURP:</strong> {{ $alumno->curp }}</p>
                <p style="font-size: 9px;"><strong>Matrícula:</strong> {{ $alumno->matricula ?? '—' }}</p>
            </div>
        </div>
        
        <div class="separador"></div>

        <div class="cuerpo">
            <div class="col">
                <div class="seccion">
                    <div class="titulo">Datos Personales</div>
                    <div class="campo"><span class="label">Fecha Nacimiento</span><span class="valor">{{ $alumno->fecha_nacimiento }}</span></div>
                    <div class="campo"><span class="label">Domicilio</span><span class="valor">{{ $alumno->domicilio ?? '—' }}</span></div>
                </div>
                <div class="seccion">
                    <div class="titulo">Datos Médicos</div>
                    <div class="campo"><span class="label">Alergias</span><span class="valor">{{ $alumno->alergias ?? 'Ninguna' }}</span></div>
                </div>
            </div>
            <div class="col">
                <div class="seccion">
                    <div class="titulo">Tutores</div>
                    @foreach($alumno->tutores as $tutor)
                        <div class="tutor-item">
                            <div class="nombre">{{ $tutor->apellidos }} {{ $tutor->nombre }}</div>
                            <div style="font-size: 8px; color: #6c757d;">{{ $tutor->pivot->tipo_relacion }} | Tel: {{ $tutor->telefono ?? '—' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- HISTORIAL DE BITÁCORA (SOLO SI ES 'completa' O 'historial') -->
    @if($tipo == 'completa' || $tipo == 'historial')
        <div class="separador" style="margin-top: 15px;"></div>
        <div class="seccion">
            <div class="titulo" style="font-size: 11px; margin-bottom: 8px;">Historial de Bitácora</div>
            @forelse($alumno->bitacoras()->orderBy('created_at', 'desc')->get() as $bitacora)
                <div class="bitacora-item">
                    <div class="bitacora-cat 
                        @if($bitacora->categoria == 'conducta') cat-conducta 
                        @elseif($bitacora->categoria == 'felicitacion') cat-felicitacion
                        @elseif($bitacora->categoria == 'logro') cat-logro
                        @else cat-otro @endif">
                        {{ str_replace('_', ' ', $bitacora->categoria) }}
                    </div>
                    <div class="bitacora-desc">{{ $bitacora->descripcion }}</div>
                    <div class="bitacora-fecha">{{ $bitacora->created_at->format('d/m/Y H:i') }} - Por: {{ $bitacora->user->name ?? 'Sistema' }}</div>
                </div>
            @empty
                <p style="font-size: 9px; color: #6c757d;">No hay entradas en la bitácora.</p>
            @endforelse
        </div>
    @endif

    <!-- FIRMAS (SOLO SI NO ES 'historial') -->
    @if($tipo != 'historial')
    <div class="firmas">
        <div class="firma">
            <div class="linea"></div>
            <p class="nombre">{{ App\Models\Configuracion::first()->director_nombre ?? 'Director(a)' }}</p>
            <p class="cargo">Director(a) de la Escuela</p>
        </div>
        <div class="firma">
            <div class="linea"></div>
            <p class="nombre">Tutor Responsable</p>
            <p class="cargo">Firma</p>
        </div>
    </div>
    @endif

    <div class="pie">
        <span>Ficha generada: {{ date('d/m/Y H:i') }}</span>
        <span>ID: {{ $alumno->id }}</span>
    </div>

</body>
</html>