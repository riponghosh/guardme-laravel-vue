<?php

return [
    'rabbitmq' => [
        'auth' => [
            'user' => env('RABBITMQ_USER', 'guest'),
            'password' => env('RABBITMQ_PASSWORD', 'guest'),
        ]
    ],
    'acl' => [
        'Job_Seeker' => 'Job Seeker',
        'License_partner' => 'License partner',
        'Employer' => 'Employer',
        'Super_Admin' => 'Super Admin',
        'Admin' => 'Admin'
    ],
    'categories' => [
        'door_supervisor' => 'Door Supervisor',
        'security_guard' => 'Security Guard',
        'close_protection' => 'Close Protection'
    ],
    'sectors' => [
        'restaurant' => 'Restaurant',
        'club' => 'Club',
        'supermarket' => 'Supermarket',
        'factory' => 'Factory',
        'retail_store' => 'Retail store',
        'others' => 'Others',
    ],
    'broadcasts' => [
        'everyone' => 'Everyone',
        'favourites' => 'Favourites'
    ],
	'ratings' => [
        'skills' => 'Skills',
        'quality_of_work' => 'Quality of Work',
        'availability' => 'Availability',
        'communication' => 'Communication',
        'adherence_to_schedule' => 'Adherence to schedule',
    ],
];