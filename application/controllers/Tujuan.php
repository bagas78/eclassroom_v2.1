<?php
class Tujuan extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['tujuan'] = 'menu-open';
			$data['tujuan_block'] = 'style="display: block;"';
			$data['tujuan_active'] = 'class="active"';
		    $data['title'] = 'Tujuan';

		    $level = $this->session->userdata('level');
		    $pelajaran = $this->session->userdata('pelajaran');
		    $kelas = $this->session->userdata('kelas');

		    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

		    switch ($level) { 
		    	
		    	case 2:
		    	//guru
		    		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_tujuan WHERE tujuan_pelajaran = '$pelajaran'");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('tujuan/index');
				    $this->load->view('v_template_admin/admin_footer');

		    		break;

		    	case 3:
		    	//siswa
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_tujuan as a JOIN t_pelajaran as b ON a.tujuan_pelajaran = b.pelajaran_id WHERE concat(',',a.tujuan_kelas,',') LIKE '%,$kelas,%' order by a.tujuan_id DESC");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('tujuan/table');
				    $this->load->view('v_template_admin/admin_footer');

		    		break;
		    }

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function save(){
		$pelajaran = $this->session->userdata('pelajaran');
		$user = $this->session->userdata('id');

		$set = array(
						'tujuan_pelajaran' => $pelajaran,
						'tujuan_user' => $user,
						'tujuan_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['tujuan_kelas'])),
						'tujuan_isi' => $_POST['tujuan_isi'], 
					);

		if ($this->query_builder->count("SELECT * FROM t_tujuan WHERE tujuan_pelajaran = '$pelajaran'")) {
			// edit
			$where = ['tujuan_pelajaran' => $pelajaran];
			$db = $this->query_builder->update('t_tujuan',$set,$where);
		} else {
			// insert
			$db = $this->query_builder->add('t_tujuan',$set);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('tujuan'));
	}
	function view($id){

		$data['tujuan'] = 'menu-open';
		$data['tujuan_block'] = 'style="display: block;"';
		$data['tujuan_active'] = 'class="active"';
		$data['title'] = 'Tujuan';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_tujuan WHERE tujuan_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('tujuan/view');
		$this->load->view('v_template_admin/admin_footer');
	}
}