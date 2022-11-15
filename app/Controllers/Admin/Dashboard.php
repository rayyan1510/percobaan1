<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\SiswaModel;
use App\Models\BayarModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$data['title'] = 'Dashboard';
		$userModel = new UserModel();
    	$bayarModel = new BayarModel();
        $siswaModel = new SiswaModel();

		$data['total_siswa'] = $siswaModel->select('COUNT(id_siswa) as total_siswa')->first();
		$data['total_petugas'] = $userModel->select('COUNT(id_user) as total_petugas')->first();
		$data['total_spp'] = $bayarModel->select('SUM(jumlah_bayar) as total_spp')->first();

		return view('admin/index', $data);
	}
}
