<x-layoutDB>

    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('createSuccess'))
        <div id="alert-0"
            class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium pl-3">Pemberitahuan </span> {{ session('createSuccess') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-0" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @error('nis')
        <div id="alert-1"
            class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium pl-3">Pemberitahuan </span>NIS sudah terdaftar
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @enderror

    <div class=" my-9 flex">
        <h1 class=" mb-1 text-5xl tracking-tight font-bold text-gray-900">{{ $judul }}</h1>
    </div>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Request::path() == 'dashboard/register')
        <form action="/dashboard/register" method="POST">
        @else
            <form action="/dashboard/reset-password" method="POST">
    @endif
    @csrf
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-3">
                    <label for="name" class="block font-medium leading-6 text-gray-900">Nama</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name"
                            class="block px-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600  leading-6"
                            required="" value="{{ isset($admin) ? $admin->name : '' }}">
                    </div>
                </div>

                <div class="col-span-3">
                    <label for="username" class="block font-medium leading-6 text-gray-900">
                        NIS
                        <div class="mt-2">
                            <input type="number" name="username" id="username"
                                class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 leading-6 peer @error('username') border-red-500 @enderror"
                                required value="{{ isset($admin) ? $admin->username : '' }}">
                        </div>
                    </label>
                </div>
                <input type="hidden" name="old_username" value="{{ isset($admin) ? $admin->username : '' }}">
                <div class="col-span-3">
                    <label for="password" class="block font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password"
                            class="block px-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600  leading-6"
                            {{ isset($admin->password) ? '' : 'required' }}>
                    </div>
                </div>
                <input type="hidden" name="role" value="1">
            </div>
        </div>
    </div>
    <div class="mt-2 flex items-center justify-end gap-x-6">
        <a href="/dashboard/santri"
            class=" mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-red-600 px-5 py-2  font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 text-sm leading-6">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="-ml-0.5 mr-1.5 size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Batal
        </a>
        <button type="submit"
            class=" text-sm  leading-6 text-white mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-blue-600 px-3 py-2  font-semibold  shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="-ml-0.5 mr-1.5 size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
            Simpan
        </button>
    </div>

    </form>
    {{-- @else
        <form action="/dashboard/reset-password" method="POST">
            @csrf
            Kosongkan Nama / Password jika tidak akan diubah
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-3">
                            <label for="username" class="block font-medium leading-6 text-gray-900">
                                NIS
                                <div class="mt-2">
                                    <input type="number" name="username" id="username"
                                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 leading-6 peer @error('username') border-red-500 @enderror"
                                        required>
                                </div>
                            </label>
                        </div>
                        <div class="col-span-3">
                            <label for="name" class="block font-medium leading-6 text-gray-900">
                                Nama
                                <div class="mt-2">
                                    <input type="text" name="name" id="name"
                                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600 leading-6 peer @error('name') border-red-500 @enderror">
                                </div>
                            </label>
                        </div>
                        <div class="col-span-3">
                            <label for="password" class="block font-medium leading-6 text-gray-900">Password
                                Baru</label>
                            <div class="mt-2">
                                <input type="text" name="password" id="password"
                                    class="block px-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lime-600  leading-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2 flex items-center justify-end gap-x-6">
                <a href="/dashboard/santri"
                    class="mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-red-600 px-5 py-2 font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 text-sm leading-6">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="-ml-0.5 mr-1.5 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    class="text-sm leading-6 text-white mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-blue-600 px-3 py-2 font-semibold shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="-ml-0.5 mr-1.5 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Reset Password
                </button>
            </div>
        </form>
    @endif --}}

    </table>
    @if (Request::path() == 'dashboard/register')
        <div class=" my-10 relative overflow-x-auto shadow-md rounded-lg">
            <table class=" w-full text-center">
                <thead class="uppercase bg-blue-600 dark:bg-blue-700 text-white">
                    <tr>
                        <th class=" px-3 py-3">Nama</th>
                        <th class=" px-3 py-3">NIS</th>
                        <th class=" px-3 py-3">Aksi</th>
                    </tr>
                <tbody>
                    @forelse ($admins as $admins)
                        <tr>
                            <td class=" py-3 px-3 "> {{ $admins->name }} </td>
                            <td class=" py-3 px-3 bg-gray-50 dark:bg-gray-200"> {{ $admins->username }}
                            </td>
                            <td class=" py-3 px-3 flex items-center justify-center">
                                <a href="/dashboard/reset-password/{{ $admins->username }}"
                                    class="text-white bg-yellow-600 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">Edit</a>
                                <div>
                                    <form action="/dashboard/reset-password/{{ $admins->username }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <p>Tidak ada admin.</p>
                    @endforelse
                </tbody>
                </thead>
            </table>
        </div>
    @endif
</x-layoutDB>
