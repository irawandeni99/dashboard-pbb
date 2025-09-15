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
//$route['dashboard-simple'] 								= 'DashboardController';

$route['dashboard-front'] 								= 'front/DashboardController/index';

$route[EncryptLink('profil-pemda')] 					= 'DashboardController/profil';
$route['sendEmail'] 									= 'DashboardController/sendEmail';



$route[EncryptLink('login-ekapip')] 					= 'admin/auth/login_ekapip';


$route['admin'] 									= 'admin/auth';
$route[EncryptLink('login')] 						= 'admin/auth/login';
$route[EncryptLink('login-ihp')] 					= 'admin/auth/login_ihp';
$route[EncryptLink('login-tlhp-itjen')] 			= 'admin/auth/login_tlhp_itjen';
$route[EncryptLink('login-tlhp-kemendagri')] 		= 'admin/auth/login_tlhp_kemendagri';
$route[EncryptLink('login-penilaian')] 				= 'admin/auth/login_penilaian';
$route[EncryptLink('login-review')] 				= 'admin/auth/login_review';
$route['logout'] 									= 'admin/auth/logout';
$route[EncryptLink('dashboard')]					= 'admin/Dashboard/index';



$route[EncryptLink('potensi')]						= 'potensi/GrafikController/index';
$route['chart-potensi/get/(:any)'] 					= 'potensi/GrafikController/get_chart_potensi/$1';

$route[EncryptLink('penerimaan')]						= 'potensi/GrafikController/penerimaan';
$route['chart-penerimaan/get/(:any)'] 					= 'potensi/GrafikController/get_chart_penerimaan/$1';


$route['master-mkecamatan-get/(:any)'] 				= 'master/MasterController/get_Mkecamatan/$1';








$route['get-chart-penilaian'] 					     = 'admin/Dashboard/get_chart_penilaian';

//$route['get-chart-keu'] 					         = 'admin/Dashboard/get_chart_keu';

$route['dashboard/get_tree'] 						= 'admin/dashboard/get_tree';
$route['dashboard/mpdf'] 							= 'admin/dashboard/mpdf';

$route[EncryptLink('data-user')] 					= 'admin/UserController';
$route['data-user/get'] 							= 'admin/UserController/get';
//$route['data-user/get-user-pemda'] 					= 'admin/UserController/get_user_pemda';
$route['data-user/get-user'] 						= 'admin/UserController/get_user';

$route['data-user/get-user-kemendagri'] 			= 'admin/UserController/get_user_kemendagri';
$route['data-user/getmax'] 							= 'admin/UserController/getmax';
$route['data-user/getkab'] 							= 'admin/UserController/get_combo_kab';
$route['data-user/getprov'] 						= 'admin/UserController/get_combo_prov';
$route['data-user/getprovfront'] 					= 'admin/UserController/get_combo_prov_front';
$route['data-user/get_akses_grup'] 					= 'admin/UserController/get_combo_grup_akses';
$route['data-user/getinspektorat'] 					= 'admin/UserController/get_combo_inspektorat';
$route['data-user/getinstansi'] 					= 'admin/UserController/get_combo_instansi';
$route['data-user/add'] 							= 'admin/UserController/add';
$route['data-user/insert'] 							= 'admin/UserController/insert';
$route['data-user/update'] 							= 'admin/UserController/update';
$route['data-user/edit/(:any)'] 					= 'admin/UserController/edit/$1';
$route['data-user/del/(:any)'] 						= 'admin/UserController/del/$1';
$route['data-user/cek-user'] 						= 'admin/UserController/cek_user';
$route['data-user/get-dop'] 						= 'admin/UserController/get_dop';







// KAPIP

// PROFIL

$route[EncryptLink('kapip-dataumum-profil-apip')]					= 'kapip/ProfilApipController/data_profil_apip';
$route['kapip-dataumum-profil-apip/getTable']		 	 			= 'kapip/ProfilApipController/get';
$route[EncryptLink('kapip-dataumum-profil-apip/add')]				= 'kapip/ProfilApipController/add';
$route['kapip-dataumum-profil-apip/insert'] 						= 'kapip/ProfilApipController/insert';
$route[EncryptLink('kapip-dataumum-profil-apip/triw')]				= 'kapip/ProfilApipController/triw';


