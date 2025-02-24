<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TrainingModule;
use App\Models\TrainingClass;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Total pengguna dalam sistem
        $totalUsers = User::count();

        // Total pengguna baru dalam 30 hari terakhir
        $newUsersCount = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Total modul dalam sistem
        $totalModules = TrainingModule::count();

        // Total kelas dalam sistem
        $totalClasses = TrainingClass::count();

        // Total modul baru dalam 30 hari terakhir
        $newModulesCount = TrainingModule::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Total kelas baru dalam 30 hari terakhir
        $newClassesCount = TrainingClass::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Pertumbuhan pengguna dibandingkan bulan sebelumnya
        $previousMonthUsers = User::whereBetween('created_at', [
            Carbon::now()->subMonths(2)->startOfMonth(),
            Carbon::now()->subMonths(1)->endOfMonth()
        ])->count();

        $currentMonthUsers = User::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $userGrowthPercentage = $previousMonthUsers > 0 
            ? round((($currentMonthUsers - $previousMonthUsers) / $previousMonthUsers) * 100, 2)
            : 0;

        // Pertumbuhan modul dibandingkan bulan sebelumnya
        $previousMonthModules = TrainingModule::whereBetween('created_at', [
            Carbon::now()->subMonths(2)->startOfMonth(),
            Carbon::now()->subMonths(1)->endOfMonth()
        ])->count();

        $currentMonthModules = TrainingModule::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $moduleGrowthPercentage = $previousMonthModules > 0 
            ? round((($currentMonthModules - $previousMonthModules) / $previousMonthModules) * 100, 2)
            : 0;

        // Pertumbuhan kelas dibandingkan bulan sebelumnya
        $previousMonthClasses = TrainingClass::whereBetween('created_at', [
            Carbon::now()->subMonths(2)->startOfMonth(),
            Carbon::now()->subMonths(1)->endOfMonth()
        ])->count();

        $currentMonthClasses = TrainingClass::whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $classGrowthPercentage = $previousMonthClasses > 0 
        ? round((($currentMonthClasses - $previousMonthClasses) / $previousMonthClasses) * 100, 2)
        : 0;
        
        // User Growth Data (12 bulan terakhir)
        $userGrowthData = [];
        $userGrowthMonths = [];
        for ($i = 0; $i < 12; $i++) {
            $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
            $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();
            $userGrowthData[] = User::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $userGrowthMonths[] = $monthStart->format('F Y');
        }

        // User LTC Data
        $ltcCategories = ['aluminium', 'steel', 'common'];
        $ltcCounts = [
            User::where('ltc', 'aluminium')->count(),
            User::where('ltc', 'steel')->count(),
            User::where('ltc', 'common')->count()
        ];

        // Data untuk Total Users setiap tanggal
        $totalUsersData = [];
        $totalUsersDates = [];
        $users = User::all();
        foreach ($users as $user) {
            $date = $user->created_at->format('Y-m-d');
            if (!isset($totalUsersData[$date])) {
                $totalUsersData[$date] = 0;
            }
            $totalUsersData[$date]++;
        }

        // Data untuk Total Modules setiap tanggal
        $totalModulesData = [];
        $totalModulesDates = [];
        $modules = TrainingModule::all();
        foreach ($modules as $module) {
            $date = $module->created_at->format('Y-m-d');
            if (!isset($totalModulesData[$date])) {
                $totalModulesData[$date] = 0;
            }
            $totalModulesData[$date]++;
        }

        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'newUsersCount' => $newUsersCount,
            'userGrowthPercentage' => $userGrowthPercentage,
            'totalModules' => $totalModules,
            'newModulesCount' => $newModulesCount,
            'moduleGrowthPercentage' => $moduleGrowthPercentage,
            'totalClasses' => $totalClasses,
            'newClassesCount' => $newClassesCount,
            'classGrowthPercentage' => $classGrowthPercentage,
            'userGrowthData' => json_encode($userGrowthData),
            'userGrowthMonths' => json_encode($userGrowthMonths),
            'ltcCounts' => json_encode($ltcCounts),
            'ltcCategories' => json_encode($ltcCategories),
            'totalUsersDates' => json_encode(array_keys($totalUsersData)),
            'totalUsersData' => json_encode(array_values($totalUsersData)),
            'totalModulesDates' => json_encode(array_keys($totalModulesData)),
            'totalModulesData' => json_encode(array_values($totalModulesData)),
        ]);
    }
}
