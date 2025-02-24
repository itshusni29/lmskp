<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceSchedule;
use App\Models\TrainingStage;
use App\Models\User;

use Illuminate\Http\Request;

class AttendanceScheduleController extends Controller
{
    // Display form to create attendance schedule
    public function create()
    {
        $trainingStages = TrainingStage::all();  // Fetch all training stages
        return view('pages.admin.attendanceSchedules.create', compact('trainingStages'));
    }

    // Store a new attendance schedule
    public function store(Request $request)
    {
        $request->validate([
            'training_stage_id' => 'required|exists:training_stages,id',
            'attendance_date' => 'required|date',
            'date_of_join' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        
        // Menggunakan waktu zona Asia/Jakarta saat menyimpan jadwal
        $attendanceDate = \Carbon\Carbon::parse($request->attendance_date)->timezone('Asia/Jakarta');
        $startTime = \Carbon\Carbon::parse($request->start_time)->timezone('Asia/Jakarta')->format('H:i');
        $endTime = \Carbon\Carbon::parse($request->end_time)->timezone('Asia/Jakarta')->format('H:i');
        
        // Simpan jadwal ke database
        AttendanceSchedule::create([
            'training_stage_id' => $request->training_stage_id,
            'attendance_date' => $attendanceDate, // Pastikan tanggal sesuai dengan zona waktu Indonesia
            'start_time' => $startTime,
            'end_time' => $endTime,
            'date_of_join' => $request->date_of_join,
        ]);
    
        return redirect()->route('attendanceSchedules.index')->with('success', 'Attendance schedule created successfully');
    }
    

    // Display all attendance schedules
    public function index()
    {
        $attendanceSchedules = AttendanceSchedule::all();
        return view('pages.admin.attendanceSchedules.index', compact('attendanceSchedules'));
    }

    public function show(Request $request, $id)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($id);
    
        // Ambil daftar user yang terkait dengan attendance schedule
        $users = User::query()
            ->when($request->date_of_join, function ($query, $dateOfJoin) {
                return $query->where('date_of_join', $dateOfJoin);
            })
            ->with(['attendances' => function ($query) use ($attendanceSchedule, $request) {
                $query->where('attendance_schedule_id', $attendanceSchedule->id);
    
                if ($request->attendance_date) {
                    $query->whereDate('attendance_date', $request->attendance_date);
                }
            }])
            ->get();
    
        // Ambil daftar tanggal date_of_join unik untuk filter
        $datesOfJoin = User::select('date_of_join')->distinct()->pluck('date_of_join');
    
        return view('pages.admin.attendanceSchedules.show', [
            'attendanceSchedule' => $attendanceSchedule,
            'users' => $users,
            'datesOfJoin' => $datesOfJoin,
        ]);
    }
    
    
    
    public function edit($id)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($id);  // Fetch attendance schedule by ID
        $trainingStages = TrainingStage::all();  // Fetch all training stages for the edit form
        return view('pages.admin.attendanceSchedules.edit', compact('attendanceSchedule', 'trainingStages'));
    }

    // Update a specific attendance schedule
    public function update(Request $request, $id)
    {
        $request->validate([
            'training_stage_id' => 'required|exists:training_stages,id',
            'attendance_date' => 'required|date',
            'date_of_join' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $attendanceSchedule = AttendanceSchedule::findOrFail($id);
        $attendanceSchedule->update([
            'training_stage_id' => $request->training_stage_id,
            'attendance_date' => $request->attendance_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'date_of_join' => $request->date_of_join,
        ]);

        return redirect()->route('attendanceSchedules.index')->with('success', 'Attendance schedule updated successfully');
    }

    // Delete a specific attendance schedule
    public function destroy($id)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($id);
        $attendanceSchedule->delete();

        return redirect()->route('attendanceSchedules.index')->with('success', 'Attendance schedule deleted successfully');
    }
}