//$route['kapip-dataumum-profil-apip/triw/(:any)/(:any)']				= 'kapip/ProfilApipController/triw/$1/$2';


// master apip

$route[EncryptLink('kapip-master-apip')]							= 'kapip/MasterApipController/data_apip';
$route[EncryptLink('kapip-master-apip/add')]						= 'kapip/MasterApipController/add';
$route['kapip-master-apip/getTable']		 	 					= 'kapip/MasterApipController/get';
$route['kapip-master-apip/edit/(:any)']								= 'kapip/MasterApipController/edit/$1';
$route['kapip-master-apip/insert'] 									= 'kapip/MasterApipController/insert';
$route['kapip-master-apip/update'] 									= 'kapip/MasterApipController/update';
$route['kapip-master-apip/hapus'] 									= 'kapip/MasterApipController/hapus';


// master group user

$route[EncryptLink('kapip-master-group')]							= 'kapip/MasterGroupController/data_apip';
$route[EncryptLink('kapip-master-group/add')]						= 'kapip/MasterGroupController/add';
$route['kapip-master-group/getTable']		 	 					= 'kapip/MasterGroupController/get';
$route['kapip-master-group/edit/(:any)']							= 'kapip/MasterGroupController/edit/$1';
$route['kapip-master-group/insert'] 								= 'kapip/MasterGroupController/insert';
$route['kapip-master-group/update'] 								= 'kapip/MasterGroupController/update';
$route['kapip-master-group/hapus'] 									= 'kapip/MasterGroupController/hapus';


$route[EncryptLink('kapip-master-referensi')]						= 'kapip/MasterReferensiController/index';
$route['kapip-master-referensi/simpan-file']						= 'kapip/MasterReferensiController/simpan_file';
$route['kapip-master-referensi/get-referensi/(:any)/(:any)']		= 'kapip/MasterReferensiController/get_referensi/$1/$2';
$route['kapip-master-referensi/hapus-file']							= 'kapip/MasterReferensiController/hapus_file';
$route['kapip-master-referensi/edit-file']							= 'kapip/MasterReferensiController/edit_file';


// Dashboard

$route['kapip-dashboard/get-simpulan']											= 'admin/Dashboard/get_simpulan';
$route['kapip-dashboard/get-table-simpulan/(:any)/(:any)']						= 'admin/Dashboard/get_table_simpulan/$1/$2';
$route['kapip-dashboard/simpan-simpulan']										= 'admin/Dashboard/simpan_simpulan';
//$route['kapip-penilaian/simpan-simpulan1']										= 'kapip/PenilaianController/simpan_simpulan1';


// pengaturan


$route[EncryptLink('kapip-Pengaturan-Manajemen-User')]							= 'kapip/PengaturanManajemenController/group';
$route['kapip-Pengaturan-Manajemen-User/get-manajemen/(:any)/(:any)']			= 'kapip/PengaturanManajemenController/get_manajemen/$1/$2';
$route['kapip-Pengaturan-Manajemen-User/tambah-elemen/(:any)/(:any)/(:any)']	= 'kapip/PengaturanManajemenController/tambah_elemen/$1/$2/$3';
$route['kapip-Pengaturan-Manajemen-User/list-elemen/(:any)/(:any)/(:any)']		= 'kapip/PengaturanManajemenController/list_elemen/$1/$2/$3';
$route['kapip-Pengaturan-Manajemen-User/simpan-elemen']							= 'kapip/PengaturanManajemenController/simpan_elemen';
$route['kapip-Pengaturan-Manajemen-User/hapus-elemen'] 		    				= 'kapip/PengaturanManajemenController/hapus_elemen';

$route['kapip-Pengaturan-Manajemen-User/setting-penilaian/(:any)/(:any)/(:any)']	= 'kapip/PengaturanManajemenController/setting_penilaian/$1/$2/$3';
$route['kapip-Pengaturan-Manajemen-User/get-simpulan']							= 'kapip/PengaturanManajemenController/get_simpulan';

