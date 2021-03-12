    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-500 leading-tight">
                <a href="{{ route('dashboard') }}">{{ __('Blood Pressure Tracker') }}</a>
            </h2>
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            {{ auth()->user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </x-slot>
                <x-slot name="content">
                    <div class="w-60">
                        <div class="border-t border-gray-100"></div>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Profile') }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-jet-dropdown-link href="{{ route('logout') }}"
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
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div wire:loading.class="bg-gray" class="flex justify-between items-center mb-5">
                <!-- Left controls -->
                <div class="">
                    <div x-data="{ profilesDropDownOpen: false }" class="relative inline-block text-left">
                        <div class="flex">
                            <button @click="profilesDropDownOpen != profilesDropDownOpen" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" id="options-menu" aria-haspopup="true" aria-expanded="true">
                                {{ __('Profiles')}} <span>{{ $profileName }}</span>
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button wire:click.prevent="toggleAddProfileModal" class="text-gray-200 font-bold bg-red-600 mx-1 py-2 px-4 rounded-md">-</button>
                            <button wire:click.prevent="toggleAddProfileModal" class="text-gray-200 font-bold bg-blue-700 mx-1 py-2 px-4 rounded-md">+</button>
                        </div>
                        <div :class="{'hidden': profilesDropDownOpen, 'block': !profilesDropDownOpen}" class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <a href="" wire:click.prevent="setCurrentProfile({{ null }})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">All</a>
                                @foreach ($profiles as $profile)
                                <a href="" wire:click.prevent="setCurrentProfile({{ $profile->id }})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">{{ $profile->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right controls -->
                <div class="">
                    <button wire:click.prevent="toggleAddRecordModal" class="bg-green-600 text-gray-100 px-6 py-2 rounded-md">Add Record</button>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Records table -->
                <div class="overflow-x-auto">
                    <div class="border border-t-2 border-gray-100 align-middle inline-block min-w-full">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Profile
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Systole
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Diastole
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Pulse
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($records as $record)
                                <tr class="hover:bg-gray-100 transition duration-75">
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            @if ($record->profile->gender == 'male')
                                            <div class="bg-blue-200 rounded-full text-3xl p-2">👨</div>
                                            @elseif($record->profile->gender == 'female')
                                            <div class="bg-pink-200 rounded-full text-3xl p-2">👩</div>
                                            @else
                                            <div class="bg-gray-200 rounded-full text-3xl p-2">👱</div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    {{ $record->profile->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $record->systole }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $record->diastole }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">{{ $record->pulse }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        <div class="text-sm leading-5 text-gray-900" title="{{ $record->created_at }}">{{ $record->created_at->diffForHumans(['parts' => 2]) }}</div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                {{ $records->links('paginator') }}
            </div>

            <!-- Add profile modal -->
            <x-jet-dialog-modal wire:model="toggleAddProfileModalStatus">
                <x-slot name="title">
                    {{ __('Add Profile') }}
                </x-slot>
                <x-slot name="content">
                    <!-- Form -->
                    <div class="grid grid-cols-6 gap-6 my-8">
                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name*</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-3">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select id="gender" name="gender" autocomplete="gender" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-span-3">
                            <label for="age" class="block text-sm font-medium text-gray-700">Age*</label>
                            <input type="number" min="0" max="180" name="age" id="age" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="sm:flex sm:flex-row-reverse justify-between">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:w-auto sm:text-sm">
                            Add Profile
                        </button>
                        <button wire:click="toggleAddProfileModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>

            <!-- Add record modal -->
            <x-jet-dialog-modal wire:model="toggleAddRecordModalStatus">
                <x-slot name="title">
                    {{ __('Add Record') }}
                </x-slot>
                <x-slot name="content">
                    <!-- Form -->
                    <div class="grid grid-cols-6 gap-6 my-8">
                        <div class="col-span-2">
                            <label for="systole" class="block text-sm font-medium text-gray-700">Systole*</label>
                            <input type="number" min="0" max="350" name="systole" id="systole" placeholder="120" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-2">
                            <label for="diastole" class="block text-sm font-medium text-gray-700">Diastole*</label>
                            <input type="number" min="0" max="350" name="diastole" id="diastole" placeholder="80" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-2">
                            <label for="pulse" class="block text-sm font-medium text-gray-700">Pulse*</label>
                            <input type="number" min="0" max="350" name="pulse" id="pulse" placeholder="72" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-1">
                            <label for="pp" class="block text-sm font-medium text-gray-700"><abbr title="Pulse Pressure">PP</abbr></label>
                            <input type="number" min="0" max="350" name="pp" id="pp" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-1">
                            <label for="map" class="block text-sm font-medium text-gray-700"><abbr title="Mean Arterial Pressure">MAP</abbr></label>
                            <input type="number" min="0" max="180" name="map" id="map" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-2">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <select id="location" name="location" autocomplete="location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="left">Left Arm</option>
                                <option value="right">Right Arm</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="posture" class="block text-sm font-medium text-gray-700">Posture</label>
                            <select id="posture" name="posture" autocomplete="posture" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="seated">Seated</option>
                                <option value="stand">Stand</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-span-6">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea type="text" name="note" id="note" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="sm:flex sm:flex-row-reverse justify-between">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none sm:w-auto sm:text-sm">
                            Add Record
                        </button>
                        <button wire:click="toggleAddRecordModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>
        </div>
    </div>
