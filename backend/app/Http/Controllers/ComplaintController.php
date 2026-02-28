<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    /**
     * Ensure all requests are authenticated via Sanctum.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a new complaint with file upload.
     */
    public function store(Request $request)
    {
        $userId = auth()->id();

        // Fail early if auth fails (extra layer of safety)
        if (!$userId) {
            return response()->json(['error' => 'Login required'], 401);
        }

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'police_unit_id' => 'required',
            'police_station_id' => 'required',
            'complaint_type_id' => 'required',
            'description' => 'required',
            'incident_date' => 'required|date',
            'incident_time' => 'required',
            'incident_location' => 'required',
            'evidence' => 'nullable|file|mimes:jpg,png,pdf,mp4|max:20480', 
        ]);

        $evidencePath = null;

        // Store file in 'storage/app/public/evidence'
        if ($request->hasFile('evidence')) {
            $evidencePath = $request->file('evidence')->store('evidence', 'public');
        }

        //Direct DB insert (useful if not using an Eloquent Model)
        DB::table('complaints')->insert([
            'user_id' => $userId,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'accused_names' => $request->accused_names,
            'incident_date' => $request->incident_date,
            'incident_time' => $request->incident_time,
            'incident_location' => $request->incident_location,
            'police_unit_id' => $request->police_unit_id,
            'police_station_id' => $request->police_station_id,
            'complaint_type_id' => $request->complaint_type_id,
            'description' => $request->description,
            'evidence_path' => $evidencePath,
            'status' => 'Pending', // 🕒 Default status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Complaint registered successfully!'], 201);
    }

    /**
     * Retrieve all complaints for the authenticated user.
     */
    public function myComplaints()
    {
        $userId = auth()->id();

        // Join tables to provide human-readable names instead of just IDs
        $complaints = DB::table('complaints')
            ->join('police_stations', 'complaints.police_station_id', '=', 'police_stations.id')
            ->join('complaint_types', 'complaints.complaint_type_id', '=', 'complaint_types.id')
            ->select(
                'complaints.*',
                'police_stations.station_name as station',
                'complaint_types.name as type'
            )
            ->where('complaints.user_id', $userId)
            ->orderBy('complaints.created_at', 'desc')
            ->get();

        return response()->json($complaints);
    }

    /**
     * Show specific complaint (Scoped to User).
     */
    public function show($id)
    {
        $userId = auth()->id();

        $complaint = DB::table('complaints')
            ->join('police_stations', 'complaints.police_station_id', '=', 'police_stations.id')
            ->join('complaint_types', 'complaints.complaint_type_id', '=', 'complaint_types.id')
            ->select(
                'complaints.*',
                'police_stations.station_name as station',
                'complaint_types.name as type'
            )
            ->where('complaints.id', $id)
            ->where('complaints.user_id', $userId) // Crucial: Prevents users from seeing others' complaints
            ->first();

        if (!$complaint) {
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        return response()->json($complaint);
    }
}