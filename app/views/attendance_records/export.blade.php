"Project","Contact","Attendance Date","Hours","Role","Volunteer?"
@foreach($records as $record)
"{{ 
    $record->project->name 
}}","{{ 
    $record->contact->Name 
}}","{{ 
    $record->attendance_date->format('Y-m-d') 
}}","{{ 
    number_format($record->hours, 2) 
}}","{{ 
    $record->role 
}}","{{ 
    $record->volunteer ? 'Yes' : 'No' 
}}"
@endforeach