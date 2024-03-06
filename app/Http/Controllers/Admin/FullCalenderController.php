<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('adminend.pages.calender.index');
    }

    public function action(Request $request)
    {
        try {
            if ($request->ajax()) {
                if ($request->type == 'add') {
                    $event = Event::create([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end'   => $request->end
                    ]);

                    return response()->json($event);
                }

                if ($request->type == 'update') {
                    $event = Event::find($request->id)->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end'   => $request->end
                    ]);

                    return response()->json($event);
                }

                if ($request->type == 'delete') {
                    $event = Event::find($request->id)->delete();

                    return response()->json($event);
                }
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return false;
        }
    }
}
