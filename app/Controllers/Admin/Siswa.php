<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\LevelModel;
use App\Models\SppModel;
use App\Models\KelasModel;
use Config\Services;

class Siswa extends BaseController
{
	public function index()
	{
		$data['title'] = 'Data Siswa';

		return view('admin/siswa/siswa', $data);
	}

	public function add()
	{
		helper(['form']);
		$siswaModel = new SiswaModel();
		$levelModel = new LevelModel();
		$sppModel   = new SppModel();
		$kelasModel = new KelasModel();
		
		$data['title'] = 'Tambah Siswa';
		$data['level'] = $levelModel->findAll();
		$data['spp'] = $sppModel->findAll();
		$data['kelas'] = $kelasModel->findAll();

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'nisn'		=> 'required|numeric|is_unique[siswa.nisn]',
				'nis'		=> 'required|numeric|is_unique[siswa.nis]',
				'nama'		=> 'required|alpha_space|min_length[3]',
				'spp'       => 'required|numeric',
				'kelas'     => 'required|numeric',
				'alamat'    => 'required',
				'password'	=> 'required|min_length[8]',
				'level'		=> 'required|numeric'
			];

			if ($this->validate($rules)) {
				$params = [
				    'nisn' 		=> $siswaModel->escapeString(esc($this->request->getPost('nisn'))),
				    'nis' 		=> $siswaModel->escapeString(esc($this->request->getPost('nis'))),
				    'nama' 		=> $siswaModel->escapeString(esc($this->request->getPost('nama'))),
					'id_spp' 	=> $siswaModel->escapeString(esc($this->request->getPost('spp'))),
					'id_kelas'	=> $siswaModel->escapeString(esc($this->request->getPost('kelas'))),
					'alamat'	=> $siswaModel->escapeString(esc($this->request->getPost('alamat'))),
					'no_telp'	=> $siswaModel->escapeString(esc($this->request->getPost('telepon'))),
					'password'	=> $siswaModel->escapeString(esc(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))),
					'id_level'	=> $siswaModel->escapeString(esc($this->request->getPost('level')))
				];

				$insert = $siswaModel->insert($params);

				if ($insert) {
					session()->setFlashdata('success', 'Berhasil menambah data');
					return redirect()->route('admin/siswa');
				} else {
					session()->setFlashdata('danger', 'Gagal menambah data');
					return redirect()->route('admin/siswa/add')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('admin/siswa/tambah_siswa', $data);
	}

	public function delete()
	{
		$siswaModel = new SiswaModel();

		$id = $siswaModel->escapeString(esc($this->request->getPost('id')));
		$delete = $siswaModel->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data');
			return redirect()->route('admin/siswa');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data');
			return redirect()->route('admin/siswa');
		}
	}

	public function edit()
	{
		helper(['form', 'url']);
		$siswaModel = new SiswaModel();
		$levelModel = new LevelModel();
		$sppModel   = new SppModel();
		$kelasModel = new KelasModel();

		$id = $siswaModel->escapeString(esc($this->request->uri->getSegment(4)));

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'nisn'		=> 'required|numeric',
				'nis'		=> 'required|numeric',
				'nama'		=> 'required|alpha_space|min_length[3]',
				'spp'       => 'required|numeric',
				'kelas'     => 'required|numeric',
				'alamat'    => 'required',
				'level'		=> 'required|numeric'
			];

			if ($this->validate($rules)) {
				$params = [
				    'nisn' 		=> $siswaModel->escapeString(esc($this->request->getPost('nisn'))),
				    'nis' 		=> $siswaModel->escapeString(esc($this->request->getPost('nis'))),
				    'nama' 		=> $siswaModel->escapeString(esc($this->request->getPost('nama'))),
					'id_spp' 	=> $siswaModel->escapeString(esc($this->request->getPost('spp'))),
					'id_kelas'	=> $siswaModel->escapeString(esc($this->request->getPost('kelas'))),
					'alamat'	=> $siswaModel->escapeString(esc($this->request->getPost('alamat'))),
					'no_telp'	=> $siswaModel->escapeString(esc($this->request->getPost('telepon'))),
					'password'	=> $siswaModel->escapeString(esc(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))),
					'id_level'	=> $siswaModel->escapeString(esc($this->request->getPost('level')))
				];

				$update = $siswaModel->update($id, $params);

				if ($update) {
					session()->setFlashdata('success', 'Berhasil edit data');
					return redirect()->route('admin/siswa');
				} else {
					session()->setFlashdata('danger', 'Gagal edit data');
					return redirect()->route('admin/siswa/edit')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		$data['title'] = 'Edit Siswa';
		$data['siswa'] = $siswaModel->find($id);
		$data['level'] = $levelModel->findAll();
		$data['spp']   = $sppModel->findAll();
		$data['kelas'] = $kelasModel->findAll();

		return view('admin/siswa/edit_siswa', $data);
	}


	public function change_password()
	{
		helper(['form', 'url']);
		$userModel = new SiswaModel();

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'old_password'		=> ['label' => 'Password Lama', 'rules'	=> 	'required'],
				'new_password'		=> ['label' => 'Password Baru', 'rules' =>	'required|min_length[3]|matches[confirm_password]'],
				'confirm_password'	=> ['label' => 'Konfirmasi Password', 'rules' => 'required|min_length[3]|matches[new_password]']
			];

			if ($this->validate($rules)) {
				$old_password = $userModel->escapeString(esc($this->request->getPost('old_password')));
				$new_password = $userModel->escapeString(esc($this->request->getPost('new_password')));
				$confirm_password = $userModel->escapeString(esc($this->request->getPost('confirm_password')));

				//cek apakah new pass sama dengan old pass
				if ($new_password != $old_password) {
					// get data user by session email
					$user = $userModel->where('nisn', session()->get('nisn'))
						->first();

					//cek apakah password sama dengan yg ada di DB
					if (password_verify($old_password, $user['password'])) {
						$params = [
							'password' => password_hash($new_password, PASSWORD_DEFAULT)
						];

						$update = $userModel->update($user['id_siswa'], $params);

						if ($update) {
							session()->setFlashdata('success', 'Berhasil mengubah password');
							return redirect()->route('admin');
						} else {
							session()->setFlashdata('danger', 'Gagal mengubah password');
							return redirect()->route('admin/users/change_password');
						}
					} else {
						session()->setFlashdata('danger', 'Password salah');
						return redirect()->route('admin/user/change_password');
					}
				} else {
					session()->setFlashdata('danger', 'Password baru tidak boleh sama dengan password lama');
					return redirect()->route('admin/user/change_password');
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		$data['title'] = 'Change Password';
		return view('admin/siswa/ganti_password', $data);
	}
	
	public function get_siswa_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$siswa = new SiswaModel($request);

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {

			$lists = $siswa->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				//hilangkan syntak if ini bila ingin
				//menampilkan akun admin di datatable

					$no++;
					$row = [];
					$row[] = $no;
					$row[] = $list->nisn;
					$row[] = $list->nis;
				    $row[] = $list->nama;
				    $row[] = $list->alamat;
				    $row[] = $list->created_at;
					$row[] = '<a class="btn btn-warning" href="' . base_url('admin/siswa/edit/' . $list->id_siswa ) . '">Edit</a> 
	                	 <a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_siswa . '">Hapus</a>';
					$data[] = $row;
			}

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $siswa->count_all(),
				"recordsFiltered" => $siswa->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
}
