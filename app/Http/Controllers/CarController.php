<?php

namespace App\Http\Controllers;

use App\Models\BookedCar;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->with('role.comfort')->first();

        return Car::whereIn('comfort_lvl', $user->role->comfort->pluck('id'))->get();
    }

    public function getCarByDate(Request $request)
    {
        $timeStart = Carbon::parse($request->get('timeStart'))->toDateTimeString();
        $timeEnd = Carbon::parse($request->get('timeEnd'))->toDateTimeString();
        $model = $request->get('model');

        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->with('role.comfort')->first();

        $comfort =  $user->role->comfort->pluck('id');

        $bookedIds = BookedCar::whereBetween('time_start', [$timeStart, $timeEnd])
            ->whereBetween('time_end', [$timeStart, $timeEnd])
            ->get()
            ->pluck('car_id')
            ->toArray();
        $bookedIds = array_unique($bookedIds);

        $query = Car::whereNotIn('id', $bookedIds)->whereIn('comfort_lvl', $comfort);

        if($request->get('model')) {
            $query = $query->where('model', $model);
        }

        $availableСars = $query->get();


        return $availableСars;
    }

    public function bookedCar(Request $request)
    {
        $userId = auth()->user()->id;
        $carId = $request->post('carId');
        $timeStart = Carbon::parse($request->post('timeStart'))->toDateTimeString();
        $timeEnd = Carbon::parse($request->post('timeEnd'))->toDateTimeString();

        return BookedCar::create([
            'time_start' => $timeStart,
            'time_end' => $timeEnd,
            'user_id' => $userId,
            'car_id' => $carId
        ]);
    }
}
