<?php

use App\Controllers\CompetencyFramework\CompetencyController;
use App\Controllers\CompetencyFramework\JobController;
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

$routes->get('ldm/divisions/', [DivisionController::class, 'index'], ['as' => 'ldm.divisions']);
$routes->post('ldm/divisions/', [DivisionController::class, 'create'], ['as' => 'ldm.divisions.create']);
$routes->get('ldm/divisions/edit/(:num)/', [DivisionController::class, 'edit'], ['as' => 'ldm.divisions.edit']);
$routes->post('ldm/divisions/update/(:num)/', [DivisionController::class, 'update'], ['as' => 'ldm.divisions.update']);
$routes->get('ldm/divisions/delete/(:num)/', [DivisionController::class, 'delete'], ['as' => 'ldm.divisions.delete']);

$routes->get('ldm/groups/', [GroupController::class, 'index'], ['as' => 'ldm.groups']);
$routes->post('ldm/groups/', [GroupController::class, 'create'], ['as' => 'ldm.groups.create']);
$routes->get('ldm/groups/edit/(:num)/', [GroupController::class, 'edit'], ['as' => 'ldm.groups.edit']);
$routes->post('ldm/groups/update/(:num)/', [GroupController::class, 'update'], ['as' => 'ldm.groups.update']);
$routes->get('ldm/groups/delete/(:num)/', [GroupController::class, 'delete'], ['as' => 'ldm.groups.delete']);

$routes->get('ldm/departments/', [DepartmentController::class, 'index'], ['as' => 'ldm.departments']);
$routes->post('ldm/departments/', [DepartmentController::class, 'create'], ['as' => 'ldm.departments.create']);
$routes->get('ldm/departments/edit/(:num)/', [DepartmentController::class, 'edit'], ['as' => 'ldm.departments.edit']);
$routes->post('ldm/departments/update/(:num)/', [DepartmentController::class, 'update'], ['as' => 'ldm.departments.update']);
$routes->get('ldm/departments/delete/(:num)/', [DepartmentController::class, 'delete'], ['as' => 'ldm.departments.delete']);

$routes->get('ldm/units/', [UnitController::class, 'index'], ['as' => 'ldm.units']);
$routes->post('ldm/units/', [UnitController::class, 'create'], ['as' => 'ldm.units.create']);
$routes->get('ldm/units/edit/(:num)', [UnitController::class, 'edit'], ['as' => 'ldm.units.edit']);
$routes->post('ldm/units/update/(:num)', [UnitController::class, 'update'], ['as' => 'ldm.units.update']);
$routes->get('ldm/units/delete/(:num)', [UnitController::class, 'delete'], ['as' => 'ldm.units.delete']);

$routes->get('ldm/jobs/', [JobController::class, 'index'], ['as' => 'ldm.jobs']);
$routes->post('ldm/jobs/', [JobController::class, 'create'], ['as' => 'ldm.jobs.create']);
$routes->get('ldm/jobs/edit/(:num)', [JobController::class, 'edit'], ['as' => 'ldm.jobs.edit']);
$routes->post('ldm/jobs/update/(:num)', [JobController::class, 'update'], ['as' => 'ldm.jobs.update']);
$routes->get('ldm/jobs/delete/(:num)', [JobController::class, 'delete'], ['as' => 'ldm.jobs.delete']);

$routes->get('ldm/competency/', [CompetencyController::class, 'index'], ['as' => 'ldm.competency']);
$routes->post('ldm/competency/', [CompetencyController::class, 'create'], ['as' => 'ldm.competency.create']);
$routes->get('ldm/competency/edit/(:num)', [CompetencyController::class, 'edit'], ['as' => 'ldm.competency.edit']);
$routes->post('ldm/competency/update/(:num)', [CompetencyController::class, 'update'], ['as' => 'ldm.competency.update']);
$routes->get('ldm/competency/delete/(:num)', [CompetencyController::class, 'delete'], ['as' => 'ldm.competency.delete']);