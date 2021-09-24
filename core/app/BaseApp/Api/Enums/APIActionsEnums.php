<?php

declare(strict_types = 1);

namespace App\BaseApp\Api\Enums;

abstract class APIActionsEnums
{
    /**
     * List of all buttons action in the api endpoints
     *
     * Please not that the following keys should not be modified because it may break the mobile app
     */
    public const TEST_ACTION = 'test_action';
    public const UPDATE_ORDER_STATUS = 'update_order_status';
    public const UPDATE_SEMESTER = 'update_semester';
    public const DELETE_SEMESTER = 'delete_semester';
    public const UPDATE_CATEGORY = 'update_category';
    public const DELETE_CATEGORY = 'delete_category';
    public const UPDATE_COUNTRY = 'update_country';
    public const DELETE_COUNTRY = 'delete_country';
    public const UPDATE_EDUCATIONAL_SYSTEM = 'update_educational_system';
    public const UPDATE_GRADE = 'update_grade';
    public const UPDATE_SCHOOL = 'update_school';
    public const SHOW_SCHOOL = 'show_school';
    public const UPDATE_SUBJECT = 'update_subject';
    public const EDIT_SUBJECT = 'edit_subject';
    public const DELETE_SUBJECT = 'delete_subject';
    public const SHOW_SUBJECT = 'show_subject';
    public const UPDATE_CLASSROOM = 'update_classroom';
    public const EDIT_CLASSROOM = 'edit_classroom';
    public const UPDATE_BRANCH = 'update_branch';
    public const CREATE_BRANCH = 'create_branch';
    public const UN_ASSIGN_LEADER = "un_assign_leader";
    const UPDATE_QUESTION = 'update_question';
    const SHOW_QUESTION = 'show_question';
    const DELETE_QUESTION = 'delete_question';
    const SHOW_COMPLAIN = 'show_complain';
    const SHOW_SETTING = 'show_setting';
    const UPDATE_SETTING = 'update_setting';
    const UPDATE_QUESTIONNAIRE_STATUS = 'update_questionnaire_status';
    const UPDATE_ANNOUNCEMENT = 'update_announcement';
    const SHOW_ANNOUNCEMENT = 'show_announcement';
    const DELETE_ANNOUNCEMENT = 'delete_announcement';
    const CREATE_ANNOUNCEMENT = 'create_announcement';
    const FILTER_ANNOUNCEMENTS = 'filter_announcements';
    const EXPORT_ANNOUNCEMENTS = 'export_announcements';
    const SHOW_VISIT = 'show_visit';
    const UPDATE_VISIT = 'update_visit';
    const DELETE_VISIT = 'delete_visit';
    const CREATE_COMPLAIN = 'create_complain';
    const RESOLVE_COMPLAIN = 'resolve_complain';
    const UPDATE_EVENT = 'update_event';
    const SHOW_EVENT = 'show_event';
    const DELETE_EVENT = 'delete_event';
    const CREATE_EVENT = 'create_event';
    const FILTER_EVENT = 'filter_event';
    const EXPORT_EVENT = 'export_event';
    const SHOW_CALL    = 'show_call';
    const UPDATE_CALL = 'update_call';
    const DELETE_CALL = 'delete_call';
    const FILTER_EVENTS = 'filter_events';
}
