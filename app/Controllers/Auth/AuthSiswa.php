<?php


namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class AuthSiswa extends BaseController
{
	public function index()
	{
		helper(['form', 'url']);
		$siswaModel = new SiswaModel();

		$data['title'] = 'Login';

		if ($this->request->getMethod() == 'post') {
			// rules validation
			$rules = [
				'nisn'		=> 'required|numeric',
				'password' 	=> 'required|min_length[8]'
			];

			// form validation
			if ($this->validate($rules)) {
				$nisn 		= $siswaModel->escapeString(esc($this->request->getPost('nisn')));
				$password 	= $siswaModel->escapeString(esc($this->request->getPost('password')));

				// ambil data user dari DB
				$siswa = $siswaModel->where('nisn', $nisn)
					->first();

				if ($siswa) {
					if (password_verify($password, $siswa['password'])) {

						$userSession = [
							'nama'			=> $siswa['nama'],
							'nisn'			=> $siswa['nisn'],
							'id_level'		=> $siswa['id_level'],
						];

						session()->set($userSession);

						// cek level
						if ($siswa['id_level'] == 1) {
							session()->setFlashdata('success', 'Berhasil login sebagai Admin');
							return redirect()->route('admin');
							
						} elseif ($siswa['id_level'] == 2) {
							session()->setFlashdata('success', 'Berhasil login sebagai Petugas');
							return redirect()->route('admin');
							
						} elseif ($siswa['id_level'] == 3) {
							session()->setFlashdata('success', 'Berhasil login sebagai Siswa');
							return redirect()->route('admin');
							
						} else {
							return redirect()->route('logout');
						}
					} else {
						// password salah
						session()->setFlashdata('danger', 'NISN atau Password salah');

						return redirect('loginsiswa')->withInput();
					}
				} else {
					// user tidak terdaftar
					session()->setFlashdata('danger', 'Maaf email dan password yang kamu masukan tidak terdaftar');

					return redirect('loginsiswa')->withInput();
				}
			} else {
				// inputan salah
				$data['validation'] = $this->validator;
			}
		}

		return view('auth/index_siswa', $data);
	}

	public function logout()
	{
		session()->destroy();

		return redirect()->route('login');
	}
}
