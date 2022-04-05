<?php
class Latihan extends CI_Controller{

	function __construct(){ 
		parent::__construct();  
	}  
	function index(){ 
		if ( $this->session->userdata('login') == 1) {
		
		$data['open_latihan'] = 'menu-open'; 
		$data['block_latihan'] = 'style="display: block;"';
	  	$data['latihan_active'] = 'class="active"';

		$level = $this->session->userdata('level');
		$pelajaran = $this->session->userdata('pelajaran');
		$kelas = $this->session->userdata('kelas');
		$tgl = date('Y-m-d');

		switch ($level) { 
			case 1: 
				// admin
				$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan as a JOIN t_pelajaran as b ON a.latihan_pelajaran = b.pelajaran_id JOIN t_kelas as c ON a.latihan_kelas = c.kelas_id WHERE a.latihan_hapus = 0");
				break;
			case 2:
				// guru
				$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan as a JOIN t_pelajaran as b ON a.latihan_pelajaran = b.pelajaran_id JOIN t_kelas as c ON a.latihan_kelas = c.kelas_id WHERE a.latihan_hapus = 0 AND a.latihan_pelajaran = '$pelajaran'");
				break;
			case 3:
				// siswa
				$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan as a JOIN t_pelajaran as b ON a.latihan_pelajaran = b.pelajaran_id JOIN t_kelas as c ON a.latihan_kelas = c.kelas_id WHERE a.latihan_hapus = 0 AND concat(',',latihan_kelas,',') LIKE '%,$kelas,%' AND latihan_tampil <= '$tgl'");
				break;
		}

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
		$data['semester_data'] = $this->query_builder->view("SELECT * FROM t_semester");

	    $data['title'] = 'latihan';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('latihan/index');
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

		$cek = $this->query_builder->view_row("SELECT * FROM t_latihan order by latihan_id DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['latihan_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}

		$data['open_latihan'] = 'menu-open'; 
		$data['block_latihan'] = 'style="display: block;"';
	  	$data['latihan_active'] = 'class="active"';

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
		$data['kelompok_data'] = $this->query_builder->view("SELECT * FROM t_kelompok WHERE kelompok_hapus = 0");

		$data['data'] = $_POST;
		$data['idsoal'] = $idsoal;

		$data['title'] = 'Ujian';
	  	$this->load->view('v_template_admin/admin_header',$data);
	  	$this->load->view('latihan/insert');
	  	$this->load->view('v_template_admin/admin_footer',$data);

	} 
	function insert(){

		$jum = $_POST['latihan_jumlah'];
		$path = 'assets/img/latihan';
		$idsoal = $_POST['latihan_id'];

		$arr = [];
		for ($i=1; $i < $jum+1 ; $i++) {

			move_uploaded_file($_FILES['gambar'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');

			//file
			$typefile = explode('/', $_FILES['file'.$i]['type']);
			$filename = $_FILES['file'.$i]['name'];
			$type = explode(".", $filename);
			$no = count($type) - 1;
			$name_file = $idsoal.'_'.$i.'.'.$type[$no];

			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$name_file);

			if ($filename) {
				$arr += array('file'.$i => $name_file);
			}
		}

		$merge = array_merge($_POST, $arr);

		$id = $this->session->userdata('id');

		$set = array(
						'latihan_id' => $_POST['latihan_id'],
						'latihan_judul' => $_POST['latihan_judul'],
						'latihan_guru' => $id,
						'latihan_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['latihan_kelas'])),
						'latihan_pelajaran' => $_POST['latihan_pelajaran'],
						'latihan_jumlah' => $jum,
						'latihan_text' => json_encode($merge),
						'latihan_jenis' => $_POST['latihan_jenis'],
						'latihan_tampil' => $_POST['latihan_tampil'],
						'latihan_batas_unggah' => $_POST['latihan_batas_unggah'],
						'latihan_semester' => $_POST['latihan_semester'],
						'latihan_pertemuan' => $_POST['latihan_pertemuan'],		
					);

		$db = $this->query_builder->add('t_latihan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('latihan'));
	}
	function delete($id){

		$set = ['latihan_hapus' => 1];
		$where = ['latihan_id' => $id];
		$db = $this->query_builder->update('t_latihan',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}
		
		redirect(base_url('latihan'));

	}
	function edit($id){

		$data['open_latihan'] = 'menu-open'; 
		$data['block_latihan'] = 'style="display: block;"';
	  	$data['latihan_active'] = 'class="active"';

		$db = $this->query_builder->view_row("SELECT * FROM t_latihan WHERE latihan_id = '$id'");

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
		$data['kelompok_data'] = $this->query_builder->view("SELECT * FROM t_kelompok WHERE kelompok_hapus = 0");

		$data['id'] = $db['latihan_id'];

		//soal
		$json = json_decode($db['latihan_text']);
		$data['data'] = json_decode(json_encode($json), true);

		$data['title'] = 'latihan';
	  	$this->load->view('v_template_admin/admin_header',$data);
	  	$this->load->view('latihan/update');
	  	$this->load->view('v_template_admin/admin_footer',$data);

	} 
	function update($id){

		$jum = $_POST['latihan_jumlah'];
		$path = 'assets/img/latihan';
		$idsoal = $_POST['latihan_id'];

		$arr = [];
		for ($i=1; $i < $jum+1 ; $i++) {

			move_uploaded_file($_FILES['gambar'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');

			//file
			$typefile = explode('/', $_FILES['file'.$i]['type']);
			$filename = $_FILES['file'.$i]['name'];
			$type = explode(".", $filename);
			$no = count($type) - 1;
			$name_file = $idsoal.'_'.$i.'.'.$type[$no];

			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$name_file);

			if ($filename) {
				$arr += array('file'.$i => $name_file);
			}else{
				$arr += array('file'.$i => $_POST['file'.$i]); 
			}
		}

		$merge = array_merge($_POST, $arr);

		$set = array(
						'latihan_id' => $_POST['latihan_id'],
						'latihan_judul' => $_POST['latihan_judul'],
						'latihan_guru' => $id,
						'latihan_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['latihan_kelas'])),
						'latihan_pelajaran' => $_POST['latihan_pelajaran'],
						'latihan_jumlah' => $jum,
						'latihan_text' => json_encode($merge),
						'latihan_jenis' => $_POST['latihan_jenis'],
						'latihan_tampil' => $_POST['latihan_tampil'],
						'latihan_batas_unggah' => $_POST['latihan_batas_unggah'],				
					);

		$where = ['latihan_id' => $id];
		$db = $this->query_builder->update('t_latihan',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di ubah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di ubah');
		}

		redirect(base_url('latihan'));
	}
	function kerjakan($id){
		$idsiswa = $this->session->userdata('id');
		$tgl = date('Y-m-d H:i:s');

		$data['kelompok_data'] = $this->query_builder->view("SELECT * FROM t_kelompok WHERE kelompok_hapus = 0 AND concat(',',kelompok_siswa,',') LIKE '%,$idsiswa,%'");

		$cek_status = $this->query_builder->view_row("SELECT * FROM t_latihan_hasil WHERE latihan_hasil_soal = '$id' AND latihan_hasil_siswa = '$idsiswa' AND latihan_hasil_hapus = 0");
		$cek_unggah = $this->query_builder->view_row("SELECT * FROM t_latihan WHERE latihan_id = '$id' AND latihan_batas_unggah <= date('$tgl')");

		if ($cek_unggah > 0) {
			// sudah
			$this->session->set_flashdata('gagal','Sudah melebihi batas unggah jawaban');
			redirect(base_url('latihan'));
		} else {

			if ($cek_status > 0) {
					
				$this->session->set_flashdata('gagal','Soal sudah di kerjakan');
				redirect(base_url('latihan'));

			} else {

				// belum
				$data['open_latihan'] = 'menu-open';
				$data['block_latihan'] = 'style="display: block;"';
		  		$data['latihan_active'] = 'class="active"';

				$db = $this->query_builder->view_row("SELECT * FROM t_latihan WHERE latihan_id = '$id'");

				$data['id'] = $db['latihan_id'];

				//soal
				$json = json_decode($db['latihan_text']);
				$data['data'] = json_decode(json_encode($json), true);

				$data['title'] = 'latihan';
			  	$this->load->view('v_template_admin/admin_header',$data);
			  	$this->load->view('latihan/kerjakan');
			  	$this->load->view('v_template_admin/admin_footer',$data);
			}
		}

	}
	function kerjakan_send(){

		$id = $this->session->userdata('id');
		$jum = $_POST['latihan_jumlah'];
		$path = 'assets/img/latihan';
		$idsoal = $_POST['latihan_id'];

		$arr = [];
		for ($i=1; $i < $jum+1 ; $i++) {

			//file
			$typefile = explode('/', $_FILES['file'.$i]['type']);
			$filename = $_FILES['file'.$i]['name'];
			$type = explode(".", $filename);
			$no = count($type) - 1;
			$name_file = $idsoal.'_'.$i.'_jawab.'.$type[$no];

			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$name_file);

			if ($filename) {
				$arr += array('jawab'.$i.'_file' => $name_file);
			}
		}

		$merge = array_merge($_POST, $arr);

		$set = array(
						'latihan_hasil_siswa' => $id,
						'latihan_hasil_soal' => $_POST['latihan_id'],
						'latihan_hasil_jawaban' => json_encode($merge), 
						'latihan_hasil_jenis' => $_POST['latihan_jenis'],
						'latihan_hasil_kelompok' => $_POST['latihan_kelompok'],  
					);

		$db = $this->query_builder->add('t_latihan_hasil',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('latihan'));
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
						$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan_hasil as a join t_latihan as b ON a.latihan_hasil_soal = b.latihan_id join t_user as c ON c.user_id = a.latihan_hasil_siswa LEFT JOIN t_kelompok as e ON a.latihan_hasil_kelompok = e.kelompok_id JOIN t_kelas as f ON c.user_kelas = f.kelas_id WHERE a.latihan_hasil_hapus = 0 AND a.latihan_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");
						break;

					case '2':
						// guru
						$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan_hasil as a join t_latihan as b ON a.latihan_hasil_soal = b.latihan_id join t_user as c ON c.user_id = a.latihan_hasil_siswa LEFT JOIN t_kelompok as e ON a.latihan_hasil_kelompok = e.kelompok_id JOIN t_kelas as f ON c.user_kelas = f.kelas_id WHERE a.latihan_hasil_hapus = 0 AND b.latihan_pelajaran = '$pelajaran' AND a.latihan_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");
						break;	
				}

			}else{
				//tanpa filter
				switch ($this->session->userdata('level')) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan_hasil as a join t_latihan as b ON a.latihan_hasil_soal = b.latihan_id join t_user as c ON c.user_id = a.latihan_hasil_siswa LEFT JOIN t_kelompok as e ON a.latihan_hasil_kelompok = e.kelompok_id JOIN t_kelas as f ON c.user_kelas = f.kelas_id WHERE a.latihan_hasil_hapus = 0");
						break;

					case '2':
						// guru
						$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan_hasil as a join t_latihan as b ON a.latihan_hasil_soal = b.latihan_id join t_user as c ON c.user_id = a.latihan_hasil_siswa LEFT JOIN t_kelompok as e ON a.latihan_hasil_kelompok = e.kelompok_id JOIN t_kelas as f ON c.user_kelas = f.kelas_id WHERE a.latihan_hasil_hapus = 0 AND b.latihan_pelajaran = '$pelajaran'");
						break;

					case '3':
						// siswa 
						$data['data'] = $this->query_builder->view("SELECT * FROM t_latihan_hasil as a join t_latihan as b ON a.latihan_hasil_soal = b.latihan_id join t_user as c ON c.user_id = a.latihan_hasil_siswa LEFT JOIN t_kelompok as e ON a.latihan_hasil_kelompok = e.kelompok_id JOIN t_kelas as f ON c.user_kelas = f.kelas_id WHERE a.latihan_hasil_hapus = 0 AND a.latihan_hasil_siswa = '$id' AND concat(',',b.latihan_kelas,',') LIKE '%,$kelas,%'");
						break;			
				}
			}

		  //materi
		  switch ($this->session->userdata('level')) {
		  	case '1':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_latihan WHERE latihan_hapus = 0");
		  		break;
		  	case '2':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_latihan WHERE latihan_hapus = 0 AND latihan_pelajaran = '$pelajaran'");
		  		break;
		  	
		  }

		  $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

		  $data['open_latihan'] = 'menu-open';
		  $data['block_latihan'] = 'style="display: block;"';
		  $data['latihan_koreksi_active'] = 'class="active"';
		  
		  $data['title'] = 'Koreksi latihan';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('latihan/koreksi');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_delete($id){
		
		$set = ['latihan_hasil_hapus' => 1];
		$where = ['latihan_hasil_id' => $id];
		$db = $this->query_builder->update('t_latihan_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('latihan/koreksi'));
	}
	function koreksi_detail($id){
		if ( $this->session->userdata('login') == 1) {

		  $data['open_latihan'] = 'menu-open'; 
		  $data['block_latihan'] = 'style="display: block;"';
	  	  $data['latihan_koreksi_active'] = 'class="active"';
				
			$data['title'] = 'Koreksi Assigment';

			$db = $this->query_builder->view_row("SELECT * FROM t_latihan as a JOIN t_latihan_hasil as b ON a.latihan_id = b.latihan_hasil_soal WHERE a.latihan_id = '$id'");

			if ($this->session->userdata('level') < 3) {
				// admin & guru
				if ($db['latihan_hasil_nilai'] == '') {
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
				$json = json_decode($db['latihan_hasil_nilai']);
				$data['nilai'] = json_decode(json_encode($json), true);
			}
			

			if ($get == 1) {
				$data['id'] = $db['latihan_hasil_id'];

				//soal
				$json = json_decode($db['latihan_text']);
				$data['data'] = json_decode(json_encode($json), true);

				//jawaban
				$json = json_decode($db['latihan_hasil_jawaban']);
				$data['jawaban'] = json_decode(json_encode($json), true);

				// echo '<pre>';
				// print_r($data['jawaban']);
				// echo '</pre>';

				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('latihan/koreksi_detail');
				$this->load->view('v_template_admin/admin_footer');
			} else {
				$this->session->set_flashdata('gagal', 'latihan sudah di koreksi');
				redirect(base_url('latihan/koreksi'));
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
						'latihan_hasil_nilai' => json_encode($_POST),
						'latihan_hasil_nilai_total' => $sum,
						'latihan_hasil_pengkoreksi' => $userid, 
					);

		$where = ['latihan_hasil_id' => $id];
		$db = $this->query_builder->update('t_latihan_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('latihan/koreksi'));
	}
}