<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{
    /**
     * Get Static Police Unit Types.
     */
    public function unitTypes()
    {
        return response()->json(['Commissionerate', 'District']);
    }

    /**
     * Get Units filtered by Type (Commissionerate/District).
     */
    public function unitsByType($type)
    {
        $units = DB::table('police_units')
            ->where('type', $type)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
            
        return response()->json($units);
    }

    /**
     * Get Police Stations belonging to a specific Unit.
     */
    public function policeStations($unitId)
    {
        $stations = DB::table('police_stations')
            ->where('police_unit_id', $unitId)
            ->select('id', 'station_name')
            ->orderBy('station_name')
            ->get();
            
        return response()->json($stations);
    }

    /**
     * Get all available Complaint Categories.
     */
    public function complaintTypes()
    {
        $types = DB::table('complaint_types')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
            
        return response()->json($types);
    }
}