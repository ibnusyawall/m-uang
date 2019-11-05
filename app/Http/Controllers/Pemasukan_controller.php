<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class Pemasukan_controller extends Controller
{
	public function index(){
		$data = \DB::table('pemasukan as a')->join('sumber as b', 'a.sumber_pemasukan', '=', 'b.id')->get();
    	return view('pemasukan.pemasukan_index', compact('data'));
    
    }

    public function tambah(){
    	$data = \DB::table('sumber')->get();
    	return view('pemasukan.pemasukan_tambah', compact('data'));
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'sumber_pemasukan'=>'required',
    		'nominal'=>'required',
    		'tanggal'=>'required',
    		'keterangan'=>'required'
    	]);
    	\DB::table('pemasukan')->insert([
    		'pemasukan_id'=>\Uuid::generate(4),
    		'sumber_pemasukan'=>$request->sumber_pemasukan,
    		'nominal'=>$request->nominal,
    		'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
    		'keterangan'=>$request->keterangan
    	]);

    	return redirect('pemasukan');

    }

    public function edit($id){
    	$data = \DB::table('pemasukan')->where('pemasukan_id', $id)->first();
    	$sumber = \DB::table('sumber')->get();
    	return view('pemasukan.pemasukan_edit', compact('data', 'sumber'));
    }

    public function update(Request $request, $id){
    	$this->validate($request, [
    		'sumber_pemasukan'=>'required',
    		'nominal'=>'required',
    		'tanggal'=>'required',
    		'keterangan'=>'required'
    	]);
    	\DB::table('pemasukan')->where('pemasukan_id', $id)->update([
   			'sumber_pemasukan'=>$request->sumber_pemasukan,
    		'nominal'=>$request->nominal,
    		'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
    		'keterangan'=>$request->keterangan 		
    	]);

    	return redirect('pemasukan');
    }

    public function delete($id){
    	\DB::table('pemasukan')->where('pemasukan_id', $id)->delete();
    	return redirect('pemasukan');
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $pemasukan = DB::table('pemasukan as a')->join('sumber as b', 'a.sumber_pemasukan', '=', 'b.id')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'a.pemasukan_id',
            'a.sumber_pemasukan',
            'b.nama',
            'a.nominal',
            'a.tanggal',
            'a.keterangan']
        )->get();

        $datatables = Datatables::of($pemasukan)->addColumn('action', function($ps){
        		$url_edit  = url('pemasukan/'.$ps->pemasukan_id);
        		$url_hapus = url('pemasukan/'.$ps->pemasukan_id);
        		return '<a class="btn btn-icon btn-3 btn-white" href="'.$url_edit.'">
        					<span class="btn-inner--icon"><i class="ni ni-bag-17 text-info"></i></span>
							<span class="btn-inner--text">Edit</span>
    					</a>
    					<a class="btn btn-icon btn-3 btn-white btn-hapus" href="'.$url_hapus.'">
        					<span class="btn-inner--icon"><i class="ni ni-bag-17 text-danger"></i></span>
							<span class="btn-inner--text">Hapus</span>
    					</a>';
        })->editColumn('nominal', function($ps){
        	$nominal = $ps->nominal;
        	$nominal = 'Rp. '.number_format($nominal, 0);
        	$nominal = str_replace(',', '.', $nominal);
        	return $nominal;
        })->editColumn('tanggal', function($ps){
        	$tanggal = $ps->tanggal;
        	$tanggal = date('Y-m-d', strtotime($tanggal));
        	return $tanggal;
        });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
	}
}

    	