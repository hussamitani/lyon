<?php

return [
    'awaiting' => [
        'status' => 'Awaiting',
        'status_category' => 'awaiting',
        'description' => 'We are awaiting a response from the patient',
    ],
    'processing' => [
        'status' => 'Processing',
        'status_category' => 'processing',
        'description' => 'We are working on it!',
    ],
    'declined' => [
        'status' => 'Declined',
        'status_category' => 'declined',
        'description' => 'The inquiry has been declined. Please read the response.',
    ],
    'approved' => [
        'status' => 'Approved',
        'status_category' => 'approved',
        'description' => 'The inquiry has been approved. Please read the response if any are attached.',
    ],
];
