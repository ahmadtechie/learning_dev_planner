<?php

use App\Controllers\AuthController;
use App\Controllers\CompetencyFramework\CompetencyController;
use App\Controllers\CompetencyFramework\CompetencyMappingController;
use App\Controllers\CompetencyFramework\JobController;
use App\Controllers\DevelopmentContracting\DevelopmentRatingController;
use App\Controllers\DevelopmentCycle\DevelopmentCycleController;
use App\Controllers\Employee\EmployeeController;
use App\Controllers\Employee\EmployeeInviteController;
use App\Controllers\Employee\LineManagerController;
use App\Controllers\EmployeeCSVController;
use App\Controllers\Home;
use App\Controllers\InterventionManagement\AssignInterventionController;
use App\Controllers\InterventionManagement\InterventionAttendanceController;
use App\Controllers\InterventionManagement\InterventionTypeController;
use App\Controllers\OrgStructure\DepartmentController;
use App\Controllers\OrgStructure\DivisionController;
use App\Controllers\OrgStructure\GroupController;
use App\Controllers\OrgStructure\UnitController;
use App\Controllers\ReportController;
use App\Controllers\Trainer\TrainerController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->get('/', [Home::class, 'index'], ['as' => 'ldm.home']);
    $routes->get('/home', [Home::class, 'index'], ['as' => 'ldm.home.dashboard']);
});


