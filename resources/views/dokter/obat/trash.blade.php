<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat Terhapus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat Terhapus') }}
                        </h2>

                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.obat.index') }}" class="btn btn-success">Kembali</a>
                            @if (session('status') === 'obat-restored')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600">{{ __('Obat berhasil dipulihkan.') }}</p>
                            @endif
                        </div>
                    </header>

                    @if ($obats->isEmpty())
                        <div class="mt-4 text-center text-gray-500">
                            Tidak ada data obat yang terhapus.
                        </div>
                    @else
                        <table class="table mt-6 overflow-hidden rounded table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Kemasan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obats as $obat)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                        <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                        <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                        <td class="align-middle text-start">
                                            {{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="flex items-center gap-3">
                                            {{-- Button Restore --}}
                                            <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning btn-sm">Restore</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
