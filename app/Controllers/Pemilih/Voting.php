<?php


namespace App\Controllers\Pemilih;

use App\Controllers\BaseController;
use App\Models\PemilihModel;
use App\Models\KandidatModel;
use App\Models\TokenModel;
use App\Models\UserModel;

class Voting extends BaseController
{
	public function index()
	{
		helper(['form', 'url']);
		$pemilihModel = new PemilihModel();
		$tokenModel = new TokenModel();
		$userModel = new UserModel();

		$data['title'] = 'Input Token';

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'token' => 'required'
			];

			if ($this->validate($rules)) {

				$getToken = $tokenModel->check_token_count($tokenModel->escapeString($this->request->getPost('token')));
				// cek token 
				if ($getToken) {
					// cek expired token
					$dateNow = date('Y-m-d H:i:s');
					if ($getToken['expired_at'] > $dateNow) {
						// cek user token
						if ($getToken['total_pengguna_saat_ini'] < $getToken['jumlah_pengguna_token']) {
							$params = [
								'token_key'		=> $tokenModel->escapeString(esc($this->request->getPost('token'))),
								'id_kandidat'	=> 0,
								'nama'			=> session()->get('nama') 
							];


							$insert = $pemilihModel->insert($params);

							if ($insert) {
								$last_id = $pemilihModel->insertID();

								$userSession = [
									'id_pemilih'	=> $last_id,
									'token_key'		=> $tokenModel->escapeString(esc($this->request->getPost('token'))),
									'nama'			=> session()->get('nama') 
								];

								session()->set($userSession);

								session()->setFlashdata('success', 'Berhasil masuk silahkan pilih');

								return redirect()->route('voting/kandidat');
							} else {
								session()->setFlashdata('danger', 'Gagal masuk data');
								return redirect()->route('voting')->withInput();
							}
						} else {
							session()->setFlashdata('danger', 'Token sudah digunakan');
							return redirect()->route('voting')->withInput();
						}
					} else {
						session()->setFlashdata('danger', 'Token sudah expired');
						return redirect()->route('voting')->withInput();
					}
				} else {
					session()->setFlashdata('danger', 'Token tidak tersedia');
					return redirect()->route('voting')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
 

		return view('user/index', $data);
	}

	public function kandidatList()
	{
		helper(['form', 'url']);
		$kandidatModel = new KandidatModel();

		$data['get_kandidat'] = $kandidatModel->findAll();

		$data['title'] = 'List Kandidat';
		return view('user/kandidat_list', $data);
	}

	public function pilihKandidat()
	{
		if ($this->request->getMethod() == 'post') {
			$pemilihModel = new PemilihModel();
			$kandidatModel = new KandidatModel();
			$id = $kandidatModel->escapeString(esc($this->request->getPost('id')));

			$getKandidat = $kandidatModel->find($id);
			if ($getKandidat) {
				$params = [
					'id_kandidat'	=> $id
				];

				$update = $pemilihModel->update(session()->get('id_pemilih'), $params);

				if ($update) {


					$data['title'] = 'Pemilihan Selesai';
					return view('user/kandidat_terpilih', $data);
				} else {
					session()->setFlashdata('danger', 'Gagal memilih kandidat');
					return redirect()->route('voting/kandidat');
				}
			} else {
				session()->setFlashdata('danger', 'Kandidat tidak ada');
				return redirect()->route('voting/kandidat');
			}
		}

		return redirect()->route('voting/kandidat');
	}
}
