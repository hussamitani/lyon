<?php

use App\Enums\PermissionOption;

return [
    PermissionOption::PDMS_PATIENT_VIEW->value => [
        'name' => 'PDMS | View patients',
        'description' => 'Allows the user to view patient records in the PDMS.',
    ],
    PermissionOption::PDMS_PATIENT_CREATE->value => [
        'name' => 'PDMS | Create patients',
        'description' => 'Allows the user to create new patient records in the PDMS.',
    ],
    PermissionOption::PDMS_PATIENT_UPDATE->value => [
        'name' => 'PDMS | Update patients',
        'description' => 'Allows the user to update patient data from the PDMS.',
    ],
    PermissionOption::PDMS_PATIENT_DELETE->value => [
        'name' => 'PDMS | Delete patients',
        'description' => 'Allows the user to delete patient records from the PDMS.',
    ],
    PermissionOption::PDMS_PATIENT_FORCE_DELETE->value => [
        'name' => 'PDMS | Force Delete patients',
        'description' => 'Allows the user to permanently delete patient records from the PDMS.',
    ],
    PermissionOption::PDMS_APPOINTMENT_VIEW->value => [
        'name' => 'PDMS | View appointments',
        'description' => 'Allows the user to view appointment schedules in the PDMS.',
    ],
    PermissionOption::PDMS_APPOINTMENT_CREATE->value => [
        'name' => 'PDMS | Create appointments',
        'description' => 'Allows the user to create appointment schedules in the PDMS (edit, reschedule, etc.).',
    ],
    PermissionOption::PDMS_APPOINTMENT_UPDATE->value => [
        'name' => 'PDMS | Update appointments',
        'description' => 'Allows the user to update appointment schedules in the PDMS (edit, reschedule, etc.).',
    ],
    PermissionOption::PDMS_APPOINTMENT_DELETE->value => [
        'name' => 'PDMS | Delete appointments',
        'description' => 'Allows the user to delete appointment schedules from the PDMS.',
    ],
    PermissionOption::PDMS_APPOINTMENT_FORCE_DELETE->value => [
        'name' => 'PDMS | Force Delete appointments',
        'description' => 'Allows the user to permanently delete appointment schedules from the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_VIEW->value => [
        'name' => 'PDMS | View inquiries',
        'description' => 'Allows the user to view inquiries in the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_CREATE->value => [
        'name' => 'PDMS | Create inquiries',
        'description' => 'Allows the user to create inquiries in the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_UPDATE->value => [
        'name' => 'PDMS | Update inquiries',
        'description' => 'Allows the user to update patient inquiries in the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_DELETE->value => [
        'name' => 'PDMS | Delete inquiries',
        'description' => 'Allows the user to delete patient inquiries from the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_FORCE_DELETE->value => [
        'name' => 'PDMS | Force Delete inquiries',
        'description' => 'Allows the user to permanently delete patient inquiries from the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_RESPONSE_VIEW->value => [
        'name' => 'PDMS | View responses to inquiries',
        'description' => 'Allows the user to view responses of patient inquiries in the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_RESPONSE_CREATE->value => [
        'name' => 'PDMS | Respond to inquiries',
        'description' => 'Allows the user to respond to patient inquiries in the PDMS.',
    ],
    PermissionOption::PDMS_INQUIRY_RESPONSE_FORCE_DELETE->value => [
        'name' => 'PDMS | Force Delete Inquiry Responses',
        'description' => 'Allows the user to delete and permanently delete responses of patient inquiries in the PDMS.',
    ],
    PermissionOption::PDMS_REPORT_VIEW->value => [
        'name' => 'PDMS | View reports',
        'description' => 'Allows the user to view reports generated in the PDMS.',
    ],
    PermissionOption::PDMS_REPORT_CREATE->value => [
        'name' => 'PDMS | Update report',
        'description' => 'Allows the user to update reports generated in the PDMS.',
    ],
    PermissionOption::PDMS_REPORT_UPDATE->value => [
        'name' => 'PDMS | Update report',
        'description' => 'Allows the user to update reports generated in the PDMS.',
    ],
    PermissionOption::PDMS_REPORT_DELETE->value => [
        'name' => 'PDMS | Delete report',
        'description' => 'Allows the user to delete reports generated in the PDMS.',
    ],
    PermissionOption::PDMS_REPORT_FORCE_DELETE->value => [
        'name' => 'PDMS | Force Delete report',
        'description' => 'Allows the user to permanently delete reports generated in the PDMS.',
    ],
    PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value => [
        'name' => 'System | Manage appointment-types',
        'description' => 'Allows the user to update appointment types in the system.',
    ],
    PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value => [
        'name' => 'System | Manage inquiry-types',
        'description' => 'Allows the user to update inquiry types in the system.',
    ],
    PermissionOption::SYSTEM_INQUIRY_STATUS_MANAGE->value => [
        'name' => 'System | Manage inquiry-response status-types',
        'description' => 'Allows the user to update inquiry response statuses in the system.',
    ],
    PermissionOption::ADMIN_USER_VIEW->value => [
        'name' => 'Admin | View users',
        'description' => 'Allows the user to view user accounts in the admin panel.',
    ],
    PermissionOption::ADMIN_USER_CREATE->value => [
        'name' => 'Admin | Create users',
        'description' => 'Allows the user to view user accounts in the admin panel.',
    ],
    PermissionOption::ADMIN_USER_UPDATE->value => [
        'name' => 'Admin | Update users',
        'description' => 'Allows the user to update user accounts in the admin panel.',
    ],
    PermissionOption::ADMIN_USER_DELETE->value => [
        'name' => 'Admin | Delete users',
        'description' => 'Allows the user to delete user accounts from the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_VIEW->value => [
        'name' => 'Admin | View roles',
        'description' => 'Allows the user to view roles defined in the system in the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_CREATE->value => [
        'name' => 'Admin | Create roles',
        'description' => 'Allows the user to create roles in the system in the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_UPDATE->value => [
        'name' => 'Admin | Update roles',
        'description' => 'Allows the user to update roles defined in the system in the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_DELETE->value => [
        'name' => 'Admin | Delete roles',
        'description' => 'Allows the user to delete roles defined in the system from the admin panel.',
    ],
    PermissionOption::ADMIN_PERMISSION_VIEW->value => [
        'name' => 'Admin | View permissions',
        'description' => 'Allows the user to view permissions assigned to roles in the admin panel.',
    ],
];
