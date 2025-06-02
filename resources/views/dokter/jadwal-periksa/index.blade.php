<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal Periksa') }}
                        </h2>

                        <div class="flex-col items-center justify-center text-center">
                            <a type="button" class="btn btn-primary" href="{{ route('dokter.jadwal-periksa.create') }}">Tambah Jadwal Periksa</a>
                        </div>
                    </header>

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalPeriksas as $index => $jadwalPeriksa)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $index + 1 }}</th>
                                <td class="align-middle text-start">{{ $jadwalPeriksa->hari }}</td>
                                <td class="align-middle text-start">{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H.i') }}</td>
                                <td class="align-middle text-start">{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H.i') }}</td>
                                <td class="align-middle text-start">
                                    @if ($jadwalPeriksa->status)
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">NonAktif</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
    @if ($jadwalPeriksa->status)
        <!-- Jika jadwal aktif, tampilkan tombol Nonaktifkan -->
        <form action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" name="status" value="nonaktif" class="btn btn-warning btn-sm">Nonaktifkan</button>
        </form>
    @else
        <!-- Jika jadwal nonaktif, tampilkan tombol Aktifkan -->
        <form action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" name="status" value="aktif" class="btn btn-success btn-sm">Aktifkan</button>
        </form>
    @endif

    <!-- Form hapus -->
    <form action="{{ route('dokter.jadwal-periksa.destroy', $jadwalPeriksa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
    </form>
</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    {{-- SweetAlert Notification --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif

    @if (session('danger'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('danger') }}',
                confirmButtonColor: '#d33',
            });
        </script>
    @endif
</x-app-layout>
