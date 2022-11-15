<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use Config\Services;

class Kelas extends BaseController
{
	public function index()
	{
		$data['title'] = 'Data Kelas';

		return view('admin/kelas/kelas', $data);
	}

	public function add()
	{
		helper(['form']);
		$kelasModel = new KelasModel();

		$data['title'] = 'Tambah Data Kelas';

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'nmkelas'   => 'required',
				'kk'		=> 'required|alpha_space|min_length[3]'
			];

			if ($this->validate($rules)) {
				$params = [
					'nama_kelas' 	     	=> $kelasModel->escapeString(esc($this->request->getPost('nmkelas'))),
					'kompetensi_keahlian'	=> $kelasModel->escapeString(esc($this->request->getPost('kk'))),
				];

				$insert = $kelasModel->insert($params);

				if ($insert) {
					session()->setFlashdata('success', 'Berhasil menambah data Kelas');
					return redirect()->route('admin/kelas');
				} else {
					session()->setFlashdata('danger', 'Gagal menambah data Kelas');
					return redirect()->route('admin/kelas/add')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('admin/kelas/tambah_kelas', $data);
	}

	public function delete()
	{
		$kelasModel = new KelasModel();

		$id = $kelasModel->escapeString(esc($this->request->getPost('id')));
		$delete = $kelasModel->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data Kelas');
			return redirect()->route('admin/kelas');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data Kelas');
			return redirect()->route('admin/kelas');
		}
	}

	public function edit()
	{
		helper(['form', 'url']);
		$kelasModel = new KelasModel();

		$id = $kelasModel->escapeString(esc($this->request->uri->getSegment(4)));

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'nmkelas'   => 'required',
				'kk'		=> 'required|alpha_space|min_length[3]'
			];

			if ($this->validate($rules)) {
				$params = [
					'nama_kelas'            => $kelasModel->escapeString(esc($this->request->getPost('nmkelas'))),
					'kompetensi_keahlian'	=> $kelasModel->escapeString(esc($this->request->getPost('kk')))
				];

				$update = $kelasModel->update($id, $params);

				if ($update) {
					session()->setFlashdata('success', 'Berhasil edit data Kelas');
					return redirect()->route('admin/kelas');
				} else {
					session()->setFlashdata('danger', 'Gagal edit data Kelas');
					return redirect()->route('admin/kelas/edit')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		$data['title'] = 'Edit Kelas';
		$data['kelas'] = $kelasModel->find($id);

		return view('admin/kelas/edit_kelas', $data);
	}


	public function get_kelas_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$kelas = new KelasModel($request);

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {

			$lists = $kelas->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				//hilangkan syntak if ini bila ingin
				//menampilkan akun admin di datatable

					$no++;
					$row = [];
					$row[] = $no;
					$row[] = $list->nama_kelas;
					$row[] = $list->kompetensi_keahlian;
					$row[] = '<a class="btn btn-warning" href="' . base_url('admin/kelas/edit/' . $list->id_kelas ) . '">Edit</a> 
	                	 <a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_kelas . '">Hapus</a>';
					$data[] = $row;
			}

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $kelas->count_all(),
				"recordsFiltered" => $kelas->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
}
