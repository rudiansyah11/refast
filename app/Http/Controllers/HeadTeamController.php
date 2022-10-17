<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\user_details;
use App\Models\user_contract;
use App\Models\SampleTest;
use App\Models\buyingTester;
use App\Models\log_activity;
use App\Models\absen_employee;
use App\Models\log_absen;
use App\Models\checkPointPosition;
use App\Models\testUpload;
use App\Models\ref_province;
use App\Models\ref_city;
use App\Models\ref_proses_persen;
use App\Models\ref_proses_category;
use App\Models\data_customer;

use App\Models\penjualan;
use App\Models\category_penjualanan;
use App\Models\category_checkpoint;
use App\Models\rugilaba;
use App\Models\rugilaba_cost;
use App\Models\invoice;
use App\Models\invoices_barang;
use App\Models\invoice_file;
use App\Models\purchasingorder_file;

use App\Models\kasbon;
use App\Models\detail_kasbon;
use App\Models\reff_kasbon;
use App\Models\kasbon_file;
use App\Models\realisasi;

use Stevebauman\Location\Facades\Location;

use Session;
use DataTables;
use PDF;

class HeadTeamController extends Controller
{
    public function menu(){
        $email = auth()->user()->email;
        // dd($email);
        $user = User::where('email', $email)->first();
        $user_details = user_details::where('email', $email)->first();
        $user_contract = user_contract::where('email', $email)->first();

        $datanya = ['data_user' => $user, 'data_detail' => $user_details, 'user_contract' => $user_contract];
        return view('HeadTeam/menu', compact('datanya'));
    }

    public function profile(){

        // this month
        $year = date('Y-');
        $month = date('Y-m');
        $username   = auth()->user()->name;
        $email      = auth()->user()->email;
        $user_contract = user_contract::where('email', $email)->first();

        $data_absen = absen_employee::where('username', $username)->get();
        $data_log_absen = DB::table('log_absens')
            ->join('absen_employees', 'log_absens.passing_id', '=', 'absen_employees.passing_id')
            ->select('log_absens.*','absen_employees.absent_type', 'absen_employees.keterangan_other')
            ->where('log_absens.username', $username)
            ->orWhere('log_absens.start_date', 'LIKE', $year.'%')
            ->groupBy('log_absens.passing_id')
            ->orderBy('log_absens.id', 'DESC')->get();

        // rubah strict => true menjadi false, di file config/database.php di 'mysql'
        // https://stackoverflow.com/questions/40917189/laravel-syntax-error-or-access-violation-1055-error
        // dd($data_log_absen);

        $data_log_aktifitas = log_activity::where('username', $username)->where('created_at', 'LIKE', ''.$year.'%')->orderBy('id','DESC')->get();

        $data_posisi = array();
        $position = log_absen::where('username', $username)->get();
        foreach($position as $row){
            $data_posisi[] = [
                'type' => 'Feature',
                'properties'=> [
                    'description'=>'<strong>'.$row->username.'</strong><p> '.$row->title.' at : '.$row->start_date.'</p>'
                ],
                'geometry'=> [
                    'type'=> 'Point',
                    'coordinates'=> [$row->longitude, $row->latitude] 
                ]
            ];
        }

        $datanya = ['data_absen' => $data_absen, 'data_log_absen' => $data_log_absen, 'user_contract' => $user_contract, 'data_log_aktifitas' => $data_log_aktifitas, 'data_posisi' => $data_posisi];
        return view('HeadTeam/profile', compact('datanya'));
    }

    public function samplePage(){
        return view('HeadTeam/sampleTemplate');
    }

    public function registerAccount(){
        return view('HeadTeam/registerPage');
    }

