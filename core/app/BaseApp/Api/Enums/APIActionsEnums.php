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
    public const PAYMENT_URL = 'payment_url';
    public const TEST_ACTION = 'test_action';
    public const SHOW_APPLICATION = 'show_application';
    public const REJECT_STATUS_APPLICATION = 'reject_status_application';
    public const STORE_PRINTING_PRESS = 'store_printing_press';
    public const LIST_BRANCH_EMPLOYEES = 'list_branch_employees';
    public const UPDATE_ORDER_STATUS = 'update_order_status';
    public const UPDATE_SEMESTER = 'update_semester';
    public const DELETE_SEMESTER = 'delete_semester';
    public const UPDATE_ACADEMIC_YEAR = 'update_academic_year';
    public const DELETE_ACADEMIC_YEAR = 'delete_academic_year';
    public const UPDATE_CATEGORY = 'update_category';
    public const DELETE_CATEGORY = 'delete_category';
    public const UPDATE_COUNTRY = 'update_country';
    public const DELETE_COUNTRY = 'delete_country';
    public const UPDATE_EDUCATIONAL_SYSTEM = 'update_educational_system';
    public const DELETE_EDUCATIONAL_SYSTEM = 'delete_educational_system';
    public const INDEX_EDUCATIONAL_SYSTEM_SCHOOLS = 'index_educational_system_schools';
    public const UPDATE_GRADE = 'update_grade';
    public const DELETE_GRADE = 'delete_grade';
    public const INDEX_GRADE_SCHOOLS = 'index_grade_schools';
    public const CREATE_SCHOOL = 'create_school';
    public const STORE_SCHOOL = 'store_school';
    public const UPDATE_SCHOOL = 'update_school';
    public const EDIT_SCHOOL = 'edit_school';
    public const DELETE_SCHOOL = 'delete_school';
    public const SHOW_SCHOOL = 'show_school';
    public const UPDATE_SUBJECT = 'update_subject';
    public const EDIT_SUBJECT = 'edit_subject';
    public const DELETE_SUBJECT = 'delete_subject';
    public const SHOW_SUBJECT = 'show_subject';
    public const UPDATE_CLASSROOM = 'update_classroom';
    public const EDIT_CLASSROOM = 'edit_classroom';
    public const DELETE_CLASSROOM = 'delete_classroom';
    public const SHOW_CLASSROOM = 'show_classroom';
    public const SHOW_BRANCH = 'show_branch';
    public const UPDATE_BRANCH = 'update_branch';
    public const CREATE_BRANCH = 'create_branch';
    public const DELETE_BRANCH = 'delete_branch';
    public const ASSIGN_LEADER = "assign_leader";
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
}
