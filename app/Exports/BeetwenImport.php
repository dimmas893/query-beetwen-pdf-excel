<?php

namespace App\Exports;

use App\Models\Beetwen;
use Maatwebsite\Excel\Concerns\FromCollection;

class BeetwenImport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Beetwen::all();
    }
}
