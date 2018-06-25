<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| --------------------  -----------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['login/(:any)'] = 'Authentication/index/$1';
$route['register/user'] = 'Authentication/userRegistration';
$route['register/confirmation/(:any)'] = 'Authentication/emailConfirmation/$1';
$route['OPAC'] = 'Opac';
$route['admin'] = 'Admin';
$route['admin/dashboard'] = 'Admin';
$route['admin/add/school'] = 'Admin/viewAddSchool';
$route['admin/add/teacher'] = 'Admin/viewAddTeacher';
$route['admin/add/librarian'] = 'Admin/viewAddLibrarian';
$route['admin/add/student'] = 'Admin/viewAddStudent';
$route['admin/edit/school'] = 'Admin/viewEditSchool';
$route['admin/add/school/settings'] = 'Admin/viewDefaultSettings';
$route['admin/edit/teacher'] = 'Admin/viewEditTeacher';
$route['admin/edit/librarian'] = 'Admin/viewEditLibrarian';
$route['admin/edit/student'] = 'Admin/viewEditStudent';
$route['admin/edit/school'] = 'Admin/viewEditSchool';
$route['admin/edit/school/setting'] = 'Admin/viewEditSetting';
$route['admin/view/schools'] = 'Admin/viewListSchool';
$route['admin/view/teachers'] = 'Admin/viewListTeacher';
$route['admin/view/librarians'] = 'Admin/viewListLibrarian';
$route['admin/view/students'] = 'Admin/viewListStudent';
$route['admin/view/schools/(:num)'] = 'Admin/viewListSchool/$1';
$route['admin/view/teachers/(:num)'] = 'Admin/viewListTeacher/$1';
$route['admin/view/librarians/(:num)'] = 'Admin/viewListLibrarian/$1';
$route['admin/view/students/(:num)'] = 'Admin/viewListStudent/$1';
$route['admin/view/school/(:any)'] = 'Admin/viewSchool/$1';
$route['admin/view/teacher/(:any)'] = 'Admin/viewTeacher/$1';
$route['admin/view/librarian/(:any)'] = 'Admin/viewLibrarian/$1';
$route['admin/view/student/(:any)'] = 'Admin/viewListSchool/$1';
$route['student'] = 'User';
$route['student/dashboard'] = 'User';
$route['student/circulation'] = 'User/circulation';
$route['teacher'] = 'User';
$route['teacher/dashboard'] = 'User';
$route['teacher/circulation'] = 'User/circulation';
$route['librarian'] = 'Librarian';
$route['librarian/dashboard'] = 'Librarian';
$route['librarian/acquisition/new'] = 'Librarian/viewAddBook';
$route['librarian/acquisition/update'] = 'Librarian/viewUpdateBook';
$route['librarian/acquisition/view'] = 'Librarian/viewListBook';
$route['default_controller'] = 'Opac';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
