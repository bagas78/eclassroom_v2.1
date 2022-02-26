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
					$num_materi = $this->query_builder->count("SELECT * FROM t_materi");
					$num_ujian = $this->query_builder->count("SELECT * FROM t_ujian");
					$num_hasil = $this->query_builder->count("SELECT * FROM t_hasil");
					$num_video = $this->query_builder->count("SELECT * FROM t_video");

					break;
				
				case '2':
					// guru
					$num_materi = $this->query_builder->count("SELECT * FROM t_materi WHERE materi_pelajaran = '$ses_pelajaran'");
					$num_ujian = $this->query_builder->count("SELECT * FROM t_ujian WHERE ujian_pelajaran = '$ses_pelajaran'");
					$num_hasil = $this->query_builder->count("SELECT * FROM t_hasil AS a JOIN t_ujian AS b ON a.hasil_soal = b.ujian_id WHERE b.ujian_pelajaran = '$ses_pelajaran'");
					$num_video = $this->query_builder->count("SELECT * FROM t_album AS a JOIN t_video AS b ON a.album_id = b.video_album WHERE a.album_pelajaran = '$ses_pelajaran'");

					break;

				case '3':
					// siswa
					$num_materi = $this->query_builder->count("SELECT * FROM t_materi WHERE FIND_IN_SET('$ses_kelas', materi_kelas)");
					$num_ujian = $this->query_builder->count("SELECT * FROM t_ujian WHERE FIND_IN_SET('$ses_kelas', ujian_kelas)");
					$num_hasil = $this->query_builder->count("SELECT * FROM t_hasil AS a JOIN t_ujian AS b ON a.hasil_soal = b.ujian_id WHERE FIND_IN_SET('$ses_kelas', b.ujian_kelas)");
					$num_video = $this->query_builder->count("SELECT * FROM t_album AS a JOIN t_video AS b ON a.album_id = b.video_album WHERE FIND_IN_SET('$ses_kelas', a.album_kelas)");

					break;
			}

			$data['materi'] = $num_materi;
			$data['ujian'] = $num_ujian;
			$data['hasil'] = $num_hasil;
			$data['video'] = $num_video;

			$data['peringkat'] = $this->query_builder->view("SELECT b.user_name AS nama, SUM(a.hasil_nilai) AS nilai FROM t_hasil AS a JOIN t_user AS b ON a.hasil_siswa = b.user_id GROUP BY a.hasil_siswa ORDER BY nilai DESC LIMIT 5");
			
			$data['dashboard'] = 'class="active"';
		    $data['title'] = 'Dashboard';
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('dashboard/dashboard');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
}