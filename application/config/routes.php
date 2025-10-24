<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "routes_dupak.php";
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
| -------------------------------------------------------------------------
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
$route['default_controller'] 							= 'DashboardController';

$route['dashboard-front'] 								= 'front/DashboardController/index';
$route['sendEmail'] 									= 'DashboardController/sendEmail';


$route['admin'] 									= 'admin/auth';
$route[EncryptLink('login')] 						= 'admin/auth/login';
$route['logout'] 									= 'admin/auth/logout';

$route[EncryptLink('dashboard')]					= 'admin/Dashboard/index';


$route[EncryptLink('potensi')]						= 'potensi/GrafikController/index';
$route['chart-potensi/get/(:any)'] 					= 'potensi/GrafikController/get_chart_potensi/$1';

$route[EncryptLink('penerimaan')]					= 'potensi/GrafikController/penerimaan';
$route['chart-penerimaan/get/(:any)'] 				= 'potensi/GrafikController/get_chart_penerimaan/$1';


$route[EncryptLink('efektivitas')]					= 'grafik/EfektivitasController/index';
$route['chart-efektivitas/get/(:any)'] 				= 'grafik/EfektivitasController/get_chart/$1';


$route['master-mkecamatan-get/(:any)'] 				= 'master/MasterController/get_Mkecamatan/$1';
$route['master-mkecamatan-list'] 					= 'master/MasterController/list_Mkecamatan';

$route[EncryptLink('realisasi-penerimaan')] 							= 'penerimaan/RealisasiController/index';
$route['realisasi-penerimaan-prev'] 									= 'penerimaan/RealisasiController/prev_laporan';
$route['realisasi-penerimaan-pdf/(:any)/(:any)/(:any)/(:any)'] 			= 'penerimaan/RealisasiController/pdf_laporan/$1/$2/$3/$4';
$route['realisasi-penerimaan-excel/(:any)/(:any)/(:any)/(:any)'] 		= 'penerimaan/RealisasiController/excel_laporan/$1/$2/$3/$4';

