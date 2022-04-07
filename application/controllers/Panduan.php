<?php
class Panduan extends CI_Controller{

	function __construct(){ 
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Panduan Pengguna';
		    $data['panduan'] = 'class="active"';
		    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_panduan");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('panduan/index');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function save(){
		$video = $_POST['panduan_video'];

		print_r($_POST);

		// youtube
		$preg = substr($video, 0, strpos($video, "="));
    	$link = str_replace($preg.'=', '', $video); 

		$set = array(
						'panduan_video' => $link,
						'panduan_tanggal' => date('Y-m-d'),
					);

		$where = ['panduan_id' => 1];
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
	    	$pdf = 'panduan_pengguna.'.$type[$no];
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
	          	$where = ['panduan_id' => 1];
	          	$set = ['panduan_file' => $pdf];
				$this->query_builder->update('t_panduan',$set,$where);
	          }
	          
		} 

		redirect(base_url('panduan'));
	} 

	function delete_file($file){

		unlink('assets/panduan/'.$file); 
		$set = ['panduan_file' => ''];
		$where = ['panduan_id' => 1];
		$this->query_builder->update('t_panduan',$set,$where);

		$this->session->set_flashdata('success','Berhasil di hapus');

		redirect(base_url('panduan'));
	}
}