$route['kapip-Pengaturan-Manajemen-User/tambah-menu/(:any)']		= 'kapip/PengaturanManajemenController/tambah_menu/$1';
$route['kapip-Pengaturan-Manajemen-User/list-menu/(:any)']			= 'kapip/PengaturanManajemenController/list_menu/$1';
$route['kapip-Pengaturan-Manajemen-User/simpan-menu']				= 'kapip/PengaturanManajemenController/simpan_menu';
$route['kapip-Pengaturan-Manajemen-User/hapus-menu'] 		    	= 'kapip/PengaturanManajemenController/hapus_menu';


$route[EncryptLink('kapip-pengaturan-copydata')]					= 'kapip/PengaturanManajemenController/list_copydata';
$route['kapip-Pengaturan-Awaltahun/get-awaltahun/(:any)/(:any)']	= 'kapip/PengaturanManajemenController/get_awaltahun/$1/$2';
$route['kapip-Pengaturan-Awaltahun/Copydata'] 		    			= 'kapip/PengaturanManajemenController/copydata';






$route['kapip-Pengaturan-Manajemen-User/tambah-topik/(:any)/(:any)/(:any)/(:any)']		= 'kapip/PengaturanManajemenController/tambah_topik/$1/$2/$3/$4';
$route['kapip-Pengaturan-Manajemen-User/list-topik/(:any)/(:any)/(:any)/(:any)']		= 'kapip/PengaturanManajemenController/list_topik/$1/$2/$3/$4';
$route['kapip-Pengaturan-Manajemen-User/simpan-topik']									= 'kapip/PengaturanManajemenController/simpan_topik';
$route['kapip-Pengaturan-Manajemen-User/hapus-topik'] 		    						= 'kapip/PengaturanManajemenController/hapus_topik';

$route['kapip-Pengaturan-Manajemen-User/tambah-group/(:any)/(:any)']			= 'kapip/PengaturanManajemenController/tambah_group/$1/$2';
$route['kapip-Pengaturan-Manajemen-User/list-group/(:any)/(:any)']				= 'kapip/PengaturanManajemenController/list_group/$1/$2';
$route['kapip-Pengaturan-Manajemen-User/simpan-group']							= 'kapip/PengaturanManajemenController/simpan_group';

$route['kapip-Pengaturan-Manajemen-User/hapus-group'] 		    				= 'kapip/PengaturanManajemenController/hapus_group';


$route['kapip-Pengaturan-Manajemen-User/get-manajemen-profil/(:any)/(:any)']	= 'kapip/PengaturanManajemenController/get_manajemen_profil/$1/$2';
$route['kapip-Pengaturan-Manajemen-User/tambah-profil/(:any)/(:any)/(:any)']	= 'kapip/PengaturanManajemenController/tambah_profil/$1/$2/$3';
$route['kapip-Pengaturan-Manajemen-User/list-profil/(:any)/(:any)/(:any)']		= 'kapip/PengaturanManajemenController/list_profil/$1/$2/$3';
$route['kapip-Pengaturan-Manajemen-User/simpan-profil']							= 'kapip/PengaturanManajemenController/simpan_profil';
$route['kapip-Pengaturan-Manajemen-User/tambah-profil/(:any)/(:any)/(:any)']	= 'kapip/PengaturanManajemenController/tambah_profil/$1/$2/$3';
$route['kapip-Pengaturan-Manajemen-User/list-profil/(:any)/(:any)/(:any)']		= 'kapip/PengaturanManajemenController/list_profil/$1/$2/$3';
$route['kapip-Pengaturan-Manajemen-User/hapus-group-profil'] 		    		= 'kapip/PengaturanManajemenController/hapus_group_profil';
$route['kapip-Pengaturan-Manajemen-User/hapus-profil'] 		    				= 'kapip/PengaturanManajemenController/hapus_profil';
$route['kapip-Pengaturan-Manajemen-User/tambah-group-profil/(:any)/(:any)']		= 'kapip/PengaturanManajemenController/tambah_group_profil/$1/$2';
$route['kapip-Pengaturan-Manajemen-User/simpan-group-profil']					= 'kapip/PengaturanManajemenController/simpan_group_profil';
$route['kapip-Pengaturan-Manajemen-User/list-group-profil/(:any)/(:any)']		= 'kapip/PengaturanManajemenController/list_group_profil/$1/$2';

$route['kapip-Pengaturan-Manajemen-User/simpan-kunci']							= 'kapip/PengaturanManajemenController/simpan_kunci';


