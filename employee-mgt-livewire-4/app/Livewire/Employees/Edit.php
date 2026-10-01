<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    public Employee $employee;

    #[Rule('required|min:2|max:50')]
    public $first_name;

    #[Rule('required|min:2|max:50')]
    public $last_name;

    public $email;

    #[Rule('required')]
    public $phone;

    #[Rule('required')]
    public $department;

    #[Rule('required')]
    public $position;

    #[Rule('required|numeric|min:0')]
    public $salary;

    #[Rule('required|date')]
    public $hire_date;

    protected function rules()
    {
        return [
            'email' => 'required|email|unique:employees,email,' . $this->employee->id,
        ];
    }

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->department = $employee->department;
        $this->position = $employee->position;
        $this->salary = $employee->salary;
        $this->hire_date = $employee->hire_date;
    }

    public function update()
    {
        $this->validate();

        $this->employee->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department' => $this->department,
            'position' => $this->position,
            'salary' => $this->salary,
            'hire_date' => $this->hire_date,
        ]);

        session()->flash('success', 'Employee updated successfully!');

        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.employees.edit')
            ->layout('components.layouts.app');
    }
}