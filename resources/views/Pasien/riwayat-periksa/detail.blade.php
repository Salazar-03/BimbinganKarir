<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Riwayat Periksa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            Detail Riwayat Pemeriksaan
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Informasi lengkap mengenai jadwal pemeriksaan Anda.
                        </p>
                    </header>

                    <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                        <div class="p-4">
                            <div class="row g-4">
                                <div class="col-md-8">
                                    <div class="list-group">
                                        <div class="px-4 py-3 mb-2 border-0 rounded list-group-item bg-light">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-gray-700">Poliklinik</span>
                                                <span class="font-medium">{{ $janjiPeriksa ->jadwalPeriksa->dokter->id_poli }}</span>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 mb-2 border-0 rounded list-group-item bg-light">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-gray-700">Nama Dokter</span>
                                                <span class="font-medium">{{ $janjiPeriksa ->jadwalPeriksa->dokter->nama }}</span>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 mb-2 border-0 rounded list-group-item bg-light">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-gray-700">Hari Pemeriksaan</span>
                                                <span class="font-medium">{{ $janjiPeriksa ->jadwalPeriksa->hari }}</span>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 mb-2 border-0 rounded list-group-item bg-light">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-gray-700">Jam Mulai</span>
                                                <span class="font-medium">{{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_mulai)->format('H.i') }}</span>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 mb-2 border-0 rounded list-group-item bg-light">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-gray-700">Jam Selesai</span>
                                                <span class="font-medium">{{ \Carbon\Carbon::parse($janjiPeriksa->jadwalPeriksa->jam_selesai)->format('H.i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-4 rounded bg-light h-100 d-flex flex-column align-items-center justify-content-center">
                                        <h5 class="mb-3 text-gray-700">Nomor Antrian Anda</h5>
                                        <div class="text-white rounded-lg bg-primary d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                            <span class="font-bold" style="font-size: 2.5rem;">{{ $janjiPeriksa->no_antrian }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                       <a href="{{ route('pasien.riwayat-periksa.index') }}" 
   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-black bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>