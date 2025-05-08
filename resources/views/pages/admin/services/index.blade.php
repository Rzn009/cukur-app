<x-admin.layout>

    @section('title', 'Dashboard Barber')

    @section('content')

        <div class="container">
            <div class="container">
            <h2> @section('content title', 'Daftar Layanan')</h2>
            <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Tambah Layanan</a>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>Rp{{ number_format($service->price) }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus layanan ini?')"
                                    class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

@endsection

</x-admin.layout>
