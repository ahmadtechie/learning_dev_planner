<?php

use App\Controllers\CompetencyFramework\CompetencyController;
use App\Controllers\CompetencyFramework\CompetencyMappingController;
use App\Controllers\CompetencyFramework\JobController;
use App\Controllers\DevelopmentCycle\DevelopmentCycleController;
use App\Controllers\Employee\EmployeeController;
use App\Controllers\Employee\LineManagerController;
use App\Controllers\OrgStructure\DepartmentController;
use App\Controllers\OrgStructure\DivisionController;
use App\Controllers\OrgStructure\GroupController;
use App\Controllers\OrgStructure\UnitController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');


// Define a route group for the "ldm" namespace
$routes->group('ldm', function ($routes) {
    $routes->group('structure', function ($routes) {
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
        $routes->post('units/', [UnitController::class, 'create'], ['as' => 'ldm.units.create']);
        $routes->get('units/edit/(:num)/', [UnitController::class, 'edit'], ['as' => 'ldm.units.edit']);
        $routes->post('units/update/(:num)/', [UnitController::class, 'update'], ['as' => 'ldm.units.update']);
        $routes->get('units/delete/(:num)/', [UnitController::class, 'delete'], ['as' => 'ldm.units.delete']);
    });

    $routes->group('competency', function ($routes) {
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

        $routes->get('dashboard/', [CompetencyMappingController::class, 'dashboard'], ['as' => 'ldm.competencies.mapping.dashboard']);
    });

    // Employee Routes
    $routes->group('employee', function ($routes) {
        $routes->get('all/', [EmployeeController::class, 'index'], ['as' => 'ldm.employee']);
        $routes->post('create/', [EmployeeController::class, 'create'], ['as' => 'ldm.employee.create']);
        $routes->post('edit/(:num)/', [EmployeeController::class, 'edit'], ['as' => 'ldm.employee.edit']);
        $routes->post('update/(:num)/', [EmployeeController::class, 'update'], ['as' => 'ldm.employee.update']);
        $routes->post('delete/(:num)/', [EmployeeController::class, 'delete'], ['as' => 'ldm.employee.delete']);

        $routes->get('role/', [LineManagerController::class, 'index'], ['as' => 'ldm.line.manager']);
        $routes->post('role/', [LineManagerController::class, 'create'], ['as' => 'ldm.line.manager.create']);
    });

    // Line Manager Routes
    $routes->group('manager', function ($routes) {
        $routes->get('assign/', [LineManagerController::class, 'index'], ['as' => 'ldm.line.manager']);
        $routes->post('assign/', [LineManagerController::class, 'create'], ['as' => 'ldm.line.manager.create']);
        $routes->post('assign/edit/(:num)/', [LineManagerController::class, 'edit'], ['as' => 'ldm.line.manager.edit']);
        $routes->post('assign/update/(:num)/', [LineManagerController::class, 'update'], ['as' => 'ldm.line.manager.update']);
        $routes->post('assign/delete/(:num)/', [LineManagerController::class, 'delete'], ['as' => 'ldm.line.manager.delete']);
    });

    // Development Cycles
    $routes->get('cycle/', [DevelopmentCycleController::class, 'index'], ['as' => 'ldm.cycle']);
});

