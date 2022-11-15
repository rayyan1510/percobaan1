<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SppModel;
use App\Models\BayarModel;
use Config\Services;

class Spp extends BaseController
{
	public function index()
	{
		$data['title'] = 'Data SPP';

		return view('admin/spp/spp', $data);
	}

	public function add()
	{
		helper(['form']);
		$sppModel = new SppModel();

		$data['title'] = 'Tambah Data SPP';

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'tahun' 		=> 'required|numeric|max_length[4]|is_unique[spp.tahun]',
				'nominal'		=> 'required|numeric|min_length[4]'
			];

			if ($this->validate($rules)) {
				$params = [
					'tahun' 		=> $sppModel->escapeString(esc($this->request->getPost('tahun'))),
					'nominal'		=> $sppModel->escapeString(esc($this->request->getPost('nominal'))),
				];

				$insert = $sppModel->insert($params);

				if ($insert) {
					session()->setFlashdata('success', 'Berhasil menambah data SPP');
					return redirect()->route('admin/spp');
				} else {
					session()->setFlashdata('danger', 'Gagal menambah data SPP');
					return redirect()->route('admin/spp/add')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('admin/spp/tambah_spp', $data);
	}

	public function delete()
	{
		$sppModel = new SppModel();
		$bayarModel = new BayarModel();

		$id = $sppModel->escapeString(esc($this->request->getPost('id')));
		$delete = $sppModel->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data SPP');
			return redirect()->route('admin/spp');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data SPP');
			return redirect()->route('admin/spp');
		}
	}

	public function edit()
	{
		helper(['form', 'url']);
		$sppModel = new SppModel();

		$id = $sppModel->escapeString(esc($this->request->uri->getSegment(4)));

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'tahun' 		=> 'required|numeric|max_length[4]',
				'nominal'		=> 'required|numeric'
			];

			if ($this->validate($rules)) {
				$params = [
					'tahun'     => $sppModel->escapeString(esc($this->request->getPost('tahun'))),
					'nominal'	=> $sppModel->escapeString(esc($this->request->getPost('nominal')))
				];

				$update = $sppModel->update($id, $params);

				if ($update) {
					session()->setFlashdata('success', 'Berhasil edit data SPP');
					return redirect()->route('admin/spp');
				} else {
					session()->setFlashdata('danger', 'Gagal edit data SPP');
					return redirect()->route('admin/spp/edit')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		$data['title'] = 'Edit SPP';
		$data['spp'] = $sppModel->find($id);

		return view('admin/spp/edit_spp', $data);
	}


	public function get_spp_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$spp = new SppModel($request);

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {

			$lists = $spp->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				//hilangkan syntak if ini bila ingin
				//menampilkan akun admin di datatable

					$no++;
					$row = [];
					$row[] = $no;
					$row[] = $list->tahun;
					$row[] = "Rp " . number_format($list->nominal,2,',','.'); 
					$row[] = $list->created_at;
					$row[] = '<a class="btn btn-warning" href="' . base_url('admin/spp/edit/' . $list->id_spp ) . '">Edit</a> 
	                	 <a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_spp . '">Hapus</a>';
					$data[] = $row;
			}

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $spp->count_all(),
				"recordsFiltered" => $spp->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
}
