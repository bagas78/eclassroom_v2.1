<?php
class Assigment extends CI_Controller{

	function __construct(){  
		parent::__construct(); 
	}   
	function index(){  
		if ( $this->session->userdata('login') == 1) {

		  $data['open_menu_latihan'] = 'menu-open';
		  $data['block_menu_latihan'] = 'style="display: block;"';
		
		  $data['assigment_active'] = 'class="active"';
		  $data['open_latihan'] = 'menu-open';
		  $data['block_latihan'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');
			$date = date('Y-m-d');
 
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
					$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment as a JOIN t_pelajaran as b ON a.assigment_pelajaran = b.pelajaran_id WHERE a.assigment_hapus = 0 AND concat(',',assigment_kelas,',') LIKE '%,$kelas,%' AND a.assigment_tampil >= $date");
					break;
			}

	    $data['title'] = 'assigment';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('assigment/index');
	    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	}
	function add(){

		$data['open_menu_latihan'] = 'menu-open';
		$data['block_menu_latihan'] = 'style="display: block;"';

		$data['assigment_active'] = 'class="active"';
		$data['open_latihan'] = 'menu-open';
		$data['block_latihan'] = 'style="display: block;"';

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['title'] = 'Ujian';
	  $this->load->view('v_template_admin/admin_header',$data);
	  $this->load->view('assigment/insert');
	  $this->load->view('v_template_admin/admin_footer',$data);

	} 
	function insert(){

		$id = $this->session->userdata('id');

		if (@$_FILES['file']['name']) {

			//type file
			$typefile = explode('/', $_FILES['file']['type']);

			//replace Karakter name foto
			$filename = $_FILES['file']['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$new_name = md5(time()).'.'.$type[$no];
	    	/////////////////////
			
			// exist file
			  $config = array(
			  'upload_path' 	=> './assets/assigment',
			  'allowed_types' 	=> "doc|docx|pdf|txt|xlsx",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "10000",
			  'file_name'		=> $new_name,
			  );

	          //Load upload library
	          $this->load->library('upload',$config);

			if ($this->upload->do_upload('file')) {

				//tanpa file
				$set = array(
								'assigment_guru' => $id,
								'assigment_judul' => $_POST['assigment_judul'],
								'assigment_jenis' => $_POST['assigment_jenis'],
								'assigment_isi' => $_POST['assigment_isi'],
								'assigment_pelajaran' => $_POST['assigment_pelajaran'],
								'assigment_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['assigment_kelas'])),	
								'assigment_tampil' => $_POST['assigment_tampil'],	
								'assigment_unggah' => $_POST['assigment_unggah'],
								'assigment_jam' => $_POST['assigment_jam'],	
								'assigment_file' => $new_name,	
							);

				$db = $this->query_builder->add('t_assigment',$set);

				if ($db == 1) {
					$this->session->set_flashdata('success','Data berhasil di tambah');
				}else{
					$this->session->set_flashdata('gagal','Data gagal di tambah');
				}
			
			}else{
				$this->session->set_flashdata('gagal','Periksa kembali file');
			}

		} else {

			//tanpa file
			$set = array(
							'assigment_guru' => $id,
							'assigment_judul' => $_POST['assigment_judul'],
							'assigment_jenis' => $_POST['assigment_jenis'],
							'assigment_isi' => $_POST['assigment_isi'],
							'assigment_pelajaran' => $_POST['assigment_pelajaran'],
							'assigment_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['assigment_kelas'])),	
							'assigment_tampil' => $_POST['assigment_tampil'],	
							'assigment_unggah' => $_POST['assigment_unggah'],
							'assigment_jam' => $_POST['assigment_jam'],		
						);

			$db = $this->query_builder->add('t_assigment',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di tambah');
			}else{
				$this->session->set_flashdata('gagal','Data gagal di tambah');
			}
			
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

		$data['open_menu_latihan'] = 'menu-open';
		$data['block_menu_latihan'] = 'style="display: block;"';

		$data['assigment_active'] = 'class="active"';
		$data['open_latihan'] = 'menu-open';
		$data['block_latihan'] = 'style="display: block;"';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_assigment WHERE assigment_id = '$id'");

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$data['title'] = 'Ujian';
	  $this->load->view('v_template_admin/admin_header',$data);
	  $this->load->view('assigment/update');
	  $this->load->view('v_template_admin/admin_footer',$data);

	} 
	function update($id){

		if (@$_FILES['file']['name']) {

			//type file
			$typefile = explode('/', $_FILES['file']['type']);

			//replace Karakter name foto
			$filename = $_FILES['file']['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$new_name = md5(time()).'.'.$type[$no];
	    	/////////////////////
			
			// exist file
			  $config = array(
			  'upload_path' 	=> './assets/assigment',
			  'allowed_types' 	=> "doc|docx|pdf|txt|xlsx",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "10000",
			  'file_name'		=> $new_name,
			  );

	          //Load upload library
	          $this->load->library('upload',$config);

			if ($this->upload->do_upload('file')) {

				//tanpa file
				$set = array(
								'assigment_judul' => $_POST['assigment_judul'],
								'assigment_jenis' => $_POST['assigment_jenis'],
								'assigment_isi' => $_POST['assigment_isi'],
								'assigment_pelajaran' => $_POST['assigment_pelajaran'],
								'assigment_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['assigment_kelas'])),
								'assigment_tampil' => $_POST['assigment_tampil'],	
								'assigment_unggah' => $_POST['assigment_unggah'],
								'assigment_jam' => $_POST['assigment_jam'],	
								'assigment_file' => $new_name,			
							);

				$where = ['assigment_id' => $id];
				$db = $this->query_builder->update('t_assigment',$set,$where);

				if ($db == 1) {
					$this->session->set_flashdata('success','Data berhasil di ubah');
				}else{
					$this->session->set_flashdata('gagal','Data gagal di ubah');
				}
			
			}else{
				$this->session->set_flashdata('gagal','Periksa kembali file');
			}

		} else {

			//tanpa file
			$set = array(
							'assigment_judul' => $_POST['assigment_judul'],
							'assigment_jenis' => $_POST['assigment_jenis'],
							'assigment_isi' => $_POST['assigment_isi'],
							'assigment_pelajaran' => $_POST['assigment_pelajaran'],
							'assigment_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['assigment_kelas'])),
							'assigment_tampil' => $_POST['assigment_tampil'],	
							'assigment_unggah' => $_POST['assigment_unggah'],
							'assigment_jam' => $_POST['assigment_jam'],				
						);

			$where = ['assigment_id' => $id];
			$db = $this->query_builder->update('t_assigment',$set,$where);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di ubah');
			}else{
				$this->session->set_flashdata('gagal','Data gagal di ubah');
			}
			
			
		}

		redirect(base_url('assigment'));
	}
	function kerjakan($id, $jenis){

		$user_id = $this->session->userdata('id');

		$data['assigment_assigment_active'] = 'class="active"';
		$data['open_assigment'] = 'menu-open';
		$data['block_assigment'] = 'style="display: block;"';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_assigment WHERE assigment_id = '$id'");

		$data['title'] = 'Ujian';

		$cek_kelompok = $this->query_builder->view_row("SELECT * FROM t_kelompok WHERE kelompok_hapus = 0 AND FIND_IN_SET('$user_id', kelompok_siswa)");

		$kelompok_id = $cek_kelompok['kelompok_id'];

		$cek_hasil_kelompok = $this->query_builder->count("SELECT * FROM t_assigment_hasil WHERE assigment_hasil_hapus = 0 AND assigment_hasil_soal = '$id' AND FIND_IN_SET('$kelompok_id', assigment_hasil_kelompok)");
		$cek_hasil_individu = $this->query_builder->count("SELECT * FROM t_assigment_hasil WHERE assigment_hasil_hapus = 0 AND assigment_hasil_soal = '$id' AND assigment_hasil_siswa = $user_id");

		if ($jenis == 'kelompok') {
			//kelompok
			
			if (@$cek_kelompok) {

				if ($cek_hasil_kelompok == 0) {
					// belum
					$data['kelompok_data'] = $this->query_builder->view("SELECT * FROM t_kelompok WHERE kelompok_hapus = 0 AND FIND_IN_SET('$user_id', kelompok_siswa)");
				} else {
					// sudah
					$this->session->set_flashdata('gagal','assigment kelompok sudah di kirim');
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
				$this->session->set_flashdata('gagal','assigment individu sudah di kirim');
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

			//filter
			$filter_materi = @$_POST['materi'];
			$filter_kelas = @$_POST['kelas'];


			if (@$filter_kelas) {
				//dengan filter
				switch ($this->session->userdata('level')) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa LEFT JOIN t_kelompok as d ON a.assigment_hasil_kelompok = d.kelompok_id JOIN t_kelas as e ON c.user_kelas = e.kelas_id WHERE a.assigment_hasil_hapus = 0 AND b.assigment_id = $filter_materi AND c.user_kelas = '$filter_kelas'");
						break;

					case '2':
						// guru
						$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa LEFT JOIN t_kelompok as d ON a.assigment_hasil_kelompok = d.kelompok_id JOIN t_kelas as e ON c.user_kelas = e.kelas_id WHERE a.assigment_hasil_hapus = 0 AND b.assigment_pelajaran = '$pelajaran' AND b.assigment_id = $filter_materi AND c.user_kelas = '$filter_kelas'");
						break;			
				}

			} else {

				//tanpa filter
				switch ($this->session->userdata('level')) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa LEFT JOIN t_kelompok as d ON a.assigment_hasil_kelompok = d.kelompok_id JOIN t_kelas as e ON c.user_kelas = e.kelas_id WHERE a.assigment_hasil_hapus = 0");
						break;

					case '2':
						// guru
						$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa LEFT JOIN t_kelompok as d ON a.assigment_hasil_kelompok = d.kelompok_id JOIN t_kelas as e ON c.user_kelas = e.kelas_id WHERE a.assigment_hasil_hapus = 0 AND b.assigment_pelajaran = '$pelajaran'");
						break;

					case '3':
						// siswa
						$data['data'] = $this->query_builder->view("SELECT * FROM t_assigment_hasil as a join t_assigment as b ON a.assigment_hasil_soal = b.assigment_id join t_user as c ON c.user_id = a.assigment_hasil_siswa LEFT JOIN t_kelompok as d ON a.assigment_hasil_kelompok = d.kelompok_id JOIN t_kelas as e ON c.user_kelas = e.kelas_id WHERE a.assigment_hasil_hapus = 0 AND concat(',',b.assigment_kelas,',') LIKE '%,$kelas,%'");
						break;			
				}
				
			}

		  //materi
		  switch ($this->session->userdata('level')) {
		  	case '1':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_assigment WHERE assigment_hapus = 0");
		  		break;
		  	case '2':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_assigment WHERE assigment_hapus = 0 AND assigment_pelajaran = '$pelajaran'");
		  		break;
		  	
		  }

		  $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

		  $data['open_menu_latihan'] = 'menu-open';
		  $data['block_menu_latihan'] = 'style="display: block;"';

		  $data['open_koreksi'] = 'menu-open';
		  $data['block_koreksi'] = 'style="display: block;"';
		  $data['koreksi_assigment_active'] = 'class="active"';
		  
		  $data['title'] = 'Koreksi assigment';

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
				$data['open_menu_latihan'] = 'menu-open';
			    $data['block_menu_latihan'] = 'style="display: block;"';

			    $data['open_koreksi'] = 'menu-open';
			    $data['block_koreksi'] = 'style="display: block;"';
			    $data['koreksi_assigment_active'] = 'class="active"';
					
			  	$data['title'] = 'Koreksi assigment';

			  	$this->load->view('v_template_admin/admin_header',$data);
			  	$this->load->view('assigment/koreksi_detail');
			  	$this->load->view('v_template_admin/admin_footer');
			} else {
				$this->session->set_flashdata('gagal', 'assigment sudah di koreksi');
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
	function unlink(){

		$id = $_POST['id'];
		$file = $_POST['file'];

		if (unlink('assets/assigment/'.$file)) { 
			$set = ['assigment_file' => ''];
			$where = ['assigment_id' => $id];
			$db = $this->query_builder->update('t_assigment',$set,$where);

			//berhasil
		    $response = 1;
		} 
		else{ 
		    //gagal 
		    $response = 0;
		}

		echo json_encode($response);
	}
}