<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Driver;
use Illuminate\Support\Facades\Cache;

class DriverController extends Controller
{
    /**
     * List of available driver
     *
     * @queryParam page Number of list offset
     *
     * @param  Request      $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = $this->getPage($request);

        $drivers = Cache::remember("drivers.index.{$page}", 1, function () {
            return Driver::paginate();
        });
        return response()->json($drivers);
    }
}
