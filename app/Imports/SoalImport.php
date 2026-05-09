<?php

namespace App\Imports;

use App\Models\Soal;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Soal([
            'modul_id'      => $row['modul_id'],
            'pertanyaan'    => $row['pertanyaan'],
            'kategori'      => $row['kategori'],
            'fase'          => $row['fase'],
            'pilihan_a'     => $row['pilihan_a'],
            'pilihan_b'     => $row['pilihan_b'],
            'pilihan_c'     => $row['pilihan_c'],
            'pilihan_d'     => $row['pilihan_d'],
            'kunci_jawaban' => $row['kunci_jawaban'], // Sesuaikan jika di DB pakai jawaban_benar
        ]);
    }
}