<?php

use App\Controllers\ADPController;
use App\Controllers\AuthController;
use App\Controllers\CompetencyFramework\CompetencyController;
use App\Controllers\CompetencyFramework\CompetencyMappingController;
use App\Controllers\CompetencyFramework\CompetencyTypeController;
use App\Controllers\DevelopmentContracting\DevelopmentRatingController;
use App\Controllers\DevelopmentCycle\DevelopmentCycleController;
use App\Controllers\Employee\EmployeeController;
use App\Controllers\Employee\EmployeeCSVController;
use App\Controllers\Employee\EmployeeInviteController;
use App\Controllers\Employee\LineManagerController;
use App\Controllers\Home;
use App\Controllers\InterventionManagement\EmployeeInterventionMappingController;
use App\Controllers\InterventionManagement\InterventionClassController;
use App\Controllers\InterventionManagement\InterventionContentController;
use App\Controllers\InterventionManagement\InterventionTypeController;
use App\Controllers\InterventionManagement\InterventionVendorController;
use App\Controllers\InterventionManagement\LearningInterventionController;
use App\Controllers\OrgStructure\DepartmentController;
use App\Controllers\OrgStructure\DivisionController;
use App\Controllers\OrgStructure\GroupController;
use App\Controllers\OrgStructure\UnitController;
use App\Controllers\PDPController;
use App\Controllers\Trainer\InterventionAttendanceController;
use App\Controllers\Trainer\ParticipantFeedbackController;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\CompetencyFramework\JobController;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->get('/', [Home::class, 'index'], ['as' => 'ldm.home']);
    $routes->get('/home', [Home::class, 'index'], ['as' => 'ldm.home.dashboard']);
    $routes->get('/access-denied', [Home::class, 'accessDenied'], ['as' => 'ldm.access_denied']);
});


