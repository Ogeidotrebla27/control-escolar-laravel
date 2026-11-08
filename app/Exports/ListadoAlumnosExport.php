<?php

namespace App\Exports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ListadoAlumnosExport implements FromCollection, WithHeadings, WithStyles
{
    protected $grado;
    protected $grupo;

    public function __construct($grado, $grupo)
    {
        $this->grado = $grado;
        $this->grupo = $grupo;
    }

    public function collection()
    {
        return Alumno::where('grado', $this->grado)
                    ->where('grupo', $this->grupo)
                    ->orderBy('apellidos')
                    ->get()
                    ->map(function ($alumno, $index) {
                        return [
                            $index + 1,
                            $alumno->apellidos . ' ' . $alumno->nombre,
                            $alumno->curp,
                            '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                        ];
                    });
    }

    public function headings(): array
    {
        $headings = ['No.', 'Nombre del Alumno', 'CURP'];
        for ($i = 1; $i <= 20; $i++) {
            $headings[] = (string) $i;
        }
        return $headings;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}