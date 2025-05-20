@extends('components.admin.layout')

@section('title', 'Edit Jadwal')

@section('content title', 'Edit Jadwal')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Jadwal</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="barber_id">Barber</label>
                    <select name="barber_id" id="barber_id" class="form-control @error('barber_id') is-invalid @enderror">
                        <option value="">Pilih Barber</option>
                        @foreach($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ old('barber_id', $schedule->barber_id) == $barber->id ? 'selected' : '' }}>
                                {{ $barber->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('barber_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="day">Hari</label>
                    <select name="day" id="day" class="form-control @error('day') is-invalid @enderror">
                        <option value="">Pilih Hari</option>
                        @php
                            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                        @endphp
                        @foreach($days as $day)
                            <option value="{{ $day }}" {{ old('day', $schedule->day) == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                    @error('day')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="start_time">Waktu Mulai</label>
                    <input type="time" name="start_time" id="start_time" 
                           class="form-control @error('start_time') is-invalid @enderror"
                           value="{{ old('start_time', $schedule->start_time) }}">
                    @error('start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_time">Waktu Selesai</label>
                    <input type="time" name="end_time" id="end_time" 
                           class="form-control @error('end_time') is-invalid @enderror"
                           value="{{ old('end_time', $schedule->end_time) }}">
                    @error('end_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