$route[EncryptLink('evaluasi-penerimaan')] 								= 'penerimaan/EvaluasiController/index';
$route['evaluasi-penerimaan-prev'] 										= 'penerimaan/EvaluasiController/prev_laporan';
$route['evaluasi-penerimaan-pdf/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'penerimaan/EvaluasiController/pdf_laporan/$1/$2/$3/$4/$5';
$route['evaluasi-penerimaan-excel/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'penerimaan/EvaluasiController/excel_laporan/$1/$2/$3/$4/$5';


$route[EncryptLink('rekap-op')] 									= 'rekap/RekapObjekPajakController/index';
$route['rekap-op-prev'] 											= 'rekap/RekapObjekPajakController/prev_laporan';
$route['rekap-op-pdf/(:any)/(:any)/(:any)/(:any)'] 					= 'rekap/RekapObjekPajakController/pdf_laporan/$1/$2/$3/$4';
$route['rekap-op-excel/(:any)/(:any)/(:any)/(:any)'] 				= 'rekap/RekapObjekPajakController/excel_laporan/$1/$2/$3/$4';


$route[EncryptLink('rekap-dhkp')] 									= 'rekap/RekapDhkpController/index';
$route['rekap-dhkp-prev'] 											= 'rekap/RekapDhkpController/prev_laporan';
$route['rekap-dhkp-pdf/(:any)/(:any)/(:any)/(:any)'] 				= 'rekap/RekapDhkpController/pdf_laporan/$1/$2/$3/$4';
$route['rekap-dhkp-excel/(:any)/(:any)/(:any)/(:any)'] 				= 'rekap/RekapDhkpController/excel_laporan/$1/$2/$3/$4';


$route[EncryptLink('cari-nop')]										= 'pencarian/CariNopController/index';
$route['cari-nop/getTable']		 	 								= 'pencarian/CariNopController/get';

$route[EncryptLink('kecamatan')]										= 'master/KecamatanController/index';
$route['kecamatan/getTable']		 	 								= 'master/KecamatanController/get';
$route[EncryptLink('kecamatan/add')]									= 'master/KecamatanController/add';
$route['kecamatan-edit/(:any)']											= 'master/KecamatanController/edit/$1';
$route['kecamatan-insert'] 												= 'master/KecamatanController/insert';
$route['kecamatan-update'] 												= 'master/KecamatanController/update';
$route['kecamatan-delete'] 												= 'master/KecamatanController/delete';


$route[EncryptLink('master-group')]							= 'master/MasterGroupController/index';
$route[EncryptLink('master-group/add')]						= 'master/MasterGroupController/add';
$route['master-group/getTable']		 	 					= 'master/MasterGroupController/get';
$route['master-group/edit/(:any)']							= 'master/MasterGroupController/edit/$1';
$route['master-group/insert'] 								= 'master/MasterGroupController/insert';
$route['master-group/update'] 								= 'master/MasterGroupController/update';
$route['master-group/hapus'] 								= 'master/MasterGroupController/hapus';


$route[EncryptLink('manajemen-group-user')]							= 'admin/ManajemenGroupController/index';
$route['manajemen-group-user/get-manajemen']						= 'admin/ManajemenGroupController/get_manajemen';
$route['manajemen-group-user/tambah-group']							= 'admin/ManajemenGroupController/tambah_group';
$route['manajemen-group-user/hapus-group'] 		    				= 'admin/ManajemenGroupController/hapus_group';

$route['manajemen-group-user/tambah-menu/(:any)']					= 'admin/ManajemenGroupController/tambah_menu/$1';
$route['manajemen-group-user/list-menu/(:any)']						= 'admin/ManajemenGroupController/list_menu/$1';
$route['manajemen-group-user/simpan-menu']							= 'admin/ManajemenGroupController/simpan_menu';
$route['manajemen-group-user/hapus-menu'] 		    				= 'admin/ManajemenGroupController/hapus_menu';


$route['dashboard/get_tree'] 						= 'admin/dashboard/get_tree';
$route['dashboard/mpdf'] 							= 'admin/dashboard/mpdf';

$route[EncryptLink('data-user')] 					= 'admin/UserController';
$route['data-user/get'] 							= 'admin/UserController/get';
$route['data-user/get-user'] 						= 'admin/UserController/get_user';

$route['data-user/getmax'] 							= 'admin/UserController/getmax';
$route['data-user/getkab'] 							= 'admin/UserController/get_combo_kab';
$route['data-user/getprov'] 						= 'admin/UserController/get_combo_prov';
$route['data-user/get_akses_grup'] 					= 'admin/UserController/get_combo_grup_akses';
$route['data-user/getinstansi'] 					= 'admin/UserController/get_combo_instansi';
$route['data-user/add'] 							= 'admin/UserController/add';
$route['data-user/insert'] 							= 'admin/UserController/insert';
$route['data-user/update'] 							= 'admin/UserController/update';
$route['data-user/edit/(:any)'] 					= 'admin/UserController/edit/$1';
$route['data-user/del/(:any)'] 						= 'admin/UserController/del/$1';
$route['data-user/cek-user'] 						= 'admin/UserController/cek_user';
$route['data-user/get-dop'] 						= 'admin/UserController/get_dop';

$route[EncryptLink('user-profile')] 					= 'admin/UserController/user_profile';
$route[EncryptLink('activity')] 						= 'admin/ActivityController';
$route['activity/get'] 									= 'admin/ActivityController/get';

$route[EncryptLink('notifikasi')] 						= 'admin/NotifikasiController';
$route['notifikasi/get'] 								= 'admin/NotifikasiController/get';

$route['notifikasi/get2'] 								= 'admin/NotifikasiController/get2';
$route['notifikasi/update']								= 'admin/NotifikasiController/update';

$route[EncryptLink('manual-book')] 						= 'admin/ManualController';
$route['manual-book/get'] 								= 'admin/ManualController/get';
$route['manual-book/preview'] 							= 'admin/ManualController/preview';
$route['get-user-profile'] 								= 'admin/UserController/get_user_profile';
$route['get-user-activity'] 							= 'admin/UserController/get_user_activity';
$route['cek-password'] 									= 'admin/UserController/cek_password';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

function EncryptLink($link='')
{
	$res = str_replace('=','',base64_encode($link));
	return $res;
}
