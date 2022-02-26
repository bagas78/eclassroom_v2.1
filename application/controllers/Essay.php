<?php
class Essay extends CI_Controller{

	function __construct(){ 
		parent::__construct(); 
	}  
	function index(){ 
		if ( $this->session->userdata('login') == 1) {
		
	  	$data['tugas_essay_active'] = 'class="active"';
	  	$data['open_tugas'] = 'menu-open';
	  	$data['block_tugas'] = 'style="display: block;"';

		$level = $this->session->userdata('level');
		$pelajaran = $this->session->userdata('pelajaran');
		$kelas = $this->session->userdata('kelas');

		switch ($level) { 
			case 1:
				// admin
				$data['data'] = $this->query_builder->view("SELECT * FROM t_essay as a JOIN t_pelajaran as b ON a.essay_pelajaran = b.pelajaran_id WHERE a.essay_hapus = 0");
				break;
			case 2:
				// guru
				$data['data'] = $this->query_builder->view("SELECT * FROM t_essay as a JOIN t_pelajaran as b ON a.essay_pelajaran = b.pelajaran_id WHERE a.essay_hapus = 0 AND a.essay_pelajaran = '$pelajaran'");
				break;
			case 3:
				// siswa
				$data['data'] = $this->query_builder->view("SELECT * FROM t_essay as a JOIN t_pelajaran as b ON a.essay_pelajaran = b.pelajaran_id WHERE a.essay_hapus = 0 AND concat(',',essay_kelas,',') LIKE '%,$kelas,%'");
				break;
		}

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

	    $data['title'] = 'Essay';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('essay/index');
	    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	}
	function add(){

		$cek = $this->query_builder->view_row("SELECT * FROM t_essay order by essay_id DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['essay_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}

		$data['tugas_essay_active'] = 'class="active"';
		$data['open_tugas'] = 'menu-open';
		$data['block_tugas'] = 'style="display: block;"';

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['data'] = $_POST;
		$data['idsoal'] = $idsoal;

		$data['title'] = 'Ujian';
	  	$this->load->view('v_template_admin/admin_header',$data);
	  	$this->load->view('essay/insert');
	  	$this->load->view('v_template_admin/admin_footer',$data);

	} 
	function insert(){

		$jum = $_POST['essay_jumlah'];
		$path = 'assets/img/essay';
		$idsoal = $_POST['essay_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$id = $this->session->userdata('id');

		$set = array(
						'essay_id' => $_POST['essay_id'],
						'essay_guru' => $id,
						'essay_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['essay_kelas'])),
						'essay_pelajaran' => $_POST['essay_pelajaran'],
						'essay_judul' => $_POST['essay_judul'],
						'essay_jumlah' => $jum,
						'essay_text' => json_encode($_POST),				
					);

		$db = $this->query_builder->add('t_essay',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('essay'));
	}
	function delete($id){

		$set = ['essay_hapus' => 1];
		$where = ['essay_id' => $id];
		$db = $this->query_builder->update('t_essay',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}
		
		redirect(base_url('essay'));

	}
	function edit($id){

		$data['tugas_essay_active'] = 'class="active"';
		$data['open_tugas'] = 'menu-open';
		$data['block_tugas'] = 'style="display: block;"';

		$db = $this->query_builder->view_row("SELECT * FROM t_essay WHERE essay_id = '$id'");

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['id'] = $db['essay_id'];

		//soal
		$json = json_decode($db['essay_text']);
		$data['data'] = json_decode(json_encode($json), true);

		$data['title'] = 'Essay';
	  	$this->load->view('v_template_admin/admin_header',$data);
	  	$this->load->view('essay/update');
	  	$this->load->view('v_template_admin/admin_footer',$data);

	} 
	function update($id){

		$jum = $_POST['essay_jumlah'];
		$path = 'assets/img/essay';
		$idsoal = $_POST['essay_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$set = array(
						'essay_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['essay_kelas'])),
						'essay_pelajaran' => $_POST['essay_pelajaran'],
						'essay_judul' => $_POST['essay_judul'],
						'essay_jumlah' => $_POST['essay_jumlah'],
						'essay_text' => json_encode($_POST),				
					);

		$where = ['essay_id' => $id];
		$db = $this->query_builder->update('t_essay',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di ubah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di ubah');
		}

		redirect(base_url('essay'));
	}
	function kerjakan($id){
		$idsiswa = $this->session->userdata('id');

		$cek = $this->query_builder->view_row("SELECT * FROM t_essay_hasil WHERE essay_hasil_soal = '$id' AND essay_hasil_siswa = '$idsiswa' AND essay_hasil_hapus = 0");

		if ($cek > 0) {
			// sudah
			$this->session->set_flashdata('gagal','Soal sudah di kerjakan');
			redirect(base_url('essay'));
		} else {
			// belum
			$data['tugas_essay_active'] = 'class="active"';
			$data['open_tugas'] = 'menu-open';
			$data['block_tugas'] = 'style="display: block;"';

			$db = $this->query_builder->view_row("SELECT * FROM t_essay WHERE essay_id = '$id'");

			$data['id'] = $db['essay_id'];

			//soal
			$json = json_decode($db['essay_text']);
			$data['data'] = json_decode(json_encode($json), true);

			$data['title'] = 'Essay';
		  	$this->load->view('v_template_admin/admin_header',$data);
		  	$this->load->view('essay/kerjakan');
		  	$this->load->view('v_template_admin/admin_footer',$data);
		}

	}
	function kerjakan_send(){

		$id = $this->session->userdata('id');

		$set = array(
						'essay_hasil_siswa' => $id,
						'essay_hasil_soal' => $_POST['essay_id'],
						'essay_hasil_jawaban' => json_encode($_POST), 
					);

		$db = $this->query_builder->add('t_essay_hasil',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('essay'));
	}
	function koreksi(){
		if ( $this->session->userdata('login') == 1) {

			$kelas = $this->session->userdata('kelas');
			$pelajaran = $this->session->userdata('pelajaran');
			$id = $this->session->userdata('id');

			switch ($this->session->userdata('level')) {
				case '1':
					// admin
					$data['data'] = $this->query_builder->view("SELECT * FROM t_essay_hasil as a join t_essay as b ON a.essay_hasil_soal = b.essay_id join t_user as c ON c.user_id = a.essay_hasil_siswa WHERE a.essay_hasil_hapus = 0");
					break;

				case '2':
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_essay_hasil as a join t_essay as b ON a.essay_hasil_soal = b.essay_id join t_user as c ON c.user_id = a.essay_hasil_siswa WHERE a.essay_hasil_hapus = 0 AND b.essay_pelajaran = '$pelajaran'");
					break;

				case '3':
					// siswa 
					$data['data'] = $this->query_builder->view("SELECT * FROM t_essay_hasil as a join t_essay as b ON a.essay_hasil_soal = b.essay_id join t_user as c ON c.user_id = a.essay_hasil_siswa WHERE a.essay_hasil_hapus = 0 AND a.essay_hasil_siswa = '$id' AND concat(',',b.essay_kelas,',') LIKE '%,$kelas,%'");
					break;			
			}

		  $data['tugas_koreksi_essay_active'] = 'class="active"';
		  $data['open_koreksi_tugas'] = 'menu-open';
		  $data['block_koreksi_tugas'] = 'style="display: block;"';
		  
		  $data['title'] = 'Koreksi Essay';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('essay/koreksi');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_delete($id){
		
		$set = ['essay_hasil_hapus' => 1];
		$where = ['essay_hasil_id' => $id];
		$db = $this->query_builder->update('t_essay_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('essay/koreksi'));
	}
	function koreksi_detail($id){
		if ( $this->session->userdata('login') == 1) {

			$data['tugas_koreksi_essay_active'] = 'class="active"';
			$data['open_koreksi_tugas'] = 'menu-open';
			$data['block_koreksi_tugas'] = 'style="display: block;"';
				
			$data['title'] = 'Koreksi Assigment';

			$db = $this->query_builder->view_row("SELECT * FROM t_essay as a JOIN t_essay_hasil as b ON a.essay_id = b.essay_hasil_soal WHERE a.essay_id = '$id'");

			if ($this->session->userdata('level') < 3) {
				// admin & guru
				if ($db['essay_hasil_nilai'] == '') {
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
				$json = json_decode($db['essay_hasil_nilai']);
				$data['nilai'] = json_decode(json_encode($json), true);
			}
			

			if ($get == 1) {
				$data['id'] = $db['essay_hasil_id'];

				//soal
				$json = json_decode($db['essay_text']);
				$data['data'] = json_decode(json_encode($json), true);

				//jawaban
				$json = json_decode($db['essay_hasil_jawaban']);
				$data['jawaban'] = json_decode(json_encode($json), true);

				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('essay/koreksi_detail');
				$this->load->view('v_template_admin/admin_footer');
			} else {
				$this->session->set_flashdata('gagal', 'Tugas sudah di koreksi');
				redirect(base_url('essay/koreksi'));
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
						'essay_hasil_nilai' => json_encode($_POST),
						'essay_hasil_nilai_total' => $sum,
						'essay_hasil_pengkoreksi' => $userid, 
					);

		$where = ['essay_hasil_id' => $id];
		$db = $this->query_builder->update('t_essay_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('essay/koreksi'));
	}
}