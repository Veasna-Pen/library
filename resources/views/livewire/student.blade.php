<div>
    <x-slot name="title">{{ __('Student') }}</x-slot>
    <a
        class="flex items-center justify-between p-4 mb-8 mt-8 text-sm font-semibold bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <span>
            <button
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                wire:click="showForm">
                Add New
            </button>
        </span>

        <div class="col-span-6 sm:col-span-3">
            <input wire:model="search" type="text" placeholder="Search Here..."
                class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
        </div>
    </a>

    <!----Alert----->
    <div x-data="{ showMessage: true }" x-show="showMessage" class="flex justify-end">
        @if (session()->has('success'))
        <div class="flex items-center justify-between max-w-xl p-4 bg-white border rounded-md shadow-sm">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <p class="ml-3 text-sm font-bold text-green-600">{{ session()->get('success') }}</p>
            </div>
            <span @click="showMessage = false" class="inline-flex items-center cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
        @endif
    </div>


    <!----Show Table & Search----->
    @if ($showTable == true)
    <div class="w-full overflow-hidden rounded-lg shadow-xs my-4">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Id</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Address</th>
                    <th class="px-4 py-3">Gender</th>
                    <th class="px-4 py-3">Class</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($students as $student)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold">{{ $student->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $student->name }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $student->email }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $student->phone }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $student->address }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $student->gender }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $student->class }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <button class="flex items-center justify-between px-2 py-2 
                            text-sm font-medium leading-5 text-purple-600 rounded-lg 
                            dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit"
                                wire:click="editStudent({{ $student->id }})">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </button>
                            <button class="flex items-center justify-between px-2 py-2 
                            text-sm font-medium leading-5 text-purple-600 rounded-lg 
                            dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit"
                                wire:click="deleteStudent({{ $student->id }})">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $students->links() }}
</div>
@endif

<!---Create-->
@if ($createForm == true)
<button type="submit" wire:click="goBack"
    class="mb-2 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    Back
</button>
<form action="" wire:submit.prevent="store">
    <div class="overflow-hidden shadow sm:rounded-md">
        <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="p-2 block text-sm font-medium text-gray-700">Student name</label>
                    <input type="text" wire:model.lazy="name"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="p-2 block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" wire:model.lazy="email"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="phone" class="p-2 block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" wire:model.lazy="phone"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('phone')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="address" class="p-2 block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" wire:model.lazy="address"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('address')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <select wire:model.lazy="gender"
                        class="w-full py-3 px-2 my-4 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                        <option selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    @error('gender')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="class" class="p-2 block text-sm font-medium text-gray-700">Class</label>
                    <input type="text" wire:model.lazy="class"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('class')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
        </div>
    </div>
</form>
@endif

<!---Update-->
@if ($updateForm == true)
<button type="submit" wire:click="goBack"
    class="mb-2 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    Back
</button>
<form action="" wire:submit.prevent="update({{ $student_id }})">
    <div class="overflow-hidden shadow sm:rounded-md">
        <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="edit_name" class="p-2 block text-sm font-medium text-gray-700">Student name</label>
                    <input type="text" wire:model.lazy="edit_name"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('edit_name')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="edit_email" class="p-2 block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" wire:model.lazy="edit_email"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('edit_email')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="edit_phone" class="p-2 block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" wire:model.lazy="edit_phone"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('edit_phone')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="edit_address" class="p-2 block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" wire:model.lazy="edit_address"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('edit_address')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <select wire:model.lazy="edit_gender"
                        class="w-full py-3 px-2 my-4 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                        <option selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    @error('edit_gender')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="edit_class" class="p-2 block text-sm font-medium text-gray-700">Class</label>
                    <input type="text" wire:model.lazy="edit_class"
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">

                    @error('edit_class')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
        </div>
    </div>
</form>
@endif