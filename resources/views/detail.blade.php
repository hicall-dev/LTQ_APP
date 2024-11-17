<x-layoutDB>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class=" my-9 mx-auto flex justify-between">
        <h1 class=" mb-1 text-5xl tracking-tight font-bold text-gray-900">{{ $judul }}</h1>
    </div>
    <form>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-6">
                    <div class="col-span-3">
                        <label for="full-name" class="block font-medium leading-6 text-gray-900">Nama Lengkap</label>
                        <div class="mt-2">
                            <input type="text" name="full-name" id="full-name" readonly
                                value="{{ isset($santri) ? $santri->nama : '' }}"
                                class="block px-3 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6">
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label for="nis" class="block  font-medium leading-6 text-gray-900">NIS</label>
                        <div class="mt-2">
                            <input type="number" name="nis" id="nis" readonly
                                value="{{ isset($santri) ? $santri->nis : '' }}"
                                class="block w-full  px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6">
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label for="kelas" class="block  font-medium leading-6 text-gray-900">Kelas</label>
                        <div class="mt-2">
                            <input type="text" name="kelas" id="kelas" readonly
                                value="{{ isset($santri) ? $santri->kelas : '' }}"
                                class="block w-full  px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6">
                        </div>
                    </div>
                    <div class="col-span-3">
                        <label for="spp" class="block  font-medium leading-6 text-gray-900">Status SPP</label>
                        <div class="mt-2">
                            <input type="text" name="spp" id="spp" readonly
                                value="{{ isset($santri->status_spp) && $santri->status_spp == 1 ? 'Lunas' : 'Belum Lunas' }}"
                                class="block w-full  px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6">
                        </div>
                    </div>
                    <div class="col-span-3">
                        <label for="up" class="block  font-medium leading-6 text-gray-900">Updated At</label>
                        <div class="mt-2">
                            <input type="text" name="up" id="up" readonly
                                value="{{ isset($santri) ? $santri->updated_at : '' }}"
                                class="block w-full  px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6">
                        </div>
                    </div>
                    <div class="col-span-3">
                        <label for="op" class="block  font-medium leading-6 text-gray-900">Operator</label>
                        <div class="mt-2">
                            <input type="text" name="op" id="op" readonly
                                value="{{ isset($user) ? $user->name : '' }}"
                                class="block w-full  px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  leading-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 flex items-center justify-end gap-x-6">
            <a href="/dashboard/santri"
                class=" mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-blue-600 px-3 py-2  font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="-ml-0.5 mr-1.5 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
            <a href="/dashboard/santri/{{ $santri->nis }}/edit"
                class=" mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-blue-600 px-3 py-2  font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                Edit
            </a>
        </div>
    </form>
</x-layoutDB>
<x-footerdb></x-footerdb>
