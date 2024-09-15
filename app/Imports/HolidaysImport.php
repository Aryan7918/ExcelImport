<?php

namespace App\Imports;

use App\Models\Holiday;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HolidaysImport implements ToCollection, ToModel, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // This function will be used for previewing the data
        return $rows;
    }

    public function model(array $row)
    {
        // This function will be used to store the data into the database
        return new Holiday([
            'occasion' => $row['occasion'],
            'date' => \Carbon\Carbon::instance(Date::excelToDateTimeObject($row['date'])),
            'user_id' => 1
        ]);
    }
}