$route[EncryptLink('kapip-master-penilaian/add')]								= 'kapip/MasterPenilaianController/add';
$route[EncryptLink('kapip-master-penilaian-mandiri')]							= 'kapip/MasterPenilaianController/data_master_penilaian';
$route[EncryptLink('kapip-master-penilaian-mandiri/add')]						= 'kapip/MasterPenilaianController/add';

$route['kapip-master-penilaian/getTable']		 	 			   				= 'kapip/MasterPenilaianController/get';
$route[EncryptLink('kapip-master-penilaian/elemen')]						 	= 'kapip/MasterPenilaianController/elemen';
$route['kapip-master-penilaian/get-elemen/(:any)/(:any)']						= 'kapip/MasterPenilaianController/get_elemen/$1/$2';
$route['kapip-master-penilaian/tambah-topik/(:any)/(:any)/(:any)']				= 'kapip/MasterPenilaianController/tambah_topik/$1/$2/$3';
$route['kapip-master-penilaian/simpan-topik']									= 'kapip/MasterPenilaianController/simpan_topik';
$route['kapip-master-penilaian/cek-topik/(:any)/(:any)/(:any)']					= 'kapip/MasterPenilaianController/cek_topik/$1/$2/$3';
$route['kapip-master-penilaian/list-level/(:any)/(:any)/(:any)/(:any)']			= 'kapip/MasterPenilaianController/list_level/$1/$2/$3/$4';
$route['kapip-master-penilaian/simpan-level']									= 'kapip/MasterPenilaianController/simpan_level';

$route['kapip-master-penilaian/edit-topik/(:any)/(:any)/(:any)/(:any)']			= 'kapip/MasterPenilaianController/edit_topik/$1/$2/$3/$4';
$route['kapip-master-penilaian/update-topik']									= 'kapip/MasterPenilaianController/update_topik';
$route['kapip-master-penilaian/tambah-level/(:any)/(:any)/(:any)/(:any)']		= 'kapip/MasterPenilaianController/tambah_level/$1/$2/$3/$4';
$route['kapip-master-penilaian/hapus-topik'] 		    						= 'kapip/MasterPenilaianController/hapus_topik';

$route['kapip-master-penilaian/tambah-penilaian']								= 'kapip/MasterPenilaianController/tambah_penilaian';
$route['kapip-master-penilaian/simpan-penilaian']								= 'kapip/MasterPenilaianController/simpan_penilaian';
$route['kapip-master-penilaian/hapus-level'] 		    						= 'kapip/MasterPenilaianController/hapus_level';
$route['kapip-master-penilaian/hapus-penilaian'] 		    					= 'kapip/MasterPenilaianController/hapus_penilaian';
$route['kapip-master-penilaian/edit-penilaian']						    		= 'kapip/MasterPenilaianController/edit_penilaian';
$route['kapip-master-penilaian/update-penilaian']								= 'kapip/MasterPenilaianController/update_penilaian';


$route['kapip-dataumum-profil-apip/get-profil1/(:any)/(:any)/(:any)']			= 'kapip/ProfilApipController/get_profil1/$1/$2/$3';
$route['kapip-dataumum-profil-apip/get-profil2/(:any)/(:any)/(:any)']			= 'kapip/ProfilApipController/get_profil2/$1/$2/$3';
$route['kapip-dataumum-profil-apip/get-profil5/(:any)/(:any)/(:any)']			= 'kapip/ProfilApipController/get_profil5/$1/$2/$3';
$route['kapip-dataumum-profil-apip/get-profil6/(:any)/(:any)/(:any)']			= 'kapip/ProfilApipController/get_profil6/$1/$2/$3';
$route['kapip-dataumum-profil-apip/get-profil7/(:any)/(:any)/(:any)']			= 'kapip/ProfilApipController/get_profil7/$1/$2/$3';
$route['kapip-dataumum-profil-apip/get-profil4/(:any)/(:any)']					= 'kapip/ProfilApipController/get_profil4/$1/$2';
$route['kapip-dataumum-profil-apip/get-profil4-cek/(:any)/(:any)']				= 'kapip/ProfilApipController/get_profil4_cek/$1/$2';
$route['kapip-dataumum-profil-apip/list-profil7/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']			= 'kapip/ProfilApipController/list_profil7/$1/$2/$3/$4/$5/$6';


