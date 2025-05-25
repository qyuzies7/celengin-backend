<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return Plan::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengguna_id' => 'required|exists:penggunas,id',
            'periode_type' => 'required|string|max:16',
            'periode_start' => 'required|date',
            'periode_end' => 'required|date',
            'nominal' => 'required|string|max:512',
        ]);
        $plan = Plan::create($validated);
        return response()->json($plan, 201);
    }

    public function show($id)
    {
        return Plan::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $validated = $request->validate([
            'pengguna_id' => 'sometimes|exists:penggunas,id',
            'periode_type' => 'sometimes|string|max:16',
            'periode_start' => 'sometimes|date',
            'periode_end' => 'sometimes|date',
            'nominal' => 'sometimes|string|max:512',
        ]);
        $plan->update($validated);
        return response()->json($plan);
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return response()->json(null, 204);
    }
}