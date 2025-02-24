<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceSchedule;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
// Controller Peserta (AttendanceController)

    public function index()
    {
        $user = auth()->user();
        
        // Ambil daftar jadwal kehadiran yang sesuai dengan 'date_of_join' pengguna
        $attendanceSchedules = AttendanceSchedule::where('date_of_join', $user->date_of_join)
            ->with(['trainingStage'])
            ->get();
        
        // Waktu sekarang di zona Asia/Jakarta
        $currentDateTime = now('Asia/Jakarta');
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');
        
        // Tandai apakah kehadiran terkunci untuk setiap jadwal
        foreach ($attendanceSchedules as $schedule) {
            // Jika attendance_date dan start_time sudah diparse menggunakan Carbon
            $attendanceDate = $schedule->attendance_date; // sudah Carbon
            $attendanceStart = $attendanceDate->copy()->setTimeFromTimeString($schedule->start_time); // Set waktu berdasarkan start_time
            $attendanceEnd = $attendanceDate->copy()->setTimeFromTimeString($schedule->end_time); // Set waktu berdasarkan end_time
            
            // Cek apakah tanggal saat ini sama dengan attendance_date dan apakah waktu berada di antara start_time dan end_time
            if ($currentDate === $attendanceDate->format('Y-m-d') && $currentTime >= $attendanceStart->format('H:i:s') && $currentTime <= $attendanceEnd->format('H:i:s')) {
                $schedule->locked = false;
            } else {
                $schedule->locked = true;
            }
        }
        
        return view('pages.student.attendance.index', compact('attendanceSchedules'));
    }


    public function store(Request $request)
    {
        // Validasi input yang diterima
        $validated = $request->validate([
            'attendance_schedule_id' => 'required|exists:attendance_schedules,id',
            'remarks' => 'required|string',
        ]);

        // Ambil waktu server saat ini (timezone Indonesia)
        $attendanceDate = now('Asia/Jakarta')->format('Y-m-d');
        $startTime = now('Asia/Jakarta')->format('H:i:s');
        $endTime = now('Asia/Jakarta')->format('H:i:s');

        // Ambil data AttendanceSchedule berdasarkan attendance_schedule_id
        $attendanceSchedule = AttendanceSchedule::find($validated['attendance_schedule_id']);

        // Pastikan AttendanceSchedule ditemukan sebelum melanjutkan
        if (!$attendanceSchedule) {
            return redirect()->back()->withErrors(['error' => 'Attendance schedule not found.']);
        }

        // Jika validasi berhasil, coba simpan attendance
        try {
            $attendance = Attendance::create([
                'user_id' => auth()->user()->id,
                'attendance_schedule_id' => $validated['attendance_schedule_id'],
                'attendance_date' => $attendanceDate,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'remarks' => $validated['remarks'],
            ]);

            // Jika berhasil disimpan, kembalikan dengan pesan sukses
            return redirect()->route('student.attendance.index')->with('success', 'Attendance recorded successfully!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Failed to save attendance: ' . $e->getMessage()]);
        }
    }
}
