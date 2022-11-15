<?php 

namespace App\Controllers;

class Home extends BaseController
{
		//public function index()
		//{
		//	$data['title'] = 'Home';

		//	return view('home', $data);
		//}
		public function index()
		{
			$data = [
				'title' => 'Beranda | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/index', $data);
		}
	
		public function contact()
		{
			$data = [
				'title' => 'Kontak | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/contact', $data);
		}
	
		public function kegiatan()
		{
			$data = [
				'title' => 'Kegiatan | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/kegiatan', $data);
		}
	
		public function struktur()
		{
			$data = [
				'title' => 'Struktur | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/struktur', $data);
		}
	
		public function fungsitujuan()
		{
			$data = [
				'title' => 'Fungsi Tujuan | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/fungsi-tujuan', $data);
		}
	
		public function identitas()
		{
			$data = [
				'title' => 'Identitas | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/identitas', $data);
		}
	
		public function visimisi()
		{
			$data = [
				'title' => 'Visi Misi | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/visi-misi', $data);
		}
	
		public function logo()
		{
			$data = [
				'title' => 'Logo | BEM POLTEKKES KEMENKES MEDAN',
			];
			return view('public/logo', $data);
		}
	
		public function register()
		{
			return view('auth/register');
		}
		public function user()
		{
			return view('user/index');
		}
	
		//--------------------------------------------------------------------
	
	}