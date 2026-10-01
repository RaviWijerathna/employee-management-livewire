<div class="max-w-3xl mx-auto mt-8">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Employee</h2>

        <form wire:submit="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" wire:model="first_name" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('first_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" wire:model="last_name" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('last_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" wire:model="email" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" wire:model="phone" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                    <select wire:model="department" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Department</option>
                        <option value="IT">IT</option>
                        <option value="HR">HR</option>
                        <option value="Sales">Sales</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Finance">Finance</option>
                    </select>
                    @error('department') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                    <input type="text" wire:model="position" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('position') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Salary (Rs.)</label>
                    <input type="number" step="0.01" wire:model="salary" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('salary') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hire Date</label>
                    <input type="date" wire:model="hire_date" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('hire_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="/" wire:navigate class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 font-medium">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                    Update Employee
                </button>
            </div>
        </form>
    </div>
</div>