    public function get_area(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = ref_city::select("city")
            		->where('city','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }

    public function process_register(Request $req){

        $validator = Validator::make($req->all(), [
            'username'  => 'required|max:255',
            'email' => 'required|email|unique:users',
            'role'  => 'required|max:3',
            'password' => 'required',
            'place_birth' => 'required',
            'date_birth' => 'required',
            'age' => 'required',
            'type_identity' => 'required',
            'no_identity' => 'required|max:25',
            'no_npwp' => 'required|max:25',
            'no_tlp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15',
            'status_marital' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'contract_date_start' => 'required',
            'contract_date_finish' => 'required',
            'position_employee' => 'required',
            'level_employee' => 'required',
            'status_employee' => 'required',
            'bpjs_tk' => 'required|max:25',
            'bpjs_ks' => 'required|max:25',
            'file_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('HeadTeam/registerAccount')
                ->withErrors($validator)
                ->withInput();
        }

        $name_file_photo = $req->file('file_photo')->getClientOriginalName();
        $file_photo = $req->file('file_photo');
        $file_photo->move(public_path('storage/uploads/photoProfile/'),$name_file_photo);

        $data = new User();
        $data->name = $req->username;
        $data->email = $req->email;
        $data->role = $req->role;
        $data->password = Hash::make($req->password);
        $data->photo_profile = $file_photo;
        $execute1 = $data->save();

        $data_detail = new user_details();
        $data_detail->email = $req->email;
        $data_detail->place_birth = $req->place_birth;
        $data_detail->date_birth = $req->date_birth;
        $data_detail->age = $req->age;
        $data_detail->type_identity = $req->type_identity;
        $data_detail->no_identity = $req->no_identity;
        $data_detail->no_npwp = $req->no_npwp;
        $data_detail->no_tlp = $req->no_tlp;
        $data_detail->religion = $req->religion;
        $data_detail->status_marital = $req->status_marital;
        $data_detail->address = $req->address;
        $execute2 = $data_detail->save();

        $data_contract = new user_contract();
        $data_contract->email = $req->email;
        $data_contract->full_name = $req->username;
        $data_contract->contract_date_start = $req->contract_date_start;
        $data_contract->contract_date_finish = $req->contract_date_finish;
        $data_contract->position_employee = $req->position_employee;
        $data_contract->level_employee = $req->level_employee;
        $data_contract->status_employee = $req->status_employee;
        $data_contract->bpjs_tk = $req->bpjs_tk;
        $data_contract->bpjs_ks = $req->bpjs_ks;
        $data_contract->working_area = $req->working_area;
        $execute3 = $data_contract->save();

        if($execute1 === true && $execute2 === true && $execute3 === true){
            
            $desc = "Has been Registered new Account <b>".$req->username."</b> ";
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Register new Account";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.registerAccount')->with('success', 'Successfully to registered new account.');
        
        } else {
            return redirect()->route('HeadTeam.registerAccount')->with('error', 'Something Wrong, Failed to register!');
        }
    }

    public function dashboard_dev_1(){
        echo "This is page will be Show Dashboard Development Page's";
    }

    // DATATABLES SERVERSIDE
    public function getServerSideTest(Request $request){
        if ($request->ajax()) {
            $datanya = SampleTest::latest()->get();
            return Datatables::of($datanya)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $link_edit = route('HeadTeam.testeredit', $row->passing_id);
                        $link_delete = route('HeadTeam.testerdelete', $row->passing_id);
                        $alert_for_delete = "return confirm('Are you sure you want to exit?');";

                        $btn = '<ul class="icons-list text-center">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="'.$link_edit.'"><i class="icon-database-edit2"></i> Edit Data</a></li>
                                            <li><a href="'.$link_delete.'" onclick="'.$alert_for_delete.'"><i class="icon-trash-alt"></i> Delete Data</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> Export PDF</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Export CSV</a></li>
                                        </ul>
                                    </li>
                                </ul>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function index_dev_1(){
        // echo "This is page will be Show Datatable's with ServerSide";
        $datanya = SampleTest::orderBy('id','DESC')->get();
        return view('HeadTeam/testershow', compact('datanya'));
    }

    public function testerinput(){
        return view('HeadTeam/testerinput');
    }

    public function insert_test(Request $req){

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

        $validator = Validator::make($req->all(), [
            'nama_barang' => 'required|max:255',
            'stok_barang' => 'required|digits_between:1,1000',
            'jenis_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'keterangan_barang' => 'required'
        ]);
            
        if ($validator->fails()) {
            return redirect('HeadTeam/testerinput')
                ->withErrors($validator)
                ->withInput();
        }

        $data = new SampleTest();

        $data->passing_id = $passing_id;
        $data->nama_barang = $req->nama_barang;
        $data->stok_barang = $req->stok_barang;
        $data->jenis_barang = $req->jenis_barang;
        $data->harga_satuan = $req->harga_barang;
        $data->keterangan = $req->keterangan_barang;
        $data->creator = $req->creator;
        $execute = $data->save();

        if($execute){
            
            $desc = "Has been add new data tester, with item name: ".$req->nama_barang;
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Tester";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.index_dev_1')->with('success', 'Data Items Has been created...');
        
        } else {
            return redirect()->route('HeadTeam.testerinput')->with('error', 'Items Failed to create!');
        }
    }

    public function testeredit($passing_id){
        $datanya = SampleTest::where('passing_id',$passing_id)->first();
        // dd($datanya);
        return view('HeadTeam/testeredit', compact('datanya'));
    }

    public function testerupdate(Request $req){
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'nama_barang' => 'required|max:255',
            'stok_barang' => 'required|digits_between:1,1000',
            'jenis_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'keterangan_barang' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.testeredit', $req->passing_id))
                        ->withErrors($validator)
                        ->withInput();
        }

        // TABLE : [building_management] (UPDATE)
        $data_update = SampleTest::find($req->id);
        $data_update->nama_barang = $req->nama_barang;
        $data_update->stok_barang = $req->stok_barang;
        $data_update->jenis_barang = $req->jenis_barang;
        $data_update->harga_satuan = $req->harga_barang;
        $data_update->keterangan = $req->keterangan_barang;
        $execute = $data_update->save();

        if($execute){
            $desc = "Just changes data items: ".$req->nama_barang;
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Tester";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.index_dev_1')->with('success', 'Data Items Has Updates...');
        } else {
            return redirect()->route('HeadTeam.testerinput')->with('error', 'Items Failed to updates!');
        }
    }

    public function testerdelete($passing_id){
        $datanya = SampleTest::where('passing_id',$passing_id)->first();
        $nama_barang = $datanya->nama_barang;

        $desc = "Delete Data ".$nama_barang;
        echo $desc;
        die();
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Tester";
        $log->the_activity = $desc;
        $log->save();
        
        SampleTest::where('passing_id', $passing_id)->delete();
        return redirect()->route('HeadTeam.index_dev_1')->with('success', 'Data News Has been Delete');
    }

    public function dataTransaksitest(){
        $datanya = buyingTester::get(); 
        return view('HeadTeam/dataTransaksitest',compact('datanya'));
    }

    public function buyingExecute($passing_id_buying, $passing_id_barang){
        $data_request = buyingTester::where('passing_id_buying',$passing_id_buying)->first();
        $data_sampel = SampleTest::where('passing_id',$passing_id_barang)->first();
        // dd($datanya);
        $datanya = ['data_request' => $data_request, 'data_sampel' => $data_sampel];

        return view('HeadTeam/buyingExecute', compact('datanya'));
    }

    public function processExecute(Request $req){

        // check quentity pemesannya lebih besar dari stok atau tidak
        if($req->quantity > $req->stock){

            //PHASE REJECT ADA 2: 1.Ketika Quantity melebihi stok, 2.Ketika Stok melebihi Quantity  
            if($req->statusnya == "Reject"){
                //STOK DIKEMBALIKAN
                $result = $req->stock + $req->quantity;
                SampleTest::where('passing_id',$req->passing_id_barang)
                    ->update(['stok_barang' => $result]);

                //UBAH STATUSNYA PEMBELIAN
                $execute = buyingTester::where('passing_id_buying',$req->passing_id_buying)
                ->update(['status_pembelian' => $req->statusnya]);
                if($execute){
                    //Insert Log Activiry before direct page
                    $desc = "Execution data buying with item Name: ".$req->nama_barang.", Quantity: ".$req->quantity.", and Status change to be: ".$req->statusnya;
                    $log = new log_activity();
                    $log->username = $req->creator;
                    $log->category_activity = "Buy Data Tester";
                    $log->the_activity = $desc;
                    $log->save();
        
                    return redirect()->route('HeadTeam.dataTransaksitest')->with('success', 'Successfully to Execute data buying.');
                } else {
                    return redirect()->route('HeadTeam.dataTransaksitest', $req->passing_id_barang)->with('error', 'Something wrong, Fail to Execution buying!');
                }

            } else {
                return redirect()
                ->route('HeadTeam.buyingExecute', ['passing_id_buying'=>$req->passing_id_buying,'passing_id_barang'=>$req->passing_id_barang])
                ->with('error', 'Quantity pemesanan melebih stock!');
            }
        
        } else {

            if($req->statusnya == "Done"){
                //KURANGIN STOK
                $result = $req->stock - $req->quantity;
                SampleTest::where('passing_id',$req->passing_id_barang)
                    ->update(['stok_barang' => $result]);
                
                //UBAH STATUSNYA PEMBELIAN
                $execute = buyingTester::where('passing_id_buying',$req->passing_id_buying)
                ->update(['status_pembelian' => $req->statusnya]);
                if($execute){
                    //Insert Log Activiry before direct page
                    $desc = "Execution data buying with item Name: ".$req->nama_barang.", Quantity: ".$req->quantity.", and Status change to be: ".$req->statusnya;
                    $log = new log_activity();
                    $log->username = $req->creator;
                    $log->category_activity = "Buy Data Tester";
                    $log->the_activity = $desc;
                    $log->save();
        
                    return redirect()->route('HeadTeam.dataTransaksitest')->with('success', 'Successfully to Execute data buying.');
                } else {
                    return redirect()->route('HeadTeam.dataTransaksitest', $req->passing_id_barang)->with('error', 'Something wrong, Fail to Execution buying!');
                }
            
            } else if($req->statusnya == "Reject"){
                //STOK DIKEMBALIKAN
                $result = $req->stock + $req->quantity;
                SampleTest::where('passing_id',$req->passing_id_barang)
                    ->update(['stok_barang' => $result]);

                //UBAH STATUSNYA PEMBELIAN
                $execute = buyingTester::where('passing_id_buying',$req->passing_id_buying)
                ->update(['status_pembelian' => $req->statusnya]);
                if($execute){
                    //Insert Log Activiry before direct page
                    $desc = "Execution data buying with item Name: ".$req->nama_barang.", Quantity: ".$req->quantity.", and Status change to be: ".$req->statusnya;
                    $log = new log_activity();
                    $log->username = $req->creator;
                    $log->category_activity = "Buy Data Tester";
                    $log->the_activity = $desc;
                    $log->save();
        
                    return redirect()->route('HeadTeam.dataTransaksitest')->with('success', 'Successfully to Execute data buying.');
                } else {
                    return redirect()->route('HeadTeam.dataTransaksitest', $req->passing_id_barang)->with('error', 'Something wrong, Fail to Execution buying!');
                }

            } else {
                $execute = buyingTester::where('passing_id_buying',$req->passing_id_buying)
                ->update(['status_pembelian' => $req->statusnya]);

                if($execute){
                    //Insert Log Activiry before direct page
                    $desc = "Execution data buying with item Name: ".$req->nama_barang.", Quantity: ".$req->quantity.", and Status change to be: ".$req->statusnya;
                    $log = new log_activity();
                    $log->username = $req->creator;
                    $log->category_activity = "Buy Data Tester";
                    $log->the_activity = $desc;
                    $log->save();
        
                    return redirect()->route('HeadTeam.dataTransaksitest')->with('success', 'Successfully to Execute data buying.');
                } else {
                    return redirect()->route('HeadTeam.dataTransaksitest', $req->passing_id_barang)->with('error', 'Something wrong, Fail to Execution buying!');
                }
            }

        }
    }

    // FOCUS HERE 
    public function dev_absen_masuk(Request $req){

        if($req->jenis_absen == "masuk"){

            // Identifikasi lokasi..

            $point1 = array("lat" => $req->latitude_absen, "long" => $req->longitude_absen);    // My Loc
            // $point1 = array("lat" => -6.2047283, "long" => 106.8661531);    // Home
            // $point2 = array("lat" => -6.3820538, "long" => 106.8677407);   // Office
            $point2 = array("lat" => -6.2061225, "long" => 106.8638568 );     // RSUD

            $distance = $this->countDistance($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
            $meter = ceil($distance['meters']);
            
            echo "Jarak Meter: ".$meter." Meter.<br>";


            if($meter > 1000){

                // echo "Lokasi anda masih jauh dari kantor";
                // die();
                Session::flash('error', 'Lokasi anda terdeteksi tidak diarea kantor, mohon untuk isi keterangannya!');
                return view('HeadTeam/absen/masuk2');
                
            } else {
                // echo "Anda dilokasi kantor, selamat kerja..";
                // die();
                return view('HeadTeam/absen/masuk');
            }
            
        } else {
            // echo "Show halaman tidak masuk";
            return view('HeadTeam/absen/tidak_masuk');
        }    
    }

    public function prosesabsenmasuk(Request $req){
        
        if($req->ajax()){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

            $username   = auth()->user()->name;
            $today      = date('Y-m-d H:i:s');
            $absen_type = $req->absen_employee;
            $latitude   = $req->latitude_absen;
            $longitude  = $req->longitude_absen;

            // Check photonya dulu ada atau ngk
            if(empty($req->photoStore_office)){
                return "kosong";
            }

            if(empty($req->keterangan)){
                $keterangan = '-';
            } else {
                $keterangan = $req->keterangan;
            }

            $encoded_data = $req->photoStore_office;
            // encode photonya
            $binary_data = base64_decode($encoded_data);
            $photonya = "absentEntry-".$passing_id.'.png';
            Storage::disk('public')->put('uploads/photoAbsentEntry/'.$photonya, $binary_data);

            $absen_employee = new absen_employee();
            $absen_employee->passing_id = $passing_id;
            $absen_employee->username = $username;
            $absen_employee->for_project_number = '-';
            $absen_employee->description = '-';
            $absen_employee->absent_type = $req->absen_type;
            $absen_employee->keterangan_other = $keterangan;
            $absen_employee->start_date = $today;
            $absen_employee->end_date = null;
            $absen_employee->duration = '0';
            $execute = $absen_employee->save();

            if($execute){

                $log_absen = new log_absen();
                $log_absen->passing_id = $passing_id;
                $log_absen->username = $username;
                $log_absen->category_activity = 'Data Absen Masuk';
                $log_absen->title = $req->absen_type;
                $log_absen->start_date = $today;
                $log_absen->longitude = $longitude;
                $log_absen->latitude = $latitude;
                $log_absen->photonya = $photonya;
                // $log_absen->photonya = $photonya;
                $execute = $log_absen->save();
                
                $desc = "Have done absent entry at ".$today;
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = auth()->user()->name;
                $log->category_activity = "Data Absent";
                $log->the_activity = $desc;
                $log->save();
                return "success";
            
            } else {
                return "fail";
            }

        } else {
            return "kosong";
        }
    }


    public function prosesabsentidakmasuk(Request $req){

        if(!empty($req->filenya)){
            // $nama_file = $req->filenya->getClientOriginalName();
            $nama_file = $req->file('filenya')->getClientOriginalName();
        } else {
            $nama_file = '-';
        }

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

        $username   = auth()->user()->name;
        $today      = date('Y-m-d H:i:s');
        $absen_type = $req->absen_type;
        $latitude   = $req->latitude_absen;
        $longitude  = $req->longitude_absen;
        $keterangan = $req->keterangan;


        if($req->jenis_keterangan == "Sakit"){
            
            $z = 0;
            for($i = 0; $i < 2; $i++){
            
                $the_weekend = date('w', strtotime('+'.$z.' days'));
                // check ada hari weekend (sabtu minggu) atau tidak 
                if ( $the_weekend == '0') {
                    // kalo dia hari minggu +1 hari lagi
                    $z = $z + 1;
                    $the_date = date('Y-m-d H:i:s', strtotime('+'.$z.' days'));

                } else if( $the_weekend == '6'){
                    // kalo dia hari sabtu +2 hari lagi
                    $z = $z + 2;
                    $the_date = date('Y-m-d H:i:s', strtotime('+'.$z.' days'));

                } else {
                    $the_date = date('Y-m-d H:i:s', strtotime('+'.$z.' days'));
                }

                $z++;

                // echo "<br> ".$the_date;

                $absen_employee = new absen_employee();
                $absen_employee->passing_id = $passing_id;
                $absen_employee->username = $username;
                $absen_employee->for_project_number = '-';
                $absen_employee->description = $req->jenis_keterangan;
                $absen_employee->absent_type = $absen_type;
                $absen_employee->keterangan_other = $keterangan;
                $absen_employee->start_date = $the_date;
                $absen_employee->end_date = $the_date;
                $absen_employee->duration = '0';
                $execute = $absen_employee->save();

                $log_absen = new log_absen();
                $log_absen->passing_id = $passing_id;
                $log_absen->username = $username;
                $log_absen->category_activity = 'Data Absen Tidak Masuk';
                $log_absen->title = $req->absen_type;
                $log_absen->start_date = $the_date;
                $log_absen->longitude = $longitude;
                $log_absen->latitude = $latitude;
                $log_absen->photonya = $nama_file;
                $execute = $log_absen->save();
            }

            // die();

        } elseif($req->jenis_keterangan == "Cuti"){

            $x = $req->jumlah_hari;
            $z = 0;

            for($i = 0; $i < $x; $i++){
                
                $the_weekend = date('w', strtotime('+'.$z.' days'));
                // check ada hari weekend (sabtu minggu) atau tidak 
                if ( $the_weekend == '0') {
                    // kalo dia hari minggu +1 hari lagi
                    $z = $z + 1;
                    $the_date = date('Y-m-d H:i:s', strtotime('+'.$z.' days'));

                } else if( $the_weekend == '6'){
                    // kalo dia hari sabtu +2 hari lagi
                    $z = $z + 2;
                    $the_date = date('Y-m-d H:i:s', strtotime('+'.$z.' days'));

                } else {
                    $the_date = date('Y-m-d H:i:s', strtotime('+'.$z.' days'));
                }

                $z++;
                // echo "<br> ".$the_date;
                // echo "<br> ".$tag;

                $absen_employee = new absen_employee();
                $absen_employee->passing_id = $passing_id;
                $absen_employee->username = $username;
                $absen_employee->for_project_number = '-';
                $absen_employee->description = $req->jenis_keterangan.", ".$req->jumlah_hari." Hari";
                $absen_employee->absent_type = $absen_type;
                $absen_employee->keterangan_other = $keterangan;
                $absen_employee->start_date = $the_date;
                $absen_employee->end_date = $the_date;
                $absen_employee->duration = '0';
                $execute = $absen_employee->save();

                $log_absen = new log_absen();
                $log_absen->passing_id = $passing_id;
                $log_absen->username = $username;
                $log_absen->category_activity = 'Data Absen Tidak Masuk';
                $log_absen->title = $req->absen_type;
                $log_absen->start_date = $the_date;
                $log_absen->longitude = $longitude;
                $log_absen->latitude = $latitude;
                $log_absen->photonya = $nama_file;
                $execute = $log_absen->save();
            }

            // die();
        } else {
            $absen_employee = new absen_employee();
            $absen_employee->passing_id = $passing_id;
            $absen_employee->username = $username;
            $absen_employee->for_project_number = '-';
            $absen_employee->description = $req->jenis_keterangan;
            $absen_employee->absent_type = $absen_type;
            $absen_employee->keterangan_other = $keterangan;
            $absen_employee->start_date = $today;
            $absen_employee->end_date = null;
            $absen_employee->duration = '0';
            $execute = $absen_employee->save();

            $log_absen = new log_absen();
            $log_absen->passing_id = $passing_id;
            $log_absen->username = $username;
            $log_absen->category_activity = 'Data Absen Tidak Masuk';
            $log_absen->title = $req->absen_type;
            $log_absen->start_date = $today;
            $log_absen->longitude = $longitude;
            $log_absen->latitude = $latitude;
            $log_absen->photonya = $nama_file;
            $execute = $log_absen->save();
        }

        if($execute){
            
            $desc = "Melakukan absen tidak masuk: ".$req->jenis_keterangan." pada ".$today;
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = auth()->user()->name;
            $log->category_activity = "Data Absent";
            $log->the_activity = $desc;
            $log->save();
            return redirect()->route('HeadTeam.profile')->with('success', 'Berhasil absent tidak masuk karena '.$req->jenis_keterangan.'.');
        
        } else {
            return redirect()->route('HeadTeam.profile')->with('error', 'Upps sorry something error, gagal absent tidak masuk karena '.$req->jenis_keterangan.'.');
        }
    }

    public function absen_tidak_masuk($passing_id){
        $datanya = DB::table('log_absens')
            ->join('absen_employees', 'log_absens.passing_id', '=', 'absen_employees.passing_id')
            ->select('log_absens.*', 'absen_employees.description', 'absen_employees.absent_type', 'absen_employees.keterangan_other')
            ->where('log_absens.passing_id', $passing_id)->first();
        
        return view('HeadTeam/absen/show_absen_tidak_masuk', compact('datanya'));
    }

    public function uploaddocument_tidak_masuk(Request $req){
        // dd($req->all());

        $name_file_photo = $req->file('filenya')->getClientOriginalName();
        $path = $req->file('filenya')->storeAs('uploads/document_absen/', $name_file_photo);

        if($path){
            absen_employee::where('passing_id',$req->passing_id)->update(['description' => $req->jenis_keterangan, 'keterangan_other' => $req->keterangan]);
            log_absen::where('passing_id',$req->passing_id)->update(['photonya' => $name_file_photo]);
            
            //Insert Log Activiry before direct page
            $desc = $req->username." Menambahkan document untuk absen tidak masuk (".$req->description.") ";
            $log = new log_activity();
            $log->username = auth()->user()->name;
            $log->category_activity = "Data Absent";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.absen_tidak_masuk', $req->passing_id)->with('success', 'Berhasil Upload Document.');
        } else {
            return redirect()->route('HeadTeam.absen_tidak_masuk', $req->passing_id)->with('error', 'Gagal Upload Document.');
        }
        
    }

    public function dev_absen_pulang(Request $req){
        $jenis_absen = $req->jenis_absen;
        $username = auth()->user()->name;
        $today = date('Y-m-d');
        // $today = date('2022-08-25');
        $check_absen = absen_employee::where('username', $username)
                                    ->where('start_date', 'LIKE', ''.$today.'%')
                                    ->first();
        if(!is_null($check_absen)){
            // echo "datanya ada";
            $datanya = ['data_absen' => $check_absen, 'jenis_absen' => $jenis_absen];
            return view('HeadTeam/absen/pulang', compact('datanya'));

        } else {
            // echo "blm absen woyy, datanya gk ada";
            return redirect()->route('HeadTeam.menu', $req->passing_id)->with('error', 'Lakukan absen masuk terlebih dahulu.');
        }
    }

    public function prosesabsenpulang(Request $req){
        
        if($req->ajax()){
            // Check photonya dulu ada atau ngk
            if(empty($req->photoStore_office)){
                return "kosong";
            }

            // YG DI POST :
            $username           = auth()->user()->name;
            $today              = date('Y-m-d H:i:s');
            $today2             = date('Y-m-d');
            $passing_id         = $req->passing_id;
            $jenis_absen        = $req->jenis_absen;
            $keterangan_absen   = $req->keterangan_absen;
            $project_number     = $req->project_number;
            $latitude           = $req->latitude_absen;
            $longitude          = $req->longitude_absen;
            $start_date         = $req->start_date;

            $start_str = strtotime($start_date);
            $end_str = strtotime($today);
            $total_ = $end_str - $start_str;
            $total_menit = floor($total_ / (60) ); // convert to minute

            // UPDATE DATA ABSEN
            $execute = absen_employee::where('passing_id',$passing_id)
                    ->update(['keterangan_other' => $keterangan_absen,'for_project_number' => $project_number, 'description' => $jenis_absen,'end_date' => $today, 'duration' => $total_menit]);

            $encoded_data = $req->photoStore_office;
            
            // ENCODE PHOTONYA, DAN MASUK KE PUBLIC
            $binary_data = base64_decode($encoded_data);
            $photonya = "absentOut-".$passing_id.'.png';
            Storage::disk('public')->put('uploads/photoAbsentOut/'.$photonya, $binary_data);


            //RUBAH SEMUA PROJECT NUMBER DI CHECKPOINT
            $execute_update_checkpoint = checkPointPosition::where('datenya', 'LIKE', ''.$today2.'%')
                    ->update(['project_number' => $project_number]);

            if($execute){

                $log_absen = new log_absen();
                $log_absen->passing_id = $passing_id;
                $log_absen->username = $username;
                $log_absen->category_activity = 'Data Absen Pulang';
                $log_absen->title = 'Absent Out';
                $log_absen->start_date = $today;
                $log_absen->longitude = $longitude;
                $log_absen->latitude = $latitude;
                $log_absen->photonya = $photonya;
                // $log_absen->photonya = $photonya;
                $execute = $log_absen->save();
                
                $desc = "Have done absent out at ".$today;
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = auth()->user()->name;
                $log->category_activity = "Data Absent";
                $log->the_activity = $desc;
                $log->save();
                return "success";
            
            } else {
                return "fail";
            }

        } else {
            return "kosong";
        }
    }

    public function dev_checkpoint(){
        $username = auth()->user()->name;
        $today = date('Y-m-d');
        // $today = date('2022-08-25');
        $check_absen = absen_employee::where('username', $username)
                                    ->where('start_date', 'LIKE', ''.$today.'%')
                                    ->first();
        if(!is_null($check_absen)){
            $category = category_checkpoint::all();
            $datanya = ['category' => $category];
            return view('HeadTeam/checkpoint/checkpoint', compact('datanya'));

        } else {
            // echo "blm absen woyy, datanya gk ada";
            return redirect()->route('HeadTeam.menu')->with('error', 'Lakukan absen masuk terlebih dahulu.');
        }
    }
    public function prosescheckpoint(Request $req){
        if($req->ajax()){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

            $username   = auth()->user()->name;
            $today      = date('Y-m-d H:i:s');
            $deskripsi  = $req->deskripsi;
            $project_number  = $req->project_number;
            $latitude   = $req->latitude_absen;
            $longitude  = $req->longitude_absen;

            // Check photonya dulu ada atau ngk
            if(empty($req->photoStore)){
                return "kosong";
            }

            $encoded_data = $req->photoStore;
            // encode photonya
            $binary_data = base64_decode($encoded_data);
            $photonya = "checkpoint-".$passing_id.'.png';
            Storage::disk('public')->put('uploads/photoCheckPoint/'.$photonya, $binary_data);

            $checkpoint = new checkPointPosition();
            $checkpoint->passing_id = $passing_id;
            $checkpoint->username = $username;
            $checkpoint->description = $deskripsi;
            $checkpoint->project_number = $project_number;
            $checkpoint->latitude = $latitude;
            $checkpoint->longitude = $longitude;
            $checkpoint->datenya = $today;
            $checkpoint->photonya = $photonya;
            $execute = $checkpoint->save();

            if($execute){
                
                $desc = "Melakukan checkpoint untuk project number: ".$project_number.", pada tanggal: ".$today." passing_id: ".$passing_id;
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = auth()->user()->name;
                $log->category_activity = "Data Check Point";
                $log->the_activity = $desc;
                $log->save();
                return "success";
            
            } else {
                return "fail";
            }

        } else {
            return "kosong";
        }
    }

    public function Absent(){
        
        $username = auth()->user()->name;
        $today = date('Y-m-d');
        // $today = date('2022-07-05');
        $check_absen = absen_employee::where('username', $username)
                                    ->where('start_date', 'LIKE', ''.$today.'%')
                                    ->first();

        // check datanya ada atau ngk
        if(!is_null($check_absen)){
            // Kalo gk sama dengan null (datanya ada) [munculin absen keluar]
            // echo "Datanya ada";
            return view('HeadTeam/absent/newAbsent', compact('check_absen'));

        } else {
            // Kalo null berarti datanya gk ada [munculin absen masuk]
            // echo "datanya gk ada !";
            return view('HeadTeam/absent/absentMenu');

        }
    }

    public function do_abenst(Request $req){
        // dd($req->all());
        // echo $req->jenis_absent;
        if($req->jenis_absent == 'absent_masuk'){
            return view('HeadTeam/absent/absent_masuk');

        } else if($req->jenis_absent == 'absen_tidak_masuk'){
            return view('HeadTeam/absent/absentMenu');

        } else {
            return view('HeadTeam/absent/absentMenu');
        }
    }

    public function processAbsentMasuk(Request $req){
        // return $req->all();
        if($req->absent_masuk == 'office'){
            if(empty($req->photoStore_office)){
                echo 'photo not found!';
            } else {
                echo "Absent Office";
            }

        } else if($req->absent_masuk == 'project'){
            if(empty($req->photoStore_project)){
                echo 'photo not found!';
            } else {
                echo "Absent Project";
            }

        } else {
            if(empty($req->photoStore)){
                echo 'photo not found!';
            } else {
                echo "Absent Lainnya";
            }
        }
    }

    public function processAbsentEntry(Request $req){
        if(empty($req->photoStore)){
            echo die('photo not found!');
        
        } else {
            
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $passing_id = substr(str_shuffle($permitted_chars), 0, 16);
            $latitude = $req->latitude;
            $longitude = $req->longitude;
            $encoded_data = $req->photoStore;
            $binary_data = base64_decode($encoded_data);
            $file_name = "absentEntry-".$passing_id.'.PNG';
            // Storage::disk('public')->put('uploads/photoCheckin/'.$file_name, $binary_data);
            if(Storage::disk('public')->put('uploads/photoAbsentEntry/'.$file_name, $binary_data)){
                
                $days = date('w');
                if($days == 0){
                    $hari = "Sunday";

                } else if($days == 1){
                    $hari = "Monday";

                } else if($days == 2){
                    $hari = "Tueday";

                } else if($days == 3){
                    $hari = "Wednesday";

                } else if($days == 4){
                    $hari = "Thuesday";

                } else if($days == 5){
                    $hari = "Friday";

                } else if($days == 1){
                    $hari = "Saturday";
                }

                $desc = "Doing Absent on ".$hari;
                $datanya = new absen_employee();
                $datanya->passing_id = $passing_id;
                $datanya->username = auth()->user()->name;
                $datanya->description = $desc;
                $datanya->keterangan_other = 'Absent Office';
                $datanya->start_date = date('Y-m-d H:m:s');
                $datanya->end_date = null;
                $datanya->duration = null;
                $execute = $datanya->save();

                //Insert Log absent yg akan di tampilak di fullcalender
                $desc_log = "Absent Entry";
                $log = new log_absen();
                $log->passing_id = $passing_id;
                $log->username = auth()->user()->name;;
                $log->category_activity = "Data Absent";
                $log->title = $desc_log;
                $log->start_date = date('Y-m-d H:m:s');
                $log->latitude = $latitude;
                $log->longitude = $longitude;
                $log->photonya = $file_name;
                $log->save();
                
                //Insert Log Activiry before direct page
                $log2 = new log_activity();
                $log2->username = auth()->user()->name;
                $log2->category_activity = "Data Absent";
                $log2->the_activity = $desc.", with passing id: ".$passing_id;
                $log2->save();

                echo "success";
            } else {
                echo die('Could not save image! check file permission.');
            }
        }
    }

    public function processAbsentOut(Request $req){
        if(empty($req->photoStore_out)){
            echo die('photo not found!');

        } else {
            // check apakah absen hari ini ada atau tidak 
            $check_absen = absen_employee::where('passing_id', $req->passing_id)
            ->first();

            $id = $check_absen->id;
            $start_date = $check_absen->start_date;
            $now = date('Y-m-d H:i:s');

            $start_str = strtotime($start_date);
            $end_str = strtotime($now);
            $total_ = $end_str - $start_str;
            $total_menit = floor($total_ / (60) ); // convert to minute
            
            // $total_menit = 300;
            // echo $total_menit." Menit";
            // die();

            // check apakah dia udh lebih dari 480 Menit? (8 Jam)
            if($total_menit >= 480){
                $encoded_data = $req->photoStore;
                $binary_data = base64_decode($encoded_data);
                $file_name = "absentEntry-".$req->passing_id.'.PNG';
                Storage::disk('public')->put('uploads/photoAbsentOut/'.$file_name, $binary_data);

                absen_employee::where('id',$id)
                    ->update(['end_date' => $now, 'duration' => $total_menit]);
                
                //Insert Log absent yg akan di tampilak di fullcalender
                $desc_log = "Absent Out";
                $log = new log_absen();
                $log->passing_id = $req->passing_id;
                $log->username = auth()->user()->name;;
                $log->category_activity = "Data Absent";
                $log->title = $desc_log;
                $log->start_date = date('Y-m-d H:i:s');
                $log->latitude = $req->latitude_out;
                $log->longitude = $req->longitude_out;
                $log->save();
                
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = auth()->user()->name;
                $log->category_activity = "Data Absent";
                $log->the_activity = $desc_log.", with passing id: ".$req->passing_id;
                $log->save();
                echo "success";
            } else {
                echo "min_8jam";
            }
        }
    }

    public function get_dataAbsent(Request $req){
        $username   = auth()->user()->name;
        $data = log_absen::where('username', $username)->get();
        $schedule = array();
        foreach($data as $row){

            $color = '';
            if($row->title == "Absent Alpha"){
                $color = '#FC890E';
            } else if($row->title == "Absent Entry"){
                $color = '#FA1111';
            } else {
                $color = '#0E44FC';
            }

            $schedule[] = [
                'title' => $row->title,
                'start' => $row->start_date,
                'end'   => $row->start_date,
                'color' => $color,
            ];
        }
        return response()->json($schedule);
    }

    // KEPAKE BUAT ABSEN BASE ON WHERE USER NYA AJA
    public function old_absent(){
        $username = auth()->user()->name;
        $today = date('Y-m-d');
        $check_absen = absen_employee::where('username', $username)
                                    ->where('start_date', 'LIKE', ''.$today.'%')
                                    ->first();

        // dd($check_absen);
        return view('HeadTeam/absent', compact('check_absen'));
    }

    public function checkpoint(){
        // $ip = '120.188.92.254';

        //TORANN GEOIP
        //Production Code
        // $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        

        //Development Code
        // $checkLocation = geoip()->getLocation($ip);
        // dd($checkLocation);

        // Stevebauman
        // $currentUserInfo = Location::get($ip);
        // dd($currentUserInfo->cityName);

        $datanya = array();
        $position = checkPointPosition::all();
        foreach($position as $row){
            $datanya[] = [
                'type' => 'Feature',
                'properties'=> [
                    'description'=>'<strong>'.$row->username.'</strong><p> '.$row->description.'</p>'
                ],
                'geometry'=> [
                    'type'=> 'Point',
                    'coordinates'=> [$row->longitude, $row->latitude] 
                ]
            ];
        }
        // dd($datanya);
        return view('HeadTeam/checkpoint', compact('datanya'));
    }

    public function processCheckpoint(Request $req){
        // dd($req->all());
        if(empty($req->photoStore)){
            echo die('Could not save image! check file permission.');
        
        } else {

            $encoded_data = $req->photoStore;
            $binary_data = base64_decode($encoded_data);
            $file_name = "checkin-".uniqid().'.PNG';

            if(Storage::disk('public')->put('uploads/photoCheckPoint/'.$file_name, $binary_data)){
                
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $passing_id = substr(str_shuffle($permitted_chars), 0, 16);
                $latitude = $req->latitude;
                $longitude = $req->longitude;

                $desc = "Check Point Position in latitude: ".$latitude.", longitude: ".$longitude;
                $log = new checkPointPosition();
                $log->passing_id = $passing_id;
                $log->username = auth()->user()->name;
                $log->description = $desc;
                $log->latitude = $latitude;
                $log->longitude = $longitude;
                $log->datenya = date('Y-m-d H:i:s');
                $log->photonya = $file_name;
                $log->save();
                
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = auth()->user()->name;
                $log->category_activity = "Data Check Point Position";
                $log->the_activity = $desc.", with passing id: ".$passing_id;
                $log->save();

                echo "success";
            } else {
                echo die('Could not save image! check file permission.');
            }
        }
    }

    public function get_data_checkpoint(){
        
        $datanya = array();
        $position = checkPointPosition::all();
        foreach($position as $row){
            $datanya[] = [
                'type' => 'Feature',
                'properties'=> [
                    'description'=>'<strong>'.$row->username.'</strong><p> '.$row->description.'</p>'
                ],
                'geometry'=> [
                    'type'=> 'Point',
                    'coordinates'=> [$row->longitude, $row->latitude] 
                ]
            ];
        }
        return response()->json($datanya);
    }

    function countDistance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet  = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('miles','feet','yards','kilometers','meters'); 
    }

    public function hitungjarak(){
        $point1 = array("lat" => -6.2047283, "long" => 106.8661531);        // home
        // $point2 = array("lat" => -6.3816592, "long" => 106.8680347 );   // office
        $point2 = array("lat" => -6.2061225, "long" => 106.8638568 );     // rsud

        $distance = $this->countDistance($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
        $meter = $distance['meters'];
        
        if($meter > 100){
            echo "Lokasi anda masih jauh dari kantor";
        } else {
            echo "oke, selamat :)";
        }
        // dd($meter);
    }

    public function check_location(){
        $ip = '180.252.165.146';
        $data = Location::get($ip);
        dd($data);
    }


    // DATA CUSTOMER ==----
    public function data_customer(){
        $data_cust = data_customer::all();
        return view('HeadTeam/customer/data_customer', compact('data_cust'));
    }

    public function prosescustomeradd(Request $req){

        $data_customer = new data_customer();
        $data_customer->nama_customer = $req->customer_name;
        $data_customer->address_customer = $req->alamat_customer;
        $data_customer->address_customer1 = $req->alamat_customer1;
        $data_customer->deskripsi_customer = $req->deskripsi_customer;
        $execute = $data_customer->save();

        if($execute){
            
            $desc = "Has been make new customer: ".$req->customer_name;
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = auth()->user()->name;
            $log->category_activity = "Data Customer";
            $log->the_activity = $desc;
            $log->save();
            return redirect()->route('HeadTeam.data_customer')->with('success', 'Berhasil membuat data customer baru.');
        
        } else {
            return redirect()->route('HeadTeam.data_customer')->with('error', 'Upps GAGAL, Ada yang salah!');
        }
    }

    public function edit_customer($id){
        $data_customer = data_customer::findOrFail($id);
        // dd($data_customer);
        $datanya = ['data_customer' => $data_customer];
        
        return view('HeadTeam/customer/edit_customer', compact('datanya'));
    }

    public function prosescustomeredit(Request $req){
        
        //UBAH STATUSNYA PEMBELIAN
        $execute = data_customer::where('id', $req->id)
        ->update([
            'nama_customer' => $req->customer_name,
            'address_customer' => $req->alamat_customer,
            'address_customer1' => $req->alamat_customer1,
            'deskripsi_customer' => $req->deskripsi_customer
        ]);

        if($execute){
            
            //Insert Log Activiry before direct page
            $desc = "Has been Update data Customer: ".$req->customer_name." ";
            $log = new log_activity();
            $log->username = auth()->user()->name;
            $log->category_activity = "Data Customer";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.edit_customer', $req->id)->with('success', 'Berhasil Update Data Customer.');
        
        } else {
            return redirect()->route('HeadTeam.edit_customer', $req->id)->with('error', 'Upps GAGAL perbarui, Ada yang salah!');
        }
    }
    public function hapusdatacustomerproses($id){
        $datanya = data_customer::where('id',$id)->first();
        $customer_name = $datanya->nama_customer;

        $desc = "Delete Data Customer: ".$customer_name;
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;;
        $log->category_activity = "Data Customer";
        $log->the_activity = $desc;
        $log->save();
        
        data_customer::where('id', $id)->delete();
        return redirect()->route('HeadTeam.data_customer')->with('success', 'Data Customer Has been Delete');
    }

    // FOR FINANCIAL MENU ==---

    // PENJUALANAN
    public function penjualan(){
        return view('HeadTeam/penjualan/menuPenjualanan');
    }

    public function getPenjualan(Request $request){
        if ($request->ajax()) {
            $datanya = penjualan::latest()->get();
            return Datatables::of($datanya)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $link_edit = route('HeadTeam.editPenjualan', $row->project_number);
                    $link_delete = route('HeadTeam.hapusPenjualan', $row->project_number);
                    $alert_for_delete = "return confirm('Are you sure you want to Delete this?');";

                    // $link_invoice = route('HeadTeam.invoicePenjualan');
                    $btn = '<div class="btn-group dropup">
                    <a href="'.$link_edit.'" class="btn bg-slate btn-xs"><i class="icon-database-edit2"></i></a>
                    <a href="'.$link_delete.'" onclick="'.$alert_for_delete.'" class="btn btn-warning btn-xs" ><i class="icon-trash-alt"></i></a>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function buatPenjualan(){
        $category = category_penjualanan::all();
        $data_customer = data_customer::all();
        
        $datanya = ['category' => $category, 'data_customer' => $data_customer];
        return view('HeadTeam/penjualan/create_penjualan', compact('datanya'));
    }

    public function prosesPenjualan(Request $req){
        // dd($req->all());

        // Validation
        $validator = Validator::make($req->all(), [
            'customer_name' => 'required|max:255',
            'po_number' => 'required',
            'po_date' => 'required',
            'category' => 'required',
            'nominal_po' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'info_payment' => 'required'
            
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.buatPenjualan'))
                        ->withErrors($validator)
                        ->withInput();
        }

        // echo "validate is complete.";
        // die();

        // Autoincreame Generate ID
        $year = date('y');
        $jumlah = penjualan::count();
        // $jumlah = 109;
        $count = $jumlah + 1;
        $leng = strlen($count);
        
        if($leng == 1){
            $angka = "0".$count;
            
        } else {
            $angka = $count;
        }

        // echo "Total nomer urut: ".$count;
        // echo "<br>Total karakter: ".$leng;
        // echo "<br>Total angka: ".$angka;
        // die();
        $format = "PRY".$year.$angka;
        // dd($format);

         // menghapus format pemisah nominal 
        $nominal_po_string = $req->nominal_po;
        $nominal_po_number = str_replace(".", "", $nominal_po_string);

        $penjualanan = new penjualan();
        $penjualanan->project_number = $format;
        $penjualanan->nama_customer = $req->customer_name;
        $penjualanan->alamat_customer = $req->alamat_customer;
        $penjualanan->po_number = $req->po_number;
        $penjualanan->po_date = $req->po_date;
        $penjualanan->po_category = $req->category;
        $penjualanan->po_nominal = $nominal_po_number;
        $penjualanan->deskripsi = $req->deskripsi;
        $penjualanan->lokasi = $req->lokasi;
        $penjualanan->info_pembayaran = $req->info_payment;
        $penjualanan->project_koordinator = "Erwin";
        $penjualanan->creator = $req->creator;
        $execute = $penjualanan->save();
        
        if($execute){
            
            // INSERT RUGI LABA 
            $rugilaba = new rugilaba();
            $rugilaba->project_number = $format;
            $rugilaba->nama_customer = $req->customer_name;
            $rugilaba->po_number = $req->po_number;
            $rugilaba->po_date = $req->po_date;
            $rugilaba->po_category = $req->category;
            $rugilaba->po_nominal = $nominal_po_number;
            $rugilaba->total_pemasukan = '0';             // CALCULATE FROM INVOICE
            $rugilaba->proses_pembayaran = '0';           // CALCULATE FROM INVOICE
            $rugilaba->total_pemasukan_with_ppn11 = '0';  // CALCULATE FROM INVOICE
            $rugilaba->sisa_nominal = '0';                // CALCULATE FROM INVOICE
            $rugilaba->total_pengeluaran = '0';           // CALCULATE FROM INVOICE
            $rugilaba->creator = $req->creator;
            $execute = $rugilaba->save();

            // INSERT COST RUGI LABA
            $rugilaba_cost = new rugilaba_cost();
            $rugilaba_cost->project_number = $format;
            $rugilaba_cost->cost_material = '0';
            $rugilaba_cost->cost_jasa = '0';
            $rugilaba_cost->cost_lainnya = '0';
            $execute = $rugilaba_cost->save();

            //Insert Log Activiry before direct page
            $desc = "Has been Created new data Penjualan & Rugi Laba with Project Number: <b>".$format."</b> ";
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Penjualan & Rugi Laba";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.penjualan')->with('success', 'Berhasil membuat data penjualan baru.');
        
        } else {
            return redirect()->route('HeadTeam.penjualan')->with('error', 'Upps GAGAL, Ada yang salah!');
        }
    }

    public function editPenjualan($project_number){
        // return "Edit project number: ".$project_number;
        $data_pn = penjualan::where('project_number',$project_number)->first();
        $category = category_penjualanan::all();
        $data_invoice = invoice::where('project_number',$project_number)->get();
        $po_file   = purchasingorder_file::where('project_number','=',$project_number)->get();

        $datanya = ['data_pn' => $data_pn, 'category' => $category, 'data_invoice' => $data_invoice, 'po_file' => $po_file];
        return view('HeadTeam/penjualan/showDetail_penjualan', compact('datanya'));
    }

    public function prosesUpdatePenjualan(Request $req){
        // Validation
        $validator = Validator::make($req->all(), [
            'customer_name' => 'required|max:255',
            'po_number' => 'required',
            'po_date' => 'required',
            'category' => 'required',
            'nominal_po' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'info_pembayaran' => 'required'
            
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.editPenjualan', $req->project_number))
                        ->withErrors($validator)
                        ->withInput();
        }

        $nominal_po_string = $req->nominal_po;
        $nominal_po_number = str_replace(".", "", $nominal_po_string);

        //UBAH STATUSNYA PEMBELIAN
        $execute = penjualan::where('project_number', $req->project_number)
        ->update([
            'nama_customer' => $req->customer_name,
            'po_number' => $req->po_number,
            'po_date' => $req->po_date,
            'po_category' => $req->category,
            'po_nominal' => $nominal_po_number,
            'deskripsi' => $req->deskripsi,
            'lokasi' => $req->lokasi,
            'info_pembayaran' => $req->info_pembayaran
        ]);

        if($execute){
            
            //Insert Log Activiry before direct page
            $desc = "Has been Update data Penjualan & Rugi Laba with Project Number: ".$req->customer_name." ";
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Penjualan & Rugi Laba";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.editPenjualan', $req->project_number)->with('success', 'Berhasil membuat data penjualan baru.');
        
        } else {
            return redirect()->route('HeadTeam.editPenjualan', $req->project_number)->with('error', 'Upps GAGAL, Ada yang salah!');
        }
    }

    public function hapusPenjualan($project_number){

        invoice::where('project_number', $project_number)->delete();
        invoices_barang::where('project_number', $project_number)->delete();
        rugilaba::where('project_number', $project_number)->delete();
        $execute = penjualan::where('project_number', $project_number)->delete();
        
        if($execute){
            $desc = "Delete Data Penjualan with Project Number: ".$project_number;
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = auth()->user()->name;;
            $log->category_activity = "Data Customer";
            $log->the_activity = $desc;
            $log->save();
            return redirect()->route('HeadTeam.penjualan')->with('success', 'Data Penjualan Has been Delete');
        }
    }

    public function get_customer_name(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = data_customer::select("nama_customer")
            		->where('nama_customer','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }
    public function get_detail_customer_name(Request $request){
        $datanya = data_customer::where('nama_customer', $request->id)->first();
        return $datanya;
    }

    public function get_projectNumberForAbsen(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = penjualan::select("project_number", "deskripsi")
                    ->where('project_number','LIKE',"%$search%")
                    ->get();
        }
        return response()->json($data);
    }

    public function get_projectNumber(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = penjualan::select("project_number")
            		->where('project_number','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }
    public function get_data_detail_project_number(Request $request){
        $set_data = [];

        $datanya = DB::table('penjualans')
            ->join('data_customers', 'penjualans.nama_customer', '=', 'data_customers.nama_customer')
            ->select('penjualans.nama_customer','penjualans.po_number','penjualans.po_nominal', 'data_customers.address_customer', 'data_customers.address_customer1','data_customers.deskripsi_customer',)
            ->where('project_number', $request->id)->first();

        return $datanya;
    }

    public function executefilepo(Request $req){
        // dd($req->all());
        $project_number = $req->project_number;
        $name_file_photo = $req->file('filenya')->getClientOriginalName();
        $encoded_data = $name_file_photo;
        $binary_data = base64_decode($encoded_data);
        // $file_name = uniqid()."-".$req->passing_id.'.pdf';

        $path = $req->file('filenya')->storeAs('uploads/filepo/', $name_file_photo);

        $po_file = new purchasingorder_file();
        $po_file->project_number   = $project_number;
        $po_file->file_name    = $name_file_photo;      
        $po_file->creator      = $req->creator;
        $execute = $po_file->save();

        if($execute){
               
            //Insert Log Activiry before direct page
            $desc = "Has been Add new file attachment purchasing order: ".$project_number." and name file: ".$name_file_photo;
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Invoices";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.editPenjualan', $req->project_number)->with('success', 'Berhasil melampirkan file Purchasing Order.');
        } else {
            return redirect()->route('HeadTeam.editPenjualan', $req->project_number)->with('error', 'Upps gagal melampirkan file Purchasing Order, Ada yang salah!');
        }
    }

    // INVOICE
    function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

    public function getInvoices(Request $request){
        if ($request->ajax()) {
            // $datanya = DB::table('invoices')
            // ->join('penjualans', 'invoices.project_number', '=', 'penjualans.project_number')
            // ->select('invoices.id','invoices.passing_id','invoices.no_invoice','invoices.project_number','invoices.nama_customer','invoices.nominal_pembayaran','invoices.subtotal','invoices.proses_percent','invoices.status_invoice','invoices.po_number','invoices.keterangan','invoices.proses_category','invoices.nominal_ppn11','invoices.nominal_pembayaran_with_ppn11', 'penjualans.deskripsi','penjualans.lokasi')
            // ->orderBy('id', 'desc');
            $datanya = DB::table('invoices')
            ->join('penjualans', 'invoices.project_number', '=', 'penjualans.project_number')
            ->select('invoices.*','penjualans.deskripsi','penjualans.lokasi')->get();
            return Datatables::of($datanya)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $link_edit = route('HeadTeam.editinvoice', $row->passing_id);
                    $link_delete = route('HeadTeam.hapusinvoice', $row->passing_id);
                    $alert_for_delete = "return confirm('Are you sure you want to Delete This?');";

                    // $link_invoice = route('HeadTeam.invoicePenjualan');
                    $btn = '<div class="btn-group dropup">
                    <a href="'.$link_edit.'" class="btn bg-slate btn-xs"><i class="icon-database-edit2"></i></a>
                    <a href="'.$link_delete.'" onclick="'.$alert_for_delete.'" class="btn btn-warning btn-xs" ><i class="icon-trash-alt"></i></a>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function invoice(){

        $data_new = DB::table('invoices')->where('status_invoice', 'New')->count();
        $nominal_data_new = DB::table('invoices')->where('status_invoice', 'New')->sum('nominal_pembayaran');
        // dd($nominal_data_new);

        $data_sent = DB::table('invoices')->where('status_invoice', 'Sent')->count();
        $nominal_data_sent = DB::table('invoices')->where('status_invoice', 'Sent')->sum('nominal_pembayaran');
        // dd($nominal_data_sent);

        $data_paid_off = DB::table('invoices')->where('status_invoice', 'paid_off')->count();
        $nominal_data_paid_off = DB::table('invoices')->where('status_invoice', 'paid_off')->sum('nominal_pembayaran');
        
        $data_keseluruhan = DB::table('invoices')->count();
        $nominal_data_keseluruhan = DB::table('invoices')->sum('nominal_pembayaran');
        
        $datanya = [
            'data_new' => $data_new, 
            'nominal_data_new' => $nominal_data_new,
            'data_sent' => $data_sent, 
            'nominal_data_sent' => $nominal_data_sent,
            'data_paid_off' => $data_paid_off, 
            'nominal_data_paid_off' => $nominal_data_paid_off,
            'data_keseluruhan' => $data_keseluruhan, 
            'nominal_data_keseluruhan' => $nominal_data_keseluruhan
        ];
        return view('HeadTeam/invoice/menuInvoice', compact('datanya'));
    }

    public function sortinvoice($type){
        $data_invoice = invoice::where('status_invoice','=', $type)->get();

        // $data_invoice = DB::table('invoices')
        //     ->join('penjualans', 'invoices.project_number', '=', 'penjualans.project_number')
        //     ->select('invoices.*','penjualans.deskripsi','penjualans.lokasi')
        //     ->where('invoices.status_invoice', $type)->get();

        $data_new = DB::table('invoices')->where('status_invoice', 'New')->count();
        $nominal_data_new = DB::table('invoices')->where('status_invoice', 'New')->sum('nominal_pembayaran');
        // dd($nominal_data_new);

        $data_sent = DB::table('invoices')->where('status_invoice', 'Sent')->count();
        $nominal_data_sent = DB::table('invoices')->where('status_invoice', 'Sent')->sum('nominal_pembayaran');
        // dd($nominal_data_sent);

        $data_paid_off = DB::table('invoices')->where('status_invoice', 'paid_off')->count();
        $nominal_data_paid_off = DB::table('invoices')->where('status_invoice', 'paid_off')->sum('nominal_pembayaran');
        
        $data_keseluruhan = DB::table('invoices')->count();
        $nominal_data_keseluruhan = DB::table('invoices')->sum('nominal_pembayaran');
        
        $datanya = [
            'data_invoice' => $data_invoice,
            'data_new' => $data_new, 
            'nominal_data_new' => $nominal_data_new,
            'data_sent' => $data_sent, 
            'nominal_data_sent' => $nominal_data_sent,
            'data_paid_off' => $data_paid_off, 
            'nominal_data_paid_off' => $nominal_data_paid_off,
            'data_keseluruhan' => $data_keseluruhan, 
            'nominal_data_keseluruhan' => $nominal_data_keseluruhan
        ];
        return view('HeadTeam/invoice/filterInvoice', compact('datanya'));
    }

    public function buatinvoice(){
        $persen = ref_proses_persen::all();
        $proses_category = ref_proses_category::all();
        $datanya = ['persen' => $persen, 'proses_category' => $proses_category];
        return view('HeadTeam/invoice/create_invoice', compact('datanya'));
    }

    public function executeprocessinvoice(Request $req){

        $validator = Validator::make($req->all(), [
            'project_number' => 'required|max:255',
            'proses_category' => 'required',
            'due_date' => 'required',
            'keterangan' => 'required',
            'nominal_pembayaran' => 'required',
            'nama_customer' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.buatinvoice'))
                        ->withErrors($validator)
                        ->withInput();
        }

        // Passing ID
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

        // Autoincreame Generate ID
        $bulan = date('n');
        $romawi = $this->getRomawi($bulan);
        $year = date('y');
        $jumlah = invoice::count();
        // $jumlah = 99;
        $count = $jumlah + 1;
        $leng = strlen($count);
        
        if($leng == 1){
            $angka = "00".$count;
            
        } else if($leng == 2){
            $angka = "0".$count;
            
        } else {
            $angka = $count;
        }

        // 001/INV/VII/22
        // $format = "PRY".$year.$angka;
        $format = $angka."/INV/".$romawi."/".$year;

        // insert ke table barang invoice 
        if(!empty($req->deskripsi)){
            for($i = 0; $i < count($req->deskripsi); $i++){
                if(!empty($req->deskripsi[$i])){
                    $deskripsi  = $req->deskripsi[$i];
                    $satuan     = $req->satuan[$i];
                    $quantity   = $req->quantity[$i];
                    $harga_unit = $req->harga_unit[$i];
                    $total_harga= $req->total_harga[$i];

                    
                    $invoices_barang = new invoices_barang();
                    $invoices_barang->passing_id = $passing_id;
                    $invoices_barang->no_invoice = $format;
                    $invoices_barang->project_number = $req->project_number;
                    $invoices_barang->po_number = $req->po_number;
                    $invoices_barang->deskripsi = $deskripsi;
                    $invoices_barang->satuannya = $satuan; 
                    $invoices_barang->quantity = $quantity;
                    $invoices_barang->harga_unit = $harga_unit; 
                    $invoices_barang->total_harga = $total_harga; 
                    $invoices_barang->creator = $req->creator;
                    $execute = $invoices_barang->save();
                }
            }
        }

        // check apakah ada discount atau tidak..
        if($req->have_discount == "no"){
            $nominal_discount = "0";
        } else {
            $nominal_discount = $req->nominal_discount;
        }


        $subtotal_query = invoices_barang::where('passing_id','=',$passing_id)->sum('total_harga');
        // subtotal barang (item invoice) dikurang discount, mau discount nya ada atau ngk pokone di kurang.. check di if else nya
        $subtotal_query = $subtotal_query - $req->nominal_discount;

        $proses_persen  = $req->proses_persen;
        $subtotal       = $subtotal_query*$proses_persen/100; 

        // menghapus format pemisah nominal 
        $nominal_pembayaran = $req->nominal_pembayaran;
        $nominal_pembayaran_number = str_replace(".", "", $nominal_pembayaran);
        

        // check apakah Nominal Pembayaran PO nilainya sama dengan seluruh total harga barang
        if($nominal_pembayaran_number != $subtotal_query){
            // jika gk sama maka error (gk bisa buat invoice)
            invoices_barang::where('passing_id', $passing_id)->delete();
            return redirect()->route('HeadTeam.buatinvoice')->with('error', 'Upps gagal, Nominal Pembayaran PO dan Seluruh total harga barang tidak sama.');
        
        }
        // if($nominal_pembayaran_number != $subtotal_query){
        //     echo "Nominal tidak sama";
        //     die();

        //     // jika gk sama maka error (gk bisa buat invoice)
        //     invoices_barang::where('passing_id', $passing_id)->delete();
        //     return redirect()->route('HeadTeam.buatinvoice')->with('error', 'Upps gagal, Nominal Pembayaran PO dan Seluruh total harga barang tidak sama.');
        // } else {
        //     echo "oke";
        // }
        // die();

        
        // get nominal ppn 11%
        $ppn_11persen = $subtotal*11/100;

        // get nominal proses + ppn
        $nominal_with_ppn = $subtotal + $ppn_11persen; 

        // update di RugiLaba
        $dataRL = rugilaba::where('project_number', $req->project_number)->first();
        $nominal_po = $dataRL->po_nominal;
        $uang_masuk = $dataRL->total_pemasukan;
        $proses_saat_ini = $dataRL->proses_pembayaran;
        $total_uang_pemasukan_with_ppn11 = $dataRL->total_pemasukan_with_ppn11;

        $nominal_with_ppn = $nominal_with_ppn + $total_uang_pemasukan_with_ppn11;
        $total_uang_sisa = $nominal_po - $subtotal;

        //proses pembayaran berupa %
        $proses_saat_ini = $proses_saat_ini + $proses_persen;

        //UBAH STATUSNYA PEMBELIAN
        $execute = rugilaba::where('project_number', $req->project_number)
        ->update([
            'total_pemasukan' => $subtotal,
            'proses_pembayaran' => $proses_saat_ini,
            'total_pemasukan_with_ppn11' => $nominal_with_ppn,
            'sisa_nominal' => $total_uang_sisa,
            'total_pengeluaran' => '0'
        ]);

        // setup categorynya, jika category nya baru (lainnya) maka kita anggap dia category baru dan kita masukan ke table
        if($req->proses_category == "Lainnya"){
            $proses_category = $req->proses_category_lainnya;
            
            $ref_proses_category = new ref_proses_category();
            $ref_proses_category->proses_categories = $proses_category;
            $execute = $ref_proses_category->save();

        } else {
            $proses_category = $req->proses_category;
        }

        $invoices = new invoice();
        $invoices->passing_id           = $passing_id;
        $invoices->no_invoice           = $format;
        $invoices->project_number       = $req->project_number;
        $invoices->po_number            = $req->po_number;
        $invoices->nama_customer        = $req->nama_customer;
        $invoices->address_customer     = $req->address_customer; 
        $invoices->address_customer1    = $req->address_customer1;
        $invoices->deskripsi_customer   = $req->deskripsi_customer;
        $invoices->proses_category      = $proses_category;
        $invoices->proses_percent       = $proses_persen;
        $invoices->subtotal             = $subtotal; 
        $invoices->nominal_pembayaran   = $nominal_pembayaran_number;
        $invoices->nominal_ppn11        = $ppn_11persen;
        $invoices->nominal_pembayaran_with_ppn11 = $nominal_with_ppn;
        $invoices->due_date             = $req->due_date;
        $invoices->keterangan           = $req->keterangan;
        $invoices->status_invoice       = 'New';          
        $invoices->have_discount        = $req->have_discount;
        $invoices->nominal_discount     = $nominal_discount;
        $invoices->aktual_pembayaran    = '0';
        $invoices->create_manual        = 'No';
        $invoices->creator              = $req->creator;
        $execute = $invoices->save();

        if($execute){
            
            //Insert Log Activiry before direct page
            $desc = "Has been Create new Invoice for Project Number: ".$req->project_number." ";
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Invoices";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.invoice', $req->project_number)->with('success', 'Berhasil membuat Invoice baru.');
        } else {
            return redirect()->route('HeadTeam.invoice', $req->project_number)->with('error', 'Upps gagal membuat baru invoice, Ada yang salah!');
        }
        
    }

    public function buatinvoice_sisa($project_number){
        
        $data_rl    = rugilaba::where('project_number','=',$project_number)->first();
        $data_cust  = data_customer::where('nama_customer', $data_rl->nama_customer)->first();
        if($data_rl->proses_pembayaran == 100){
            return redirect()->route('HeadTeam.editrugilaba', $project_number)->with('error', 'Upps gagal, Invoice sudah 100%.');   
        }
        
        // mendapatkan saat ini proses udh brp persen
        $percent = 100 - $data_rl->proses_pembayaran;
        $persen     = ref_proses_persen::whereBetween('proses_persen', [0, $percent])->get();
        $proses_category = ref_proses_category::all();
        
        $datanya = ['data_rl' => $data_rl, 'data_cust' => $data_cust, 'persen' => $persen, 'proses_category' => $proses_category];
        return view('HeadTeam/invoice/create_invoice_sisa', compact('datanya'));
    }

    public function executeprocessinvoice_sisa(Request $req){
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'project_number' => 'required|max:255',
            'proses_category' => 'required',
            'due_date' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.buatinvoice_sisa', $req->project_number))
                        ->withErrors($validator)
                        ->withInput();
        }

        $subtotal_query = invoices_barang::where('project_number','=',$req->project_number)->sum('total_harga');
        $proses_persen  = $req->proses_persen;
        $subtotal       = $subtotal_query*$proses_persen/100; 

        // get nominal ppn 11%
        $ppn_11persen = $subtotal*11/100;

        // get nominal proses + ppn
        $nominal_with_ppn_inv = $subtotal + $ppn_11persen; 

        // update di RugiLaba
        $dataRL = rugilaba::where('project_number', $req->project_number)->first();
        $nominal_po = $dataRL->po_nominal;
        $uang_masuk = $dataRL->total_pemasukan;
        $proses_saat_ini = $dataRL->proses_pembayaran;
        $total_uang_pemasukan_with_ppn11 = $dataRL->total_pemasukan_with_ppn11;

        $total_pemasukan = $uang_masuk + $subtotal;
        $nominal_with_ppn = $nominal_with_ppn_inv + $total_uang_pemasukan_with_ppn11;
        $total_uang_sisa = $nominal_po - $total_pemasukan;

        //proses pembayaran berupa %
        $proses_saat_ini = $proses_saat_ini + $proses_persen;

        //UBAH STATUSNYA PEMBELIAN
        $execute = rugilaba::where('project_number', $req->project_number)
        ->update([
            'total_pemasukan' => $total_pemasukan,
            'proses_pembayaran' => $proses_saat_ini,
            'total_pemasukan_with_ppn11' => $nominal_with_ppn,
            'sisa_nominal' => $total_uang_sisa,
            'total_pengeluaran' => '0'
        ]);

        // Passing ID
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

        // Autoincreame Generate ID
        $bulan = date('n');
        $romawi = $this->getRomawi($bulan);
        $year = date('y');
        $jumlah = invoice::count();
        // $jumlah = 99;
        $count = $jumlah + 1;
        $leng = strlen($count);
        
        if($leng == 1){
            $angka = "00".$count;
            
        } else if($leng == 2){
            $angka = "0".$count;
            
        } else {
            $angka = $count;
        }

        // 001/INV/VII/22
        // $format = "PRY".$year.$angka;
        $format = $angka."/INV/".$romawi."/".$year;

        // setup categorynya, jika category nya baru (lainnya) maka kita anggap dia category baru dan kita masukan ke table
        if($req->proses_category == "Lainnya"){
            $proses_category = $req->proses_category_lainnya;
            
            $ref_proses_category = new ref_proses_category();
            $ref_proses_category->proses_categories = $proses_category;
            $execute = $ref_proses_category->save();

        } else {
            $proses_category = $req->proses_category;
        }

        $invoices = new invoice();
        $invoices->passing_id           = $passing_id;
        $invoices->no_invoice           = $format;
        $invoices->project_number       = $req->project_number;
        $invoices->po_number            = $req->po_number;
        $invoices->nama_customer        = $req->nama_customer;
        $invoices->address_customer     = $req->address_customer; 
        $invoices->address_customer1    = $req->address_customer1;
        $invoices->deskripsi_customer   = $req->deskripsi_customer;
        $invoices->proses_category      = $proses_category;
        $invoices->proses_percent       = $req->proses_persen;
        $invoices->subtotal             = $subtotal; 
        $invoices->nominal_pembayaran   = $nominal_po;
        $invoices->nominal_ppn11        = $ppn_11persen;
        $invoices->nominal_pembayaran_with_ppn11 = $nominal_with_ppn_inv;
        $invoices->due_date             = $req->due_date;
        $invoices->keterangan           = $req->keterangan;
        $invoices->aktual_pembayaran    = '0';
        $invoices->status_invoice       = 'New';
        $invoices->create_manual        = 'No';          
        $invoices->creator              = $req->creator;
        $execute = $invoices->save();

        if($execute){
            
            //Insert Log Activiry before direct page
            $desc = "Has been Create new Invoice for Project Number: ".$req->project_number." ";
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Invoices";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.invoice')->with('success', 'Berhasil membuat Invoice baru.');
        } else {
            return redirect()->route('HeadTeam.invoice')->with('error', 'Upps gagal membuat baru invoice, Ada yang salah!');
        }
    }

    public function buatinvoicemanual(){
        $proses_category = ref_proses_category::all();
        $datanya = ['proses_category' => $proses_category];
        return view('HeadTeam/invoice/create_invoice_manual', compact('datanya'));
    }

    public function processmanualinvoice(Request $req){
        // dd($req->all());
        
        // create_manual
        $validator = Validator::make($req->all(), [
            'project_number' => 'required|max:255',
            'nominal_pembayaran_invoice' => 'required',
            'proses_category' => 'required',
            'due_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.buatinvoicemanual'))
                        ->withErrors($validator)
                        ->withInput();
        }

        // Passing ID
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

        // Autoincreame Generate ID
        $bulan = date('n');
        $romawi = $this->getRomawi($bulan);
        $year = date('y');
        $jumlah = invoice::count();
        // $jumlah = 99;
        $count = $jumlah + 1;
        $leng = strlen($count);
        
        if($leng == 1){
            $angka = "00".$count;
            
        } else if($leng == 2){
            $angka = "0".$count;
            
        } else {
            $angka = $count;
        }

        // 001/INV/VII/22
        // $format = "PRY".$year.$angka;
        $format = $angka."/INV/".$romawi."/".$year;

        // insert ke table barang invoice 
        if(!empty($req->deskripsi)){
            for($i = 0; $i < count($req->deskripsi); $i++){
                if(!empty($req->deskripsi[$i])){
                    $deskripsi  = $req->deskripsi[$i];
                    $satuan     = $req->satuan[$i];
                    $quantity   = $req->quantity[$i];
                    $harga_unit = $req->harga_unit[$i];
                    $total_harga= $req->total_harga[$i];

                    
                    $invoices_barang = new invoices_barang();
                    $invoices_barang->passing_id = $passing_id;
                    $invoices_barang->no_invoice = $format;
                    $invoices_barang->project_number = $req->project_number;
                    $invoices_barang->po_number = $req->po_number;
                    $invoices_barang->deskripsi = $deskripsi;
                    $invoices_barang->satuannya = $satuan; 
                    $invoices_barang->quantity = $quantity;
                    $invoices_barang->harga_unit = $harga_unit; 
                    $invoices_barang->total_harga = $total_harga; 
                    $invoices_barang->creator = $req->creator;
                    $execute = $invoices_barang->save();
                }
            }
        }

        // check apakah ada discount atau tidak..
        if($req->have_discount == "no"){
            $nominal_discount = "0";
        } else {
            $nominal_discount = $req->nominal_discount;
        }

        // menghapus format pemisah nominal 
        $nominal_pembayaran = $req->nominal_pembayaran;
        $nominal_pembayaran_number = str_replace(".", "", $nominal_pembayaran);

        $nominal_pembayaran_invoice = $req->nominal_pembayaran_invoice;
        $nominal_pembayaran_invoice_number = str_replace(".", "", $nominal_pembayaran_invoice);


        $subtotal_query = invoices_barang::where('passing_id','=',$passing_id)->sum('total_harga');
        // subtotal barang (item invoice) dikurang discount, mau discount nya ada atau ngk pokone di kurang.. check di if else nya
        $subtotal_query = $subtotal_query - $req->nominal_discount;

        $proses_persen  = $nominal_pembayaran_invoice_number/$nominal_pembayaran_number*100;
        
        // get nominal ppn 11%
        $ppn_11persen = $nominal_pembayaran_invoice_number*11/100;

        // get nominal proses + ppn
        $nominal_with_ppn = $nominal_pembayaran_invoice_number + $ppn_11persen; 

        // update di RugiLaba
        $dataRL = rugilaba::where('project_number', $req->project_number)->first();
        $nominal_po = $dataRL->po_nominal;
        $uang_masuk = $dataRL->total_pemasukan;
        $proses_saat_ini = $dataRL->proses_pembayaran;
        $total_uang_pemasukan_with_ppn11 = $dataRL->total_pemasukan_with_ppn11;

        $nominal_with_ppn = $nominal_with_ppn + $total_uang_pemasukan_with_ppn11;
        $total_uang_sisa = $nominal_po - $nominal_pembayaran_invoice_number;

        //proses pembayaran berupa %
        $proses_saat_ini = $proses_saat_ini + $proses_persen;

        //UBAH STATUSNYA PEMBELIAN
        $execute = rugilaba::where('project_number', $req->project_number)
        ->update([
            'total_pemasukan' => $nominal_pembayaran_invoice_number,
            'proses_pembayaran' => $proses_saat_ini,
            'total_pemasukan_with_ppn11' => $nominal_with_ppn,
            'sisa_nominal' => $total_uang_sisa,
            'total_pengeluaran' => '0'
        ]);

        // setup categorynya, jika category nya baru (lainnya) maka kita anggap dia category baru dan kita masukan ke table
        if($req->proses_category == "Lainnya"){
            $proses_category = $req->proses_category_lainnya;
            
            $ref_proses_category = new ref_proses_category();
            $ref_proses_category->proses_categories = $proses_category;
            $execute = $ref_proses_category->save();

        } else {
            $proses_category = $req->proses_category;
        }

        $invoices = new invoice();
        $invoices->passing_id           = $passing_id;
        $invoices->no_invoice           = $format;
        $invoices->project_number       = $req->project_number;
        $invoices->po_number            = $req->po_number;
        $invoices->nama_customer        = $req->nama_customer;
        $invoices->address_customer     = $req->address_customer; 
        $invoices->address_customer1    = $req->address_customer1;
        $invoices->deskripsi_customer   = $req->deskripsi_customer;
        $invoices->proses_category      = $proses_category;
        $invoices->proses_percent       = $proses_persen;
        $invoices->subtotal             = $nominal_pembayaran_invoice_number; 
        $invoices->nominal_pembayaran   = $nominal_pembayaran_number;
        $invoices->nominal_ppn11        = $ppn_11persen;
        $invoices->nominal_pembayaran_with_ppn11 = $nominal_with_ppn;
        $invoices->due_date             = $req->due_date;
        $invoices->keterangan           = $req->keterangan;
        $invoices->status_invoice       = 'New';          
        $invoices->have_discount        = $req->have_discount;
        $invoices->nominal_discount     = $nominal_discount;
        $invoices->aktual_pembayaran    = '0';
        $invoices->create_manual        = 'Yes';
        $invoices->creator              = $req->creator;
        $execute = $invoices->save();

        if($execute){
            
            //Insert Log Activiry before direct page
            $desc = "Has been Create new Invoice for Project Number: ".$req->project_number." ";
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Invoices";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.invoice', $req->project_number)->with('success', 'Berhasil membuat Invoice baru.');
        } else {
            return redirect()->route('HeadTeam.invoice', $req->project_number)->with('error', 'Upps gagal membuat baru invoice, Ada yang salah!');
        }
    }

    public function editinvoice($passing_id){

        $data_invoice   = invoice::where('passing_id', $passing_id)->first();
        $project_number = $data_invoice->project_number;
        $no_invoice     = $data_invoice->no_invoice;

        $persen = ref_proses_persen::all();
        $proses_category = ref_proses_category::all();
        $data_barang    = invoices_barang::where('project_number','=',$project_number)->get();
        $subtotal       = invoices_barang::where('project_number','=',$project_number)->sum('total_harga');
        $invoice_file   = invoice_file::where('no_invoice','=',$no_invoice)->get();

        $datanya = ['data_invoice' => $data_invoice, 'proses_category' => $proses_category, 'data_barang' => $data_barang, 'subtotal' => $subtotal, 'persen' => $persen, 'invoice_file' => $invoice_file];
        return view('HeadTeam/invoice/showDetail_invoice', compact('datanya'));
    }

    public function prosesupdateinvoice(Request $req){
        // dd($req->all());

        // Validation
        $validator = Validator::make($req->all(), [
            'project_number' => 'required|max:255',
            'proses_category' => 'required',
            'due_date' => 'required',
            'keterangan' => 'required',
            'status_invoice' => 'required',
            'nominal_pembayaran' => 'required',
            'nama_customer' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.editinvoice', $req->passing_id))
                        ->withErrors($validator)
                        ->withInput();
        }

        $aktual_pembayaran_string  = $req->aktual_pembayaran;
        $aktual_pembayaran_number  = str_replace(".", "", $aktual_pembayaran_string);


        $nominal_po_string  = $req->nominal_pembayaran;
        $nominal_po_number  = str_replace(".", "", $nominal_po_string);
        $proses_persen      =  $req->proses_persen;

        $subtotal       = $nominal_po_number*$proses_persen/100; 

        // get nominal ppn 11%
        $ppn_11persen = $subtotal*11/100;

        // get nominal proses + ppn
        $nominal_with_ppn = $subtotal + $ppn_11persen; 

        //UBAH DATA INVOICES
        $execute = invoice::where('passing_id', $req->passing_id)
        ->update([
            'project_number' => $req->project_number,
            'due_date' => $req->due_date,
            'nama_customer' => $req->nama_customer,
            'po_number' => $req->po_number,
            'nominal_pembayaran' => $nominal_po_number,
            'proses_category' => $req->proses_category,
            'proses_percent' => $req->proses_persen,
            'keterangan' => $req->keterangan,
            'status_invoice' => $req->status_invoice,
            'subtotal' => $subtotal,
            'nominal_ppn11' => $ppn_11persen,
            'nominal_pembayaran_with_ppn11' => $nominal_with_ppn,
            'address_customer' => $req->address_customer,
            'address_customer1' => $req->address_customer1,
            'deskripsi_customer' => $req->deskripsi_customer,
            'aktual_pembayaran' => $aktual_pembayaran_number
        ]);

        // Ambil data di RugiLaba
        $dataRL = rugilaba::where('project_number', $req->project_number)->first();
        $nominal_po = $dataRL->po_nominal;
        $uang_masuk_rb = $dataRL->total_pemasukan;
        $total_uang_pemasukan_with_ppn11 = $dataRL->total_pemasukan_with_ppn11;  
        $sisa_nominal = $dataRL->sisa_nominal;
        $proses_pembayaran = $dataRL->proses_pembayaran;

        if($execute){

            // check apakah status nya dia cancel apa bukan,
            // jika dia statusnya cancel maka nominal di rugi laba berkurang
            if($req->status_invoice == "cancel"){

                $total_pemasukan = $uang_masuk_rb - $subtotal;
                $total_pemasukan_with_ppn11 = $total_uang_pemasukan_with_ppn11 - $nominal_with_ppn;
                $sisa_nominal = $sisa_nominal + $subtotal;
                $proses_pembayaran = $proses_pembayaran - $proses_persen;

                $execute_rl = rugilaba::where('project_number', $req->project_number)
                ->update([
                    'total_pemasukan' => $total_pemasukan,
                    'proses_pembayaran' => $proses_pembayaran,
                    'total_pemasukan_with_ppn11' => $total_pemasukan_with_ppn11,
                    'sisa_nominal' => $sisa_nominal
                ]);

            }
            
            //Insert Log Activiry before direct page
            $desc = "Has been Update data Invoices with No Invoices: ".$req->no_invoice.", Keterangan:".$req->keterangan.", Status Invoice:".$req->status_invoice;
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Invoices";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.editinvoice', $req->passing_id)->with('success', 'Update invoice berhasil.');
        
        } else {
            return redirect()->route('HeadTeam.editinvoice', $req->passing_id)->with('error', 'Upps GAGAL, Ada yang salah!');
        }
    }

    public function hapusinvoice($passing_id){

        $datanya = invoice::where('passing_id',$passing_id)->first();
        $no_invoice = $datanya->no_invoice;

        invoices_barang::where('passing_id', $passing_id)->delete();
        $execute = invoice::where('passing_id', $passing_id)->delete();
        
        if($execute){
            $desc = "Delete Data Invoice with No Invoice: ".$no_invoice;
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = auth()->user()->name;;
            $log->category_activity = "Data Customer";
            $log->the_activity = $desc;
            $log->save();
            return redirect()->route('HeadTeam.invoice')->with('success', 'Data Invoice Has been Delete');
        }
    }

    public function showPDF($passing_id){ 
        $data_invoice   = invoice::where('passing_id', $passing_id)->first();
        $invoice        = $data_invoice->no_invoice;
        $project_number = $data_invoice->project_number; 
        // dd($invoice);

        $data_barang    = invoices_barang::where('project_number', $project_number)->get();
        $subtotal       = invoices_barang::where('project_number','=',$project_number)->sum('total_harga');
        $datanya = ['data_invoice' => $data_invoice, 'data_barang' => $data_barang, 'subtotal' => $subtotal];
        
        
        $pdf = PDF::loadView('HeadTeam/invoice/PDF_test_invoice', compact('datanya'));
        return $pdf->download('INVOICE-'.$invoice.'.pdf');
        // return view('HeadTeam/invoice/PDF_test_invoice');
    }

    public function executefileinvoice(Request $req){
        $no_invoice = strval($req->no_invoice);
        $name_file_photo = $req->file('filenya')->getClientOriginalName();
        $encoded_data = $name_file_photo;
        $binary_data = base64_decode($encoded_data);
        // $file_name = uniqid()."-".$req->passing_id.'.pdf';

        $path = $req->file('filenya')->storeAs('uploads/fileinvoice/', $name_file_photo);

        $invoices = new invoice_file();
        $invoices->no_invoice   = $no_invoice;
        $invoices->file_name    = $name_file_photo;      
        $invoices->creator      = $req->creator;
        $execute = $invoices->save();

        if($execute){
            
            //Insert Log Activiry before direct page
            $desc = "Has been Add new file attachment Invoice: ".$no_invoice." and name file: ".$name_file_photo;
            $log = new log_activity();
            $log->username = $req->creator;
            $log->category_activity = "Data Invoices";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.editinvoice', $req->passing_id)->with('success', 'Berhasil melampirkan file invoice.');
        } else {
            return redirect()->route('HeadTeam.editinvoice', $req->passing_id)->with('error', 'Upps gagal melampirkan file invoice, Ada yang salah!');
        }
    }

    public function showAttachment($id){
        $data_file  = invoice_file::where('id', $id)->first();
        $filenya    = $data_file->file_name;
        // dd($filenya);
        return response()->file('filenya')->storeAs('uploads/fileinvoice/', $filenya);
        
    }

    // RUGILABA
    public function rugilaba(){
        return view('HeadTeam/rugilaba/menuRugiLaba');
    }

    public function getrugilaba(Request $request){
        if ($request->ajax()) {
            $datanya = DB::table('rugilabas')
            ->join('penjualans', 'rugilabas.project_number', '=', 'penjualans.project_number')
            ->select('rugilabas.*','penjualans.deskripsi','penjualans.lokasi','penjualans.project_koordinator')->orderBy('id', 'desc');
            return Datatables::of($datanya)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $link_edit = route('HeadTeam.editrugilaba', $row->project_number);
                    $link_delete = route('HeadTeam.hapusrugilaba', $row->project_number);
                    $alert_for_delete = "return confirm('Are you sure you want to Delete This?');";

                    // $link_invoice = route('HeadTeam.invoicePenjualan');
                    $btn = '<div class="btn-group dropup">
                    <a href="'.$link_edit.'" class="btn bg-slate btn-xs"><i class="icon-database-edit2"></i></a>
                    <a href="'.$link_delete.'" onclick="'.$alert_for_delete.'" class="btn btn-warning btn-xs" ><i class="icon-trash-alt"></i></a>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function editrugilaba($project_number){

        $data_rl        = rugilaba::where('project_number', $project_number)->first();
        $data_invoice   = invoice::where('project_number',$project_number)->get();
        $data_barang    = invoices_barang::where('project_number','=', $project_number)->get();
        $subtotal       = invoices_barang::where('project_number','=',$project_number)->sum('total_harga');
        $data_cost      = rugilaba_cost::where('project_number','=', $project_number)->get();

        $datanya = ['data_rl' => $data_rl, 'data_invoice' => $data_invoice, 'data_barang' => $data_barang, 'subtotal' => $subtotal, 'data_cost' => $data_cost];
        return view('HeadTeam/rugilaba/showDetail_rugilaba', compact('datanya'));
    }

    public function hapusrugilaba($project_number){
        invoice::where('project_number', $project_number)->delete();
        invoices_barang::where('project_number', $project_number)->delete();
        penjualan::where('project_number', $project_number)->delete();
        $execute = rugilaba::where('project_number', $project_number)->delete();
        
        if($execute){
            $desc = "Delete Data Rugi Laba with Project Number: ".$project_number;
            //Insert Log Activiry before direct page
            $log = new log_activity();
            $log->username = auth()->user()->name;;
            $log->category_activity = "Data Rugi Laba";
            $log->the_activity = $desc;
            $log->save();
            return redirect()->route('HeadTeam.rugilaba')->with('success', 'Data Rugi Laba Has been Delete');
        }
    }

    //  END FOR FINANCIAL MENU ==---

    // SALAH BUAT!!!!!!!!!!!!!!!!!!!!!!

    public function executeprocesspayment(Request $req){
        

        // Validation
        $validator = Validator::make($req->all(), [
            'proses_category' => 'required',
            'proses_persen' => 'required',
            'proses_nominal_pembayaran' => 'required',
            'tgl_pembayaran' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('HeadTeam.buatprosespembayaran', $req->project_number))
                        ->withErrors($validator)
                        ->withInput();
        }
        // get data nominal project (PO)
        $data_pn = penjualan::where('project_number',$req->project_number)->first();
        $data_pn_nominal = $data_pn->nominal_po;
        
        // menghapus format pemisah nominal 
        $proses_nominal_pembayaran_string = $req->proses_nominal_pembayaran;
        $proses_nominal_pembayaran_number = str_replace(".", "", $proses_nominal_pembayaran_string);
        
        // get nominal ppn 11%
        $ppn_11persen = $proses_nominal_pembayaran_number*11/100;

        // get nominal proses + ppn
        $nominal_plus_ppn = $proses_nominal_pembayaran_number + $ppn_11persen; 

        // get Total sisa tanpa PPN
        $total_tanpa_ppn = $data_pn_nominal - $proses_nominal_pembayaran_number;

        // get Total sisa dengan PPN
        $total_dengan_ppn = $data_pn_nominal - $nominal_plus_ppn;

        echo "Nominal proses tanpa PPN: ".$proses_nominal_pembayaran_number;
        echo "<br>Nominal PPN: ".$ppn_11persen;
        echo "<br>Nominal + PPN: ".$nominal_plus_ppn;
        echo "<br>Total sisa nominal PO tanpa PPN: ".$total_tanpa_ppn;
        echo "<br>Total sisa nominal PO dengan PPN: ".$total_dengan_ppn;
        echo "<br><br><b>UNTUK PERHITUNGAN SEPAKAT TANPA PPN DULU</b>";

        die();
        // dd($ppn_11persen);

        // "_token" => "dVOSwVIhu2E39bfaIqsrUMuDe9kqPkX2vXFLETrK"
        // "creator" => "Rudi Chan"
        // "project_number" => "PRY22001"
        // "proses_category" => "DP"
        // "proses_category_lainnya" => "Tester"
        // "proses_persen" => "30"
        // "proses_nominal_pembayaran" => "10.000.000"
        // "tgl_pembayaran" => "2022-07-10"
        // "keterangan" => "Data tester ae"

        if( !empty($req->proses_category_lainnya) ){
            // kalo proses_category_lainnya gk null atau ada inputnya
            // Masuk category baru
            $categorynya = new ref_proses_category();
            $categorynya->proses_categories = $req->proses_category_lainnya;
            $execute = $categorynya->save();


        } else {

        }

    }

    // KASBON
    public function getKasbon(Request $request){
        if ($request->ajax()) {
            $datanya = kasbon::orderBy('id','DESC')->get();
            return Datatables::of($datanya)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $link_edit = route('HeadTeam.editkasbon', $row->passing_id);
                    $link_delete = route('HeadTeam.cancelkasbon', $row->passing_id);
                    $alert_for_delete = "return confirm('Are you sure you want to Delete this?');";

                    // $link_invoice = route('HeadTeam.invoicePenjualan');
                    $btn = '<div class="btn-group dropup">
                    <a href="'.$link_edit.'" class="btn bg-slate btn-xs"><i class="icon-database-edit2"></i></a>
                    <a href="'.$link_delete.'" onclick="'.$alert_for_delete.'" class="btn btn-warning btn-xs" ><i class="icon-trash-alt"></i></a>
                    </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function kasbon(){
        $datakasbon = kasbon::orderBy('id','DESC')->get();
        // $datakasbon = kasbon::all();
        $datanya = ['datakasbon' => $datakasbon];
        return view('HeadTeam/kasbon/menuKasbon', compact('datanya'));
    }
    
    function check_no_kasbon($value_format, $key_kasbon){  

        // return $value_format;
        // die();

        // check apakah dia kasbon atau settlement
        if($key_kasbon == "kasbon"){
            // check apakah number kasbon ini udh ada atau belum.
            $checknokasbon = kasbon::where('no_kasbon', $value_format)->first(); 
            // dd($checknokasbon);
            if( !empty($checknokasbon) ){

                $bulan = date('n');
                $romawi = $this->getRomawi($bulan);
                $year = date('y');
                
                $jumlah = kasbon::where('no_kasbon', 'LIKE', '%/KSB/%')->count();
                $count = $jumlah + 2;
                $leng = strlen($count);
                
                if($leng == 1){
                    $angka = "00".$count;
                    
                } else if($leng == 2){
                    $angka = "0".$count;
                    
                } else {
                    $angka = $count;
                }
        
                $format = $angka."/KSB/".$romawi."/".$year;
                return $format;
            } else {
                // echo "pry sekian datanya blm ada, langsung masuk ke database";
                $format = $value_format;
                return $format;
            }

        } else {

            // check apakah number kasbon ini udh ada atau belum.
            $checknokasbon = kasbon::where('no_kasbon', $value_format)->first(); 
            // dd($checknokasbon);
            if( !empty($checknokasbon) ){

                $bulan = date('n');
                $romawi = $this->getRomawi($bulan);
                $year = date('y');
                
                $jumlah = kasbon::where('no_kasbon', 'LIKE', '%/STL/%')->count();
                $count = $jumlah + 2;
                $leng = strlen($count);
                
                if($leng == 1){
                    $angka = "00".$count;
                    
                } else if($leng == 2){
                    $angka = "0".$count;
                    
                } else {
                    $angka = $count;
                }
        
                $format = $angka."/STL/".$romawi."/".$year;
                return $format;
            } else {
                // echo "pry sekian datanya blm ada, langsung masuk ke database";
                $format = $value_format;
                return $format;
            }
        }
        // die();
    }

    public function create_kasbon($key){

        // Passing ID
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

        // Autoincreame Generate ID
        $bulan = date('n');
        $romawi = $this->getRomawi($bulan);
        $year = date('y');

        if($key == "kasbon"){
            $jumlah = kasbon::where('no_kasbon', 'LIKE', '%/KSB/%')->count();
            
            // $jumlah = 99;
            $count = $jumlah + 1;
            $leng = strlen($count);
            
            if($leng == 1){
                $angka = "00".$count;
                
            } else if($leng == 2){
                $angka = "0".$count;
                
            } else {
                $angka = $count;
            }
            $format = $angka."/KSB/".$romawi."/".$year;
            $format = $this->check_no_kasbon($format, $key);
        
        } else {
            $jumlah = kasbon::where('no_kasbon', 'LIKE', '%/STL/%')->count();
            
            // $jumlah = 99;
            $count = $jumlah + 1;
            $leng = strlen($count);
            
            if($leng == 1){
                $angka = "00".$count;
                
            } else if($leng == 2){
                $angka = "0".$count;
                
            } else {
                $angka = $count;
            }
            $format = $angka."/STL/".$romawi."/".$year;
            $format = $this->check_no_kasbon($format, $key);
        }
        
        // check apakah project number ini udh ada atau belum.
        $checknokasbon = kasbon::where('no_kasbon', $format)->first();

        if( !empty($checknokasbon) ){
            $format = $this->check_no_kasbon($format, $key);
        } else {
            $format = $format;
        }
        // dd($format);

        $kasbon = new kasbon();
        $kasbon->passing_id     = $passing_id;
        $kasbon->no_kasbon      = $format;      
        $kasbon->date_kasbon    = null;
        $kasbon->date_close     = null;
        $kasbon->pic            = null;
        $kasbon->total_amount   = '0';
        $kasbon->total_amount_in_deskripsi   = '0';
        $kasbon->payment        = '-';
        $kasbon->tgl_realisasi  = null;
        $kasbon->no_realisasi   = '-';
        $kasbon->over_under     = '-';
        $kasbon->resultnya      = '0';
        $kasbon->tgl_transfer   = null;
        $kasbon->categorynya    = '-';
        $kasbon->statusnya      = 'New';
        $execute = $kasbon->save();

        if($execute){

            //Insert Log Activiry before direct page
            $desc = "Has been Create data Kabson: ".$format." ";
            $log = new log_activity();
            $log->username = auth()->user()->name;
            $log->category_activity = "Data Kasbon";
            $log->the_activity = $desc;
            $log->save();

            return redirect()->route('HeadTeam.processing_kasbon', $passing_id);
            
        } else {
            return redirect()->route('HeadTeam.kasbon')->with('error', 'Maaf Sedang terjadi kesalahan pada sistem !');
        }
    }

    public function get_name_pic(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = reff_kasbon::select("valuenya")
                    ->where('titlenya', 'nama_karyawan')
            		->where('valuenya','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }

    public function get_deskripsi_kasbon(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = reff_kasbon::select("valuenya")
                    ->where('titlenya', 'deskripsi_kasbon')
            		->where('valuenya','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }

    public function processing_kasbon($passing_id){
        // dd($passing_id);

        // GET DATA KASBON BUAT DI LENGKAPIN
        $validasi_data  = kasbon::where('passing_id', $passing_id)->first();
        $no_kasbon      = $validasi_data->no_kasbon;
        $data_deskripsi = detail_kasbon::where('no_kasbon', $no_kasbon)->get();

        $reff_pic       = reff_kasbon::where('titlenya', 'nama_karyawan')->get();
        $reff_desc      = reff_kasbon::where('titlenya', 'deskripsi_kasbon')->get();

        $datanya = ['validasi_data' => $validasi_data, 'data_deskripsi' => $data_deskripsi, 'reff_pic' => $reff_pic, 'reff_desc' => $reff_desc];
        return view('HeadTeam/kasbon/create_kasbon', compact('datanya'));
    }

    public function executeprocesskasbon(Request $req){

        if($req->hasfile('filenya')){
            foreach($req->file('filenya') as $key => $file)
            {
                $name_file_photo = $file->getClientOriginalName();
                $path = $file->storeAs('uploads/filekasbon/', $name_file_photo);

                if($path){
                    // echo "<br> file terupload";
                    $kasbon_file = new kasbon_file();
                    $kasbon_file->passing_id   = $req->passing_id;
                    $kasbon_file->file_name    = $name_file_photo;      
                    $kasbon_file->creator      = $req->creator;
                    $execute_file = $kasbon_file->save();

                } else {
                    // echo "<br> file tidak terupload :(";
                }
            }
        }

        // die();

        // validasi
        $sekarang = date('Y-m-d H:i:s');
        $amount_string  = $req->total_amount;
        $amount_number  = str_replace(".", "", $amount_string);

        // check apakah nominalnya lebih atau kurang
        $checked = kasbon::where('passing_id', $req->passing_id)->first();
        $totalnya = $amount_number - $checked->total_amount_in_deskripsi;

        if($amount_number == $checked->total_amount_in_deskripsi){
            $over_under = 'Pass';
        
        } else if($amount_number < $checked->total_amount_in_deskripsi){
            $over_under = 'Over';
        
        } else if($amount_number > $checked->total_amount_in_deskripsi ){
            $over_under = 'Under';
        } else {
            $over_under = '-';
        }

        $execute_kasbon = kasbon::where('passing_id', $req->passing_id)
        ->update([
            'pic' => $req->name_pic,
            'total_amount' => $amount_number,
            'payment' => $req->payment,
            'date_kasbon' => $sekarang,
            'over_under' => $over_under,
            'resultnya' => $totalnya,
            'categorynya' => $req->category_kasbon,
            'statusnya' => 'Open'
        ]);

        $desc = "Membuat Kasbon: ".$req->no_kasbon;
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Kasbon";
        $log->the_activity = $desc;
        $log->save();

        return redirect()->route('HeadTeam.kasbon')->with('success', 'Selamat, Kasbon berhasil dibuat :)');
    }

    public function executeprocesskasbondeskripsi(Request $req){
        
        $amount_string  = $req->nominal_kasbon;
        $amount_number  = str_replace(".", "", $amount_string);

        //masukin dulu jumlah amount ini, ke total_amount_in_deskripsi di table kasbon
        $data_kasbon = kasbon::where('passing_id', $req->passing_id)->first();
        $total_semuanya = $data_kasbon->total_amount_in_deskripsi + $amount_number;

        $execute_kasbon = kasbon::where('passing_id', $req->passing_id)
        ->update([
            'total_amount_in_deskripsi' => $total_semuanya
        ]);

        $datail_kasbon = new detail_kasbon();
        $datail_kasbon->no_kasbon = $req->no_kasbon;
        $datail_kasbon->deskripsi_kasbon = $req->deskripsi_kasbon;
        $datail_kasbon->amount = $amount_number;
        $datail_kasbon->code_project = '-';
        $datail_kasbon->optional_remark = '-';
        $datail_kasbon->keterangan = $req->keterangan_tambahan;
        $datail_kasbon->approvalnya = '-';
        $datail_kasbon->save();

        $desc = "Menambakan detail kasbon ".$req->deskripsi_kasbon." dengan nominal ".$amount_string.", pada Kasbon: ".$req->no_kasbon;
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Kasbon";
        $log->the_activity = $desc;
        $log->save();

        return redirect()->route('HeadTeam.processing_kasbon', $req->passing_id)->with('success', 'Detail Deskripsi kasbon berhasil ditambah :)');
    }

    public function executeprocesskasbondeskripsi_fromedit(Request $req){
        
        $amount_string  = $req->nominal_kasbon;
        $amount_number  = str_replace(".", "", $amount_string);

        //masukin dulu jumlah amount ini, ke total_amount_in_deskripsi di table kasbon
        $data_kasbon = kasbon::where('passing_id', $req->passing_id)->first();
        $total_semuanya = $data_kasbon->total_amount_in_deskripsi + $amount_number;

        $execute_kasbon = kasbon::where('passing_id', $req->passing_id)
        ->update([
            'total_amount_in_deskripsi' => $total_semuanya
        ]);

        if( empty($req->project_number) ){
            $project = '-';
        } else {
            $project = $req->project_number;
        }

        $datail_kasbon = new detail_kasbon();
        $datail_kasbon->no_kasbon = $req->no_kasbon;
        $datail_kasbon->deskripsi_kasbon = $req->deskripsi_kasbon;
        $datail_kasbon->amount = $amount_number;
        $datail_kasbon->code_project = '-';
        $datail_kasbon->optional_remark = '-';
        $datail_kasbon->keterangan = $req->keterangan_tambahan;
        $datail_kasbon->save();

        $desc = "Menambakan detail kasbon ".$req->deskripsi_kasbon." dengan nominal ".$amount_string.", pada Kasbon: ".$req->no_kasbon;
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Kasbon";
        $log->the_activity = $desc;
        $log->save();

        return redirect()->route('HeadTeam.editkasbon', $req->passing_id)->with('success', 'Detail Deskripsi kasbon berhasil ditambah :)');
    }

    public function cancelkasbon($passing_id){

        $data_kasbon = kasbon::where('passing_id', $passing_id)->first();
        $no_kasbon = $data_kasbon->no_kasbon;

        $desc = "Membatalkan Kasbon: ".$no_kasbon;

        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Kasbon";
        $log->the_activity = $desc;
        $log->save();
        
        kasbon::where('passing_id', $passing_id)->delete();
        detail_kasbon::where('no_kasbon', $no_kasbon)->delete();
        kasbon_file::where('passing_id', $passing_id)->delete();

        return redirect()->route('HeadTeam.kasbon');
    }

    public function editkasbon($passing_id){
        // GET DATA KASBON BUAT DI LENGKAPIN
        $validasi_data  = kasbon::where('passing_id', $passing_id)->first();
        $no_kasbon      = $validasi_data->no_kasbon;
        $data_deskripsi = detail_kasbon::where('no_kasbon', $no_kasbon)->get();
        $total_nominal_desc = DB::table('detail_kasbons')->where('no_kasbon', $no_kasbon)->sum('amount');
        $file_kasbon    = kasbon_file::where('passing_id', $passing_id)->get();

        $reff_pic       = reff_kasbon::where('titlenya', 'nama_karyawan')->get();
        $reff_desc      = reff_kasbon::where('titlenya', 'deskripsi_kasbon')->get();

        $datanya = ['validasi_data' => $validasi_data, 'data_deskripsi' => $data_deskripsi, 'reff_pic' => $reff_pic, 'reff_desc' => $reff_desc, 'total_nominal_desc' => $total_nominal_desc, 'file_kasbon' => $file_kasbon];
        return view('HeadTeam/kasbon/edit_kasbon', compact('datanya'));
    }

    public function updateprocesskasbon(Request $req){
        // dd($req->all());

        $amount_string  = $req->total_amount;
        $amount_number  = str_replace(".", "", $amount_string);

        // check apakah nominalnya lebih atau kurang
        $checked = kasbon::where('passing_id', $req->passing_id)->first();
        $nominal_sebelumnya = $checked->total_amount;   // untuk history update
        $totalnya = $amount_number - $checked->total_amount_in_deskripsi;

        if($amount_number == $checked->total_amount_in_deskripsi){
            $over_under = 'Pass';
        
        } else if($amount_number < $checked->total_amount_in_deskripsi){
            $over_under = 'Over';
        
        } else if($amount_number > $checked->total_amount_in_deskripsi ){
            $over_under = 'Under';
        } else {
            $over_under = '-';
        }

        if($req->statusnya == "Close"){
            $date_close = date("Y-m-d H:i:s");
        } else {
            $date_close = null;
        }

        $execute_kasbon = kasbon::where('passing_id', $req->passing_id)
        ->update([
            'pic' => $req->name_pic,
            'total_amount' => $amount_number,
            'payment' => $req->payment,
            'over_under' => $over_under,
            'resultnya' => $totalnya,
            'tgl_transfer' => $req->date_transfer,
            'date_close' => $date_close,
            'statusnya' => $req->statusnya
        ]);

        $desc = "Update Kasbon: ".$req->no_kasbon.", nominal kasbon: ".$nominal_sebelumnya." Menjadi ".$req->total_amount;
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Kasbon";
        $log->the_activity = $desc;
        $log->save();

        return redirect()->route('HeadTeam.editkasbon', $req->passing_id)->with('success', 'Kasbon '.$req->no_kasbon.' berhasil diubah :)');
    }

    public function uploadfilekasbon(Request $req){
        // dd($req->all());

        if($req->hasfile('filenya')){
            foreach($req->file('filenya') as $key => $file)
            {
                $name_file_photo = $file->getClientOriginalName();
                $path = $file->storeAs('uploads/filekasbon/', $name_file_photo);

                if($path){
                    // echo "<br> file terupload";
                    $kasbon_file = new kasbon_file();
                    $kasbon_file->passing_id   = $req->passing_id;
                    $kasbon_file->file_name    = $name_file_photo;      
                    $kasbon_file->creator      = $req->creator;
                    $execute_file = $kasbon_file->save();

                    $desc = "Menambahkan file lampiran kasbon, pada nomor kasbon: ".$req->no_kasbon;
                    //Insert Log Activiry before direct page
                    $log = new log_activity();
                    $log->username = auth()->user()->name;
                    $log->category_activity = "Data Kasbon";
                    $log->the_activity = $desc;
                    $log->save();

                } else {
                    // echo "<br> file tidak terupload :(";
                }
            }
        }

        return redirect()->route('HeadTeam.editkasbon', $req->passing_id)->with('success', 'Photo lampiran berhasil ditambah :)');
    }

    public function updatekasbonapproval(Request $req){
        dd($req->all());
    }

    public function create_realisasi($passing_id){
        $validasi_data  = kasbon::where('passing_id', $passing_id)->first();
        $no_kasbon      = $validasi_data->no_kasbon;

        $data_deskripsi = detail_kasbon::where('no_kasbon', $no_kasbon)->get();
        $total_nominal_desc = DB::table('detail_kasbons')->where('no_kasbon', $no_kasbon)->where('approvalnya', 'approved')->sum('amount');
        $file_kasbon    = kasbon_file::where('passing_id', $passing_id)->get();

        $reff_pic       = reff_kasbon::where('titlenya', 'nama_karyawan')->get();
        $reff_desc      = reff_kasbon::where('titlenya', 'deskripsi_kasbon')->get();

        $datanya = ['validasi_data' => $validasi_data, 'data_deskripsi' => $data_deskripsi, 'file_kasbon' => $file_kasbon, 'reff_pic' => $reff_pic, 'reff_desc' => $reff_desc, 'total_nominal_desc' => $total_nominal_desc];
        return view('HeadTeam/kasbon/create_realisasi', compact('datanya'));
    }

    public function editdeskripsikasbon($id){
        $data_deskripsi = detail_kasbon::where('id', $id)->first();
        
        // getting passing id kasbon
        $no_kasbon      = $data_deskripsi->no_kasbon;
        $kasbon         = kasbon::where('no_kasbon', $no_kasbon)->first();
        $passing_id     = $kasbon->passing_id;
        
        // dd($passing_id);
        
        $datanya = ['data_deskripsi' => $data_deskripsi, 'passing_id' => $passing_id];
        return view('HeadTeam/kasbon/editdeskripsikasbon', compact('datanya'));
    }

    public function updateprocessdeskripsi(Request $req){

        $amount_string  = $req->nominal_kasbon;
        $amount_number  = str_replace(".", "", $amount_string);

        $execute_kasbon = detail_kasbon::where('id', $req->idnya)
        ->update([
            'approvalnya' => $req->approval,
            'deskripsi_kasbon' => $req->deskripsi_kasbon,
            'amount' => $amount_number,
            'keterangan' => $req->keterangan_tambahan
        ]);

        $desc = "Update deskripsi Kasbon: ".$req->no_kasbon.", nominal kasbon menjadi: ".$req->total_amount." dan status approval menjadi ".$req->approval;
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Kasbon";
        $log->the_activity = $desc;
        $log->save();

        return redirect()->route('HeadTeam.create_realisasi', $req->passing_id)->with('success', 'Kasbon '.$req->no_kasbon.' berhasil diubah :)');
    }

    public function processrealisasi(Request $req){
       
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $passing_id = substr(str_shuffle($permitted_chars), 0, 16);

        // Autoincreame Generate ID
        $bulan = date('n');
        $romawi = $this->getRomawi($bulan);
        $year = date('y');
        $jumlah = realisasi::count();
        // $jumlah = 99;
        $count = $jumlah + 1;
        $leng = strlen($count);
        
        if($leng == 1){
            $angka = "000".$count;
            
        } else if($leng == 2){
            $angka = "00".$count;
            
        } else if($leng == 3){
            $angka = "0".$count;
            
        } else {
            $angka = $count;
        }

        // 001/INV/VII/22
        // $format = "PRY".$year.$angka;
        $format = $angka."/RLS/".$romawi."/".$year;

        $total_nominal_desc = DB::table('detail_kasbons')->where('no_kasbon', $req->no_kasbon)->where('approvalnya', 'approved')->sum('amount');
        
        $amount_string  = $req->total_amount;
        $amount_number  = str_replace(".", "", $amount_string);

        $selisih = $amount_number - $total_nominal_desc;
        $now = date("Y-m-d H:i:s");

        // UPDATE DATA YG ADA DI KASBON
        $execute_kasbon = kasbon::where('passing_id', $req->passing_id)
        ->update([
            'tgl_realisasi' => $now,
            'no_realisasi' => $format,
            'resultnya' => $selisih
        ]);

        // INSERT LOG BUAT KASBON
        $desc = "Mengupdate data kasbon by sistem, karena realisasi sudah dibuat.";
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Kasbon";
        $log->the_activity = $desc;
        $log->save();

        // INSERT DATA KE TABLE REALISASI
        $realisasi = new realisasi();
        $realisasi->passing_id      = $passing_id;
        $realisasi->no_realisasi    = $format;
        $realisasi->passing_id_kasbon    = $req->passing_id;
        $realisasi->no_nota         = $req->no_kasbon;
        $realisasi->pic             = $req->pic;
        $realisasi->amount          = $total_nominal_desc;
        $realisasi->amount_return   = $selisih;
        $execute_file = $realisasi->save();

        // INSERT LOG BUAT REALISASI
        $desc = "Membuat Realisasi baru: ".$format;
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Data Realisasi";
        $log->the_activity = $desc;
        $log->save();

        return redirect()->route('HeadTeam.realisasi')->with('success', 'Realisasn berhasil');
    }

    public function getRealisasi(Request $request){
        if ($request->ajax()) {
            $datanya = realisasi::orderBy('id','DESC')->get();
            return Datatables::of($datanya)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $link_edit = route('HeadTeam.show_realisasi', $row->passing_id_kasbon);
                    
                    $btn = '<div class="btn-group dropup">
                    <a href="'.$link_edit.'" class="btn bg-slate btn-xs" target="_blank"><i class="icon-database-edit2"></i></a>
                    </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function realisasi(){
        $data_realisasi = realisasi::all();
        $total_amount = DB::table('realisasis')->sum('amount');
        $total_data = DB::table('realisasis')->count();

        $datanya = ['data_realisasi' => $data_realisasi, 'total_amount' => $total_amount, 'total_data' => $total_data];
        return view('HeadTeam/kasbon/menuRealisasi', compact('datanya'));
    }

    public function show_realisasi($passing_id){
        $data_realisasi = realisasi::where('passing_id_kasbon', $passing_id)->first();
        $data_kasbon    = kasbon::where('passing_id', $passing_id)->first();
        $no_kasbon      = $data_kasbon->no_kasbon;
        $data_deskripsi = detail_kasbon::where('no_kasbon', $no_kasbon)->get();
        $total_nominal_desc = DB::table('detail_kasbons')->where('no_kasbon', $no_kasbon)->where('approvalnya', 'approved')->sum('amount');

        $file_kasbon    = kasbon_file::where('passing_id', $passing_id)->get();

        $datanya = ['data_realisasi' => $data_realisasi, 'data_kasbon' => $data_kasbon, 'data_deskripsi' => $data_deskripsi, 'total_nominal_desc' => $total_nominal_desc, 'file_kasbon' => $file_kasbon];
        return view('HeadTeam/kasbon/edit_realisasi', compact('datanya'));
    }

}
