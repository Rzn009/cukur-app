<x-admin.layout>

    @section('title', 'Dashboard Jadwal')

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">@yield('content title', 'Daftar Jadwal')</h2>
                    <a href="{{ route('schedule.create') }}" class="btn btn-light">
                        <i class="fas fa-plus"></i> Atur Jadwal Baru
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Barber</th>
                                    <th>Hari</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($schedules as $schedule)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($schedule->barber->photo)
                                                    <img src="{{ asset('storage/' . $schedule->barber->photo) }}" 
                                                         class="rounded-circle me-2" 
                                                         width="32" height="32" 
                                                         alt="{{ $schedule->barber->name }}">
                                                @else
                                                    <div class="rounded-circle bg-secondary me-2 d-flex align-items-center justify-content-center" 
                                                         style="width: 32px; height: 32px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                <span>{{ $schedule->barber->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $schedule->day }}</span>
                                        </td>
                                        <td>
                                            <i class="far fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        </td>
                                        <td>
                                            <i class="far fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('schedule.edit', $schedule) }}" 
                                                   class="btn btn-warning btn-sm" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('schedule.destroy', $schedule) }}" 
                                                      method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-times fa-2x mb-3"></i>
                                                <p class="mb-0">Belum ada jadwal yang diatur</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</x-admin.layout>
