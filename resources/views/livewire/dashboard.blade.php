<div class="">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-500 dark:text-gray-300 leading-tight">
                <a href="{{ route('dashboard') }}">{{ __('Blood Pressure Tracker') }}</a>
            </h2>
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-600 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                            {{ auth()->user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </x-slot>
                <x-slot name="content">
                    <div class="w-60">
                        <div class="border-t border-gray-100 dark:border-gray-900"></div>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Profile') }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-jet-dropdown-link href="{{ route('logout') }}" class="dark:bg-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-jet-dropdown>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-5 gap-1">
                <!-- Left controls -->
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <div class="flex">
                        <button @click="open = !open" type="button" class="inline-flex justify-center items-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                            <span class="truncate">{{ $currentProfileName ?? 'All Profiles' }}</span>
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        @if($currentProfileId)
                        <button wire:click.prevent="$set('removeProfileModalStatus', true)" class="text-gray-200 font-bold bg-red-600 ml-1 px-4 py-2 rounded-md border border-gray-400 shadow-sm">
                            <div class="w-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </button>
                        <button wire:click.prevent="$set('updateProfileModalStatus', true)" class="text-gray-200 font-bold bg-yellow-700 ml-1 px-4 py-2 rounded-md border border-gray-400 shadow-sm">
                            <div class="w-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                        </button>
                        @endif
                        <button wire:click.prevent="$set('addProfileModalStatus', true)" class="text-gray-200 font-bold bg-green-600 ml-1 px-4 py-2 rounded-md border border-gray-400 shadow-sm">
                            <div class="w-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                        </button>
                    </div>
                    <div :class="{'block': open, 'hidden': !open}"  @click="open = false" @click.away="open = false" class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="" wire:click.prefetch.prevent="setCurrentProfile({{ '' }})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">All Profiles</a>
                            @foreach ($profiles as $profile)
                            <a href="" wire:click.prefetch.prevent="setCurrentProfile({{ $profile->id }})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">{{ $profile->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Right controls -->
                <div class="flex gap-1">
                    @if($currentProfileId)
                    <button wire:click.prefetch.prevent="setCurrentProfile({{ '' }})" class="bg-gray-600 text-sm text-gray-100 px-6 py-2 rounded-md border border-gray-400 shadow-sm">View All Records</button>
                    <button wire:click.prevent="$set('addRecordModalStatus', true)" class="bg-green-600 text-sm text-gray-100 px-6 py-2 rounded-md border border-gray-400 shadow-sm">Add Record</button>
                    @endif
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Records table -->
                <div class="overflow-x-auto">
                    <div class="border border-t-2 border-gray-100 align-middle inline-block min-w-full">
                        <table wire:loading.class="opacity-75" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Profile
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Systole
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Diastole
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Pulse
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (count($records))
                                    @foreach ($records as $record)
                                    <tr class="hover:bg-gray-100 transition duration-75">
                                        <td class="px-6 py-4 whitespace-no-wrap cursor-pointer" wire:click.prefetch.prevent="setCurrentProfile({{ $record->profile->id }})">
                                            <div class="flex items-center">
                                                @if ($record->profile->gender == 'male')
                                                <div class="bg-blue-200 rounded-full text-3xl p-2">👨</div>
                                                @elseif($record->profile->gender == 'female')
                                                <div class="bg-pink-200 rounded-full text-3xl p-2">👩</div>
                                                @else
                                                <div class="bg-gray-200 rounded-full text-3xl p-2">👱</div>
                                                @endif
                                                <div class="ml-4">
                                                    <div class="text-sm leading-5 font-medium text-gray-900 truncate">
                                                        {{ $record->profile->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-center">
                                            <div class="inline-block text-sm leading-5 font-bold text-white px-2 rounded-full {{ $record->systole_color }}">{{ $record->systole }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-center">
                                            <div class="inline-block text-sm leading-5 font-bold text-white px-2 rounded-full {{ $record->diastole_color }}">{{ $record->diastole }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-center">
                                            <div class="text-sm leading-5 text-gray-900">{{ $record->pulse }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right">
                                            <div class="text-sm leading-5 text-gray-900 truncate" title="{{ $record->created_at }}">{{ $record->created_at->diffForHumans(['parts' => 2]) }}</div>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                            <button wire:click.prefetch.prevent="setRecord({{ $record->id }})" class="text-gray-200 font-bold bg-blue-600 ml-1 px-4 py-2 rounded-md border border-gray-400 shadow-sm">
                                                <div class="w-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @elseif (count($profiles) == 0)
                                    <tr><td class="text-center text-gray-600 py-5" colspan="6">Create a new profile to begin.</td></tr>
                                @elseif (count($records) == 0)
                                    <tr><td class="text-center text-gray-600 py-5" colspan="6">Select a profile to add new records.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                {{ $records->links('paginator') }}
            </div>

            <!-- Add profile modal -->
            <x-jet-dialog-modal wire:model="addProfileModalStatus">
                <x-slot name="title">
                    {{ __('Add Profile') }}
                </x-slot>
                <x-slot name="content">
                    <!-- Form -->
                    <div class="grid grid-cols-6 gap-6 my-8">
                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name*</label>
                            <input type="text" wire:model.lazy="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('name') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select id="gender" wire:model.lazy="gender" autocomplete="gender" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value=""></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="age" class="block text-sm font-medium text-gray-700">Age*</label>
                            <input type="number" min="0" max="180" wire:model.lazy.debounce.1s="age" id="age" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('age') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="sm:flex sm:flex-row-reverse justify-between">
                        <button wire:click.prevent="submitProfile()" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:w-auto sm:text-sm">
                            Add Profile
                        </button>
                        <button wire:click="$set('addProfileModalStatus', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>

            <!-- Update profile modal -->
            <x-jet-dialog-modal wire:model="updateProfileModalStatus">
                <x-slot name="title">
                    {{ __('Update Profile') }}
                </x-slot>
                <x-slot name="content">
                    <!-- Form -->
                    <div class="grid grid-cols-6 gap-6 my-8">
                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name*</label>
                            <input type="text" wire:model.lazy="currentProfileName" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('currentProfileName') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select id="gender" wire:model.lazy="currentProfileGender" autocomplete="gender" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('currentProfileGender') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="age" class="block text-sm font-medium text-gray-700">Age*</label>
                            <input type="number" min="0" max="180" wire:model.lazy.debounce.1s="currentProfileAge" id="age" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('currentProfileAge') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="sm:flex sm:flex-row-reverse justify-between">
                        <button wire:click.prevent="submitUpdateProfile()" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:w-auto sm:text-sm">
                            Update Profile
                        </button>
                        <button wire:click="$set('updateProfileModalStatus', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>

            <!-- Remove profile modal -->
            <x-jet-confirmation-modal wire:model="removeProfileModalStatus">
                <x-slot name="title">
                    Profile Delete
                </x-slot>
                <x-slot name="content">
                    Are you sure you need to delete <strong>{{ $currentProfileName }}</strong>'s profile? All related records will be permanently deleted and will not be able to recover.
                </x-slot>
                <x-slot name="footer">
                    <button wire:click.prevent="$set('removeProfileModalStatus', false)" type="button" class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                    @if($currentProfileId)
                    <button wire:click.prevent="removeCurrentProfile()" type="button" class="rounded-md border border-red-700 shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">Delete</button>
                    @endif
                </x-slot>
            </x-jet-confirmation-modal>

            <!-- Add record modal -->
            <x-jet-dialog-modal wire:model="addRecordModalStatus">
                <x-slot name="title">
                    {{ __('Add Record') }}
                </x-slot>
                <x-slot name="content">
                    <!-- Form -->
                    <div class="grid grid-cols-6 gap-6 my-8">
                        <div class="col-span-2">
                            <label for="systole" class="block text-sm font-medium text-gray-700">Systole*</label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="systole" id="systole" placeholder="120" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('systole') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="diastole" class="block text-sm font-medium text-gray-700">Diastole*</label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="diastole" id="diastole" placeholder="80" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('diastole') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="pulse" class="block text-sm font-medium text-gray-700">Pulse*</label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="pulse" id="pulse" placeholder="72" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('pulse') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="is_irregular_hb" class="block text-sm font-medium text-gray-700"><abbr title="Irregular Heart Beat">IHB</abbr></label>
                            <select id="is_irregular_hb" wire:model.lazy="is_irregular_hb" autocomplete="location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                                <option value="">N/A</option>
                            </select>
                            @error('is_irregular_hb') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="pp" class="block text-sm font-medium text-gray-700"><abbr title="Pulse Pressure">PP</abbr></label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="pulse_pressure" id="pp" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('pulse_pressure') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="map" class="block text-sm font-medium text-gray-700"><abbr title="Mean Arterial Pressure">MAP</abbr></label>
                            <input type="number" min="0" max="180" wire:model.lazy.debounce.1s="mean_arterial_pressure" id="map" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('mean_arterial_pressure') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <select id="location" wire:model.lazy="location" autocomplete="location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                                <option value="other">Other</option>
                            </select>
                            @error('location') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="posture" class="block text-sm font-medium text-gray-700">Posture</label>
                            <select id="posture" wire:model.lazy="posture" autocomplete="posture" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="seated">Seated</option>
                                <option value="stand">Stand</option>
                                <option value="other">Other</option>
                            </select>
                            @error('posture') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-6">
                            <label for="created_at" class="block text-sm font-medium text-gray-700">Created At</label>
                            <input type="text" wire:model.lazy="created_at" id="created_at" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('created_at') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-6">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea type="text" wire:model.lazy="note" id="note" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            @error('note') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="sm:flex sm:flex-row-reverse justify-between">
                        <button wire:click.prevent="submitRecord()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:w-auto sm:text-sm">
                            Add Record
                        </button>
                        <button wire:click="$set('addRecordModalStatus', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>

            <!-- Update record modal -->
            <x-jet-dialog-modal wire:model="updateRecordModalStatus">
                <x-slot name="title">
                    {{ __('Update Record') }}
                </x-slot>
                <x-slot name="content">
                    <!-- Form -->
                    <div class="grid grid-cols-6 gap-6 my-8">
                        <div class="col-span-2">
                            <label for="systole" class="block text-sm font-medium text-gray-700">Systole*</label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="setSystole" id="systole" placeholder="120" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('setSystole') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="diastole" class="block text-sm font-medium text-gray-700">Diastole*</label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="setDiastole" id="diastole" placeholder="80" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('setDiastole') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="pulse" class="block text-sm font-medium text-gray-700">Pulse*</label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="setPulse" id="pulse" placeholder="72" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('setPulse') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="is_irregular_hb" class="block text-sm font-medium text-gray-700"><abbr title="Irregular Heart Beat">IHB</abbr></label>
                            <select id="is_irregular_hb" wire:model.lazy="setIsIrregularHb" autocomplete="location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                                <option value="">N/A</option>
                            </select>
                            @error('setIsIrregularHb') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="pp" class="block text-sm font-medium text-gray-700"><abbr title="Pulse Pressure">PP</abbr></label>
                            <input type="number" min="0" max="350" wire:model.lazy.debounce.1s="setPulsePressure" id="pp" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('setPulsePressure') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="map" class="block text-sm font-medium text-gray-700"><abbr title="Mean Arterial Pressure">MAP</abbr></label>
                            <input type="number" min="0" max="180" wire:model.lazy.debounce.1s="setMeanArterialPressure" id="map" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('setMeanArterialPressure') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <select id="location" wire:model.lazy="setLocation" autocomplete="location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                                <option value="other">Other</option>
                            </select>
                            @error('setLocation') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label for="posture" class="block text-sm font-medium text-gray-700">Posture</label>
                            <select id="posture" wire:model.lazy="setPosture" autocomplete="posture" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="seated">Seated</option>
                                <option value="stand">Stand</option>
                                <option value="other">Other</option>
                            </select>
                            @error('setPosture') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-6">
                            <label for="created_at" class="block text-sm font-medium text-gray-700">Created At</label>
                            <input type="text" wire:model.lazy="setCreatedAt" id="created_at" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('setCreatedAt') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-6">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea type="text" wire:model.lazy="setNote" id="note" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            @error('setNote') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="sm:flex sm:flex-row-reverse justify-between">
                        <button wire:click.prevent="submitUpdateRecord()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:w-auto sm:text-sm">
                            Update Record
                        </button>
                        <button wire:click="$set('updateRecordModalStatus', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>
        </div>
    </div>
</div>