$route['kapip-dataumum-profil-apip/map1'] 										= 'kapip/ProfilApipController/map1';
$route['kapip-dataumum-profil-apip/edit-profil1/(:any)/(:any)/(:any)/(:any)']	= 'kapip/ProfilApipController/edit_profil1/$1/$2/$3/$4';
$route['kapip-dataumum-profil-apip/edit-profil2/(:any)/(:any)/(:any)/(:any)']	= 'kapip/ProfilApipController/edit_profil2/$1/$2/$3/$4';
$route['kapip-dataumum-profil-apip/edit-profil5/(:any)/(:any)/(:any)/(:any)']	= 'kapip/ProfilApipController/edit_profil5/$1/$2/$3/$4';
$route['kapip-dataumum-profil-apip/edit-profil6/(:any)/(:any)/(:any)/(:any)']	= 'kapip/ProfilApipController/edit_profil6/$1/$2/$3/$4';
$route['kapip-dataumum-profil-apip/edit-profil7/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']	= 'kapip/ProfilApipController/edit_profil7/$1/$2/$3/$4/$5/$6';
$route['kapip-dataumum-profil-apip/edit-hprofil4/(:any)/(:any)/(:any)']			= 'kapip/ProfilApipController/edit_hprofil4/$1/$2/$3';


$route['kapip-dataumum-profil-apip/simpan-profil1']								= 'kapip/ProfilApipController/simpan_profil1';
$route['kapip-dataumum-profil-apip/simpan-profil2']								= 'kapip/ProfilApipController/simpan_profil2';
$route['kapip-dataumum-profil-apip/simpan-profil4']								= 'kapip/ProfilApipController/simpan_profil4';
$route['kapip-dataumum-profil-apip/simpan-profil5']								= 'kapip/ProfilApipController/simpan_profil5';
$route['kapip-dataumum-profil-apip/simpan-profil6']								= 'kapip/ProfilApipController/simpan_profil6';
$route['kapip-dataumum-profil-apip/simpan-profil7']								= 'kapip/ProfilApipController/simpan_profil7';
$route['kapip-dataumum-profil-apip/simpan-rinci-profil7']						= 'kapip/ProfilApipController/simpan_rinci_profil7';
$route['kapip-dataumum-profil-apip/hapus-rinci-p7'] 		    				= 'kapip/ProfilApipController/hapus_rincip7';
$route['kapip-dataumum-profil-apip/proses-hprofil7'] 		    				= 'kapip/ProfilApipController/proses_headerP7';
$route['kapip-dataumum-profil-apip/proses-hprofil4'] 		    				= 'kapip/ProfilApipController/proses_headerP4';
$route['kapip-dataumum-profil-apip/proses-dprofil7'] 		    				= 'kapip/ProfilApipController/proses_detailP7';


$route['kapip-dataumum-profil-apip/simpan-hprofil7']							= 'kapip/ProfilApipController/simpan_hprofil7';
$route['kapip-dataumum-profil-apip/simpan-dprofil7']							= 'kapip/ProfilApipController/simpan_dprofil7';
$route['kapip-dataumum-profil-apip/simpan-Eprofil7']							= 'kapip/ProfilApipController/simpan_Eprofil7';
$route['kapip-dataumum-profil-apip/hapus-hprofil7'] 		    				= 'kapip/ProfilApipController/hapus_hprofil7';
$route['kapip-dataumum-profil-apip/hapus-hprofil4'] 		    				= 'kapip/ProfilApipController/hapus_hprofil4';
$route['kapip-dataumum-profil-apip/hapus-dprofil7'] 		    				= 'kapip/ProfilApipController/hapus_dprofil7';
$route['kapip-dataumum-profil-apip/update-Hprofil7'] 		    				= 'kapip/ProfilApipController/update_Hprofil7';
$route['kapip-dataumum-profil-apip/update-Hprofil4'] 		    				= 'kapip/ProfilApipController/update_Hprofil4';
$route['kapip-dataumum-profil-apip/simpan-Hprofil4'] 		    				= 'kapip/ProfilApipController/simpan_Hprofil4';


