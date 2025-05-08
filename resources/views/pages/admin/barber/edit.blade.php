<x-admin.layout>

    @section('title', 'Dashboard Barber Edit')

    @section('content')
        <div class="container">
            <h2>
            @section('content title', 'Create Barber')
        </h2>

        <form action="{{ route('barber.update', $barber) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>User</label>
                <select name="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Barber</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $barber->name) }}">
            </div>

            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" class="form-control">{{ old('bio', $barber->bio) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Foto</label>
                <input type="file" name="photo" class="form-control">
                @if ($barber->photo)
                    <img src="{{ asset('storage/' . $barber->photo) }}" width="120" class="mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label>Pengalaman (tahun)</label>
                <input type="number" name="experience_years" class="form-control"
                    value="{{ old('experience_years', $barber->experience_years) }}">
            </div>

            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="speciality" class="form-control"
                    value="{{ old('speciality', $barber->speciality) }}">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="available" class="form-control">
                    <option value="1" {{ $barber->available ? 'selected' : '' }}>Tersedia</option>
                    <option value="0" {{ !$barber->available ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('barber.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

</x-admin.layout>
