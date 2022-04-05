<?php
class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct(); 
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) { 

			$id = $this->session->userdata('id');
			$level = $this->session->userdata('level');
			$ses_pelajaran = $this->session->userdata('pelajaran');
			$ses_kelas = $this->session->userdata('kelas');

			switch ($level) { 
				case '1':
					// admin
					$num_materi = $this->query_builder->count("SELECT * FROM t_materi WHERE materi_hapus = 0");
					$num_latihan = $this->query_builder->count("SELECT * FROM t_assigment WHERE assigment_hapus = 0");
					$num_modul = $this->query_builder->count("SELECT * FROM t_modul WHERE modul_hapus = 0");
					$num_video = $this->query_builder->count("SELECT * FROM t_video WHERE video_hapus = 0");

					break;
				
				case '2':
					// guru
					$num_materi = $this->query_builder->count("SELECT * FROM t_materi WHERE materi_pelajaran = '$ses_pelajaran' AND materi_hapus = 0");
					$num_latihan = $this->query_builder->count("SELECT * FROM t_assigment WHERE assigment_pelajaran = '$ses_pelajaran' AND assigment_hapus = 0");
					$num_modul = $this->query_builder->count("SELECT * FROM t_modul WHERE modul_pelajaran = '$ses_pelajaran' AND modul_hapus = 0");
					$num_video = $this->query_builder->count("SELECT * FROM t_album AS a JOIN t_video AS b ON a.album_id = b.video_album WHERE a.album_pelajaran = '$ses_pelajaran' AND b.video_hapus = 0");

					break;

				case '3':
					// siswa
					$num_materi = $this->query_builder->count("SELECT * FROM t_materi WHERE FIND_IN_SET('$ses_kelas', materi_kelas)");
					$num_latihan = $this->query_builder->count("SELECT * FROM t_assigment WHERE FIND_IN_SET('$ses_kelas', assigment_kelas) AND assigment_hapus = 0");
					$num_modul = $this->query_builder->count("SELECT * FROM t_modul WHERE FIND_IN_SET('$ses_kelas', modul_kelas) AND modul_hapus = 0");
					$num_video = $this->query_builder->count("SELECT * FROM t_album AS a JOIN t_video AS b ON a.album_id = b.video_album WHERE FIND_IN_SET('$ses_kelas', a.album_kelas) AND video_hapus = 0");

					break;
			}

			$data['materi'] = $num_materi;
			$data['latihan'] = $num_latihan;
			$data['modul'] = $num_modul;
			$data['video'] = $num_video;

			$data['info'] = $this->query_builder->view_row("SELECT * FROM t_informasi");
			
			$data['dashboard'] = 'class="active"';
		    $data['title'] = 'Dashboard';
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('dashboard/dashboard');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
	function edit(){
		$set = array(
						'informasi_user' => $this->session->userdata('id'),
						'informasi_mata_kuliah' => $_POST['informasi_mata_kuliah'],
						'informasi_sks' => $_POST['informasi_sks'],
						'informasi_deskripsi' => $_POST['informasi_deskripsi'],
						'informasi_relevansi' => $_POST['informasi_relevansi'], 
					);

		$where = ['informasi_id' => 1];
		$db = $this->query_builder->update('t_informasi',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berujian_pilihan_hasil di edit');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('dashboard'));
	}
}