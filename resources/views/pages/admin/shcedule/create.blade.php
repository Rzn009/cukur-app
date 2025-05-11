<x-admin.layout>

    @section('title', 'Dashboard Jadwal')

    @section('content')
        <div class="container">
            <h2>
            @section('content title', 'Atur Jadwal')
        </h2>

        <form action="{{ route('schedule.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Barber</label>
                <select name="barber_id" class="form-control" required>
                    <option value="">Pilih Barber</option>
                    @foreach($barbers as $barber)
                        <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Hari</label>
                <select name="day" class="form-control" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="end_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>

    </div>
@endsection

</x-admin.layout>
