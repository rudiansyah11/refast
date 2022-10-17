<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\HeadTeamController;
use App\Http\Controllers\OpratorTeamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
	return redirect('login');
});

Route::middleware(['middleware' => 'PreventBackHistory'])->group( function(){
	Auth::routes([
		'register' => false, // Registration Routes...
		'reset' => false, // Password Reset Routes...
		'verify' => false, // Email Verification Routes...
	]);
});
Route::post('logout', [logoutController::class, 'logout'])->name('logout');

// Akses HeadTeam (Super Admin)
Route::group(['prefix' => 'HeadTeam', 'middleware' => ['isHeadTeam','auth','PreventBackHistory']], function(){
	Route::get('menu', [HeadTeamController::class, 'menu'])->name('HeadTeam.menu');

	// ABSEN
	Route::get('buatabsen', [HeadTeamController::class, 'dev_absen_masuk'])->name('HeadTeam.buatabsen');
	Route::post('prosesabsenmasuk', [HeadTeamController::class, 'prosesabsenmasuk'])->name('HeadTeam.prosesabsenmasuk');
	Route::post('prosesabsentidakmasuk', [HeadTeamController::class, 'prosesabsentidakmasuk'])->name('HeadTeam.prosesabsentidakmasuk');
	Route::get('absen_tidak_masuk/{id}', [HeadTeamController::class, 'absen_tidak_masuk'])->name('HeadTeam.absen_tidak_masuk');
	Route::post('uploaddocument_tidak_masuk', [HeadTeamController::class, 'uploaddocument_tidak_masuk'])->name('HeadTeam.uploaddocument_tidak_masuk');
	Route::get('absenpulang', [HeadTeamController::class, 'dev_absen_pulang'])->name('HeadTeam.absenpulang');
	Route::post('prosesabsenpulang', [HeadTeamController::class, 'prosesabsenpulang'])->name('HeadTeam.prosesabsenpulang');
	
	// CHECK POINT POSITION
	Route::get('dev_checkpoint', [HeadTeamController::class, 'dev_checkpoint'])->name('HeadTeam.dev_checkpoint');
	Route::post('prosescheckpoint', [HeadTeamController::class, 'prosescheckpoint'])->name('HeadTeam.prosescheckpoint');

	// ABOUT USER
	Route::get('profile', [HeadTeamController::class, 'profile'])->name('HeadTeam.profile');
	Route::get('registerAccount', [HeadTeamController::class, 'registerAccount'])->name('HeadTeam.registerAccount');
	Route::get('get_area', [HeadTeamController::class, 'get_area'])->name('HeadTeam.get_area');
	Route::post('process_register', [HeadTeamController::class, 'process_register'])->name('HeadTeam.process_register');
	Route::get('samplePage', [HeadTeamController::class, 'samplePage'])->name('HeadTeam.samplePage');
	
	Route::get('dashboard_dev_1', [HeadTeamController::class, 'dashboard_dev_1'])->name('HeadTeam.dashboard_dev_1');
	Route::get('getServerSideTest', [HeadTeamController::class, 'getServerSideTest'])->name('HeadTeam.getServerSideTest');

	// DATA CUSTOMER
	Route::get('data_customer', [HeadTeamController::class, 'data_customer'])->name('HeadTeam.data_customer');
	Route::post('prosescustomeradd', [HeadTeamController::class, 'prosescustomeradd'])->name('HeadTeam.prosescustomeradd');
	Route::get('edit_customer/{id}', [HeadTeamController::class, 'edit_customer'])->name('HeadTeam.edit_customer');
	Route::post('prosescustomeredit', [HeadTeamController::class, 'prosescustomeredit'])->name('HeadTeam.prosescustomeredit');
	Route::get('hapusdatacustomerproses/{passing_id}', [HeadTeamController::class, 'hapusdatacustomerproses'])->name('HeadTeam.hapusdatacustomerproses');
	
	// DATA TESTER CRUD 
	Route::get('index_dev_1', [HeadTeamController::class, 'index_dev_1'])->name('HeadTeam.index_dev_1');
	Route::get('testerinput', [HeadTeamController::class, 'testerinput'])->name('HeadTeam.testerinput');
	Route::post('insert_test', [HeadTeamController::class, 'insert_test'])->name('HeadTeam.insert_test');
	Route::get('testeredit/{passing_id}', [HeadTeamController::class, 'testeredit'])->name('HeadTeam.testeredit');
	Route::post('testerupdate', [HeadTeamController::class, 'testerupdate'])->name('HeadTeam.testerupdate');
	Route::get('testerdelete/{passing_id}', [HeadTeamController::class, 'testerdelete'])->name('HeadTeam.testerdelete');
	
	// EXECUTE DATA TESTER 
	Route::get('dataTransaksitest', [HeadTeamController::class, 'dataTransaksitest'])->name('HeadTeam.dataTransaksitest');
	Route::get('buyingExecute/{passing_id_buying}/{passing_id_barang}', [HeadTeamController::class, 'buyingExecute'])->name('HeadTeam.buyingExecute');
	Route::post('processExecute', [HeadTeamController::class, 'processExecute'])->name('HeadTeam.processExecute');

	// ABSENT ENTRY & OUT
	Route::get('absent', [HeadTeamController::class, 'Absent'])->name('HeadTeam.Absent');
	Route::get('get_dataAbsent', [HeadTeamController::class, 'get_dataAbsent'])->name('HeadTeam.get_dataAbsent');
	
	Route::post('processAbsentMasuk', [HeadTeamController::class, 'processAbsentMasuk'])->name('HeadTeam.processAbsentMasuk');
	Route::post('processAbsentEntry', [HeadTeamController::class, 'processAbsentEntry'])->name('HeadTeam.processAbsentEntry');
	Route::post('processAbsentOut', [HeadTeamController::class, 'processAbsentOut'])->name('HeadTeam.processAbsentOut');
	
	// OLD ABSENT ENTRY & OUT
	// Route::get('old_absent', [HeadTeamController::class, 'old_absent'])->name('HeadTeam.old_absent');
	
	Route::get('checkpoint', [HeadTeamController::class, 'checkpoint'])->name('HeadTeam.checkpoint');
	Route::get('get_data_checkpoint', [HeadTeamController::class, 'get_data_checkpoint'])->name('HeadTeam.get_data_checkpoint');
	Route::post('processCheckpoint', [HeadTeamController::class, 'processCheckpoint'])->name('HeadTeam.processCheckpoint');

	Route::get('hitungjarak', [HeadTeamController::class, 'hitungjarak'])->name('HeadTeam.hitungjarak');
	Route::get('check_location', [HeadTeamController::class, 'check_location'])->name('HeadTeam.check_location');

	// PENJUALANAN 
	Route::get('penjualan', [HeadTeamController::class, 'penjualan'])->name('HeadTeam.penjualan');
	Route::get('getPenjualan', [HeadTeamController::class, 'getPenjualan'])->name('HeadTeam.getPenjualan');
	Route::get('buatPenjualan', [HeadTeamController::class, 'buatPenjualan'])->name('HeadTeam.buatPenjualan');
	Route::post('prosesPenjualan', [HeadTeamController::class, 'prosesPenjualan'])->name('HeadTeam.prosesPenjualan');
	Route::get('editPenjualan/{project_number}', [HeadTeamController::class, 'editPenjualan'])->name('HeadTeam.editPenjualan');
	Route::post('prosesUpdatePenjualan', [HeadTeamController::class, 'prosesUpdatePenjualan'])->name('HeadTeam.prosesUpdatePenjualan');
	Route::get('hapusPenjualan/{project_number}', [HeadTeamController::class, 'hapusPenjualan'])->name('HeadTeam.hapusPenjualan');
	Route::post('executefilepo', [HeadTeamController::class, 'executefilepo'])->name('HeadTeam.executefilepo');
	// Route::get('showAttachmentpo/{id}', [HeadTeamController::class, 'showAttachmentpo'])->name('HeadTeam.showAttachmentpo');

	// INVOICE 
	Route::get('invoice', [HeadTeamController::class, 'invoice'])->name('HeadTeam.invoice');
	Route::get('getInvoices', [HeadTeamController::class, 'getInvoices'])->name('HeadTeam.getInvoices');
	Route::get('buatinvoice', [HeadTeamController::class, 'buatinvoice'])->name('HeadTeam.buatinvoice');
	Route::post('executeprocessinvoice', [HeadTeamController::class, 'executeprocessinvoice'])->name('HeadTeam.executeprocessinvoice');
	Route::get('buatinvoice_sisa/{project_number}', [HeadTeamController::class, 'buatinvoice_sisa'])->name('HeadTeam.buatinvoice_sisa');
	Route::post('executeprocessinvoice_sisa', [HeadTeamController::class, 'executeprocessinvoice_sisa'])->name('HeadTeam.executeprocessinvoice_sisa');
	Route::get('editinvoice/{passing_id}', [HeadTeamController::class, 'editinvoice'])->name('HeadTeam.editinvoice');
	Route::post('prosesupdateinvoice', [HeadTeamController::class, 'prosesupdateinvoice'])->name('HeadTeam.prosesupdateinvoice');
	Route::get('hapusinvoice/{passing_id}', [HeadTeamController::class, 'hapusinvoice'])->name('HeadTeam.hapusinvoice');
	Route::get('showPDF/{passing_id}', [HeadTeamController::class, 'showPDF'])->name('HeadTeam.showPDF');
	Route::post('executefileinvoice', [HeadTeamController::class, 'executefileinvoice'])->name('HeadTeam.executefileinvoice');
	Route::get('showAttachment/{id}', [HeadTeamController::class, 'showAttachment'])->name('HeadTeam.showAttachment');
	Route::get('buatinvoicemanual', [HeadTeamController::class, 'buatinvoicemanual'])->name('HeadTeam.buatinvoicemanual');
	Route::post('processmanualinvoice', [HeadTeamController::class, 'processmanualinvoice'])->name('HeadTeam.processmanualinvoice');
	Route::get('sortinvoice/{type}', [HeadTeamController::class, 'sortinvoice'])->name('HeadTeam.sortinvoice');
	

	// RUGI/LABA 
	Route::get('rugilaba', [HeadTeamController::class, 'rugilaba'])->name('HeadTeam.rugilaba');
	Route::get('getrugilaba', [HeadTeamController::class, 'getrugilaba'])->name('HeadTeam.getrugilaba');
	// Route::get('editrugilaba/{project_number}', [HeadTeamController::class, 'editrugilaba'])->name('HeadTeam.editrugilaba');
	Route::get('editrugilaba/{project_number}', [HeadTeamController::class, 'editrugilaba'])->name('HeadTeam.editrugilaba');
	Route::get('hapusrugilaba/{project_number}', [HeadTeamController::class, 'hapusrugilaba'])->name('HeadTeam.hapusrugilaba');

	// REFFERRRRRRRRR
	Route::get('get_customer_name', [HeadTeamController::class, 'get_customer_name'])->name('HeadTeam.get_customer_name');
	Route::get('get_detail_customer_name', [HeadTeamController::class, 'get_detail_customer_name'])->name('HeadTeam.get_detail_customer_name');
	Route::get('get_projectNumberForAbsen', [HeadTeamController::class, 'get_projectNumberForAbsen'])->name('HeadTeam.get_projectNumberForAbsen');
	Route::get('get_projectNumber', [HeadTeamController::class, 'get_projectNumber'])->name('HeadTeam.get_projectNumber');
	Route::get('get_data_detail_project_number', [HeadTeamController::class, 'get_data_detail_project_number'])->name('HeadTeam.get_data_detail_project_number');
	Route::get('get_name_pic', [HeadTeamController::class, 'get_name_pic'])->name('HeadTeam.get_name_pic');
	Route::get('get_deskripsi_kasbon', [HeadTeamController::class, 'get_deskripsi_kasbon'])->name('HeadTeam.get_deskripsi_kasbon');
	
	// sample aja buat nanti kalkulasi
	Route::post('executeprocesspayment', [HeadTeamController::class, 'executeprocesspayment'])->name('HeadTeam.executeprocesspayment');


	// KASBON
	Route::get('getKasbon', [HeadTeamController::class, 'getKasbon'])->name('HeadTeam.getKasbon');
	Route::get('kasbon', [HeadTeamController::class, 'kasbon'])->name('HeadTeam.kasbon');
	Route::get('create_kasbon/{key}', [HeadTeamController::class, 'create_kasbon'])->name('HeadTeam.create_kasbon');
	Route::get('processing_kasbon/{passing_id}', [HeadTeamController::class, 'processing_kasbon'])->name('HeadTeam.processing_kasbon');
	Route::post('executeprocesskasbon', [HeadTeamController::class, 'executeprocesskasbon'])->name('HeadTeam.executeprocesskasbon');
	Route::post('executeprocesskasbondeskripsi', [HeadTeamController::class, 'executeprocesskasbondeskripsi'])->name('HeadTeam.executeprocesskasbondeskripsi');
	Route::get('editdeskripsikasbon/{id}', [HeadTeamController::class, 'editdeskripsikasbon'])->name('HeadTeam.editdeskripsikasbon');
	Route::post('updateprocessdeskripsi', [HeadTeamController::class, 'updateprocessdeskripsi'])->name('HeadTeam.updateprocessdeskripsi');

	Route::get('cancelkasbon/{passing_id}', [HeadTeamController::class, 'cancelkasbon'])->name('HeadTeam.cancelkasbon');
	Route::get('editkasbon/{passing_id}', [HeadTeamController::class, 'editkasbon'])->name('HeadTeam.editkasbon');
	Route::post('updateprocesskasbon', [HeadTeamController::class, 'updateprocesskasbon'])->name('HeadTeam.updateprocesskasbon');
	Route::post('uploadfilekasbon', [HeadTeamController::class, 'uploadfilekasbon'])->name('HeadTeam.uploadfilekasbon');
	Route::post('executeprocesskasbondeskripsi_fromedit', [HeadTeamController::class, 'executeprocesskasbondeskripsi_fromedit'])->name('HeadTeam.executeprocesskasbondeskripsi_fromedit');
	Route::post('updatekasbonapproval', [HeadTeamController::class, 'updatekasbonapproval'])->name('HeadTeam.updatekasbonapproval');

	Route::get('create_realisasi/{passing_id}', [HeadTeamController::class, 'create_realisasi'])->name('HeadTeam.create_realisasi');
	Route::post('processrealisasi', [HeadTeamController::class, 'processrealisasi'])->name('HeadTeam.processrealisasi');

	// REALISASI 
	Route::get('getRealisasi', [HeadTeamController::class, 'getRealisasi'])->name('HeadTeam.getRealisasi');
	Route::get('realisasi', [HeadTeamController::class, 'realisasi'])->name('HeadTeam.realisasi');
	Route::get('show_realisasi/{passing_id}', [HeadTeamController::class, 'show_realisasi'])->name('HeadTeam.show_realisasi');

});

// Akses OpratorTeam (Admin)
Route::group(['prefix' => 'OpratorTeam', 'middleware' => ['isOpratorTeam','auth','PreventBackHistory']], function(){
	Route::get('profile', [OpratorTeamController::class, 'profile'])->name('OpratorTeam.profile');
	Route::get('samplePage', [OpratorTeamController::class, 'samplePage'])->name('OpratorTeam.samplePage');

	Route::get('showdatatest', [OpratorTeamController::class, 'showdatatest'])->name('OpratorTeam.showdatatest');
	Route::get('getServerSideTest', [OpratorTeamController::class, 'getServerSideTest'])->name('OpratorTeam.getServerSideTest');
	Route::get('testbuy/{passing_id}', [OpratorTeamController::class, 'testbuy'])->name('OpratorTeam.testbuy');
	Route::post('processTestTransksi', [OpratorTeamController::class, 'processTestTransksi'])->name('OpratorTeam.processTestTransksi');
	Route::get('dataTransaksitest', [OpratorTeamController::class, 'dataTransaksitest'])->name('OpratorTeam.dataTransaksitest');
	
	// Route::get('dashboard1', [OpratorTeamController::class, 'dashboard1'])->name('OpratorTeam.dashboard1');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
