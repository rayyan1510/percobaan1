<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BayarModel;
use App\Models\HapusBayarModel;
use App\Models\SppModel;
use App\Models\SiswaModel;
use App\Models\UserModel;
use Config\Services;

class Bayar extends BaseController
{
	public function index()
	{
		$data['title'] = 'Transaksi Pembayaran SPP';

		return view('admin/bayar/bayar', $data);
	}

	public function add()
	{
		helper(['form']);
		$bayarModel = new BayarModel();
		$siswaModel = new SiswaModel();
		$sppModel = new SppModel();

		$data['title'] = 'Tambah Data Pembayaran SPP';
		$data['siswa'] = $siswaModel->findAll();
		$data['spp'] = $sppModel->findAll();

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'nisn' => 'required',
				'tgl' => 'required',
				'bulanbayar' => 'required',
				'tahunbayar' => 'required',
				'jumlah' => 'required'
			];

			if ($this->validate($rules)) {
				$tahun = $this->request->getPost('jumlah');
				$params = [
					'nisn' 		    => $bayarModel->escapeString(esc($this->request->getPost('nisn'))),
					'id_user'       => $bayarModel->escapeString(($this->request->getPost('id_user'))),
					'tgl_bayar'		=> $bayarModel->escapeString(esc($this->request->getPost('tgl'))),
					'bulan_dibayar'	=> $bayarModel->escapeString(esc($this->request->getPost('bulanbayar'))),
					'id_spp'        => $bayarModel->escapeString(esc($this->request->getPost('tahunbayar'))),
					'jumlah_bayar'  => $bayarModel->escapeString(esc($this->request->getPost('jumlah'))),
				];

				$insert = $bayarModel->insert($params);

				if ($insert) {
					session()->setFlashdata('success', 'Berhasil menambah data Pembayaran SPP');
					return redirect()->route('admin/bayar');
				} else {
					session()->setFlashdata('danger', 'Gagal menambah data Pembayaran SPP');
					return redirect()->route('admin/bayar/add')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('admin/bayar/tambah_bayar', $data);
	}

	public function edit()
	{
		helper(['form', 'url']);
		$siswaModel = new SiswaModel();
		$sppModel   = new SppModel();
		$bayarModel = new BayarModel();
		$userModel  = new UserModel();

		$id = $bayarModel->escapeString(esc($this->request->uri->getSegment(4)));

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'nisn' => 'required',
				'tgl' => 'required',
				'bulanbayar' => 'required',
				'tahunbayar' => 'required',
				'jumlah' => 'required'
			];

			if ($this->validate($rules)) {
				$params = [
					'nisn' 		    => $bayarModel->escapeString(esc($this->request->getPost('nisn'))),
					'id_user'       => $bayarModel->escapeString(($this->request->getPost('iduser'))),
					'tgl_bayar'		=> $bayarModel->escapeString(esc($this->request->getPost('tgl'))),
					'bulan_dibayar'	=> $bayarModel->escapeString(esc($this->request->getPost('bulanbayar'))),
					'id_spp' => $bayarModel->escapeString(esc($this->request->getPost('tahunbayar'))),
					'jumlah_bayar'  => $bayarModel->escapeString(esc($this->request->getPost('jumlah'))),
				];

				$update = $bayarModel->update($id, $params);

				if ($update) {
					session()->setFlashdata('success', 'Berhasil edit data');
					return redirect()->route('admin/bayar');
				} else {
					session()->setFlashdata('danger', 'Gagal edit data');
					return redirect()->route('admin/bayar/edit')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		$data['title'] = 'Edit Pembayaran SPP';
		$data['bayar'] = $bayarModel->find($id);
		$data['siswa'] = $siswaModel->findAll();
		$data['spp'] = $sppModel->findAll();
		$data['user'] = $userModel->findAll();

		return view('admin/bayar/edit_bayar', $data);
	}

	public function print()
	{
		helper(['form', 'url']);
		$siswaModel = new SiswaModel();
		$sppModel   = new SppModel();
		$bayarModel = new BayarModel();
		$userModel  = new UserModel();

		$id = $bayarModel->escapeString(esc($this->request->uri->getSegment(4)));

		$data['title'] = 'Struk Pembayaran SPP';
		$data['bayar'] = $bayarModel->find($id);
		$data['siswa'] = $siswaModel->findAll();
		$data['spp'] = $sppModel->findAll();
		$data['user'] = $userModel->findAll();

		return view('admin/bayar/print', $data);
	}


	public function delete()
	{
		$bayarModel = new BayarModel();

		$id = $bayarModel->escapeString(esc($this->request->getPost('id')));
		$delete = $bayarModel->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data SPP');
			return redirect()->route('admin/bayar');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data SPP');
			return redirect()->route('admin/bayar');
		}
	}

	public function get_bayar_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$bayar = new BayarModel($request);
		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {
			$lists = $bayar->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				//hilangkan syntak if ini bila ingin
				//menampilkan akun admin di datatable
				$status = $list->jumlah_bayar;
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->nisn;
				$row[] = $list->bulan_dibayar;
				$row[] = "Rp " . number_format($list->jumlah_bayar, 2, ',', '.');
				$row[] = $status == $list->nominal ? '<span class="text-success">Lunas</span>' : '<span class="text-danger">Belum Lunas</span>';
				$row[] = $list->created_at;
				$row[] = '<a class="btn btn-warning" href="' . base_url('admin/bayar/edit/' . $list->id_pembayaran) . '">edit</a>
						 <a class="btn btn-info" href="' . base_url('admin/bayar/print/' . $list->id_pembayaran) . '">cetak</a>  
	                	 <a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_pembayaran . '">hapus</a>';
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

	public function hapusbayar()
	{
		$data['title'] = 'Data Pembayaran SPP Terhapus';

		return view('admin/bayar/hapusbayar', $data);
	}


	public function get_hapusbayar_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$bayar = new HapusBayarModel($request);

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
				$row[] = $list->nisn;
				$row[] = $list->tgl_bayar;
				$row[] = $list->bulan_dibayar;
				$row[] = "Rp " . number_format($list->jumlah_bayar, 2, ',', '.');
				$row[] = '<a class="btn btn-warning" href="' . base_url('admin/bayar/edit/' . $list->id_pembayaran) . '"><i class="fas fa-edit"></i></a> 
	                	 <a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_pembayaran . '"><i class="fas fa-trash-alt"></i></a>';
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
