"First Name","Last Name","Email","Mobile","Telephone","Address Line 1","Address Line 2","Town","Postcode","Date of birth","Age","Gender","Volunteer","Guest"
@foreach($contacts as $contact)
"{{ 
    $contact->first_name
}}","{{ 
    $contact->last_name 
}}","{{ 
    $contact->email 
}}","{{ 
    $contact->mobile ? "'$contact->mobile'" : ''
}}","{{ 
    $contact->telephone ? "'$contact->telephone'" : ''
}}","{{ 
    $contact->address_line_1 
}}","{{ 
    $contact->address_line_2 
}}","{{ 
    $contact->address_town 
}}","{{ 
    $contact->address_postcode 
}}","{{ 
    empty($contact->date_of_birth) ? '' : $contact->date_of_birth->format('d-m-Y')
}}","{{ 
    $contact->age 
}}","{{ 
    $contact->gender
}}","{{ 
    $contact->volunteer ? 'Yes' : 'No'
}}","{{ 
    $contact->guest ? 'Yes' : 'No'
}}"
@endforeach