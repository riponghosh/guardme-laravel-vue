<?php

/**
 * Access control configuration for this module
 */
return [
    [
        'name' => 'POST_NEW_JOB',
        'roles' => [
            config('guardme.acl.Employer'),
            config('guardme.acl.Admin'),
            config('guardme.acl.Super_Admin'),
        ]
    ],
    [
        'name' => 'VIEW_ALL_JOBS',
        'roles' => [
            config('guardme.acl.License_partner'),
            config('guardme.acl.Admin'),
            config('guardme.acl.Super_Admin'),
        ]
    ],
    [
        'name' => 'VIEW_CREATED_JOBS',
        'roles' => [
            config('guardme.acl.Employer')
        ]
    ],
    [
        'name' => 'VIEW_APPLIED_JOBS',
        'roles' => [
            config('guardme.acl.Job_Seeker')
        ]
    ]
];