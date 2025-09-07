<x-layoutDB>
    <x-slot:title>{{ $title }}</x-slot:title>

    <h1 class=" mb-1 text-5xl tracking-tight font-bold text-gray-900">{{ $title }}</h1>

    <div class="mt-10 relative overflow-x-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            @foreach ($results as $result)
                <x-custom.penilaian-ustadz-card :result="$result" />
            @endforeach
        </div>
    </div>
</x-layoutDB>
