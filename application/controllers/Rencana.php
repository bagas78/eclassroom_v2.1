<?php
class Rencana extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['tujuan'] = 'menu-open';
			$data['tujuan_block'] = 'style="display: block;"';
			$data['rencana_active'] = 'class="active"';
		    $data['title'] = 'rencana';

		    $level = $this->session->userdata('level');
		    $pelajaran = $this->session->userdata('pelajaran');
		    $kelas = $this->session->userdata('kelas');

		    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

		    switch ($level) { 
		    	
		    	case 2:
		    	//guru
		    		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_rencana WHERE rencana_pelajaran = '$pelajaran'");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('rencana/index');
				    $this->load->view('v_template_admin/admin_footer');

		    		break;

		    	case 3:
		    	//siswa
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_rencana as a JOIN t_pelajaran as b ON a.rencana_pelajaran = b.pelajaran_id WHERE concat(',',a.rencana_kelas,',') LIKE '%,$kelas,%' order by a.rencana_id DESC");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('rencana/table');
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
						'rencana_pelajaran' => $pelajaran,
						'rencana_user' => $user,
						'rencana_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['rencana_kelas'])),
						'rencana_isi' => $_POST['rencana_isi'], 
					);

		if ($this->query_builder->count("SELECT * FROM t_rencana WHERE rencana_pelajaran = '$pelajaran'")) {
			// edit
			$where = ['rencana_pelajaran' => $pelajaran];
			$db = $this->query_builder->update('t_rencana',$set,$where);
		} else {
			// insert
			$db = $this->query_builder->add('t_rencana',$set);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('rencana'));
	}
	function view($id){

		$data['tujuan'] = 'menu-open';
		$data['tujuan_block'] = 'style="display: block;"';
		$data['rencana_active'] = 'class="active"';
		$data['title'] = 'rencana';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_rencana WHERE rencana_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('rencana/view');
		$this->load->view('v_template_admin/admin_footer');
	}
}