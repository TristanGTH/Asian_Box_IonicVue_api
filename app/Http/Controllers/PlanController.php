<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function showAllPlans()
    {
        $plans = DB::table('plans')->get();

        return response()->json([
            'plans' => $plans
        ], 200);
    }

    public function subscribePlan(Request $request)
    {

        $request->validate([
            'family_name' => 'required',
            'token' => 'required',
            'plan' => 'required',
            'coupon' => 'nullable'
        ]);


        return response()->json([
            'success' => 'Subscription success'
        ], 204);
    }
}