// Define a route group for the "ldm" namespace
$routes->group('ldm', function ($routes) {
    $routes->group('structure', ['filter' => 'LDMCheck'], function ($routes) {
        // Division routes
        $routes->get('divisions/', [DivisionController::class, 'index'], ['as' => 'ldm.divisions']);
        $routes->post('divisions/', [DivisionController::class, 'create'], ['as' => 'ldm.divisions.create']);
        $routes->get('divisions/edit/(:num)/', [DivisionController::class, 'edit'], ['as' => 'ldm.divisions.edit']);
        $routes->post('divisions/update/(:num)/', [DivisionController::class, 'update'], ['as' => 'ldm.divisions.update']);
        $routes->get('divisions/delete/', [DivisionController::class, 'delete'], ['as' => 'ldm.divisions.delete']);

        // Group routes
        $routes->get('groups/', [GroupController::class, 'index'], ['as' => 'ldm.groups']);
        $routes->post('groups/', [GroupController::class, 'create'], ['as' => 'ldm.groups.create']);
        $routes->get('groups/all', [GroupController::class, 'allGroups'], ['as' => 'ldm.groups.all']);
        $routes->get('groups/edit/(:num)/', [GroupController::class, 'edit'], ['as' => 'ldm.groups.edit']);
        $routes->post('groups/update/(:num)/', [GroupController::class, 'update'], ['as' => 'ldm.groups.update']);
        $routes->get('groups/delete/', [GroupController::class, 'delete'], ['as' => 'ldm.groups.delete']);

        // Department routes
        $routes->get('departments/', [DepartmentController::class, 'index'], ['as' => 'ldm.departments']);
        $routes->get('departments/all', [DepartmentController::class, 'allDepartments'], ['as' => 'ldm.departments.all']);
        $routes->post('departments/', [DepartmentController::class, 'create'], ['as' => 'ldm.departments.create']);
        $routes->get('departments/edit/(:num)/', [DepartmentController::class, 'edit'], ['as' => 'ldm.departments.edit']);
        $routes->post('departments/update/(:num)/', [DepartmentController::class, 'update'], ['as' => 'ldm.departments.update']);
        $routes->get('departments/delete/', [DepartmentController::class, 'delete'], ['as' => 'ldm.departments.delete']);

        // Unit routes
        $routes->get('units/', [UnitController::class, 'index'], ['as' => 'ldm.units']);
        $routes->get('units/all', [UnitController::class, 'allUnits'], ['as' => 'ldm.units.all']);
        $routes->post('units/', [UnitController::class, 'create'], ['as' => 'ldm.units.create']);
        $routes->get('units/edit/(:num)/', [UnitController::class, 'edit'], ['as' => 'ldm.units.edit']);
        $routes->post('units/update/(:num)/', [UnitController::class, 'update'], ['as' => 'ldm.units.update']);
        $routes->get('units/delete/', [UnitController::class, 'delete'], ['as' => 'ldm.units.delete']);
    });

    $routes->group('competency', ['filter' => 'LDMCheck'], function ($routes) {
        // Job routes
        $routes->get('jobs/', [JobController::class, 'index'], ['as' => 'ldm.jobs']);
        $routes->post('jobs/', [JobController::class, 'create'], ['as' => 'ldm.jobs.create']);
        $routes->get('jobs/edit/(:num)/', [JobController::class, 'edit'], ['as' => 'ldm.jobs.edit']);
        $routes->post('jobs/update/(:num)/', [JobController::class, 'update'], ['as' => 'ldm.jobs.update']);
        $routes->get('jobs/delete/', [JobController::class, 'delete'], ['as' => 'ldm.jobs.delete']);

        // Competency routes
        $routes->get('framework/', [CompetencyController::class, 'index'], ['as' => 'ldm.competencies']);
        $routes->post('framework/', [CompetencyController::class, 'create'], ['as' => 'ldm.competencies.create']);
        $routes->get('framework/edit/(:num)', [CompetencyController::class, 'edit'], ['as' => 'ldm.competencies.edit']);
        $routes->post('framework/update/(:num)', [CompetencyController::class, 'update'], ['as' => 'ldm.competencies.update']);
        $routes->get('framework/delete/', [CompetencyController::class, 'delete'], ['as' => 'ldm.competencies.delete']);

        // Job-Competency Mapping
        $routes->get('mapping/', [CompetencyMappingController::class, 'index'], ['as' => 'ldm.competencies.mapping']);
        $routes->post('mapping/', [CompetencyMappingController::class, 'create'], ['as' => 'ldm.competencies.mapping.create']);
        $routes->get('mapping/edit/(:num)/', [CompetencyMappingController::class, 'edit'], ['as' => 'ldm.competencies.mapping.edit']);
        $routes->post('mapping/update/(:num)/', [CompetencyMappingController::class, 'update'], ['as' => 'ldm.competencies.mapping.update']);
        $routes->get('mapping/delete/', [CompetencyMappingController::class, 'delete'], ['as' => 'ldm.competencies.mapping.delete']);

        // competency types routes
        $routes->get('types/', [CompetencyTypeController::class, 'index'], ['as' => 'ldm.competencies.types']);
        $routes->post('types/', [CompetencyTypeController::class, 'create'], ['as' => 'ldm.competencies.types.create']);
        $routes->get('types/edit/(:num)/', [CompetencyTypeController::class, 'edit'], ['as' => 'ldm.competencies.types.edit']);
        $routes->post('types/update/(:num)/', [CompetencyTypeController::class, 'update'], ['as' => 'ldm.competencies.types.update']);
        $routes->get('types/delete/', [CompetencyTypeController::class, 'delete'], ['as' => 'ldm.competencies.types.delete']);
    });

    // Employee Routes
    $routes->group('users', ['filter' => 'LDMCheck'], function ($routes) {
        $routes->get('all/', [EmployeeController::class, 'index'], ['as' => 'ldm.employee']);
        $routes->post('create/', [EmployeeController::class, 'create'], ['as' => 'ldm.employee.create']);
        $routes->get('edit/(:num)/', [EmployeeController::class, 'edit'], ['as' => 'ldm.employee.edit']);
        $routes->post('update/(:num)/', [EmployeeController::class, 'update'], ['as' => 'ldm.employee.update']);
        $routes->get('delete/', [EmployeeController::class, 'delete'], ['as' => 'ldm.employee.delete']);
        $routes->get('activate/(:num)/', [EmployeeController::class, 'activate'], ['as' => 'ldm.employee.activate']);
        $routes->get('line-manager/', [EmployeeController::class, 'getEmployeeLineManager'], ['as' => 'ldm.employee.line.manager']);

        $routes->group('org/map/', function ($routes) {
            $routes->get('', [EmployeeController::class, 'map'], ['as' => 'ldm.map.org']);
            $routes->post('', [EmployeeController::class, 'createMapping'], ['as' => 'ldm.map.org.create']);
        });

        $routes->get('upload/', [EmployeeCSVController::class, 'index'], ['as' => 'ldm.employee.upload']);
        $routes->post('upload/', [EmployeeCSVController::class, 'previewUpload'], ['as' => 'ldm.employee.upload.preview']);
        $routes->get('upload/format', [EmployeeCSVController::class, 'downloadTemplate'], ['as' => 'ldm.employee.format']);
        $routes->post('upload/create', [EmployeeCSVController::class, 'bulkUpload'], ['as' => 'ldm.employee.upload.create']);

        // Line Manager Routes
        $routes->group('manager', function ($routes) {
            $routes->get('assign/', [LineManagerController::class, 'index'], ['as' => 'ldm.line.manager']);
            $routes->post('assign/', [LineManagerController::class, 'create'], ['as' => 'ldm.line.manager.create']);
            $routes->get('assign/edit/(:num)/', [LineManagerController::class, 'edit'], ['as' => 'ldm.line.manager.edit']);
            $routes->post('assign/update/', [LineManagerController::class, 'update'], ['as' => 'ldm.line.manager.update']);
        });
    });

    // Development Cycles
    $routes->group('development', ['filter' => 'LDMCheck'], function ($routes) {
        $routes->get('cycle/', [DevelopmentCycleController::class, 'index'], ['as' => 'ldm.cycle']);
        $routes->post('cycle/', [DevelopmentCycleController::class, 'create'], ['as' => 'ldm.cycle.create']);
        $routes->get('cycle/edit/(:num)/', [DevelopmentCycleController::class, 'edit'], ['as' => 'ldm.cycle.edit']);
        $routes->post('cycle/update/(:num)/', [DevelopmentCycleController::class, 'update'], ['as' => 'ldm.cycle.update']);

        $routes->get('invite/', [EmployeeInviteController::class, 'index'], ['as' => 'ldm.employee.invite']);
        $routes->post('invite/', [EmployeeInviteController::class, 'create'], ['as' => 'ldm.employee.invite.create']);
    });

    $routes->group('contracting', ['filter' => 'EmployeeCheck'], function ($routes) {
        $routes->get('self/', [DevelopmentRatingController::class, 'index'], ['as' => 'ldm.rating.self']);
        $routes->post('self/', [DevelopmentRatingController::class, 'create'], ['as' => 'ldm.rating.self.create']);
    });

    $routes->group('contracting', ['filter' => 'LineManagerCheck'], function ($routes) {
        $routes->get('validate/', [DevelopmentRatingController::class, 'validateRating'], ['as' => 'ldm.rating.validate']);
        $routes->post('validate/', [DevelopmentRatingController::class, 'updateLineManagerRating'], ['as' => 'ldm.rating.validate.update']);
        $routes->get('manager/pdp/', [PDPController::class, 'getPlans'], ['as' => 'ldm.rating.pdp']);
        $routes->post('manager/pdp/create/', [PDPController::class, 'createPlans'], ['as' => 'ldm.rating.pdp.create']);
    });

    $routes->group('intervention', ['filter' => 'LDMCheck'], function ($routes) {
        $routes->get('type/', [InterventionTypeController::class, 'index'], ['as' => 'ldm.intervention.type']);
        $routes->post('type/', [InterventionTypeController::class, 'create'], ['as' => 'ldm.intervention.type.create']);
        $routes->get('type/edit/(:num)/', [InterventionTypeController::class, 'edit'], ['as' => 'ldm.intervention.type.edit']);
        $routes->post('type/update/(:num)/', [InterventionTypeController::class, 'update'], ['as' => 'ldm.intervention.type.update']);
        $routes->get('type/delete/', [InterventionTypeController::class, 'delete'], ['as' => 'ldm.intervention.type.delete']);

        $routes->get('set/', [LearningInterventionController::class, 'index'], ['as' => 'ldm.learning.intervention']);
        $routes->post('set/', [LearningInterventionController::class, 'create'], ['as' => 'ldm.learning.intervention.create']);
        $routes->get('set/edit/(:num)/', [LearningInterventionController::class, 'edit'], ['as' => 'ldm.learning.intervention.edit']);
        $routes->post('set/update/(:num)/', [LearningInterventionController::class, 'update'], ['as' => 'ldm.learning.intervention.update']);
        $routes->get('set/delete/', [LearningInterventionController::class, 'delete'], ['as' => 'ldm.learning.intervention.delete']);

        $routes->get('class/', [InterventionClassController::class, 'index'], ['as' => 'ldm.intervention.class']);
        $routes->post('class/', [InterventionClassController::class, 'create'], ['as' => 'ldm.intervention.class.create']);
        $routes->get('class/edit/(:num)/', [InterventionClassController::class, 'edit'], ['as' => 'ldm.intervention.class.edit']);
        $routes->post('class/update/(:num)/', [InterventionClassController::class, 'update'], ['as' => 'ldm.intervention.class.update']);
        $routes->get('class/delete/', [InterventionClassController::class, 'delete'], ['as' => 'ldm.intervention.class.delete']);

        $routes->get('content/', [InterventionContentController::class, 'index'], ['as' => 'ldm.intervention.content']);
        $routes->post('content/', [InterventionContentController::class, 'create'], ['as' => 'ldm.intervention.content.create']);
        $routes->get('content/edit/(:num)/', [InterventionContentController::class, 'edit'], ['as' => 'ldm.intervention.content.edit']);
        $routes->post('content/update/(:num)/', [InterventionContentController::class, 'update'], ['as' => 'ldm.intervention.content.update']);
        $routes->get('content/delete/', [InterventionContentController::class, 'delete'], ['as' => 'ldm.intervention.content.delete']);

        $routes->get('vendor/', [InterventionVendorController::class, 'index'], ['as' => 'ldm.vendor']);
        $routes->post('vendor/', [InterventionVendorController::class, 'create'], ['as' => 'ldm.vendor.create']);
        $routes->get('vendor/edit/(:num)/', [InterventionVendorController::class, 'edit'], ['as' => 'ldm.vendor.edit']);
        $routes->post('vendor/update/(:num)/', [InterventionVendorController::class, 'update'], ['as' => 'ldm.vendor.update']);
        $routes->get('vendor/delete/', [InterventionVendorController::class, 'delete'], ['as' => 'ldm.vendor.delete']);

        $routes->get('map/', [EmployeeInterventionMappingController::class, 'index'], ['as' => 'ldm.intervention.map']);
        $routes->post('map/', [EmployeeInterventionMappingController::class, 'create'], ['as' => 'ldm.intervention.map.create']);
        $routes->get('fetch-interventions/', [EmployeeInterventionMappingController::class, 'fetchInterventions'], ['as' => 'ldm.intervention.fetch']);
        $routes->get('fetch-classes/', [EmployeeInterventionMappingController::class, 'fetchClasses'], ['as' => 'ldm.intervention.class.fetch']);
        $routes->get('fetch-employees/', [EmployeeInterventionMappingController::class, 'fetchEligibleEmployees'], ['as' => 'ldm.intervention.employees.fetch']);
    });

    $routes->group('trainer', ['filter' => 'TrainerCheck'], function ($routes) {
        $routes->get('attendance/', [InterventionAttendanceController::class, 'index'], ['as' => 'ldm.intervention.attendance']);
        $routes->post('attendance/', [InterventionAttendanceController::class, 'create'], ['as' => 'ldm.intervention.attendance.create']);
        $routes->get('attendance/format/', [InterventionAttendanceController::class, 'format'], ['as' => 'ldm.intervention.attendance.format']);
        $routes->post('attendance/preview/', [InterventionAttendanceController::class, 'previewUpload'], ['as' => 'ldm.intervention.attendance.preview']);

        $routes->get('feedback/invite/', [ParticipantFeedbackController::class, 'index'], ['as' => 'ldm.feedback.invite']);
        $routes->get('feedback/form/', [ParticipantFeedbackController::class, 'feedbackForm'], ['as' => 'ldm.feedback.form']);
        $routes->post('feedback/create/submit/', [ParticipantFeedbackController::class, 'submitFeedback'], ['as' => 'ldm.feedback.create']);
        $routes->post('feedback/invite/submit/', [ParticipantFeedbackController::class, 'sendEmailInvite'], ['as' => 'ldm.feedback.invite.create']);
        $routes->get('feedback/fetch-employees/', [ParticipantFeedbackController::class, 'fetchEmployeesForFeedback'], ['as' => 'ldm.feedback.employees.fetch']);
        $routes->get('feedback/list/', [ParticipantFeedbackController::class, 'feedbackList'], ['as' => 'ldm.feedback.list']);
    });

    $routes->group('dashboard', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('pdp/', [PDPController::class, 'index'], ['as' => 'ldm.dashboard.pdp']);
        $routes->post('pdp/create/', [PDPController::class, 'create'], ['as' => 'ldm.dashboard.pdp.create']);
        $routes->post('pdp/signoff/(:num)/', [PDPController::class, 'signoff'], ['as' => 'ldm.dashboard.pdp.signoff']);
        $routes->get('adp/', [ADPController::class, 'index'], ['as' => 'ldm.dashboard.adp']);
    });

    $routes->get('login/', [AuthController::class, 'index'], ['as' => 'ldm.login']);
    $routes->post('login/', [AuthController::class, 'login'], ['as' => 'ldm.login.auth']);
    $routes->get('logout/', [AuthController::class, 'logout'], ['as' => 'ldm.logout']);
    $routes->get('password/forgot/', [AuthController::class, 'forgotPassword'], ['as' => 'ldm.forgot.password']);
    $routes->post('password/retrieve/', [AuthController::class, 'handleForgotPassword'], ['as' => 'ldm.retrieve.password']);
    $routes->post('password/change/form', [AuthController::class, 'passwordChangeForm'], ['as' => 'ldm.password.change']);
    $routes->get('password/new/form', [AuthController::class, 'getPasswordSubmitForm'], ['as' => 'ldm.password.new']);
    $routes->post('password/reset', [AuthController::class, 'resetPassword'], ['as' => 'ldm.password.reset']);

    $routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('password/change', [AuthController::class, 'getChangePassword'], ['as' => 'ldm.change.password']);
        $routes->post('password/save', [AuthController::class, 'handleChangePassword'], ['as' => 'ldm.change.password.save']);
    });
});

