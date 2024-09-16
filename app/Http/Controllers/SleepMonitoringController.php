<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepMonitoring;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SleepMonitoringController extends Controller
{
    public function monthlySleepDataChart()
    {
        // Retrieve monthly average sleep data
        $monthlyData = SleepMonitoring::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('AVG(snoring_level) as avg_snoring_level'),
            DB::raw('AVG(heart_rate) as avg_heart_rate'),
            DB::raw('AVG(sp02) as avg_sp02')
        )
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();

        // Prepare data for the chart
        $labels = [];
        $avgSnoringLevels = [];
        $avgHeartRates = [];
        $avgSp02s = [];

        foreach ($monthlyData as $data) {
            $labels[] = date('M Y', strtotime($data->year . '-' . $data->month . '-01'));
            $avgSnoringLevels[] = $data->avg_snoring_level;
            $avgHeartRates[] = $data->avg_heart_rate;
            $avgSp02s[] = $data->avg_sp02;
        }

        // You can pass this data to your view
        return view('partials.smmonthly', [
            'labels' => $labels,
            'avgSnoringLevels' => $avgSnoringLevels,
            'avgHeartRates' => $avgHeartRates,
            'avgSp02s' => $avgSp02s,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $notification = $user->storeNotification([
            'snoring_level' => isset($request->snoring_level) ? $request->snoring_level  : null,
            'heart_rate' => isset($request->heart_rate) ? $request->heart_rate  : null,
            'sp02' => isset($request->sp02) ? $request->sp02  : null,
        ]);

        $user->sendAbnormalityDetectedNotification([$notification]);

        return response()->json($request->except(['_token']));
    }

    public function updateSerialKey(Request $request, $id)
    {
        $sleepMonitoring = SleepMonitoring::where('id', $id)->first();
        $sleepMonitoring->serial_key = $request->serial_key;
        $sleepMonitoring->save();

        return response()->json(true);
    }

    public function readNotification(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->noContent();
    }

    public function getUserLatestSleepData(Request $request)
    {
        $latestSleepData = SleepMonitoring::where('user_id', auth()->user()->id)
            ->latest()
            ->first();

        return response()->json($latestSleepData);
    }

    public function getChartsData(Request $request)
    {
        $night1 = Carbon::now()->subDay();

        // $yesterday = Carbon::yesterday();
        // $dayBeforeYesterday = Carbon::yesterday()->subDay();

        // $night3 = Carbon::now()->subDays(2);
        // $dayBeforeNight3 = Carbon::now()->subDays(3);
        
        $lastNightData = SleepMonitoring::where('user_id', auth()->user()->id)->where('created_at', '>=', $night1)->get();

        $sevenDaysAgo = Carbon::now()->subDays(7);
        $weeklyActivityData = SleepMonitoring::where('created_at', '>=', $sevenDaysAgo)
                        ->where('user_id', auth()->user()->id)
                        ->selectRaw('DATE(created_at) as day, MAX(snoring_level) as snoring_level, MAX(heart_rate) as heart_rate, MAX(sp02) as sp02')
                        ->groupBy('day')
                        ->orderBy('day', 'asc')
                        ->get();

        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        $monthlyActivityData = SleepMonitoring::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->where('user_id', auth()->user()->id)
            ->selectRaw('DATE(created_at) as day, MAX(snoring_level) as snoring_level, MAX(heart_rate) as heart_rate, MAX(sp02) as sp02')
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();

        // $night2Data = SleepMonitoring::where('user_id', auth()->user()->id)->whereBetween('created_at', [$dayBeforeYesterday, $yesterday])->get();
        // $night3Data = SleepMonitoring::where('user_id', auth()->user()->id)->whereBetween('created_at', [$dayBeforeNight3, $night3])->get();

        $object = new \stdClass;
        $object->lastNight = $lastNightData;
        $object->weeklyActivity = $weeklyActivityData;
        $object->monthlyActivity = $monthlyActivityData;

        return response()->json($object);
    }

    public function startMonitor()
    {
        auth()->user()->startMonitor();

        return response()->json('Start Monitoring.');
    }

    public function stopMonitor()
    {
        auth()->user()->stopMonitor();

        return response()->json('Stop Monitoring.');
    }
}
