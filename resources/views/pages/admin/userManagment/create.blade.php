<x-admin.layout>

    @section('title', 'Dashboard User Management')

    @section('content')
        <div class="container">
            <h2>Tambah User</h2>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="roles">Role</label>
                    <select name="roles[]" id="roles" class="form-control" multiple required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ isset($userRoles) && in_array($role->name, $userRoles) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>

    @endsection

</x-admin.layout>
