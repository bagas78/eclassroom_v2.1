<?php
class Modul extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['modul'] = 'class="active"';
		    $data['title'] = 'Modul';
		    $level = $this->session->userdata('level');
		    $pelajaran = $this->session->userdata('pelajaran');
		    $kelas = $this->session->userdata('kelas');

		    switch ($level) { 
		    	case 1: 
		    	//admin
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_modul as a JOIN t_pelajaran as b ON a.modul_pelajaran = b.pelajaran_id WHERE modul_hapus = 0 order by a.modul_id DESC");
		    		break;
		    	
		    	case 2:
		    	//guru
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_modul as a JOIN t_pelajaran as b ON a.modul_pelajaran = b.pelajaran_id WHERE modul_hapus = 0 AND modul_pelajaran = '$pelajaran' order by a.modul_id DESC");
		    		break;

		    	case 3:
		    	//siswa
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_modul as a JOIN t_pelajaran as b ON a.modul_pelajaran = b.pelajaran_id WHERE modul_hapus = 0 AND concat(',',modul_kelas,',') LIKE '%,$kelas,%' order by a.modul_id DESC");
		    		break;
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('modul/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function insert(){
		$data['modul'] = 'class="active"';
	    $data['title'] = 'modul';

	    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
	    $data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('modul/insert');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function add(){ 

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
			  'upload_path' 	=> './assets/modul',
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
								'modul_user' => $this->session->userdata('id'),
								'modul_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['modul_kelas'])),
								'modul_judul' => $_POST['modul_judul'],
								'modul_isi' => $_POST['modul_isi'],
								'modul_tanggal' => date('Y-m-d'), 
								'modul_pelajaran' => $_POST['modul_pelajaran'],
								'modul_file' => $new_name,
							);

				$db = $this->query_builder->add('t_modul',$set);

				if ($db == 1) {
					$this->session->set_flashdata('success','Berhasil di tambah');
				} else {
					$this->session->set_flashdata('gagal','Gagal di tambah');
				}
			
			}else{
				$this->session->set_flashdata('gagal','Periksa kembali file');
			}

		} else {

			//tanpa file
			$set = array(
							'modul_user' => $this->session->userdata('id'),
							'modul_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['modul_kelas'])),
							'modul_judul' => $_POST['modul_judul'],
							'modul_isi' => $_POST['modul_isi'],
							'modul_tanggal' => date('Y-m-d'), 
							'modul_pelajaran' => $_POST['modul_pelajaran'],
						);

			$db = $this->query_builder->add('t_modul',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Berhasil di tambah');
			} else {
				$this->session->set_flashdata('gagal','Gagal di tambah');
			}
			
		}
		
		redirect(base_url('modul'));
	}
	function delete($id){

		$set = ['modul_hapus' => 1];
		$where = ['modul_id' => $id];
		$db = $this->query_builder->update('t_modul',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}
		
		redirect(base_url('modul'));
	}
	function edit($id){
		$data['modul'] = 'class="active"';
	    $data['title'] = 'modul';
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_modul WHERE modul_hapus = 0 AND modul_id = '$id'");
	    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
	    $data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('modul/edit');
	    $this->load->view('v_template_admin/admin_footer');
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
			  'upload_path' 	=> './assets/modul',
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
								'modul_judul' => $_POST['modul_judul'],
								'modul_isi' => $_POST['modul_isi'],
								'modul_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['modul_kelas'])),
								'modul_pelajaran' => $_POST['modul_pelajaran'],
								'modul_file' => $new_name,
							);

				$where = ['modul_id' => $id];
				$db = $this->query_builder->update('t_modul',$set,$where);

				if ($db == 1) {
					$this->session->set_flashdata('success','Berhasil di simpan');
				} else {
					$this->session->set_flashdata('gagal','Gagal di simpan');
				}
			
			}else{
				$this->session->set_flashdata('gagal','Periksa kembali file');
			}

		} else {

			//tanpa file
			$set = array(
							'modul_judul' => $_POST['modul_judul'],
							'modul_isi' => $_POST['modul_isi'],
							'modul_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['modul_kelas'])),
							'modul_pelajaran' => $_POST['modul_pelajaran'],
						);

			$where = ['modul_id' => $id];
			$db = $this->query_builder->update('t_modul',$set,$where);

			if ($db == 1) {
				$this->session->set_flashdata('success','Berhasil di simpan');
			} else {
				$this->session->set_flashdata('gagal','Gagal di simpan');
			}	
			
		}

		redirect(base_url('modul'));
	}
	function view($id){
		$data['modul'] = 'class="active"';
	    $data['title'] = 'modul';
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_modul WHERE modul_hapus = 0 AND modul_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('modul/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function unlink(){

		$id = $_POST['id'];
		$file = $_POST['file'];

		if (unlink('assets/modul/'.$file)) { 
			$set = ['modul_file' => ''];
			$where = ['modul_id' => $id];
			$db = $this->query_builder->update('t_modul',$set,$where);

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