// Define a route group for the "ldm" namespace
$routes->group('ldm', function ($routes) {
    $routes->group('structure', ['filter' => 'AuthCheck'], function ($routes) {
        // Division routes
        $routes->get('divisions/', [DivisionController::class, 'index'], ['as' => 'ldm.divisions']);
        $routes->post('divisions/', [DivisionController::class, 'create'], ['as' => 'ldm.divisions.create']);
        $routes->get('divisions/edit/(:num)/', [DivisionController::class, 'edit'], ['as' => 'ldm.divisions.edit']);
        $routes->post('divisions/update/(:num)/', [DivisionController::class, 'update'], ['as' => 'ldm.divisions.update']);
        $routes->get('divisions/delete/(:num)/', [DivisionController::class, 'delete'], ['as' => 'ldm.divisions.delete']);

        // Group routes
        $routes->get('groups/', [GroupController::class, 'index'], ['as' => 'ldm.groups']);
        $routes->post('groups/', [GroupController::class, 'create'], ['as' => 'ldm.groups.create']);
        $routes->get('groups/edit/(:num)/', [GroupController::class, 'edit'], ['as' => 'ldm.groups.edit']);
        $routes->post('groups/update/(:num)/', [GroupController::class, 'update'], ['as' => 'ldm.groups.update']);
        $routes->get('groups/delete/(:num)/', [GroupController::class, 'delete'], ['as' => 'ldm.groups.delete']);

        // Department routes
        $routes->get('departments/', [DepartmentController::class, 'index'], ['as' => 'ldm.departments']);
        $routes->post('departments/', [DepartmentController::class, 'create'], ['as' => 'ldm.departments.create']);
        $routes->get('departments/edit/(:num)/', [DepartmentController::class, 'edit'], ['as' => 'ldm.departments.edit']);
        $routes->post('departments/update/(:num)/', [DepartmentController::class, 'update'], ['as' => 'ldm.departments.update']);
        $routes->get('departments/delete/(:num)/', [DepartmentController::class, 'delete'], ['as' => 'ldm.departments.delete']);

        // Unit routes
        $routes->get('units/', [UnitController::class, 'index'], ['as' => 'ldm.units']);
        $routes->post('units/all', [UnitController::class, 'allUnits'], ['as' => 'ldm.units.all']);
        $routes->post('units/', [UnitController::class, 'create'], ['as' => 'ldm.units.create']);
        $routes->get('units/edit/(:num)/', [UnitController::class, 'edit'], ['as' => 'ldm.units.edit']);
        $routes->post('units/update/(:num)/', [UnitController::class, 'update'], ['as' => 'ldm.units.update']);
        $routes->get('units/delete/(:num)/', [UnitController::class, 'delete'], ['as' => 'ldm.units.delete']);
    });

    $routes->group('competency', ['filter' => 'AuthCheck'], function ($routes) {
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
        $routes->get('framework/delete/(:num)', [CompetencyController::class, 'delete'], ['as' => 'ldm.competencies.delete']);

        // Job-Competency Mapping
        $routes->get('mapping/', [CompetencyMappingController::class, 'index'], ['as' => 'ldm.competencies.mapping']);
        $routes->post('mapping/', [CompetencyMappingController::class, 'create'], ['as' => 'ldm.competencies.mapping.create']);
        $routes->get('mapping/edit/(:num)/', [CompetencyMappingController::class, 'edit'], ['as' => 'ldm.competencies.mapping.edit']);
        $routes->post('mapping/update/(:num)/', [CompetencyMappingController::class, 'update'], ['as' => 'ldm.competencies.mapping.update']);
        $routes->get('mapping/delete/(:num)/', [CompetencyMappingController::class, 'delete'], ['as' => 'ldm.competencies.mapping.delete']);

        $routes->get('dashboard/competencies/', [CompetencyMappingController::class, 'dashboard'], ['as' => 'ldm.competencies.mapping.dashboard']);
    });

    // Employee Routes
    $routes->group('employee', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('all/', [EmployeeController::class, 'index'], ['as' => 'ldm.employee']);
        $routes->post('create/', [EmployeeController::class, 'create'], ['as' => 'ldm.employee.create']);
        $routes->get('edit/(:num)/', [EmployeeController::class, 'edit'], ['as' => 'ldm.employee.edit']);
        $routes->post('update/(:num)/', [EmployeeController::class, 'update'], ['as' => 'ldm.employee.update']);
        $routes->get('delete/(:num)/', [EmployeeController::class, 'delete'], ['as' => 'ldm.employee.delete']);
        $routes->get('activate/(:num)/', [EmployeeController::class, 'activate'], ['as' => 'ldm.employee.activate']);
        $routes->post('line-manager/', [EmployeeController::class, 'getEmployeeLineManager'], ['as' => 'ldm.employee.line.manager']);

        $routes->group('org/map/', function ($routes) {
            $routes->get('', [EmployeeController::class, 'map'], ['as' => 'ldm.map.org']);
            $routes->post('', [EmployeeController::class, 'createMapping'], ['as' => 'ldm.map.org.create']);
        });

        $routes->get('invite/', [EmployeeInviteController::class, 'index'], ['as' => 'ldm.employee.invite']);
        $routes->post('invite/', [EmployeeInviteController::class, 'create'], ['as' => 'ldm.employee.invite.create']);

        $routes->get('upload/', [EmployeeCSVController::class, 'index'], ['as' => 'ldm.employee.upload']);
        $routes->get('upload/format', [EmployeeCSVController::class, 'downloadTemplate'], ['as' => 'ldm.employee.format']);
        $routes->post('upload/', [EmployeeCSVController::class, 'index'], ['as' => 'ldm.employee.upload.create']);
        $routes->post('upload/preview', [EmployeeCSVController::class, 'previewUpload'], ['as' => 'ldm.employee.upload.preview']);

        // Line Manager Routes
        $routes->group('manager', function ($routes) {
            $routes->get('assign/', [LineManagerController::class, 'index'], ['as' => 'ldm.line.manager']);
            $routes->post('assign/', [LineManagerController::class, 'create'], ['as' => 'ldm.line.manager.create']);
            $routes->post('assign/edit/(:num)/', [LineManagerController::class, 'edit'], ['as' => 'ldm.line.manager.edit']);
            $routes->post('assign/update/(:num)/', [LineManagerController::class, 'update'], ['as' => 'ldm.line.manager.update']);
            $routes->post('assign/delete/(:num)/', [LineManagerController::class, 'delete'], ['as' => 'ldm.line.manager.delete']);
        });
    });

    // Development Cycles
    $routes->group('development', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('cycle/', [DevelopmentCycleController::class, 'index'], ['as' => 'ldm.cycle']);
        $routes->post('cycle/', [DevelopmentCycleController::class, 'create'], ['as' => 'ldm.cycle.create']);
        $routes->get('cycle/edit/(:num)/', [DevelopmentCycleController::class, 'edit'], ['as' => 'ldm.cycle.edit']);
        $routes->post('cycle/update/(:num)/', [DevelopmentCycleController::class, 'update'], ['as' => 'ldm.cycle.update']);
        $routes->post('cycle/delete/(:num)/', [DevelopmentCycleController::class, 'delete'], ['as' => 'ldm.cycle.delete']);
    });

    $routes->group('contracting', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('self/', [DevelopmentRatingController::class, 'index'], ['as' => 'ldm.rating.self']);
        $routes->post('self/', [DevelopmentRatingController::class, 'create'], ['as' => 'ldm.rating.self.create']);
        $routes->get('self/edit/(:num)/', [DevelopmentRatingController::class, 'edit'], ['as' => 'ldm.rating.self.edit']);
        $routes->post('self/update/(:num)/', [DevelopmentRatingController::class, 'update'], ['as' => 'ldm.rating.self.update']);
        $routes->post('self/delete/(:num)/', [DevelopmentRatingController::class, 'delete'], ['as' => 'ldm.rating.self.delete']);

        $routes->get('validate/', [DevelopmentRatingController::class, 'validateRating'], ['as' => 'ldm.rating.validate']);
        $routes->post('validate/', [DevelopmentRatingController::class, 'updateLineManagerRating'], ['as' => 'ldm.rating.validate.update']);
    });

    $routes->group('intervention', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('type/', [InterventionTypeController::class, 'index'], ['as' => 'ldm.intervention.type']);
        $routes->post('type/', [InterventionTypeController::class, 'create'], ['as' => 'ldm.intervention.type.create']);
        $routes->get('type/edit/(:num)/', [InterventionTypeController::class, 'edit'], ['as' => 'ldm.intervention.type.edit']);
        $routes->post('type/update/(:num)/', [InterventionTypeController::class, 'update'], ['as' => 'ldm.intervention.type.update']);
        $routes->post('type/delete/(:num)/', [InterventionTypeController::class, 'delete'], ['as' => 'ldm.intervention.type.delete']);

        $routes->get('assign/', [AssignInterventionController::class, 'index'], ['as' => 'ldm.intervention.assign']);
        $routes->post('assign/', [AssignInterventionController::class, 'create'], ['as' => 'ldm.intervention.assign.create']);
        $routes->get('assign/edit/(:num)/', [AssignInterventionController::class, 'edit'], ['as' => 'ldm.intervention.assign.edit']);
        $routes->post('assign/update/(:num)/', [AssignInterventionController::class, 'update'], ['as' => 'ldm.intervention.assign.update']);
        $routes->post('assign/delete/(:num)/', [AssignInterventionController::class, 'delete'], ['as' => 'ldm.intervention.assign.delete']);

        $routes->get('attendance/', [InterventionAttendanceController::class, 'index'], ['as' => 'ldm.intervention.attendance']);
        $routes->post('attendance/', [InterventionAttendanceController::class, 'create'], ['as' => 'ldm.intervention.attendance.create']);
        $routes->get('attendance/edit/(:num)/', [InterventionAttendanceController::class, 'edit'], ['as' => 'ldm.intervention.attendance.edit']);
        $routes->post('attendance/update/(:num)/', [InterventionAttendanceController::class, 'update'], ['as' => 'ldm.intervention.attendance.update']);
        $routes->post('attendance/delete/(:num)/', [InterventionAttendanceController::class, 'delete'], ['as' => 'ldm.intervention.attendance.delete']);
    });

    $routes->group('trainer', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('vendor/', [TrainerController::class, 'index'], ['as' => 'ldm.trainer']);
        $routes->post('vendor/', [TrainerController::class, 'create'], ['as' => 'ldm.trainer.create']);
        $routes->get('vendor/edit/(:num)/', [TrainerController::class, 'edit'], ['as' => 'ldm.trainer.edit']);
        $routes->post('vendor/update/(:num)/', [TrainerController::class, 'update'], ['as' => 'ldm.trainer.update']);
        $routes->post('vendor/delete/(:num)/', [TrainerController::class, 'delete'], ['as' => 'ldm.trainer.delete']);
    });

    $routes->group('dashboard', ['filter' => 'AuthCheck'], function ($routes) {
        $routes->get('pdp/', [TrainerController::class, 'index'], ['as' => 'ldm.dashboard.pdp']);
        $routes->get('adp/', [TrainerController::class, 'index'], ['as' => 'ldm.dashboard.adp']);
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

