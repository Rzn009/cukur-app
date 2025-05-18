<x-admin.layout>
    @section('title', 'Detail User')

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0 fs-4">Detail User</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <p>{{ $user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <p>
                            @foreach($userRoles as $role)
                                <span class="badge bg-primary me-1">{{ ucfirst($role) }}</span>
                            @endforeach
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Dibuat</label>
                        <p>{{ $user->created_at->format('d F Y H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Terakhir Diperbarui</label>
                        <p>{{ $user->updated_at->format('d F Y H:i') }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.userManagment.edit', $user) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('admin.userManagment.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin.layout> 