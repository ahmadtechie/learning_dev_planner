<?php

use App\Controllers\AuthController;
use App\Controllers\CompetencyFramework\CompetencyController;
use App\Controllers\CompetencyFramework\CompetencyMappingController;
use App\Controllers\CompetencyFramework\JobController;
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
use App\Controllers\InterventionManagement\LearningInterventionController;
use App\Controllers\InterventionManagement\InterventionVendorController;
use App\Controllers\OrgStructure\DepartmentController;
use App\Controllers\OrgStructure\DivisionController;
use App\Controllers\OrgStructure\GroupController;
use App\Controllers\OrgStructure\UnitController;
use App\Controllers\ReportController;
use App\Controllers\Trainer\InterventionAttendanceController;
use App\Controllers\Trainer\ParticipantFeedbackController;
use CodeIgniter\Router\RouteCollection;

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
        $routes->get('groups/edit/(:num)/', [GroupController::class, 'edit'], ['as' => 'ldm.groups.edit']);
        $routes->post('groups/update/(:num)/', [GroupController::class, 'update'], ['as' => 'ldm.groups.update']);
        $routes->get('groups/delete/', [GroupController::class, 'delete'], ['as' => 'ldm.groups.delete']);

        // Department routes
        $routes->get('departments/', [DepartmentController::class, 'index'], ['as' => 'ldm.departments']);
        $routes->post('departments/', [DepartmentController::class, 'create'], ['as' => 'ldm.departments.create']);
        $routes->get('departments/edit/(:num)/', [DepartmentController::class, 'edit'], ['as' => 'ldm.departments.edit']);
        $routes->post('departments/update/(:num)/', [DepartmentController::class, 'update'], ['as' => 'ldm.departments.update']);
        $routes->get('departments/delete/', [DepartmentController::class, 'delete'], ['as' => 'ldm.departments.delete']);

        // Unit routes
        $routes->get('units/', [UnitController::class, 'index'], ['as' => 'ldm.units']);
        $routes->post('units/all', [UnitController::class, 'allUnits'], ['as' => 'ldm.units.all']);
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
        $routes->get('jobs/delete/(:num)/', [JobController::class, 'delete'], ['as' => 'ldm.jobs.delete']);

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

        $routes->get('dashboard/competencies/', [CompetencyMappingController::class, 'dashboard'], ['as' => 'ldm.competencies.mapping.dashboard']);
    });

    // Employee Routes
    $routes->group('employee', ['filter' => 'LDMCheck'], function ($routes) {
        $routes->get('all/', [EmployeeController::class, 'index'], ['as' => 'ldm.employee']);
        $routes->post('create/', [EmployeeController::class, 'create'], ['as' => 'ldm.employee.create']);
        $routes->get('edit/(:num)/', [EmployeeController::class, 'edit'], ['as' => 'ldm.employee.edit']);
        $routes->post('update/(:num)/', [EmployeeController::class, 'update'], ['as' => 'ldm.employee.update']);
        $routes->get('delete/', [EmployeeController::class, 'delete'], ['as' => 'ldm.employee.delete']);
        $routes->get('activate/(:num)/', [EmployeeController::class, 'activate'], ['as' => 'ldm.employee.activate']);
        $routes->post('line-manager/', [EmployeeController::class, 'getEmployeeLineManager'], ['as' => 'ldm.employee.line.manager']);

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
        $routes->post('fetch-interventions/', [EmployeeInterventionMappingController::class, 'fetchInterventions'], ['as' => 'ldm.intervention.fetch']);
        $routes->post('fetch-classes/', [EmployeeInterventionMappingController::class, 'fetchClasses'], ['as' => 'ldm.intervention.class.fetch']);
        $routes->get('fetch-employees/(:num)/', [EmployeeInterventionMappingController::class, 'fetchEligibleEmployees'], ['as' => 'ldm.intervention.employees.fetch']);
    });

    $routes->group('trainer', ['filter' => 'TrainerCheck'], function ($routes) {
        $routes->get('attendance/', [InterventionAttendanceController::class, 'index'], ['as' => 'ldm.intervention.attendance']);
        $routes->post('attendance/', [InterventionAttendanceController::class, 'create'], ['as' => 'ldm.intervention.attendance.create']);
        $routes->get('attendance/format', [InterventionAttendanceController::class, 'format'], ['as' => 'ldm.intervention.attendance.format']);
        $routes->post('attendance/preview', [InterventionAttendanceController::class, 'previewUpload'], ['as' => 'ldm.intervention.attendance.preview']);

        $routes->get('feedback/', [ParticipantFeedbackController::class, 'index'], ['as' => 'ldm.feedback']);
        $routes->post('feedback/', [ParticipantFeedbackController::class, 'create'], ['as' => 'ldm.feedback.create']);
        $routes->get('feedback/edit/(:num)/', [ParticipantFeedbackController::class, 'edit'], ['as' => 'ldm.feedback.edit']);
        $routes->post('feedback/update/(:num)/', [ParticipantFeedbackController::class, 'update'], ['as' => 'ldm.feedback.update']);
        $routes->post('feedback/delete/(:num)/', [ParticipantFeedbackController::class, 'delete'], ['as' => 'ldm.feedback.delete']);
    });

    $routes->group('dashboard', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('pdp/', [InterventionVendorController::class, 'index'], ['as' => 'ldm.dashboard.pdp']);
        $routes->get('adp/', [InterventionVendorController::class, 'index'], ['as' => 'ldm.dashboard.adp']);
    });

    $routes->group('reports', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('competencies/', [ReportController::class, 'index'], ['as' => 'ldm.reports.competencies']);
        $routes->get('contracts/', [ReportController::class, 'index'], ['as' => 'ldm.reports.contracts']);
        $routes->get('interventions/', [ReportController::class, 'index'], ['as' => 'ldm.reports.interventions']);
        $routes->get('attendance/', [ReportController::class, 'index'], ['as' => 'ldm.reports.attendance']);
        $routes->get('feedback/', [ReportController::class, 'index'], ['as' => 'ldm.reports.feedback']);
    });

    $routes->get('login/', [AuthController::class, 'index'], ['as' => 'ldm.login']);
    $routes->post('login/', [AuthController::class, 'login'], ['as' => 'ldm.login.auth']);
    $routes->get('logout/', [AuthController::class, 'logout'], ['as' => 'ldm.logout']);
    $routes->get('forgot/password', [AuthController::class, 'forgotPassword'], ['as' => 'ldm.forgot.password']);
    $routes->post('forgot/password', [AuthController::class, 'handleForgotPassword'], ['as' => 'ldm.retrieve.password']);
});

