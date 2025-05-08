<x-admin.layout>
    @section('title', 'Detail Barber')

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">@yield('content title', 'Detail Barber')</h2>
                    <a href="{{ route('barber.index') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Image Column -->
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            @if ($barber->photo)
                                <img src="{{ asset('storage/' . $barber->photo) }}" 
                                     class="img-fluid rounded shadow-sm mb-3" 
                                     style="max-height: 300px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 250px; width: 100%;">
                                    <i class="bi bi-person-fill" style="font-size: 5rem; color: #ccc;"></i>
                                </div>
                            @endif
                            
                            <div class="mt-3">
                                <span class="badge {{ $barber->available ? 'bg-success' : 'bg-danger' }} p-2">
                                    {{ $barber->available ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Barber Details Column -->
                        <div class="col-md-8">
                            <h3 class="mb-3 border-bottom pb-2">{{ $barber->name }}</h3>
                            
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold text-muted">Email</div>
                                <div class="col-md-9">{{ $barber->user->email ?? '-' }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold text-muted">Pengalaman</div>
                                <div class="col-md-9">
                                    <span class="badge bg-info text-dark">{{ $barber->experience_years }} tahun</span>
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-3 fw-bold text-muted">Spesialisasi</div>
                                <div class="col-md-9">{{ $barber->speciality }}</div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-3 fw-bold text-muted">Bio</div>
                                <div class="col-md-9">
                                    <p class="text-muted">{{ $barber->bio ?: 'Tidak ada bio tersedia.' }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('barber.edit', $barber->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus barber <strong>{{ $barber->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('barber.destroy', $barber->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin.layout>