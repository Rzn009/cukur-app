<x-admin.layout>

    @section('title', 'Dashboard Barber')

    @section('content')

        <div class="container">
            <div class="container">
            <h2> @section('content title', 'Daftar Barber')</h2>
            @section('export-url', route('admin.admin.export', ['module' => 'barber']))

            @section('export-button')
                <a href="{{ route('admin.admin.export', ['module' => 'barber']) }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Export Barber
                </a>
            @endsection




            <a href="{{ route('admin.barbers.create') }}" class="btn btn-primary mb-3">Tambah Barber</a>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>User</th>
                        <th>Spesialis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barbers as $barber)
                        <tr>
                            <td>{{ $barber->name }}</td>
                            <td>{{ $barber->user->email ?? '-' }}</td>
                            <td>{{ $barber->speciality }}</td>
                            <td>
                                <a href="{{ route('admin.barbers.show', $barber) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('admin.barbers.edit', $barber) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.barbers.destroy', $barber) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

</x-admin.layout>
