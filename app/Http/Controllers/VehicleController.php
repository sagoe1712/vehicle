<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class VehicleController extends Controller
{

    public function search(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'make' => 'required',
            'model' => 'required',
            'registration' => 'required',
        ]);

        if ($validated->fails()) {
            throw new ValidationException($validated);
        }

        $make = $request->input('make');
        $model = $request->input('model');
        $registration = $request->input('registration');

        $query = Vehicle::query();

        if ($make) {
            $query->where('make', $make);
        }

        if ($model) {
            $query->where('model', $model);
        }

        if ($registration) {
            $query->where('registration', $registration);
        }

        $vehicles = $query->get();

        return response()->json($vehicles);
    }
}
