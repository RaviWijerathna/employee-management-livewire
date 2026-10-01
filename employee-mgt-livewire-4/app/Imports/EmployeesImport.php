<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row): Employee
    {
        return new Employee([
            'first_name' => $row['first_name'],
            'last_name'  => $row['last_name'],
            'email'      => $row['email'],
            'phone'      => $row['phone'],
            'department' => $row['department'],
            'position'   => $row['position'],
            'salary'     => $row['salary'],
            'hire_date'  => $row['hire_date'],
        ]);
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|min:2',
            'last_name'  => 'required|min:2',
            'email'      => 'required|email|unique:employees,email',
            'phone'      => 'required',
            'department' => 'required',
            'position'   => 'required',
            'salary'     => 'required|numeric|min:0',
            'hire_date'  => 'required|date',
        ];
    }
}