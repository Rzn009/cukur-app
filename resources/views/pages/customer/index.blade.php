<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Cukur</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #1a1a1a;
            --accent-color: #FFD700;
            --accent-hover: #FFC107;
            --text-color: #333333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            background-color: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--accent-color) !important;
            font-size: 1.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            border-radius: 5px;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
            background-color: rgba(255, 215, 0, 0.1);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--white);
            padding: 8rem 0 4rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23FFD700' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
        }

        .profile-section {
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--accent-color);
            margin-bottom: 1rem;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .profile-info {
            color: var(--gray-600);
            margin-bottom: 1rem;
        }

        .profile-stats {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--accent-color);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            background: var(--white);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
            background-color: var(--primary-color) !important;
            color: var(--accent-color) !important;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 2px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.15);
        }

        .btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
            transform: translateY(-2px);
        }

        .btn-outline-light:hover {
            transform: translateY(-2px);
            color: var(--accent-color) !important;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table th {
            font-weight: 600;
            background-color: var(--gray-100);
            border-bottom: 2px solid var(--gray-300);
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 8px;
        }

        .badge.bg-info {
            background-color: var(--accent-color) !important;
            color: var(--primary-color);
        }

        .footer {
            background-color: var(--gray-900);
            color: var(--white);
            padding: 4rem 0 2rem;
            margin-top: 4rem;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .footer h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
            color: var(--accent-color);
        }

        .footer h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: var(--accent-color);
        }

        .footer .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .footer .list-unstyled li {
            margin-bottom: 0.75rem;
        }

        .footer .list-unstyled li i {
            color: var(--accent-color);
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: var(--accent-color);
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            border-top: 1px solid var(--gray-200);
            padding: 1.5rem;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }

        /* Animations */
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .fade-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-hover);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-cut me-2"></i>Barber Shop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            <i class="fas fa-calendar-plus me-1"></i>Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jadwal">
                            <i class="fas fa-calendar-alt me-1"></i>Jadwal
                        </a>
                    </li>
                </ul>
            </div>
            @php
                $notifications = Auth::user()->unreadNotifications;
            @endphp

            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    🔔
                    @if ($notifications->count() > 0)
                        <span class="badge bg-danger">{{ $notifications->count() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
                    @forelse ($notifications as $notification)
                        <div class="dropdown-item">
                            {{ $notification->data['message'] }}
                            <br><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST"
                                class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-link text-muted">Tandai sudah
                                    dibaca</button>
                            </form>
                        </div>
                    @empty
                        <span class="dropdown-item text-muted">Tidak ada notifikasi</span>
                    @endforelse
                </div>
            </div>


        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <h1 class="display-4 fw-bold mb-3">Booking Cukur Anda</h1>
                    <p class="lead mb-4">Pilih barber favorit Anda dan atur jadwal cukur sesuai keinginan. Kami siap
                        melayani Anda dengan sepenuh hati.</p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            <i class="fas fa-calendar-plus me-2"></i>Booking Sekarang
                        </button>
                        <a href="#jadwal" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-calendar-alt me-2"></i>Lihat Jadwal
                        </a>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <img src="{{ asset('images/hero-image.jpg') }}" alt="Barber Shop"
                        class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <!-- Profile Section -->
        <div class="profile-section" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    @if (auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile" class="profile-image">
                    @else
                        <img src="data:image/jpeg;base64,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"
                            alt="Default Profile" class="profile-image">
                    @endif
                </div>
                <div class="col-md-6">
                    <h2 class="profile-name">{{ auth()->user()->name }}</h2>
                    <p class="profile-info">
                        <i class="fas fa-envelope me-2"></i>{{ auth()->user()->email }}<br>
                        <i class="fas fa-phone me-2"></i>{{ auth()->user()->phone }}
                    </p>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $totalBookings }}</div>
                            <div class="stat-label">Total Booking</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $completedBookings }}</div>
                            <div class="stat-label">Selesai</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $upcomingBookings }}</div>
                            <div class="stat-label">Mendatang</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-2"></i>Edit Profil
                    </button>
                </div>
            </div>
        </div>

        <!-- Schedule Section -->
        <div id="jadwal" class="card shadow-sm" data-aos="fade-up">
            <div class="card-header text-white py-3">
                <h2 class="h4 mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Jadwal Barber
                </h2>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">Barber</th>
                                <th class="px-3">Hari</th>
                                <th class="px-3">Jam Mulai</th>
                                <th class="px-3">Jam Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $schedule)
                                <tr data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                                    <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            @if ($schedule->barber->photo)
                                                <img src="{{ asset('storage/' . $schedule->barber->photo) }}"
                                                    class="rounded-circle me-3" width="40" height="40"
                                                    alt="{{ $schedule->barber->name }}">
                                            @else
                                                <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <span class="fw-medium d-block">{{ $schedule->barber->name }}</span>
                                                <small class="text-muted">{{ $schedule->barber->speciality }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3">
                                        <span class="badge bg-info px-3 py-2">{{ $schedule->day }}</span>
                                    </td>
                                    <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-clock me-2 text-dark"></i>
                                            <span>{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-clock me-2 text-dark"></i>
                                            <span>{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                            <p class="mb-0 fs-5">Belum ada jadwal yang tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Riwayat Booking Section -->
        <div class="card shadow-sm mt-4" data-aos="fade-up">
            <div class="card-header text-white py-3">
                <h2 class="h4 mb-0">
                    <i class="fas fa-history me-2"></i>Riwayat Booking
                </h2>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">Barber</th>
                                <th class="px-3">Tanggal</th>
                                <th class="px-3">Waktu</th>
                                <th class="px-3">Status</th>
                                <th class="px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                                    <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            @if ($booking->barber->photo)
                                                <img src="{{ asset('storage/' . $booking->barber->photo) }}"
                                                    class="rounded-circle me-3" width="40" height="40"
                                                    alt="{{ $booking->barber->name }}">
                                            @else
                                                <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                            @endif
                                            <span class="fw-medium">{{ $booking->barber->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-calendar me-2 text-primary"></i>
                                            <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-clock me-2 text-primary"></i>
                                            <span>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3">
                                        @php
                                            $statusClass = '';
                                            switch ($booking->status) {
                                                case 'pending':
                                                    $statusClass = 'bg-warning';
                                                    break;
                                                case 'confirmed':
                                                    $statusClass = 'bg-success';
                                                    break;
                                                case 'completed':
                                                    $statusClass = 'bg-info';
                                                    break;
                                                case 'cancelled':
                                                    $statusClass = 'bg-danger';
                                                    break;
                                            }
                                        @endphp
                                        <span
                                            class="badge {{ $statusClass }} px-3 py-2">{{ ucfirst($booking->status) }}</span>
                                    </td>
                                    <td class="px-3">
                                        @if ($booking->status === 'pending')
                                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times me-1"></i>Batalkan
                                                </button>
                                            </form>
                                        @elseif ($booking->status === 'completed' && $booking->review === null)
                                            <form action="{{ route('reviews.store') }}" method="POST"
                                                class="mt-2">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                <input type="hidden" name="barber_id"
                                                    value="{{ $booking->barber->id }}">
                                                <div class="mb-2">
                                                    <label for="rating" class="form-label">Rating:</label>
                                                    <select name="rating" class="form-select form-select-sm"
                                                        required>
                                                        <option value="">Pilih rating</option>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <option value="{{ $i }}">{{ $i }}
                                                                Bintang</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="review" class="form-label">Ulasan:</label>
                                                    <textarea name="review" rows="2" class="form-control form-control-sm" placeholder="Tulis ulasan..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-paper-plane me-1"></i>Kirim
                                                </button>
                                            </form>
                                        @elseif ($booking->review)
                                            <div class="mt-2">
                                                <strong>Rating: {{ $booking->review->rating }}/5</strong><br>
                                                <small>"{{ $booking->review->review }}"</small>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                            <p class="mb-0 fs-5">Belum ada riwayat booking</p>
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

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">
                        <i class="fas fa-calendar-plus me-2"></i>Form Booking
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bookings.store') }}" method="POST" class="row g-4">
                        @csrf

                        <!-- Barber Selection -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user-tie me-2"></i>Pilih Barber
                            </label>
                            <select name="barber_id"
                                class="form-select form-select-lg @error('barber_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Barber --</option>
                                @foreach ($barbers as $barber)
                                    <option value="{{ $barber->id }}"
                                        {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                        {{ $barber->name }} - {{ $barber->speciality }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barber_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date Selection -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar me-2"></i>Tanggal Booking
                            </label>
                            <input type="date" name="booking_date"
                                class="form-control form-control-lg @error('booking_date') is-invalid @enderror"
                                value="{{ old('booking_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Time Selection -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-clock me-2"></i>Waktu Booking
                            </label>
                            <input type="time" name="booking_time"
                                class="form-control form-control-lg @error('booking_time') is-invalid @enderror"
                                value="{{ old('booking_time') }}" required>
                            @error('booking_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jam operasional: 08:00 - 20:00</small>
                        </div>

                        <!-- Service Selection -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-cut me-2"></i>Layanan
                            </label>
                            <select name="service_id"
                                class="form-select form-select-lg @error('service_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Layanan --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} - Rp{{ number_format($service->price) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-comment-alt me-2"></i>Catatan (Opsional)
                            </label>
                            <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                                placeholder="Masukkan catatan atau permintaan khusus">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Pastikan data yang dimasukkan sudah benar. Jadwal booking hanya dapat diubah atau
                                dibatalkan
                                minimal 2 jam sebelum waktu yang dijadwalkan.
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>Buat Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Profil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.profile.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone" class="form-control"
                                value="{{ auth()->user()->phone }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <h5>Barber Shop</h5>
                    <p class="text-muted">Melayani Anda dengan sepenuh hati untuk tampil lebih percaya diri.</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Contoh No. 123</li>
                        <li><i class="fas fa-phone me-2"></i>(021) 1234-5678</li>
                        <li><i class="fas fa-envelope me-2"></i>info@barbershop.com</li>
                    </ul>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <h5>Jam Operasional</h5>
                    <ul class="list-unstyled text-muted">
                        <li>Senin - Jumat: 08:00 - 20:00</li>
                        <li>Sabtu: 09:00 - 20:00</li>
                        <li>Minggu: 10:00 - 18:00</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center text-muted">
                <small>&copy; 2024 Barber Shop. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.querySelector('input[name="booking_date"]');
            const timeInput = document.querySelector('input[name="booking_time"]');

            // Set tanggal minimum hari ini
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const formattedToday = `${yyyy}-${mm}-${dd}`;

            dateInput.setAttribute('min', formattedToday);

            // Validasi waktu dalam jam operasional
            timeInput.addEventListener('change', function() {
                const selectedTime = this.value;
                const hour = parseInt(selectedTime.split(':')[0]);

                if (hour < 8 || hour >= 20) {
                    alert('Mohon pilih waktu antara jam 08:00 - 20:00');
                    this.value = '';
                }
            });

            // Smooth scroll untuk navigasi
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset -
                        navbarHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>

</html>
