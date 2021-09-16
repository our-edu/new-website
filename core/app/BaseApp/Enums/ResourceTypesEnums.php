<?php

declare(strict_types = 1);

namespace App\BaseApp\Enums;

abstract class ResourceTypesEnums
{
    const DOCUMENT = 'document';
    const ORDER = 'order';
    const APPLICATION = 'application';
    const BUS = 'bus';
    const SERVICE = 'service';
    const SCHOOL_EMPLOYEE = 'school_employee';
    const LIST_RELATED_ATTACHMENT = 'list_related_attachment';
    const ACTION = 'action';
    const UPLOADED_MEDIA = 'uploaded_media';
    const PAYMENT_METHOD = 'payment_method';
    const QUESTION = 'question';
    const COMPLAIN = 'complain';
}
