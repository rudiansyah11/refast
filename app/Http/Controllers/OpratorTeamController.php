<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\SampleTest;
use App\Models\buyingTester;
use App\Models\log_activity;

use DataTables;
use Auth;

class OpratorTeamController extends Controller
{
    function profile(){
        return view('OpratorTeam/profile');
    }

    public function samplePage(){
        return view('OpratorTeam/sampleTemplate');
    }

    // DATATABLES SERVERSIDE
    public function getServerSideTest(Request $request)
    {
        if ($request->ajax()) {
            $datanya = SampleTest::latest()->get();
            return Datatables::of($datanya)
                    ->addIndexColumn()
                    // ->addColumn('jenis_barang', function($row){
                    //     $show = '<span class="label bg-info-600">'.$row->jenis_barang.'</span>';
                    //     return $show;
                    // })->rawColumns(['jenis_barang'])
                    ->addColumn('action', function($row){
                        
                        $link_buy = route('OpratorTeam.testbuy', $row->passing_id);
                        if($row->stok_barang > 0){
                            $btn = '<ul class="icons-list text-center">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="'.$link_buy.'"><i class="icon-transmission"></i>Beli</a></li>
                                            </ul>
                                        </li>
                                    </ul>';
                            return $btn;

                        } else {
                            $btn = '<ul class="icon-lock2 text-center">
                                    </ul>';
                            return $btn;
                        }
                        
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function showdatatest(){
        return view('OpratorTeam/showdatatest');
    }

    public function testbuy($passing_id){
        $datanya = SampleTest::where('passing_id',$passing_id)->first();
        // dd($datanya);
        return view('OpratorTeam/buytester', compact('datanya'));
    }

    public function processTestTransksi(Request $req){
        // return $req->all();
        
        //VALIDASI
        $checkstok = SampleTest::where('passing_id',$req->passing_id_barang)->first();
        $stok = $checkstok->stok_barang;

        $validator = Validator::make($req->all(), [
            'quantity' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return redirect(route('OpratorTeam.testbuy', $req->passing_id_barang))
            ->withErrors($validator)
            ->withInput();
        }

        // CHECK QUANTITY LEBIH DARI STOK ATAU TIDAK
        if($req->quantity > $stok){
            return redirect()->route('OpratorTeam.testbuy', $req->passing_id_barang)->with('error', 'Quantity pemesanan melebih stock!');
        
        } else {

            //MASUKIN KE TABLE
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $passing_id = substr(str_shuffle($permitted_chars), 0, 16);
            $datanya = new buyingTester();
            $datanya->name_buyer = $req->creator;
            $datanya->passing_id_buying = $passing_id;
            $datanya->passing_id_barang = $req->passing_id_barang;
            $datanya->nama_barang = $req->nama_barang;
            $datanya->quantity = $req->quantity;
            $datanya->status_pembelian = 'Request';
            $execute = $datanya->save();
        
            if($execute){
                $desc = "Make buying transaction with item Name: ".$req->nama_barang.", and Quantity: ".$req->quantity;
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = $req->creator;
                $log->category_activity = "Buy Data Tester";
                $log->the_activity = $desc;
                $log->save();
    
                return redirect()->route('OpratorTeam.dataTransaksitest')->with('success', 'Successfully to make new buying.');
            } else {
                return redirect()->route('OpratorTeam.testbuy', $req->passing_id_barang)->with('error', 'Something wrong, Fail to buy!');
            }
        }

    }

    public function dataTransaksitest(){
        $name = Auth::user()->name; //untuk filter di querynya
        $datanya = buyingTester::where('name_buyer', $name)->get();
        return view('OpratorTeam/dataTransaksitest',compact('datanya'));
    }

    public function transaksitest(){
        return view('OpratorTeam/sampleTemplate');
    }
    

}
