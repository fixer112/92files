<?php

namespace App\Imports;

use App\Http\Controllers\Controller;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public $settings;
    public function __construct()
    {
        $this->settings = (new Controller)->getSettings();
    }
    public function model(array $row)
    {
        return new User([
            'username' => $row['username'],
            'fname' => $row['firstname'],
            'lname' => $row['lastname'],
            'so' => ucfirst($row['so']),
            'sex' => strtolower($row['sex']),
            'num' => $row['number'],
            'email' => $row['email'],
            'addr' => $row['address'],
            'dob' => Date::excelToDateTimeObject($row['dob']),
            'role' => 'user',
            'parent_name' => $row['parent_name'],
            'password' => $row['username'],
        ]);
    }

    public function rules(): array
    {

        return [
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|unique:users|min:5',
            'so' => 'required|string|in:' . implode(',', $this->settings['states']),
            'sex' => 'required|string|in:male,female',
            'number' => 'required|numeric',
            'address' => 'required|string|max:255',
            'dob' => 'required',
            'parent_name' => 'required|string|max:50',
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
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