$route[EncryptLink('kapip-penilaian-mandiri')]									= 'kapip/PenilaianController/data_penilaian';
$route['kapip-penilaian/getTable']		 	 			   						= 'kapip/PenilaianController/get';

$route[EncryptLink('kapip-penilaian/elemen')]		 							= 'kapip/PenilaianController/elemen';
$route['kapip-penilaian/get-elemen1/(:any)/(:any)/(:any)']						= 'kapip/PenilaianController/get_elemen1/$1/$2/$3';
$route['kapip-penilaian/get-elemen2/(:any)/(:any)/(:any)']						= 'kapip/PenilaianController/get_elemen2/$1/$2/$3';
$route['kapip-penilaian/get-elemen3/(:any)/(:any)/(:any)']						= 'kapip/PenilaianController/get_elemen3/$1/$2/$3';
$route['kapip-penilaian/get-elemen4/(:any)/(:any)/(:any)']						= 'kapip/PenilaianController/get_elemen4/$1/$2/$3';
$route['kapip-penilaian/get-elemen5/(:any)/(:any)/(:any)']						= 'kapip/PenilaianController/get_elemen5/$1/$2/$3';
$route['kapip-penilaian/get-elemen6/(:any)/(:any)/(:any)']						= 'kapip/PenilaianController/get_elemen6/$1/$2/$3';

$route['kapip-penilaian/get-simpulan1/(:any)/(:any)/(:any)']					= 'kapip/PenilaianController/get_simpulan1/$1/$2/$3';
$route['kapip-penilaian/get-table-simpulan/(:any)/(:any)']						= 'kapip/PenilaianController/get_table_simpulan/$1/$2';


$route['kapip-penilaian/simpan-simpulan1']										= 'kapip/PenilaianController/simpan_simpulan1';
$route['kapip-penilaian/status-simpulan']										= 'kapip/PenilaianController/status_simpulan';


$route['kapip-penilaian/simpan-elemen1']										= 'kapip/PenilaianController/simpan_elemen1';
$route['kapip-penilaian/simpan-elemen2']										= 'kapip/PenilaianController/simpan_elemen2';
$route['kapip-penilaian/simpan-elemen3']										= 'kapip/PenilaianController/simpan_elemen3';
$route['kapip-penilaian/simpan-elemen4']										= 'kapip/PenilaianController/simpan_elemen4';
$route['kapip-penilaian/simpan-elemen5']										= 'kapip/PenilaianController/simpan_elemen5';
$route['kapip-penilaian/simpan-elemen6']										= 'kapip/PenilaianController/simpan_elemen6';


$route['kapip-penilaian/simpan-verif']											= 'kapip/PenilaianController/simpan_verif';
$route['kapip-penilaian/simpan-file']											= 'kapip/PenilaianController/simpan_file';
$route['kapip-penilaian/hapus-file']											= 'kapip/PenilaianController/hapus_file';
$route['kapip-penilaian/edit-file']												= 'kapip/PenilaianController/edit_file';

$route['kapip-penilaian/get-pengawasan/(:any)/(:any)']		 					= 'kapip/PenilaianController/get_pengawasan/$1/$2';



// KERTAS KERJA



$route[EncryptLink('kapip-laptri-angreal')] 									= 'laporan/LaptriAngrealController/index';
$route['kapip-laptri-angreal-prev'] 											= 'laporan/LaptriAngrealController/prev_laporan';
$route['kapip-laptri-angreal-pdf/(:any)/(:any)/(:any)/(:any)'] 					= 'laporan/LaptriAngrealController/pdf_laporan/$1/$2/$3/$4';
$route['kapip-laptri-angreal-excel/(:any)/(:any)/(:any)/(:any)'] 				= 'laporan/LaptriAngrealController/excel_laporan/$1/$2/$3/$4';


$route[EncryptLink('kapip-laptri-pengawasan')] 									= 'laporan/LaptriPengawasanController/index';
$route['kapip-laptri-pengawasan-prev'] 											= 'laporan/LaptriPengawasanController/prev_laporan';
$route['kapip-laptri-pengawasan-pdf/(:any)/(:any)/(:any)/(:any)'] 				= 'laporan/LaptriPengawasanController/pdf_laporan/$1/$2/$3/$4';
$route['kapip-laptri-pengawasan-excel/(:any)/(:any)/(:any)/(:any)'] 			= 'laporan/LaptriPengawasanController/excel_laporan/$1/$2/$3/$4';


