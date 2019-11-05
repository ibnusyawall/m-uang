<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sumber_controller extends Controller{
    public function index(){
    	$sumber = \DB::table('sumber')->get();
    	return view('sumber.sumber_index', compact('sumber'));
    }

    public function add(){
    	return view('sumber.sumber_add');
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'nama'=>'required'
    	]);

    	$nama = $request->nama;

    	\DB::table('sumber')->insert([
    		'id'=>\Uuid::generate(4),
    		'nama'=>$nama,
    		'created_at'=>date('Y-m-d H:i:s'),
    		'updated_at'=>date('Y-m-d H:i:s')
    	]);

    	return redirect('sumber-pemasukan');
    }

    public function edit($id){
    	$data = \DB::table('sumber')->where('id', $id)->first();
        //$data['judul'] = 'Edit Data Sumber Pemasukan';
        return view('sumber.sumber_edit', compact('data'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama'=>'required'
        ]);

        \DB::table('sumber')->where('id', $id)->update([
            'nama'=>$request->nama,
            'updated_at'=>date('Y-m-d H:i:s')
        ]);

        return redirect('sumber-pemasukan');
    }

    public function delete($id){
        \DB::table('sumber')->where('id', $id)->delete();

        return redirect('sumber-pemasukan');
    }

    // Home Dashboard
    public function home(Request $request){

        $user_agent = $request->header('User-Agent');
        $bname = 'Unknown';
        $platform = 'Unknown';

        // init curl object        
        $ch = curl_init();

        // define options
        $optArray = array(
            CURLOPT_URL => 'https://api.myip.com',
            CURLOPT_RETURNTRANSFER => true
        );

        // apply those options
        curl_setopt_array($ch, $optArray);

        // execute request and get response
        $_ip_ = curl_exec($ch);
        $ip = json_decode($_ip_, true);
        // also get the error and response code
        $errors = curl_error($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        //First get the platform?
        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'windows';
        }


        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$user_agent) && !preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$user_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$user_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$user_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$user_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$user_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        \DB::table('settings')->insert([
            'bip'=>$bname,
            'pip'=>$platform,
            'ip'=>$ip['ip'],
            'cip'=>$ip['country']
        ]);

        $data  = \DB::table('settings')->get();

        $count_v = \DB::table('settings')->count();
        $count_s = \DB::table('sumber')->count();
        $count_p = \DB::table('pemasukan')->count();
        $count_k = \DB::table('pengeluaran')->count();

        $tu_pengeluaran = \DB::table('pengeluaran')->sum('nominal');
        $tu_pemasukan   = \DB::table('pemasukan')->sum('nominal');

        $d_sumber      = \DB::table('sumber')->get();
        $d_pemasukan   = \DB::table('pemasukan as a')->join('sumber as b', 'a.sumber_pemasukan', '=', 'b.id')->get();
        $d_pengeluaran = \DB::table('pengeluaran')->get();

        //$wb = \DB::table('settings')->whereNotIn('cip', '')->get();

        return view('welcome', compact('data', 'count_v', 'count_s', 'count_p', 'count_k', 'tu_pemasukan', 'tu_pengeluaran', 'd_sumber', 'd_pemasukan', 'd_pengeluaran'));
    }
    
}
