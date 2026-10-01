<div>
    <style>
        .space-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: -10;
            background-color: #020205;
            overflow: hidden;
            perspective: 800px;
        }
        .background-stars {
            position: absolute;
            width: 100vw; height: 100vh;
            background-image:
                radial-gradient(2px 2px at 15% 25%, #ffffff, transparent),
                radial-gradient(1px 1px at 35% 75%, #ffffff, transparent),
                radial-gradient(3px 3px at 75% 15%, #aaccff, transparent),
                radial-gradient(2px 2px at 85% 65%, #ffffff, transparent),
                radial-gradient(2px 2px at 50% 50%, #ffccaa, transparent);
            background-size: 350px 350px;
        }
        .tilted-galaxy {
            position: absolute;
            top: 70%; left:15%;
            width: 120vw; height: 120vw;
            margin-top: -60vw; margin-left: -60vw;
            transform-style: preserve-3d;
            transform: rotateX(75deg);
        }
        .spinning-disk {
            position: absolute;
            width: 100%; height: 100%;
            border-radius: 50%;
            transform-style: preserve-3d;
            animation: spinDisk 15s linear infinite;
        }
        .galaxy-arms {
            position: absolute;
            width: 100%; height: 100%;
            border-radius: 50%;
            background: repeating-conic-gradient(
                from 0deg,
                transparent 0deg, rgba(150, 200, 255, 0.4) 30deg, transparent 60deg
            );
            filter: blur(30px);
        }
        .galaxy-stars {
            position: absolute;
            width: 100%; height: 100%;
            border-radius: 50%;
            background-image: 
                radial-gradient(3px 3px at 20% 30%, #ffffff, transparent),
                radial-gradient(4px 4px at 80% 40%, #aaccff, transparent),
                radial-gradient(3px 3px at 30% 70%, #ffffff, transparent),
                radial-gradient(5px 5px at 70% 80%, #ffccaa, transparent);
            background-size: 200px 200px;
        }
        .galaxy-core {
            position: absolute;
            top: 40%; left: 40%; width: 20%; height: 20%;
            border-radius: 50%;
            background: radial-gradient(circle, #ffffff 0%, #ffeec0 40%, transparent 75%);
            filter: blur(10px);
            box-shadow: 0 0 100px 30px rgba(255, 230, 180, 0.8);
            animation: pulseCore 3s infinite alternate ease-in-out;
        }
        @keyframes spinDisk {
            0% { transform: rotateZ(0deg); }
            100% { transform: rotateZ(360deg); }
        }
        @keyframes pulseCore {
            100% { transform: scale(1.1); opacity: 0.9; }
        }
    </style>

    <div class="space-bg">
        <div class="background-stars"></div>
        <div class="tilted-galaxy">
            <div class="spinning-disk">
                <div class="galaxy-arms"></div>
                <div class="galaxy-stars"></div>
                <div class="galaxy-core"></div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        
        <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 rounded-xl p-8 border border-gray-700 flex flex-col items-center justify-center gap-4 shadow-2xl relative overflow-hidden mb-8">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 via-blue-400 to-blue-600"></div>
            
            <img src="https://cdn.bitrix24.com/b24927941/bitrix24/983/983e80d96db1954fb853d58b1d2fbee8/logo_r7dv1ckza8.png" alt="Zuse Technologies Logo" class="h-20 md:h-24 w-auto object-contain relative z-10 drop-shadow-xl">
            
            <div class="text-center relative z-10 mt-2">
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-[0.15em] uppercase drop-shadow-lg">
                    Zuse Technologies
                </h1>
                <p class="text-xs md:text-sm text-blue-400 mt-3 font-bold tracking-[0.2em] uppercase">Employee Management System</p>
            </div>
        </div>

        <div class="bg-gray-800/90 backdrop-blur-md p-4 rounded-xl border border-gray-700 flex flex-col md:flex-row gap-4 items-center shadow-lg mb-6">
            <div class="flex-1 w-full">
                <input type="file" wire:model="import_file" id="import_file" class="hidden" accept=".csv, .xls, .xlsx">
            </div>
            <div class="w-full md:w-48">
                <select wire:model.live="selectedDepartment" class="w-full bg-gray-900 border border-gray-700 text-white rounded-md shadow-sm px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Departments</option>
                    <option value="IT">IT</option>
                    <option value="HR">HR</option>
                    <option value="Sales">Sales</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Finance">Finance</option>
                </select>
            </div>
            <div class="w-full md:w-48">
                <select class="w-full bg-gray-900 border border-gray-700 text-white rounded-md shadow-sm px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="w-full md:w-auto">
                <button type="button" wire:click="resetFilters" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-sm font-medium text-white hover:bg-gray-600 transition">
                    Reset
                </button>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="bg-green-100/90 backdrop-blur-sm border border-green-400 text-green-700 px-4 py-3 relative shadow-sm mb-6 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-100/90 backdrop-blur-sm border border-red-400 text-red-700 px-4 py-3 relative shadow-sm mb-6 rounded-md">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('import_errors'))
            <div class="bg-red-100/90 backdrop-blur-sm border border-red-400 text-red-700 px-4 py-3 relative shadow-sm mb-6 rounded-md">
                <ul class="list-disc list-inside">
                    @foreach (session('import_errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gray-50/95 backdrop-blur-md p-4 border-x border-t border-gray-200 rounded-t-xl flex flex-wrap gap-3 justify-end items-center mb-0 mt-6">
            
            <button type="button" wire:click="exportExcel" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 shadow-sm transition">
                Export Excel
            </button>
            
            <button type="button" wire:click="exportPdf" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 shadow-sm transition">
                Export PDF
            </button>
            
            <div class="relative flex items-center gap-3">
                <input type="file" wire:model.live="import_file" id="import_file" class="hidden" accept=".csv, .xls, .xlsx">
                <label for="import_file" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 shadow-sm transition cursor-pointer">
                    Import Excel
                </label>
                @error('import_file') <span class="text-red-500 text-[11px] absolute -bottom-5 left-0">{{ $message }}</span> @enderror
            </div>

            <a href="/employees/create" wire:navigate class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 shadow-sm transition">
                + Add Employee
            </a>
        </div>

        <div class="bg-white/95 backdrop-blur-md rounded-b-xl shadow-2xl overflow-x-auto border-x border-b border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100/80">
                    <tr>
                        <th class="px-6 py-3 text-left w-12">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white/90 divide-y divide-gray-200">
                    @forelse($employees as $employee)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" value="{{ $employee->id }}" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-gray-900">{{ $employee->first_name }} {{ $employee->last_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $employee->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $employee->department }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $employee->position }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="/employees/{{ $employee->id }}/edit" wire:navigate class="text-blue-600 hover:text-blue-900 mr-4">Edit</a>
                            <button wire:click="delete({{ $employee->id }})" wire:confirm="Are you sure you want to delete this employee?" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 font-medium">
                            No employees found. Click "+ Add Employee" to create one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>