<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <td colspan="8" style="text-align: center; font-size: 24px; font-weight: bold; color: #1e293b; height: 40px; vertical-align: middle;">
            ZUSE TECHNOLOGIES
        </td>
    </tr>
    <tr>
        <td colspan="8" style="text-align: center; font-size: 14px; font-weight: bold; color: #3b82f6; height: 30px; vertical-align: middle;">
            EMPLOYEE MANAGEMENT SYSTEM - DIRECTORY EXPORT
        </td>
    </tr>
    <tr>
        <td colspan="8" style="height: 15px;"></td>
    </tr>
    <tr>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: center; width: 40px; height: 30px;">ID</th>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: left; width: 100px;">First Name</th>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: left; width: 100px;">Last Name</th>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: left; width: 160px;">Email</th>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: left; width: 100px;">Phone</th>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: left; width: 80px;">Dept</th>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: left; width: 100px;">Position</th>
        <th style="background-color: #1e293b; color: #ffffff; font-weight: bold; border: 1px solid #000000; text-align: right; width: 90px;">Salary(Rs)</th>
    </tr>
    @foreach($employees as $employee)
    <tr>
        <td style="border: 1px solid #000000; text-align: center; height: 25px;">{{ $employee->id }}</td>
        <td style="border: 1px solid #000000;">{{ $employee->first_name }}</td>
        <td style="border: 1px solid #000000;">{{ $employee->last_name }}</td>
        <td style="border: 1px solid #000000;">{{ $employee->email }}</td>
        <td style="border: 1px solid #000000;">{{ $employee->phone }}</td>
        <td style="border: 1px solid #000000; color: #1d4ed8; font-weight: bold;">{{ $employee->department }}</td>
        <td style="border: 1px solid #000000;">{{ $employee->position }}</td>
        <td style="border: 1px solid #000000; text-align: right;">{{ number_format($employee->salary, 2) }}</td>
    </tr>
    @endforeach
</table>