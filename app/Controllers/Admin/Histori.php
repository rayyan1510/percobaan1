<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HistoriModel;
use App\Models\SppModel;
use App\Models\SiswaModel;
use App\Models\UserModel;
use Config\Services;

class Histori extends BaseController
{
	public function index()
	{
		$data['title'] = 'Histori Pembayaran';

		return view('admin/histori/histori', $data);
	}
	
    public function laporan()
	{
		$data['title'] = 'Laporan Pembayaran SPP';

		return view('admin/histori/laporan', $data);
	}

	public function get_histori_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$bayar = new HistoriModel($request);

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {

			$lists = $bayar->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				//hilangkan syntak if ini bila ingin
				//menampilkan akun admin di datatable
					$no++;
					$row = [];
					$row[] = $no;
					$row[] = $list->nama;
					$row[] = $list->nisn;
					$row[] = $list->tgl_bayar;
					$row[] = $list->bulan_dibayar;
					$row[] = $list->tahun;
					$row[] = "Rp " . number_format($list->jumlah_bayar,2,',','.'); 
					$data[] = $row;
			}	

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $bayar->count_all(),
				"recordsFiltered" => $bayar->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
	
	public function historisiswa()
	{
		$data['title'] = 'Histori Pembayaran';

		return view('admin/histori/historisiswa', $data);
	}
	
	
	
	public function get_historisiswa_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$bayar = new HistoriModel($request);

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {

			$lists = $bayar->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				//hilangkan syntak if ini bila ingin
				//menampilkan akun admin di datatable
					$no++;
					$row = [];
					$row[] = $no;
					$row[] = $list->nama;
					$row[] = $list->nisn;
					$row[] = $list->tgl_bayar;
					$row[] = $list->bulan_dibayar;
					$row[] = $list->tahun;
					$row[] = "Rp " . number_format($list->jumlah_bayar,2,',','.'); 
					$data[] = $row;
			}	

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $bayar->count_all(),
				"recordsFiltered" => $bayar->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
}
