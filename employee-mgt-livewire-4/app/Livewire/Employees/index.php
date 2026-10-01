<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;

class Index extends Component
{
    use WithFileUploads;

    public $selectedDepartment = '';
    public $search = '';
    public $import_file;

    
    public function updatedImportFile()
    {
        $this->importExcel();
    }

    public function resetFilters()
    {
        $this->reset(['selectedDepartment', 'search']);
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        session()->flash('success', 'Employee deleted successfully!');
    }

    public function exportExcel()
    {
        $employees = $this->getEmployeesCollection();
        return Excel::download(new EmployeesExport($employees), 'employees.xlsx');
    }

    public function exportPdf()
    {
        $employees = $this->getEmployeesCollection();
        return Excel::download(new EmployeesExport($employees), 'employees.pdf', ExcelFormat::DOMPDF);
    }

    public function importExcel()
    {
        $this->validate([
            'import_file' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new EmployeesImport, $this->import_file->getRealPath());
            
            session()->flash('success', 'Employees imported successfully!');
            $this->reset(['import_file']);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             session()->flash('import_errors', $failures[0]->errors());
        } catch (\Exception $e) {
            session()->flash('error', 'There was an issue importing the file: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $employees = $this->getEmployeesQuery()->get();
        
        return view('livewire.employees.index', [
            'employees' => $employees
        ])->layout('components.layouts.app');
    }

    protected function getEmployeesQuery()
    {
        return Employee::query()
            ->when($this->selectedDepartment, function ($query) {
                $query->where('department', $this->selectedDepartment);
            })
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('id', 'desc');
    }

    protected function getEmployeesCollection()
    {
        return $this->getEmployeesQuery()->reorder('id', 'asc')->get();
    }
}