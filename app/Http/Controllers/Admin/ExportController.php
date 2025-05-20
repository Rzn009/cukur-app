<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GenericExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export($module)
    {
        switch ($module) {
            case 'barber':
                $data = \App\Models\Barber::select('id', 'user_id', 'name', 'bio', 'photo', 'experience_years', 'speciality', 'available')->get();
                $headings = ['ID', 'User ID', 'Nama', 'Bio', 'Foto', 'Tahun Pengalaman', 'Spesialisasi', 'Tersedia'];
                break;

            case 'booking':
                $data = \App\Models\Bookings::select('id', 'user_id', 'barber_id', 'booking_date', 'booking_time', 'status', 'note')->get();
                $headings = ['ID', 'User ID', 'Barber ID', 'Tanggal Booking', 'Waktu Booking', 'Status', 'Catatan'];
                break;

            case 'user':
                $data = \App\Models\User::select('id', 'name', 'email', 'phone', 'photo')->get();
                $headings = ['ID', 'Nama', 'Email', 'Telepon', 'Foto'];
                break;

            case 'service':
                $data = \App\Models\Service::select('id', 'name', 'price', 'description', 'duration')->get();
                $headings = ['ID', 'Nama', 'Harga', 'Deskripsi', 'Durasi'];
                break;

            case 'schedule':
                $data = \App\Models\Shcedule::select('id', 'barber_id', 'day', 'start_time', 'end_time')->get();
                $headings = ['ID', 'Barber ID', 'Hari', 'Waktu Mulai', 'Waktu Selesai'];
                break;

            default:
                abort(404, 'Module tidak ditemukan.');
        }

        return Excel::download(new GenericExport($data, $headings), $module . '.xlsx');
    }
}
