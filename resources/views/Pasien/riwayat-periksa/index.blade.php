<x-app-layout>
    {{-- Header halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Riwayat Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                {{-- Judul --}}
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Riwayat Janji Periksa</h3>
                </div>

                {{-- Menampilkan flash message sukses --}}
                @if (session('success'))
                    <div class="relative p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded">
                        {{ session('success') }}
                        <button type="button" onclick="this.parentElement.remove();"
                                class="absolute top-2 right-2 text-green-800 hover:text-green-900">
                            &times;
                        </button>
                    </div>
                @endif

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200 table-auto">
                        <thead class="text-xs text-black uppercase bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Poliklinik</th>
                                <th class="px-4 py-3">Dokter</th>
                                <th class="px-4 py-3">Hari</th>
                                <th class="px-4 py-3">Mulai</th>
                                <th class="px-4 py-3">Selesai</th>
                                <th class="px-4 py-3">Antrian</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($janjiPeriksas as $index => $janjiPeriksa)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $janjiPeriksa->jadwalPeriksa->dokter->poli->nama }}</td>
                                    <td class="px-4 py-2">{{ $janjiPeriksa->jadwalPeriksa->dokter->nama }}</td>
                                    <td class="px-4 py-2">{{ $janjiPeriksa->jadwalPeriksa->hari }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_mulai)->format('H.i') }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_selesai)->format('H.i') }}</td>
                                    <td class="px-4 py-2">{{ $janjiPeriksa->no_antrian }}</td>
                                    <td class="px-4 py-2">
                                        @if (is_null($janjiPeriksa->periksa))
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded">Belum Diperiksa</span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded">Sudah Diperiksa</span>
                                        @endif
                                    </td>
                     <td class="px-4 py-2">
                        <div class="inline-block rounded-md shadow-sm bg-white p-1">
                            @if (is_null($janjiPeriksa->periksa))
                                <a href="{{ route('pasien.riwayat-periksa.detail', $janjiPeriksa->id) }}"
                                class="inline-block px-3 py-1 text-xs font-medium text-black btn btn-warning btn-sm">
                                    Detail
                                </a>
                            @else
                                <a href="{{ route('pasien.riwayat-periksa.riwayat', $janjiPeriksa->id) }}"
                                class="inline-block px-3 py-1 text-xs font-medium text-black btn btn-success btn-sm">
                                    Riwayat
                                </a>
                            @endif
                        </div>
                     </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-4 text-center text-gray-500">Tidak ada riwayat periksa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>