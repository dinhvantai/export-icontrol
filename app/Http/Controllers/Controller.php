<?php

namespace App\Http\Controllers;

use App\Excel\MultiSheet;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('welcome');
    }

    public function postForm(Request $request)
    {
        $points = [
            'sheet-1' => [1,2,3,4,5,6,7,8,9,10,11,12],
            'sheet-2' => [13,14,15,16,17,18,19,20,21,22,23,24],
        ];

        $dataExcel = [];

        $startTime = Carbon::parse($request['start-time']);
        $endTime = Carbon::parse($request['end-time']);
        $step = (int) $request['step'];
        if ($step < 0) {
            $step = 1;
        }


        while ($startTime->lessThanOrEqualTo($endTime)) {
            foreach ($points as $sheetName => $point) {
                $pointData = [$startTime->toDateTimeString()];
                $endMinute = $startTime->copy()->addMinute(1);
                $endMinute = $startTime->copy()->addSecond(1);
                foreach ($point as $pointId) {
                    $result = DB::table('analogevents')->where('points_idPoint', $pointId)
                        ->whereDate('eventTime', '>=', $startTime)
                        ->whereDate('eventTime', '<', $endMinute)
                        ->orderBy('eventTime', 'asc')
                        ->first();
                    $pointData[] = $result ? $result->value : null;
                }
                $dataSheet = (empty($dataExcel[$sheetName])) ? [] : $dataExcel[$sheetName];
                $dataSheet[] = $pointData;
                $dataExcel[$sheetName] = $dataSheet;
            }

            $startTime->addMinute($step);
        }

        $fileName = 'export_' . Carbon::now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new MultiSheet($points, $dataExcel), $fileName);
    }
}
