<?php
class Assigment extends CI_Controller{

	function __construct(){ 
		parent::__construct(); 
	}  
	function index(){  
		if ( $this->session->userdata('login') == 1) {
		
		  $data['tugas_assigment_active'] = 'class="active"';
		  $data['open_tugas'] = 'menu-open';
		  $data['block_tugas'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');

			switch ($level) { 
				case 1:
					// admin
					$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment as a JOIN t_pelajaran as b ON a.assigment_pelajaran = b.pelajaran_id WHERE a.assigment_hapus = 0");
					break;
				case 2:
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment as a JOIN t_pelajaran as b ON a.assigment_pelajaran = b.pelajaran_id WHERE a.assigment_hapus = 0 AND a.assigment_pelajaran = '$pelajaran'");
					break;
				case 3:
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment as a JOIN t_pelajaran as b ON a.assigment_pelajaran = b.pelajaran_id WHERE a.assigment_hapus = 0 AND concat(',',assigment_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

	    $data['title'] = 'Assigment';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('assigment/index');
	    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	}
	function add(){

		$data['tugas_assigment_active'] = 'class="active"';
		$data['open_tugas'] = 'menu-open';
		$data['block_tugas'] = 'style="display: block;"';

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['title'] = 'Ujian';
	  $this->load->view('v_template_admin/admin_header',$data);
	  $this->load->view('assigment/insert');
	  $this->load->view('v_template_admin/admin_footer',$data);

	} 
	function insert(){

		$id = $this->session->userdata('id');

		$set = array(
						'assigment_guru' => $id,
						'assigment_judul' => $_POST['assigment_judul'],
						'assigment_jenis' => $_POST['assigment_jenis'],
						'assigment_isi' => $_POST['assigment_isi'],
						'assigment_pelajaran' => $_POST['assigment_pelajaran'],
						'assigment_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['assigment_kelas'])),				
					);

		$db = $this->query_builder->add('t_assigment',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('assigment'));
	}
	function delete($id){

		$set = ['assigment_hapus' => 1];
		$where = ['assigment_id' => $id];
		$db = $this->query_builder->update('t_assigment',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}
		
		redirect(base_url('assigment'));

	}
	function edit($id){

		$data['tugas_assigment_active'] = 'class="active"';
		$data['open_tugas'] = 'menu-open';
		$data['block_tugas'] = 'style="display: block;"';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_assigment WHERE assigment_id = '$id'");

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['title'] = 'Ujian';
	  $this->load->view('v_template_admin/admin_header',$data);
	  $this->load->view('assigment/update');
	  $this->load->view('v_template_admin/admin_footer',$data);

	} 
	function update($id){

		$set = array(
						'assigment_judul' => $_POST['assigment_judul'],
						'assigment_jenis' => $_POST['assigment_jenis'],
						'assigment_isi' => $_POST['assigment_isi'],
						'assigment_pelajaran' => $_POST['assigment_pelajaran'],
						'assigment_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['assigment_kelas'])),				
					);

		$where = ['assigment_id' => $id];
		$db = $this->query_builder->update('t_assigment',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di ubah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di ubah');
		}

		redirect(base_url('assigment'));
	}
	function kerjakan($id, $jenis){

		$user_id = $this->session->userdata('id');

		$data['tugas_assigment_active'] = 'class="active"';
		$data['open_tugas'] = 'menu-open';
		$data['block_tugas'] = 'style="display: block;"';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_assigment WHERE assigment_id = '$id'");

		$data['title'] = 'Ujian';

		$cek_kelompok = $this->query_builder->view_row("SELECT * FROM t_kelompok WHERE kelompok_hapus = 0 AND FIND_IN_SET('$user_id', kelompok_siswa)");

		$kelompok_id = $cek_kelompok['kelompok_id'];

		$cek_hasil_kelompok = $this->query_builder->count("SELECT * FROM t_assigment_hasil WHERE assigment_hasil_hapus = 0 AND assigment_hasil_soal = '$id' AND assigment_hasil_siswa = $user_id AND FIND_IN_SET('$kelompok_id', assigment_hasil_kelompok)");
		$cek_hasil_individu = $this->query_builder->count("SELECT * FROM t_assigment_hasil WHERE assigment_hasil_hapus = 0 AND assigment_hasil_soal = '$id' AND assigment_hasil_siswa = $user_id");

		if ($jenis == 'kelompok') {
			//kelompok
			
			if (@$cek_kelompok) {

				if ($cek_hasil_kelompok == 0) {
					// belum
					$data['kelompok_data'] = $this->query_builder->view("SELECT * FROM t_kelompok WHERE kelompok_hapus = 0 AND FIND_IN_SET('$user_id', kelompok_siswa)");
				} else {
					// sudah
					$this->session->set_flashdata('gagal','Tugas kelompok sudah di kirim');
					redirect(base_url('assigment'));
				}

			  $this->load->view('v_template_admin/admin_header',$data);
			  $this->load->view('assigment/kerjakan');
			  $this->load->view('v_template_admin/admin_footer',$data);

			} else {
				$this->session->set_flashdata('gagal','Anda tidak punya kelompok, silahkan hubungi guru terkait');
				redirect(base_url('assigment'));
			}

		} else {
			//individu

			if ($cek_hasil_individu == 0) {
				// belum
				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('assigment/kerjakan');
				$this->load->view('v_template_admin/admin_footer',$data);
			} else {
				// sudah
				$this->session->set_flashdata('gagal','Tugas individu sudah di kirim');
				redirect(base_url('assigment'));
			}
		}
		
	}
	function kerjakan_send(){

		$id = $this->session->userdata('id');

		//type file
		$typefile = explode('/', $_FILES['file']['type']);

		//replace Karakter name foto
		$filename = $_FILES['file']['name'];

		//replace name foto
		$type = explode(".", $filename);
  		$no = count($type) - 1;
  		$new_name = md5(time()).'.'.$type[$no];
  		/////////////////////
	
		//config upload
	  $config = array(
	  'upload_path' 	=> './assets/img/assigment',
	  'allowed_types' 	=> "gif|jpg|png|jpeg|doc|docx|pdf|txt|xlsx|ppt|pptx",
	  'overwrite' 		=> TRUE,
	  'max_size' 		=> "10000",
	  'file_name'		=> $new_name,
	  );

    //Load upload library
    $this->load->library('upload',$config);

		if ($this->upload->do_upload('file')) {

			if (@$_POST['kelompok']) {
				// kelompok
				$set = array(
							'assigment_hasil_soal' => $_POST['idsoal'],
							'assigment_hasil_siswa' => $id,	
							'assigment_hasil_kelompok' => $_POST['kelompok'],	
							'assigment_hasil_jenis' => $_POST['jenis'],	
							'assigment_hasil_catatan' => $_POST['catatan'],	
							'assigment_hasil_file' => $new_name,
							'assigment_hasil_file_type' => $typefile[0],			
						);
			} else {
				// individu
				$set = array(
							'assigment_hasil_soal' => $_POST['idsoal'],
							'assigment_hasil_siswa' => $id,		
							'assigment_hasil_jenis' => $_POST['jenis'],
							'assigment_hasil_catatan' => $_POST['catatan'],	
							'assigment_hasil_file' => $new_name,
							'assigment_hasil_file_type' => $typefile[0],			
						);
			}


			$db = $this->query_builder->add('t_assigment_hasil',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Berhasil di kirim');
			}else{
				$this->session->set_flashdata('gagal','Gagal di kirim');
			}
		}else{
			$this->session->set_flashdata('gagal','Jenis file tidak di dukung');
		}

		redirect(base_url('assigment'));
	}
	function koreksi(){
		if ( $this->session->userdata('login') == 1) {

			$kelas = $this->session->userdata('kelas');
			$pelajaran = $this->session->userdata('pelajaran');

			switch ($this->session->userdata('level')) {
				case '1':
					// admin
					$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa WHERE a.assigment_hasil_hapus = 0");
					break;

				case '2':
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa WHERE a.assigment_hasil_hapus = 0 AND b.assigment_pelajaran = '$pelajaran'");
					break;

				case '3':
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa WHERE a.assigment_hasil_hapus = 0 AND concat(',',b.assigment_kelas,',') LIKE '%,$kelas,%'");
					break;			
			}

		  $data['tugas_koreksi_assigment_active'] = 'class="active"';
		  $data['open_koreksi_tugas'] = 'menu-open';
		  $data['block_koreksi_tugas'] = 'style="display: block;"';
		  
		  $data['title'] = 'Koreksi Assigment';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('assigment/koreksi');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_detail($id){
		if ( $this->session->userdata('login') == 1) {

			$data['data'] = $this->query_builder->view_row("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa LEFT JOIN t_kelompok AS d ON a.assigment_hasil_kelompok = d.kelompok_id WHERE a.assigment_hasil_hapus = 0 AND assigment_hasil_id = '$id'");

			if ($this->session->userdata('level') < 3) {
				// admin & guru
				if ($data['data']['assigment_hasil_nilai'] == '') {
					// belum
					$get = 1;
				}else{
					//sudah
					$get = 0;
				}
			}else{

				$get = 1;
			}

			if ($get == 1) {
				$data['tugas_koreksi_assigment_active'] = 'class="active"';
			  	$data['open_koreksi_tugas'] = 'menu-open';
			  	$data['block_koreksi_tugas'] = 'style="display: block;"';
				
			  	$data['title'] = 'Koreksi Assigment';

			  	$this->load->view('v_template_admin/admin_header',$data);
			  	$this->load->view('assigment/koreksi_detail');
			  	$this->load->view('v_template_admin/admin_footer');
			} else {
				$this->session->set_flashdata('gagal', 'Tugas sudah di koreksi');
				redirect(base_url('assigment/koreksi'));
			}

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_delete($id){
		
		$set = ['assigment_hasil_hapus' => 1];
		$where = ['assigment_hasil_id' => $id];
		$db = $this->query_builder->update('t_assigment_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('assigment/koreksi'));
	}
	function koreksi_send($id){

		$set = array(
						'assigment_hasil_nilai' => $_POST['nilai'],
						'assigment_hasil_nilai_catatan' => $_POST['catatan'],
					);

		$where = ['assigment_hasil_id' => $id];
		$db = $this->query_builder->update('t_assigment_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal','Gagal di simpan');
		}

		redirect(base_url('assigment/koreksi'));
	}
}