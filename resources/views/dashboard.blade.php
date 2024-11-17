<x-layoutDB>

    <x-slot:title>{{ $title }}</x-slot:title>

    @if (session()->has('success'))
        <div id="alert-0"
            class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium pl-3">Pemberitahuan</span> {{ session('success') }}
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

    <div class=" my-9 mx-auto flex justify-between" ">
        <h1 class=" mb-1 text-5xl tracking-tight font-bold text-gray-900">{{ $judul }}</h1>
        <div>
            <button data-modal-target="reset-modal" data-modal-toggle="reset-modal" class=" mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-red-500 px-3 py-2  font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="-ml-0.5 mr-1.5 size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d=" M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374
        1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12
        15.75h.007v.008H12v-.008Z" />
    </svg>
    Reset SPP
    </button>

    <a href="/dashboard/santri/create"
        class=" mt-6 mb-1 w-fit inline-flex justify-center items-center rounded-md bg-blue-600 px-3 py-2  font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-ml-0.5 mr-1.5 size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d=" M12 4.5v15m7.5-7.5h-15">
        </svg>
        Tambah Santri
    </a>
    </div>
    </div>

    {{-- PENCARIAN --}}
    <form>
        <div class="my-9 flex ">
            <div
                class=" w-full rounded-md shadow-sm mr-2 ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600">
                <input type="search"id="search" name="search" autocomplete="off"
                    class=" block w-full flex-auto border-0 bg-transparent py-3 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0  leading-6 rounded-md"
                    placeholder="Cari Berdasarkan Nama atau NIS">

            </div>
            <button type="submit"
                class="inline-flex justify-center items-center rounded-md bg-blue-600 px-4  font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" my-3 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>
    </form>
    {{ $santri->links() }}

    {{-- TABEL --}}
    <div class=" relative overflow-x-auto shadow-md rounded-lg">
        <table class=" w-full text-center">
            <thead class="uppercase bg-blue-500 dark:bg-blue-700 text-white">
                <tr>
                    <th class=" px-3 py-3">Nama</th>
                    <th class=" px-3 py-3">NIS</th>
                    <th class=" px-3 py-3">Kelas</th>
                    <th class=" px-3 py-3">SPP</th>
                    <th class=" px-3 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($santri as $santri)
                    <tr>
                        <td class=" py-3 bg-gray-50 dark:bg-gray-200"> {{ $santri->nama }} </td>
                        <td class=" py-3"> {{ $santri->nis }} </td>
                        <td class=" py-3 bg-gray-50 dark:bg-gray-200"> {{ $santri->kelas }} </td>
                        <td class=" py-3">
                            <div
                                class="w-fit inline-flex justify-center items-center rounded-md py-2 px-2 font-semibold text-white shadow-sm {{ $santri->status_spp ? 'bg-green-500 ' : 'bg-red-500 ' }}">
                                {{ $santri->status_spp ? 'Lunas' : 'Belum Lunas' }}
                            </div>
                        </td>
                        <td
                            class=" py-3 bg-gray-50 dark:bg-gray-200 grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-1 sm:gap-1 md:gap-0 lg:gap-0">
                            <div>
                                <a href="/dashboard/santri/{{ $santri->nis }}/edit"
                                    class=" w-4/5 inline-flex justify-center items-center rounded-md bg-blue-600 py-2 px-2 font-semibold text-white shadow-sm focus:ring-blue-200 hover:bg-blue-500 focus-visible:outline-blue-600">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="/dashboard/santri/{{ $santri->nis }}"
                                    class=" w-4/5 inline-flex justify-center items-center rounded-md bg-green-500 py-2 px-2  font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline-green-500">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <button type="button"
                                    class=" w-4/5 inline-flex justify-center items-center rounded-md bg-red-500 py-2 px-2 font-semibold text-white shadow-sm  hover:bg-red-400 focus-visible:outline-red-500"
                                    onclick="openModal('modelDelete')">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
            </tbody>
        @empty
        </table>
        <div class="flex items-center justify-between">
            <div class="px-3 py-3 font-semibold text-xl"> Data Santri Kosong </div>
            <a href="/dashboard/santri"
                class=" w-fit inline-flex justify-center items-center rounded-md bg-blue-600 px-3 py-2 mr-3  font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="-ml-0.5 mr-1.5 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
        </div>
        @endforelse
        </table>
    </div>

    {{-- MODAL --}}
    <div id="modelDelete"
        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
            <div class="flex justify-end p-2">
                <button onclick="closeModal('modelDelete')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24"">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Yakin Untuk Menghapus Data?
                </h3>
                <form action="/dashboard/santri/{{ $santri->nis ?? 'NIS tidak tersedia' }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                        Ya, Saya yakin
                    </button>
                    <a href="#" onclick="closeModal('modelDelete')"
                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-blue-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center"
                        data-modal-toggle="delete-user-modal">
                        Tidak, Batalkan
                    </a>
                </form>
            </div>
        </div>
    </div>

    <div id="reset-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="reset-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-red-600 w-12 h-12 dark:text-red-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin Untuk Melakukan Reset
                        SPP?</h3>
                    <a data-modal-hide="reset-modal" href="/dashboard/reset"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Ya, Saya Yakin
                    </a>
                    <button data-modal-hide="reset-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak,
                        Batalkan</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block'
            //document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            event.preventDefault();
            //document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }

        // Close all modals when press ESC
        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                //document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none'
                })
            }
        };
    </script>

</x-layoutDB>
<x-footerdb></x-footerdb>
