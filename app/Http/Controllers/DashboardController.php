<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\DB; //raw query (SQL)
use App\Models\CounterModel; //model
use App\Models\FoodModel;
use App\Models\PetModel;
use App\Models\StaffModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; 
use function PHPUnit\Framework\returnSelf;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        
        try {
            // sumPrice tbl_food
            $sumPrice = FoodModel::sum('food_price');

            // count tbl_user
            $countAdmin = UserModel::whereRaw('LOWER(TRIM(user_role)) = ?', ['staff'])->count();

            // count tbl_user
            $countMember = UserModel::whereIn('user_role', ['member','vip'])->count();

            // count tbl_food
            $countProduct = FoodModel::count();

            // count tbl_pet
            $countPet = PetModel::count();

            // count view
            $countView = CounterModel::count();

            // จำนวนผู้เข้าชมเว็ปไซต์แยกตามเดือน
            $monthlyVisits = DB::table('tbl_counter')
            ->selectRaw('DATE_FORMAT(c_date, "%m-%Y") as ym, COUNT(*) as total')
            ->groupBy('ym')
            ->orderByRaw('DATE_FORMAT(c_date, "%Y-%m") DESC')
            ->limit(12) // จำกัดแค่ 12 เดือนล่าสุด
            ->get();

            // แปลงเป็น array สำหรับ Chart.js
            $monthlyLabels = $monthlyVisits->pluck('ym');
            $monthlyData   = $monthlyVisits->pluck('total');

            // Start status viewer
            $statusVisits = DB::table('tbl_user')
                ->selectRaw("LOWER(COALESCE(NULLIF(TRIM(user_role), ''), 'unknown')) AS role_norm, COUNT(*) AS total")
                ->groupBy('role_norm')
                ->pluck('total','role_norm')
                ->toArray();

            $statusLabels = array_map('ucfirst', array_keys($statusVisits));
            $statusData   = array_values($statusVisits);
            // End status customer

            // Start weeklyVisits
            $weeklyVisits = DB::table('tbl_counter')
                ->selectRaw('DAYOFWEEK(c_date) as day_of_week, COUNT(*) as total')
                ->whereBetween('c_date', [now()->startOfWeek(), now()->endOfWeek()])
                ->groupBy('day_of_week')
                ->orderBy('day_of_week')
                ->get();

            // map วันอาทิตย์-เสาร์
            $daysMap = [
                1 => 'Sunday',
                2 => 'Monday',
                3 => 'Tuesday',
                4 => 'Wednesday',
                5 => 'Thursday',
                6 => 'Friday',
                7 => 'Saturday',
            ];

            $weeklyLabels = [];
            $weeklyData   = [];

            foreach ($daysMap as $key => $dayName) {
                $weeklyLabels[] = $dayName;
                $weeklyData[]   = $weeklyVisits->firstWhere('day_of_week', $key)->total ?? 0;
            }
            // End weeklyVisits

            // echo '<pre>';
            // print_r($monthlyVisits);
            // exit;

            return view('dashboard.index', compact('sumPrice', 'countAdmin', 'countMember', 'countProduct', 'countPet', 
                                                'countView', 'monthlyLabels', 'monthlyData', 'statusLabels', 'statusData', 
                                                'weeklyLabels', 'weeklyData'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404'); //404 error page
        }
    }
}