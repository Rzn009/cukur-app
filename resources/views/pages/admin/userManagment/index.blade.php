<x-admin.layout>

    @section('title', 'User Management')

    @section('styles')
        <style>
            .user-table {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                overflow: hidden;
            }

            .user-table th {
                background-color: #f8f9fa;
                border-bottom: 2px solid #dee2e6;
            }

            .badge {
                font-size: 0.85em;
                padding: 0.35em 0.65em;
            }

            .badge-admin {
                background-color: #6f42c1;
            }

            .badge-user {
                background-color: #20c997;
            }

            .badge-editor {
                background-color: #fd7e14;
            }

            .actions-column {
                min-width: 160px;
            }

            .status-indicator {
                display: inline-block;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                margin-right: 5px;
            }

            .status-active {
                background-color: #28a745;
            }

            .status-inactive {
                background-color: #dc3545;
            }

            .search-container {
                margin-bottom: 20px;
            }

            .table-responsive {
                border-radius: 8px;
                overflow: hidden;
            }

            .dashboard-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .btn-icon {
                margin-right: 5px;
            }

            .alert-dismissible {
                border-left: 4px solid #28a745;
            }

            .pagination {
                justify-content: center;
                margin-top: 20px;
            }
        </style>
    @endsection

    @section('content')
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fs-4">@yield('content title', 'Daftar User')</h2>
                    @can('user-create')
                        <a href="{{ route('admin.users.create') }}" class="btn btn-light">
                            <i class="fas fa-user-plus"></i> Tambah User
                        </a>
                    @endcan
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-3">#</th>
                                    <th class="px-3">Nama</th>
                                    <th class="px-3">Email</th>
                                    <th class="px-3">Role</th>
                                    <th class="px-3">Status</th>
                                    <th class="px-3">Tanggal Daftar</th>
                                    <th class="px-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $user)
                                    <tr>
                                        <td class="px-3">{{ $index + 1 }}</td>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2">
                                                    <div class="avatar-initial rounded-circle bg-light text-dark">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div>{{ $user->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-3">{{ $user->email }}</td>
                                        <td class="px-3">
                                            @foreach ($user->getRoleNames() as $role)
                                                <span
                                                    class="badge bg-{{ strtolower($role) == 'admin' ? 'primary' : (strtolower($role) == 'user' ? 'success' : 'warning') }} px-3 py-2">{{ $role }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="status-indicator {{ isset($user->active) && $user->active ? 'status-active' : 'status-inactive' }}"></span>
                                                {{ isset($user->active) && $user->active ? 'Active' : 'Inactive' }}
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <i class="far fa-calendar me-2 text-primary"></i>
                                                <span>{{ $user->created_at->format('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3">
                                            <div class="btn-group" role="group">
                                                @can('user-edit')
                                                    <a href="{{ route('admin.users.edit', $user) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                @endcan
                                                @can('user-delete')
                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-users fa-3x mb-3"></i>
                                                <p class="mb-0 fs-5">Belum ada user yang terdaftar</p>
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

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus user <strong id="userName"></strong>?</p>
                        <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form id="confirmDeleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Setup delete confirmation
                const deleteButtons = document.querySelectorAll('.delete-btn');
                const deleteModal = document.getElementById('deleteModal');
                const userName = document.getElementById('userName');
                const confirmDeleteForm = document.getElementById('confirmDeleteForm');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const userId = this.getAttribute('data-id');
                        const userNameText = this.getAttribute('data-name');

                        userName.textContent = userNameText;
                        confirmDeleteForm.action = `/users/${userId}`;

                        const modal = new bootstrap.Modal(deleteModal);
                        modal.show();
                    });
                });
            });
        </script>
    @endsection

</x-admin.layout>
