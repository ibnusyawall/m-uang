<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class Laporan_controller extends Controller
{
    public function index(){
    	return view('laporan.laporan_index');
    }

    public function cari(Request $request){
    	$this->validate($request, [
    		'dari'=>'required',
    		'sampai'=>'required'
    	]);

    	$dari = date('Y-m-d', strtotime($request->dari));
    	$sampai = date('Y-m-d', strtotime($request->sampai));

    	$pemasukan = \DB::table('pemasukan as p')->join('sumber as s', 'p.sumber_pemasukan', '=', 's.id')->whereBetween('tanggal', [$dari, $sampai])->get();
    	$t_pemasukan = \DB::table('pemasukan as p')->join('sumber as s', 'p.sumber_pemasukan', '=', 's.id')->whereBetween('tanggal', [$dari, $sampai])->sum('nominal');

    	$pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal', [$dari, $sampai])->get();

    	$t_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal', [$dari, $sampai])->sum('nominal');

    	return view('laporan.laporan_index', compact('pemasukan', 't_pemasukan', 'pengeluaran', 't_pengeluaran', 'dari', 'sampai'));
    }

    public function export_pemasukan($dari, $sampai){
    	$title = 'Laporan_Pemasukan';
    	$pemasukan = \DB::table('pemasukan as p')->join('sumber as s', 'p.sumber_pemasukan', '=', 's.id')->whereBetween('tanggal', [$dari, $sampai])->get();
    	$t_pemasukan = \DB::table('pemasukan as p')->join('sumber as s', 'p.sumber_pemasukan', '=', 's.id')->whereBetween('tanggal', [$dari, $sampai])->sum('nominal');

    	Excel::create($title, function($excel) use($pemasukan, $t_pemasukan) {

    		$excel->sheet('sheetname', function($sheet) use($pemasukan, $t_pemasukan) {

    			$sheet->loadView('laporan.exports_pemasukan')->with('pemasukan', $pemasukan)->with('t_pemasukan', $t_pemasukan);
    		});

    	})->export('xls');
    }

    public function export_pengeluaran($dari, $sampai){
    	$title = 'Laporan_Pengeluaran';
    	$pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal', [$dari, $sampai])->get();

    	$t_pengeluaran = \DB::table('pengeluaran')->whereBetween('tanggal', [$dari, $sampai])->sum('nominal');


    	Excel::create($title, function($excel) use($pengeluaran, $t_pengeluaran) {

    		$excel->sheet('sheetname', function($sheet) use($pengeluaran, $t_pengeluaran) {

    			$sheet->loadView('laporan.exports_pengeluaran')->with('pengeluaran', $pengeluaran)->with('t_pengeluaran', $t_pengeluaran);
    		});

    	})->export('xls');
    }
}
