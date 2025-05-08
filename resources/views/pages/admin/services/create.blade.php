<x-admin.layout>

    @section('title', 'Dashboard Layanan create')

    @section('content')
        <div class="container">
            <h2>
            @section('content title', 'Create Services')
        </h2>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Layanan</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Duration</label>
                <input name="duration" class="form-control"></input>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>

    </div>
@endsection

</x-admin.layout>