$route[EncryptLink('kapip-laptri-governance')] 									= 'laporan/LaptriGovernanceController/index';
$route['kapip-laptri-governance-prev'] 											= 'laporan/LaptriGovernanceController/prev_laporan';
$route['kapip-laptri-governance-pdf/(:any)/(:any)/(:any)'] 						= 'laporan/LaptriGovernanceController/pdf_laporan/$1/$2/$3';
$route['kapip-laptri-governance-excel/(:any)/(:any)/(:any)'] 					= 'laporan/LaptriGovernanceController/excel_laporan/$1/$2/$3';


$route[EncryptLink('kapip-laptri-komposisi-sdm')] 								= 'laporan/LaptriKomposisiSdmController/index';
$route['kapip-laptri-komposisi-sdm-prev'] 										= 'laporan/LaptriKomposisiSdmController/prev_laporan';
$route['kapip-laptri-komposisi-sdm-pdf/(:any)/(:any)/(:any)'] 					= 'laporan/LaptriKomposisiSdmController/pdf_laporan/$1/$2/$3';
$route['kapip-laptri-komposisi-sdm-excel/(:any)/(:any)/(:any)'] 				= 'laporan/LaptriKomposisiSdmController/excel_laporan/$1/$2/$3';


$route[EncryptLink('kapip-laptri-sertifikasi-sdm')] 								= 'laporan/LaptriSertifikasiSdmController/index';
$route['kapip-laptri-sertifikasi-sdm-prev'] 										= 'laporan/LaptriSertifikasiSdmController/prev_laporan';
$route['kapip-laptri-sertifikasi-sdm-pdf/(:any)/(:any)/(:any)'] 					= 'laporan/LaptriSertifikasiSdmController/pdf_laporan/$1/$2/$3';
$route['kapip-laptri-sertifikasi-sdm-excel/(:any)/(:any)/(:any)'] 					= 'laporan/LaptriSertifikasiSdmController/excel_laporan/$1/$2/$3';


$route[EncryptLink('kapip-laptri-teknologi-informasi')] 							= 'laporan/LaptriTeknologiInformasiController/index';
$route['kapip-laptri-teknologi-informasi-prev'] 									= 'laporan/LaptriTeknologiInformasiController/prev_laporan';
$route['kapip-laptri-teknologi-informasi-pdf/(:any)/(:any)/(:any)'] 				= 'laporan/LaptriTeknologiInformasiController/pdf_laporan/$1/$2/$3';
$route['kapip-laptri-teknologi-informasi-excel/(:any)/(:any)/(:any)'] 				= 'laporan/LaptriTeknologiInformasiController/excel_laporan/$1/$2/$3';


$route[EncryptLink('kapip-laptah-penilaian-mandiri')] 							= 'laporan/LaptahPenilaianMandiriController/index';
$route['kapip-laptah-penilaian-mandiri-prev'] 									= 'laporan/LaptahPenilaianMandiriController/prev_laporan';
$route['kapip-laptah-penilaian-mandiri-pdf/(:any)/(:any)/(:any)/(:any)'] 		= 'laporan/LaptahPenilaianMandiriController/pdf_laporan/$1/$2/$3/$4';
$route['kapip-laptah-penilaian-mandiri-excel/(:any)/(:any)/(:any)/(:any)'] 		= 'laporan/LaptahPenilaianMandiriController/excel_laporan/$1/$2/$3/$4';



//$route['prev-tl-pemeriksaan-lk/(:any)'] 							= 'laporan/laporanLKController/prev_laporan/$1';

//$route[EncryptLink('lap-tl-pemeriksaan-lk')] 						= 'laporan/laporanLKController/index';


$route[EncryptLink('dashboard-pemda')] 					= 'tlhp/DashboardPemdaController';
$route['dashboard-pemda/(:any)'] 						= 'tlhp/DashboardPemdaController/getdisplay/$1';
$route['dashboard-pemda-filter/(:any)'] 				= 'tlhp/DashboardPemdaController/getdisplay_filter/$1';
$route['dashboard-pemda-get'] 							= 'tlhp/DashboardPemdaController/get_dashboard';
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
