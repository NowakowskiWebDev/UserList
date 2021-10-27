<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class UsersImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }
    /**
    * @param array $row
    *
    * @return App\Models\User
    */
    public function model(array $row)
    {
        return new User([
           'first_name'     => $row[0],
           'last_name'    => $row[1],
           'birthdate' => date('Y-m-d',strtotime($row[2])),
           'height' =>  Helper::multiplication($row[3], 10),
           'club_member' => $row[4] === 'true',
        ]);
    }
}
