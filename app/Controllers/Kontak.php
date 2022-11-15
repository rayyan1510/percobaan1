<?php

namespace App\Controllers;

use App\Models\KontakModel;

class Kontak extends BaseController
{
 protected $KontakModel;
 public function __construct()
    {
        $this->KontakModel = new KontakModel(); 
    }

    public function index()
    {
        $data = [
            'title' => 'Kontak | BEM POLTEKKES KEMENKES MEDAN',
            'validation' => \Config\Services::validation()
        ];

        return view('public/contact', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_depan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama depan wajib diisi',
                ]
            ],
            'nama_belakang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama belakang wajib diisi'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email wajib diisi'
                ]
            ],
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pesan wajib diisi'
                ]
            ]
        ])) {
            return redirect()->to('/contact')->withInput();

        }

        $this->KontakModel->save([
            'nama_depan' => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            'email' => $this->request->getVar('email'),
            'pesan' => $this->request->getVar(('pesan'))
        ]);

        session()->setFlashdata('pesan', 'Selamat Data Berhasil Terkirim.');

        return redirect()->to('/contact');
    
    }
}