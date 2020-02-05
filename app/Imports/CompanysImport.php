<?php

namespace App\Imports;

use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CompanysImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Company([

            'name' => $row['name'],
            'location' => $row['location'],
            'addr' => $row['address'],
            'num' => $row['number'],
            'state' => $row['state'],
            'grn' => $row['grn'],
            'email' => $row['email'],
            'type' => $row['type'],
            'uc' => Str::random(10),
            'admin_id' => Auth::id(),

        ]);
    }

    public function rules(): array
    {

        return [
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'number' => 'required|numeric',
            'state' => 'required|string|max:25',
            'grn' => 'required|string|max:25|unique:companies',
            'email' => 'required|string|email|max:100|unique:companies',
            'type' => 'required|string|in:education,health,others',

        ];
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