<?php

namespace App\Enums;

enum PermissionOption: string
{
    case PDMS_PATIENT_VIEW = 'pdms_patient_view';
    case PDMS_PATIENT_CREATE = 'pdms_patient_create';
    case PDMS_PATIENT_UPDATE = 'pdms_patient_update';
    case PDMS_PATIENT_DELETE = 'pdms_patient_delete';
    case PDMS_PATIENT_FORCE_DELETE = 'pdms_patient_force_delete';

    case PDMS_APPOINTMENT_VIEW = 'pdms_appointment_view';
    case PDMS_APPOINTMENT_CREATE = 'pdms_appointment_create';
    case PDMS_APPOINTMENT_UPDATE = 'pdms_appointment_update';
    case PDMS_APPOINTMENT_DELETE = 'pdms_appointment_delete';
    case PDMS_APPOINTMENT_FORCE_DELETE = 'pdms_appointment_force_delete';

    case PDMS_INQUIRY_VIEW = 'pdms_inquiry_view';
    case PDMS_INQUIRY_CREATE = 'pdms_inquiry_create';
    case PDMS_INQUIRY_UPDATE = 'pdms_inquiry_update';
    case PDMS_INQUIRY_DELETE = 'pdms_inquiry_delete';
    case PDMS_INQUIRY_FORCE_DELETE = 'pdms_inquiry_force_delete';

    case PDMS_INQUIRY_RESPONSE_VIEW = 'pdms_inquiry_response_view';
    case PDMS_INQUIRY_RESPONSE_CREATE = 'pdms_inquiry_response_create';
    case PDMS_INQUIRY_RESPONSE_FORCE_DELETE = 'pdms_inquiry_response_force_delete';

    case PDMS_REPORT_VIEW = 'pdms_report_view';
    case PDMS_REPORT_CREATE = 'pdms_report_create';
    case PDMS_REPORT_UPDATE = 'pdms_report_update';
    case PDMS_REPORT_DELETE = 'pdms_report_delete';
    case PDMS_REPORT_FORCE_DELETE = 'pdms_report_force_delete';

    case SYSTEM_APPOINTMENT_TYPE_MANAGE = 'system_appointment_type_update';
    case SYSTEM_INQUIRY_TYPE_MANAGE = 'system_inquiry_type_update';
    case SYSTEM_INQUIRY_STATUS_MANAGE = 'system_inquiry_status_update';

    case ADMIN_USER_VIEW = 'admin_user_view';
    case ADMIN_USER_CREATE = 'admin_user_create';
    case ADMIN_USER_UPDATE = 'admin_user_update';
    case ADMIN_USER_DELETE = 'admin_user_delete';

    case ADMIN_ROLE_VIEW = 'admin_role_view';
    case ADMIN_ROLE_CREATE = 'admin_role_create';
    case ADMIN_ROLE_UPDATE = 'admin_role_update';
    case ADMIN_ROLE_DELETE = 'admin_role_delete';

    case ADMIN_PERMISSION_VIEW = 'admin_permission_view';
}
