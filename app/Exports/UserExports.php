<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UserExports implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        if ($this->data['format'] == 'bulan') {
            $bulan = $this->data['bulan'];
            $tahun = $this->data['tahun'];
            return User::role('user')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
        }
        if ($this->data['format'] == 'tahun') {
            $tahun = $this->data['tahun'];
            return User::role('user')->whereYear('created_at', $tahun)->get();
        }
        if ($this->data['format'] == 'range') {
            $start = $this->data['start_date'];
            $end = $this->data['end_date'];
            return User::role('user')->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->get();
        }
        return User::role('user')->get();
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Nama',
            'Email',
            'KTP',
            'Tanggal Daftar',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            url('storage/'.$user->id_image),
            $user->created_at,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $data= $this->collection();
                for ($i=0; $i < sizeof($data); $i++) { 
                    $user = $data[$i];
                    $event->sheet->getDelegate()->getCell('D'.($i+1))->getHyperlink()->setUrl(url('storage/'.$user->id_image));    
                }
            },
        ];
    }

    // public function drawings()
    // {
    //     $result = [];

    //     $data = $this->collection();

    //     for ($i = 0; $i < sizeof($data); $i++) {
    //         $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    //         $drawing->setName('KTP');
    //         $drawing->setDescription('Foto KTP User ' . $data[$i]->name);
    //         $drawing->setPath(public_path('storage/'.$data[$i]->id_image));
    //         $drawing->setHeight(90);
    //         $drawing->setCoordinates('E' . ($i + 1));
    //         $result[] = $drawing;
    //     }

    //     return $result;
    // }
}
