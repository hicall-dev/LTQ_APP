<x-layoutDB>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="bg-white p-6 rounded shadow-md w-full">
        <h2 class="text-xl font-semibold mb-4">Upload Gambar</h2>

        @if (session('success'))
            <div class="mb-4 p-3 text-green-800 bg-green-100 rounded">
                {{ session('success') }}
                {{-- @if (session('image'))
                    <img src="{{ asset('img/' . session('image')) }}" alt="Uploaded Image" class="mt-2 w-full rounded">
                @endif --}}
            </div>
        @endif

        {{-- @if (asset('img/popup.jpg'))
            <img src="{{ asset('img/popup.jpg') }}" alt="Current Promo" class="mb-4 w-1/2 rounded">
        @endif --}}

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium">Pilih sebuah gambar:</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full" accept="image/*"
                    onchange="previewImage(event)">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                Upload
            </button>
            <div id="preview-container" class="mb-4">
                <p class="text-gray-600">Preview:</p>
                <div class="flex justify-center">
                    <img id="image-preview" class="hidden max-h-screen rounded" />
                </div>
            </div>


        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewContainer = document.getElementById('preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }
    </script>

</x-layoutDB>
