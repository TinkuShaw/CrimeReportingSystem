<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'address', 'city', 'state', 'zip', 
        'accused_names', 'incident_date', 'incident_time', 
        'incident_location', 'police_unit_id', 'police_station_id', 
        'complaint_type_id', 'description', 'evidence_path'
    ];
}
