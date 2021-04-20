<?php

namespace App\OurEdu\BaseApp\Enums;

class DynamicLinksEnum
{

    const studentFinishExam = '{portal_url}/ar/subject-activities/parent/exam-results/{examId}';
    const GENERALEXAM_PUBLISH = '{firebase_url}/?link={portal_url}/en/student/exams/general/{id}&apn=com.ouredu.students';
    const STUDENT_JOIN_COMPETITION = '{firebase_url}/?link={portal_url}/ar/student/competitions/join?competition_id={competition_id}&apn=com.ouredu.students';
    const INSTRUCTOR_JOIN_ROOM = '{portal_url}/#/home?osession={session_id}&otoken={token}&otype={type}';
    const SUPERVISOR_JOIN_ROOM = '{portal_url}/#/home?osession={session_id}&otoken={token}&otype={type}';
    const INSTRUCTOR_VIEW_STUDENT_FEEDBACK= '{portal_url}/ar/vcr/instructor/requests/{request_id}';
    const ADMIN_ASSIGN_SME_SUBJECT= '{portal_url}/#/subjects/{subject_id}/edit';
    const STUDENT_SHARE_LIVE_SESSION= '{portal_url}/ar/student/live-lessons/{live_session_id}/share';
    const INSTRUCTOR_GENERATE_EXAM= '{portal_url}/ar/exams?session_id={session_id}';
    const STUDENT_START_VCR_EXAM= '{portal_url}/ar/student/exams/{exam_id}/take';
    // TODO change it
    const STUDENT_GET_QUIZ= '{portal_url}/ar/student/quiz/{quiz_id}/take';
    const INSTRUCTOR_VIEW_STUDENT_VCR_EXAM_FEEDBACK= '{portal_url}/ar/instructor/live-lessons/{session_id}/exams/{exam_id}/feedback';
    const STUDENT_CHALLENGE_STUDENT= '{firebase_url}/?link={portal_url}/en/student/exams/{exam_id}/challenge?exam_id={exam_id}&apn=com.ouredu.students';
    const NOTIFY_INSTRUCTOR_SUPERVISOR_ABSENT= 'school-branch-supervisor/sessions/{classroom_session_id}/edit';
    const STUDENT_HOMEWORK = '{portal_url}/ar/student/homework/{homeworkId}';
}
