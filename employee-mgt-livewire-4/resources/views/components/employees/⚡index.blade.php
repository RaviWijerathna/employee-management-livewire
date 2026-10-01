<?php

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

new class extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $department = '';

    public $sortField = 'id';
    public $sortDirection = 'desc';

    public array $selectedEmployees = [];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'department', 'sortField', 'sortDirection']);
        $this->resetPage();
    }

    public function deleteEmployee($id)
    {
        Employee::findOrFail($id)->delete();
        session()->flash('success', 'Employee deleted successfully.');
    }

    #[Computed]
    public function employees()
    {
        return Employee::query()
            ->search($this->search)
            ->when($this->department, function ($query) {
                $query->where('department', $this->department);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    #[Computed]
    public function departments()
    {
        return Employee::select('department')
            ->whereNotNull('department')
            ->distinct()
            ->pluck('department');
    }
};
?>

<div class="p-6">
    <!-- Top Bar: Search, Filter, and Add Button -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex space-x-4 w-2/3">
            <input 
                type="text" 
                wire:model.live="search" 
                placeholder="Search employees..." 
                class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2"
            >

            <select wire:model.live="department" class="border-gray-300 rounded-md shadow-sm px-4 py-2">
                <option value="">All Departments</option>
                @foreach($this->departments as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>

            @if($search || $department)
                <button wire:click="resetFilters" class="text-red-500 hover:text-red-700 font-medium px-4 py-2">
                    Clear
                </button>
            @endif
        </div>

        <div>
            <a href="/employees/create" wire:navigate class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
    + Add Employee
</a>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm font-semibold">
                    <th wire:click="sortBy('first_name')" class="px-6 py-3 cursor-pointer hover:bg-gray-200">
                        Name
                    </th>
                    <th wire:click="sortBy('department')" class="px-6 py-3 cursor-pointer hover:bg-gray-200">
                        Department
                    </th>
                    <th class="px-6 py-3">Position</th>
                    <th wire:click="sortBy('salary')" class="px-6 py-3 cursor-pointer hover:bg-gray-200">
                        Salary
                    </th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @forelse($this->employees as $employee)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->full_name }}</td>
                        <td class="px-6 py-4">{{ $employee->department }}</td>
                        <td class="px-6 py-4">{{ $employee->position }}</td>
                        <td class="px-6 py-4">Rs. {{ number_format($employee->salary, 2) }}</td>
                        <td class="px-6 py-4 flex space-x-3">
                            <button class="text-blue-500 hover:text-blue-700 font-semibold">Edit</button>
                            <button wire:click="deleteEmployee({{ $employee->id }})" wire:confirm="Are you sure you want to delete this employee?" class="text-red-500 hover:text-red-700 font-semibold">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No employees found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $this->employees->links() }}
    </div>
</div>