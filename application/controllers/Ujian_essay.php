<?php
class Ujian_essay extends CI_Controller{

	function __construct(){ 
		parent::__construct();  
	}  
	function index(){  
		if ( $this->session->userdata('login') == 1) {

		$data['open_ujian'] = 'menu-open';
		$data['block_ujian'] = 'style="display: block;"';
		$data['ujian_essay_active'] = 'class="active"';

		$level = $this->session->userdata('level');
		$pelajaran = $this->session->userdata('pelajaran');
		$kelas = $this->session->userdata('kelas');

		switch ($level) {  
			case 1:  
				// admin
				$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay as a JOIN t_pelajaran as b ON a.ujian_essay_pelajaran = b.pelajaran_id WHERE a.ujian_essay_hapus = 0");
				break;
			case 2:
				// guru
				$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay as a JOIN t_pelajaran as b ON a.ujian_essay_pelajaran = b.pelajaran_id WHERE a.ujian_essay_hapus = 0 AND a.ujian_essay_pelajaran = '$pelajaran'");
				break;
			case 3:
				// siswa
				$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay as a JOIN t_pelajaran as b ON a.ujian_essay_pelajaran = b.pelajaran_id WHERE a.ujian_essay_hapus = 0 AND concat(',',ujian_essay_kelas,',') LIKE '%,$kelas,%'");
				break;
		}

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
		$data['semester_data'] = $this->query_builder->view("SELECT * FROM t_semester");

	    $data['title'] = 'ujian_essay';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('ujian_essay/index');
	    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	}
	function get_pertemuan(){
		$no = $_POST['no'];

		$db = $this->query_builder->view("SELECT * FROM t_pertemuan WHERE pertemuan_semester = '$no'");
		echo json_encode($db);
	}
	function add(){

		$cek = $this->query_builder->view_row("SELECT * FROM t_ujian_essay order by ujian_essay_id DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['ujian_essay_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['data'] = $_POST;
		$data['idsoal'] = $idsoal;

		$data['open_ujian'] = 'menu-open';
		$data['block_ujian'] = 'style="display: block;"';
		$data['ujian_essay_active'] = 'class="active"';

		$data['title'] = 'Ujian';
	  	$this->load->view('v_template_admin/admin_header',$data);
	  	$this->load->view('ujian_essay/insert');
	  	$this->load->view('v_template_admin/admin_footer',$data);

	} 
	function insert(){

		$jum = $_POST['ujian_essay_jumlah'];
		$path = 'assets/img/ujian_essay';
		$idsoal = $_POST['ujian_essay_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$id = $this->session->userdata('id');

		$set = array(
						'ujian_essay_id' => $_POST['ujian_essay_id'],
						'ujian_essay_guru' => $id,
						'ujian_essay_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_essay_kelas'])),
						'ujian_essay_pelajaran' => $_POST['ujian_essay_pelajaran'],
						'ujian_essay_jumlah' => $jum,
						'ujian_essay_text' => json_encode($_POST),
						'ujian_essay_judul' => $_POST['ujian_essay_judul'],
						'ujian_essay_durasi' => $_POST['ujian_essay_durasi'],
						'ujian_essay_petunjuk' => $_POST['ujian_essay_petunjuk'],
						'ujian_essay_pelaksanaan' => $_POST['ujian_essay_pelaksanaan'],	
						'ujian_essay_semester' => $_POST['ujian_essay_semester'],	
						'ujian_essay_pertemuan' => $_POST['ujian_essay_pertemuan'],				
					);

		$db = $this->query_builder->add('t_ujian_essay',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('ujian_essay'));
	}
	function delete($id){

		$set = ['ujian_essay_hapus' => 1];
		$where = ['ujian_essay_id' => $id];
		$db = $this->query_builder->update('t_ujian_essay',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}
		
		redirect(base_url('ujian_essay'));

	} 
	function edit($id){

		$data['open_ujian'] = 'menu-open';
		$data['block_ujian'] = 'style="display: block;"';
		$data['ujian_essay_active'] = 'class="active"';

		$db = $this->query_builder->view_row("SELECT * FROM t_ujian_essay WHERE ujian_essay_id = '$id'");

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['id'] = $db['ujian_essay_id'];

		//soal
		$json = json_decode($db['ujian_essay_text']);
		$data['data'] = json_decode(json_encode($json), true);

		$data['title'] = 'ujian_essay';
	  	$this->load->view('v_template_admin/admin_header',$data);
	  	$this->load->view('ujian_essay/update');
	  	$this->load->view('v_template_admin/admin_footer',$data);

	} 
	function update($id){

		$jum = $_POST['ujian_essay_jumlah'];
		$path = 'assets/img/ujian_essay';
		$idsoal = $_POST['ujian_essay_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$set = array(
						'ujian_essay_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_essay_kelas'])),
						'ujian_essay_pelajaran' => $_POST['ujian_essay_pelajaran'],
						'ujian_essay_jumlah' => $_POST['ujian_essay_jumlah'],
						'ujian_essay_text' => json_encode($_POST),
						'ujian_essay_judul' => $_POST['ujian_essay_judul'],
						'ujian_essay_durasi' => $_POST['ujian_essay_durasi'],
						'ujian_essay_petunjuk' => $_POST['ujian_essay_petunjuk'],
						'ujian_essay_pelaksanaan' => $_POST['ujian_essay_pelaksanaan'],	
					);

		$where = ['ujian_essay_id' => $id];
		$db = $this->query_builder->update('t_ujian_essay',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di ubah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di ubah');
		}

		redirect(base_url('ujian_essay'));
	}
	function kerjakan($id){
		$idsiswa = $this->session->userdata('id');

		$curdate = date('Y-m-d H:i:s');

		$cek_status = $this->query_builder->view_row("SELECT * FROM t_ujian_essay_hasil WHERE ujian_essay_hasil_soal = '$id' AND ujian_essay_hasil_siswa = '$idsiswa' AND ujian_essay_hasil_hapus = 0");

		$cek_pelaksanaan = $this->query_builder->view_row("SELECT * FROM t_ujian_essay WHERE ujian_essay_id = '$id' AND ujian_essay_pelaksanaan <= '$curdate'");

		if ($cek_pelaksanaan < 1) {
			// sudah
			$this->session->set_flashdata('gagal','Ujian belum di mulai');
			redirect(base_url('ujian_essay'));
		} else {

			if ($cek_status > 0) {
				// sudah
				$this->session->set_flashdata('gagal','Ujian sudah di kerjakan');
				redirect(base_url('ujian_essay'));
			} else {
				// belum
				$data['open_ujian'] = 'menu-open';
				$data['block_ujian'] = 'style="display: block;"';
				$data['ujian_essay_active'] = 'class="active"';

				$db = $this->query_builder->view_row("SELECT * FROM t_ujian_essay WHERE ujian_essay_id = '$id'");

				$data['id'] = $db['ujian_essay_id'];

				//soal
				$json = json_decode($db['ujian_essay_text']);
				$data['data'] = json_decode(json_encode($json), true);

				$data['title'] = 'ujian_essay';
			  	$this->load->view('v_template_admin/admin_header',$data);
			  	$this->load->view('ujian_essay/kerjakan');
			  	$this->load->view('v_template_admin/admin_footer',$data);
			}

		}

	}
	function kerjakan_send(){

		$id = $this->session->userdata('id');

		$set = array(
						'ujian_essay_hasil_durasi_sisa' => $_POST['timer'],
						'ujian_essay_hasil_siswa' => $id,
						'ujian_essay_hasil_soal' => $_POST['id'],
						'ujian_essay_hasil_jawaban' => json_encode($_POST),
					);

		$db = $this->query_builder->add('t_ujian_essay_hasil',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('ujian_essay'));
	}
	function koreksi(){
		if ( $this->session->userdata('login') == 1) {

			$kelas = $this->session->userdata('kelas');
			$pelajaran = $this->session->userdata('pelajaran');
			$id = $this->session->userdata('id');

			//filter
			$filter_materi = @$_POST['materi'];
			$filter_kelas = @$_POST['kelas'];

			if (@$filter_kelas) {
				//dengan filter
				switch ($this->session->userdata('level')) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay_hasil as a join t_ujian_essay as b ON a.ujian_essay_hasil_soal = b.ujian_essay_id join t_user as c ON c.user_id = a.ujian_essay_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_essay_hasil_hapus = 0 AND a.ujian_essay_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");
						break;

					case '2':
						// guru
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay_hasil as a join t_ujian_essay as b ON a.ujian_essay_hasil_soal = b.ujian_essay_id join t_user as c ON c.user_id = a.ujian_essay_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_essay_hasil_hapus = 0 AND b.ujian_essay_pelajaran = '$pelajaran' AND a.ujian_essay_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");
						break;	
				}

			}else{
				//tanpa filter
				switch ($this->session->userdata('level')) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay_hasil as a join t_ujian_essay as b ON a.ujian_essay_hasil_soal = b.ujian_essay_id join t_user as c ON c.user_id = a.ujian_essay_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_essay_hasil_hapus = 0");
						break;

					case '2':
						// guru
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay_hasil as a join t_ujian_essay as b ON a.ujian_essay_hasil_soal = b.ujian_essay_id join t_user as c ON c.user_id = a.ujian_essay_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_essay_hasil_hapus = 0 AND b.ujian_essay_pelajaran = '$pelajaran'");
						break;

					case '3':
						// siswa 
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay_hasil as a join t_ujian_essay as b ON a.ujian_essay_hasil_soal = b.ujian_essay_id join t_user as c ON c.user_id = a.ujian_essay_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_essay_hasil_hapus = 0 AND a.ujian_essay_hasil_siswa = '$id' AND concat(',',b.ujian_essay_kelas,',') LIKE '%,$kelas,%'");
						break;			
				}
			}

		  //materi
		  switch ($this->session->userdata('level')) {
		  	case '1':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay WHERE ujian_essay_hapus = 0");
		  		break;
		  	case '2':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_ujian_essay WHERE ujian_essay_hapus = 0 AND ujian_essay_pelajaran = '$pelajaran'");
		  		break;
		  	
		  }

		  $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

		  $data['open_ujian'] = 'menu-open';
		  $data['block_ujian'] = 'style="display: block;"';
		  $data['block_ujian_hasil'] = 'style="display: block;"';
		  $data['ujian_essay_hasil_active'] = 'class="active"';
		  
		  $data['title'] = 'Koreksi ujian_essay';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('ujian_essay/koreksi');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_delete($id){
		
		$set = ['ujian_essay_hasil_hapus' => 1];
		$where = ['ujian_essay_hasil_id' => $id];
		$db = $this->query_builder->update('t_ujian_essay_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('ujian_essay/koreksi'));
	}
	function koreksi_detail($id){
		if ( $this->session->userdata('login') == 1) {

		  $data['open_ujian'] = 'menu-open';
		  $data['block_ujian'] = 'style="display: block;"';
		  $data['block_ujian_hasil'] = 'style="display: block;"';
		  $data['ujian_essay_hasil_active'] = 'class="active"';
				
			$data['title'] = 'Koreksi Assigment';

			$db = $this->query_builder->view_row("SELECT * FROM t_ujian_essay as a JOIN t_ujian_essay_hasil as b ON a.ujian_essay_id = b.ujian_essay_hasil_soal WHERE b.ujian_essay_hasil_id = $id");

			if ($this->session->userdata('level') < 3) {
				// admin & guru
				if ($db['ujian_essay_hasil_nilai'] == '') {
					// belum
					$get = 1;
				} else {
					// sudah
					$get = 0;
				}
				
			} else {
				// siswa
				$get = 1;

				//nilai
				$json = json_decode($db['ujian_essay_hasil_nilai']);
				$data['nilai'] = json_decode(json_encode($json), true);
			}
			

			if ($get == 1) {
				$data['id'] = $db['ujian_essay_hasil_id'];

				//soal
				$json = json_decode($db['ujian_essay_text']);
				$data['data'] = json_decode(json_encode($json), true);

				//jawaban
				$json = json_decode($db['ujian_essay_hasil_jawaban']);
				$data['jawaban'] = json_decode(json_encode($json), true);

				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('ujian_essay/koreksi_detail');
				$this->load->view('v_template_admin/admin_footer');
			} else {
				$this->session->set_flashdata('gagal', 'latihan sudah di koreksi');
				redirect(base_url('ujian_essay/koreksi'));
			}

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_send($id){

		$userid = $this->session->userdata('id');

		//jumlah nilai
		$jum = $_POST['jumlah'];
		$sum = 0;
		for ($i=1; $i < $jum+1; $i++){
			$sum += $_POST['nilai'.$i];
		}
		//

		$set = array(
						'ujian_essay_hasil_nilai' => json_encode($_POST),
						'ujian_essay_hasil_nilai_total' => $sum,
						'ujian_essay_hasil_pengkoreksi' => $userid, 
					);

		$where = ['ujian_essay_hasil_id' => $id];
		$db = $this->query_builder->update('t_ujian_essay_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('ujian_essay/koreksi'));
	}
}