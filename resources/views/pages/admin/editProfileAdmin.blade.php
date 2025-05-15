<x-admin.layout>

    @section('title', 'Edit Profile')

    @section('content')
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Edit Profil Admin</h4>
                        </div>

                        <div class="card-body bg-white p-4">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row mb-4">
                                    <div class="col-md-4 text-center mb-4 mb-md-0">
                                        <div class="position-relative mx-auto" style="width: 150px;">
                                            @if ($admin->photo)
                                                <img src="{{ asset('storage/' . $admin->photo) }}" alt="Foto Profil"
                                                    class="img-thumbnail rounded-circle img-fluid"
                                                    style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 150px; height: 150px;">
                                                    <i class="fas fa-user fa-4x text-secondary"></i>
                                                </div>
                                            @endif

                                            <label for="photo-upload"
                                                class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 cursor-pointer"
                                                style="cursor: pointer;">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                        </div>

                                        <input id="photo-upload" type="file" name="photo" class="d-none">
                                        <small class="d-block text-muted mt-2">Klik ikon kamera untuk mengubah foto</small>

                                        @error('photo')
                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Nama</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-primary text-white"><i
                                                            class="fas fa-user"></i></span>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $admin->name) }}">
                                                </div>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-primary text-white"><i
                                                            class="fas fa-envelope"></i></span>
                                                    <input type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', $admin->email) }}">
                                                </div>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">No. Telepon</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white"><i
                                                        class="fas fa-phone"></i></span>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', $admin->phone) }}">
                                            </div>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h5 class="text-primary mb-3"><i class="fas fa-lock me-2"></i>Ubah Password</h5>
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Password Baru</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white"><i
                                                    class="fas fa-key"></i></span>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Kosongkan jika tidak diganti">
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white"><i
                                                    class="fas fa-check-double"></i></span>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi password baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            // Preview image before upload
            document.getElementById('photo-upload').addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.querySelector('.rounded-circle.img-thumbnail') ||
                            document.querySelector('.bg-light.rounded-circle');

                        if (preview.tagName === 'IMG') {
                            preview.src = e.target.result;
                        } else {
                            // Create new image if there wasn't one
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('img-thumbnail', 'rounded-circle', 'img-fluid');
                            img.style.width = '150px';
                            img.style.height = '150px';
                            img.style.objectFit = 'cover';
                            preview.parentNode.replaceChild(img, preview);
                        }
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        </script>
    @endpush
</x-admin.layout>
