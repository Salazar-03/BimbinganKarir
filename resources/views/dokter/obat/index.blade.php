<!-- resources/views/obat/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{route('dokter.obat.create')}}" class="btn btn-primary">Tambah Obat</a>
                            <a href="{{ route('dokter.obat.trash') }}" class="btn btn-danger">Lihat Obat Terhapus</a>


                            @if (session('status') === 'obat-created')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Created.') }}</p>
                            @endif
                        </div>

                    </header>

                    <table class="table mt-6 overflow-hidden rounded table-hover w-full">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-start">No</th>
                                <th scope="col" class="text-start">Nama Obat</th>
                                <th scope="col" class="text-start">Kemasan</th>
                                <th scope="col" class="text-start">Harga</th>
                                <th scope="col" class="text-start">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $obat)
                            <tr>
                                <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                <td class="align-middle text-start">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                <td class="align-middle text-start flex gap-2">
                                    <a href="{{ route('dokter.obat.edit', $obat->id) }}" class="btn btn-secondary btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus obat ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Data obat kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('
            success ') }}',
            confirmButtonColor: '#3085d6',
        });
    </script>
    @endif

    {{-- Notifikasi Error Validasi --}}
    @if ($errors->any())
    @php
    $errorMessages = implode(' ', $errors->all());
    @endphp
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            html: {!! nl2br(e($errorMessages)) !!},
            confirmButtonColor: '#d33',
        });
    </script>
    @endif
</x-app-layout> 