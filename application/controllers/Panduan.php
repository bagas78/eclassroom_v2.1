<?php
class Panduan extends CI_Controller{

	function __construct(){ 
		parent::__construct(); 
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {

			$level = $this->session->userdata('level');

			if ($level == 1) {
				$data['open'] = 1;
			}else{
				$data['open'] = 0;
			} 

		    $data['title'] = 'Panduan Pengguna';
		    $data['panduan'] = 'class="active"';
		    
		    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_panduan WHERE panduan_for = 'dosen'");
		    $data['for'] = 'dosen';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('panduan/index');
		    $this->load->view('v_template_admin/admin_footer');

		}  
		else{
			redirect(base_url('login'));
		}
	}
	function mahasiswa(){
		if ( $this->session->userdata('login') == 1) {

			$level = $this->session->userdata('level');

			if ($level == 1) {
				$data['open'] = 1;
			}else{
				$data['open'] = 0;
			}

		 	$data['title'] = 'Panduan Pengguna';
			$data['panduan_mahasiswa'] = 'class="active"';
			$data['data'] = $this->query_builder->view_row("SELECT * FROM t_panduan WHERE panduan_for = 'mahasiswa'");
			$data['for'] = 'mahasiswa';

			$this->load->view('v_template_admin/admin_header',$data);
			$this->load->view('panduan/index');
			$this->load->view('v_template_admin/admin_footer');
		}  
		else{
			redirect(base_url('login'));
		}
	}
	function save(){

		if ($_POST['for'] == 'dosen') {
			$name = 'panduan_dosen';
			$url = base_url('panduan');
		} else {
			$name = 'panduan_mahasiswa';
			$url = base_url('panduan/mahasiswa');
		}

		$video = $_POST['panduan_video'];
		$id = $_POST['id'];

		// youtube
		$preg = substr($video, 0, strpos($video, "="));
    	$link = str_replace($preg.'=', '', $video); 

		$set = array(
						'panduan_for' => $_POST['for'],
						'panduan_video' => $link,
						'panduan_tanggal' => date('Y-m-d'),
					);

		$where = ['panduan_id' => $id];
		$db = $this->query_builder->update('t_panduan',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Gagal di simpan');
		}

		if (@$_FILES['panduan_file']['name']) {

			//type file
			$typefile = explode('/', $_FILES['panduan_file']['type']);

			//replace Karakter name foto
			$filename = $_FILES['panduan_file']['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$pdf = $name.'.'.$type[$no];
	    	/////////////////////
			
			// exist file
			  $config = array(
			  'upload_path' 	=> './assets/panduan',
			  'allowed_types' 	=> "doc|docx|pdf",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "10000",
			  'file_name'		=> $pdf,
			  );

	          //Load upload library
	          $this->load->library('upload',$config);

	          if ($this->upload->do_upload('panduan_file')) {
	          	$where = ['panduan_id' => $id];
	          	$set = ['panduan_file' => $pdf];
				$this->query_builder->update('t_panduan',$set,$where);
	          }
	          
		} 

		redirect($url);
	} 

	function delete_file($id, $file){

		if ($_POST['for'] == 'dosen') {
			$url = base_url('panduan');
		} else {			
			$url = base_url('panduan/mahasiswa');
		}

		unlink('assets/panduan/'.$file); 
		$set = ['panduan_file' => ''];
		$where = ['panduan_id' => $id];
		$this->query_builder->update('t_panduan',$set,$where);

		$this->session->set_flashdata('success','Berhasil di hapus');

		redirect($url);
	}
}