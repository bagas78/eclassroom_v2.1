<?php
class Rekap extends CI_Controller{
 
	function __construct(){
		parent::__construct(); 
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['rekap'] = 'class="active"';
		    $data['title'] = 'Rekap';

		    //variable sementara
		    $mah = @$_POST['mahasiswa'];
		    $pel = @$_POST['pelajaran'];
		    $sem = @$_POST['semester']; 

		    //information
		    $data['nama_info'] = $this->query_builder->view_row("SELECT user_name as nama FROM t_user WHERE user_id = '$mah'");
		    $data['pelajaran_info'] = $this->query_builder->view_row("SELECT pelajaran_nama as pelajaran FROM t_pelajaran WHERE pelajaran_id = '$pel'");
		    $data['semester_info'] = $sem;

		    //search
		    $data['mahasiswa_data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_level = 3 AND user_hapus = 0");
		    $data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
		    $data['semester_data'] = $this->query_builder->view("SELECT * FROM t_semester");

		    //view
		    $data['semester_view'] = $this->query_builder->view("SELECT * FROM t_semester AS a JOIN t_pertemuan AS b ON a.semester_no = b.pertemuan_semester WHERE semester_no = '$sem'");
		    $data['pre_view'] = $this->query_builder->view("SELECT * FROM t_pre as a JOIN t_pre_hasil as b ON a.pre_id = b.pre_hasil_soal WHERE b.pre_hasil_hapus = 0 AND a.pre_semester = '$sem' AND b.pre_hasil_siswa = '$mah' AND a.pre_pelajaran = '$pel'");
		    $data['post_view'] = $this->query_builder->view("SELECT * FROM t_post as a JOIN t_post_hasil as b ON a.post_id = b.post_hasil_soal WHERE b.post_hasil_hapus = 0 AND a.post_semester = '$sem' AND b.post_hasil_siswa = '$mah' AND a.post_pelajaran = '$pel'");
		    $data['latihan_view'] = $this->query_builder->view("SELECT * FROM t_latihan as a JOIN t_latihan_hasil as b ON a.latihan_id = b.latihan_hasil_soal WHERE b.latihan_hasil_hapus = 0 AND a.latihan_semester = '$sem' AND b.latihan_hasil_siswa = '$mah' AND a.latihan_pelajaran = '$pel'");
		    $data['ujian_pilihan_view'] = $this->query_builder->view_row("SELECT b.ujian_pilihan_hasil_nilai AS nilai FROM t_ujian_pilihan AS a JOIN t_ujian_pilihan_hasil AS b ON a.ujian_pilihan_id = b.ujian_pilihan_hasil_soal WHERE a.ujian_pilihan_semester = '$sem' AND b.ujian_pilihan_hasil_siswa = '$mah' AND a.ujian_pilihan_pelajaran = '$pel' AND b.ujian_pilihan_hasil_hapus = 0");
		    $data['ujian_essay_view'] = $this->query_builder->view_row("SELECT b.ujian_essay_hasil_nilai_total AS nilai FROM t_ujian_essay AS a JOIN t_ujian_essay_hasil AS b ON a.ujian_essay_id = b.ujian_essay_hasil_soal WHERE a.ujian_essay_semester = '$sem' AND b.ujian_essay_hasil_siswa = '$mah' AND a.ujian_essay_pelajaran = '$pel' AND b.ujian_essay_hasil_hapus = 0");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('rekap/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
}