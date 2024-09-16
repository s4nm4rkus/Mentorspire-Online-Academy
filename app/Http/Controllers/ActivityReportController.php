<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepMonitoring;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Auth;

class ActivityReportController extends Controller
{
    public function activityReports()
    {
        return view('pages.admin.activity_reports');
    }

    public function getActivityReports(Request $request)
    {
        $query = SleepMonitoring::query();
        
        if (!auth()->user()->hasRole('admin')) {
            $query->where('user_id', auth()->user()->id);
        }

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where('user_id', 'like', '%' . $search . '%');
        }

        if ($request->has('date') && !empty($request->date)) {
            $date = $request->date;
            $query->whereDate('created_at', $date);
        }

        $page = $request->start / $request->length + 1;
        $perPage = $request->length;
        $results = $query->with('user')->paginate($perPage, ['*'], 'page', $page);

        $data = [
            'draw' => $request->draw,
            'recordsTotal' => $results->total(),
            'recordsFiltered' => $results->total(),
            'data' => $results->items(),
        ];

        return response()->json($data);
    }

    public function getActivityReportsDates(Request $request)
    {
        $dates = SleepMonitoring::
            when(!auth()->user()->hasRole('admin'), function ($query) {
                return $query->where('user_id', auth()->user()->id);
            })
            ->select(DB::raw('DATE(created_at) as date'))
            ->distinct()
            ->get();

        return response()->json($dates);
    }

    public function destroy($date)
    {
        $item = SleepMonitoring::
            whereDate('created_at', $date)
            ->when(!auth()->user()->hasRole('admin'), function ($query) {
                return $query->where('user_id', auth()->user()->id);
            });

        $item->delete();
        return response()->json(['success' => 'Item deleted successfully']);
    }

}
