<?php

use App\Http\Controllers\App\Applicant\ApplicantController;
use App\Http\Controllers\App\Applicant\ApplicantDetailsController;
use App\Http\Controllers\App\Applicant\AttendeeController;
use App\Http\Controllers\App\Applicant\EventController;
use App\Http\Controllers\App\Applicant\EventTypeController;
use App\Http\Controllers\App\Applicant\JobApplicantController;
use App\Http\Controllers\App\Applicant\NoteController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'app', 'as' => 'app_permission.'], function (Router $route) {
    Route::post('applicant/check-email', [ApplicantController::class, 'checkEmail'])
        ->name('applicant.check_email');;
    
    Route::get('job-applicant/{job_applicant_id}/get-timeline', [JobApplicantController::class, 'getTimeline'])
        ->name('job_applicant_timeline.list');

    $route->get('job-applicant/details/{job_applicant_id}', [ApplicantDetailsController::class, 'applicantDetails'])
        ->name('applicant_details.view');    
    
    $route->patch('job-applicant/{job_applicant_id}/change-stage', [JobApplicantController::class, 'changeStage'])
        ->name('job_applicant.change_stage');

    $route->patch('job-applicant/{job_applicant_id}/change-review', [JobApplicantController::class, 'changeReview'])
        ->name('job_applicant.change_review');
    $route->patch('job-applicant/{job_applicant}/disqualify', [JobApplicantController::class, 'disqualify'])
        ->name('job_applicant.disqualify');
    $route->patch('job-applicant/{job_applicant}/update-disqualification-note', [JobApplicantController::class, 'updateDisqualificationNote'])
        ->name('job_applicant.update_disqualification_note');

    $route->patch('job-applicant/{job_applicant}/send-email', [JobApplicantController::class, 'sendEmailToApplicant'])
        ->name('job_applicant.send_email');
    $route->get('note/job-applicant/{job_applicant_id}/get-notes', [NoteController::class, 'getNotesByJobApplicantId'])
        ->name('note_by_recruiters.list');
    $route->get('event/job-applicant-event-list/{job_applicant_id}', [EventController::class, 'jobApplicantEventList'])
        ->name('events_for_job_applicant.list');
});
Route::group(['prefix' => 'app', 'as' => 'app_permission.', 'middleware' => ['permission']], function () {
    Route::apiResource('applicant', ApplicantController::class);
    Route::apiResource('job-applicant', JobApplicantController::class);
    Route::apiResource('event', EventController::class);
    Route::apiResource('event-type', EventTypeController::class);
    Route::apiResource('note', NoteController::class);
    Route::apiResource('attendee', AttendeeController::class)->only(['store', 'destroy']);
});