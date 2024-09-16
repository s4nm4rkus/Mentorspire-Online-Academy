<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IotData;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Auth;

class IotDataController extends Controller
{
    public function activityReports()
    {
        return view('pages.admin.activity_reports');
    }

    public function getIotData(Request $request)
    {
        $query = IotData::query();

        $page = $request->start ?? 1 / $request->length + 1;
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
}
