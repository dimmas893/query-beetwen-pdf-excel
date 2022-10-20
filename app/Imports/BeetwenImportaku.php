<?php

namespace App\Imports;

use App\Models\Beetwen;
use Maatwebsite\Excel\Concerns\ToModel;

class BeetwenImportaku implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Beetwen([
            'tanggal'     => $row[1],
            'name'    => $row[2],
        ]);
    }
}
