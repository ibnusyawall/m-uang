<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pengeluaran_controller extends Controller
{
    public function  index(){
    	$data = \DB::table('pengeluaran')->get();
    	return view('pengeluaran.pengeluaran_index', compact('data'));
    }

    public function tambah(){
    	$data = \DB::table('pengeluaran')->get();
    	return view('pengeluaran.pengeluaran_tambah', compact("data"));
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'nominal'=>'required',
    		'tanggal'=>'required',
    		'keterangan'=>'required'
    	]);

    	\DB::table('pengeluaran')->insert([
    		'pengeluaran_id'=>\Uuid::generate(4),
    		'nominal'=>$request->nominal,
    		'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
    		'keterangan'=>$request->keterangan
    	]);

    	return redirect('pengeluaran');

    }

    public function edit($id){
    	$data = \DB::table('pengeluaran')->where('pengeluaran_id', $id)->first();
    	return view('pengeluaran.pengeluaran_edit', compact('data'));
    }

    public function update(Request $request, $id){
    	$this->validate($request, [
    		'nominal'=>'required',
    		'tanggal'=>'required',
    		'keterangan'=>'required'
    	]);
    	
    	\DB::table('pengeluaran')->where('pengeluaran_id', $id)->update([
    		'nominal'=>$request->nominal,
    		'tanggal'=>date('Y-m-d', strtotime($request->tanggal)),
    		'keterangan'=>$request->keterangan 		
    	]);

    	return redirect('pengeluaran');
    }

    public function delete($id){
    	\DB::table('pengeluaran')->where('pengeluaran_id', $id)->delete();

    	return redirect('pengeluaran');
    }
}
