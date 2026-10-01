<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Create extends Component
{
    #[Rule('required|min:2|max:50')]
    public $first_name = '';

    #[Rule('required|min:2|max:50')]
    public $last_name = '';

    #[Rule('required|email|unique:employees,email')]
    public $email = '';

    #[Rule('required')]
    public $phone = '';

    #[Rule('required')]
    public $department = '';

    #[Rule('required')]
    public $position = '';

    #[Rule('required|numeric|min:0')]
    public $salary = '';

    #[Rule('required|date')]
    public $hire_date = '';

    public function save()
    {
        $this->validate();

        Employee::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department' => $this->department,
            'position' => $this->position,
            'salary' => $this->salary,
            'hire_date' => $this->hire_date,
            'status' => true,
        ]);

        session()->flash('success', 'Employee created successfully!');

        return $this->redirect('/', navigate: true);
    }
    
    public function render()
    {
        return view('livewire.employees.create')
            ->layout('components.layouts.app');
    }
}