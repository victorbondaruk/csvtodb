<?php

namespace App\Imports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;

class MedicinesImport implements ToModel, WithChunkReading, ShouldQueue
{
    use Importable;
    use RemembersChunkOffset;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $chunkOffset = $this->getChunkOffset();

        // return new Medicine([
        //     'name' => $row[0],
        //     'section' => $row[1],
        //     'indication' => $row[2],
        // ]);
        return new Medicine($row);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}