<?php
class Peta extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['tujuan'] = 'menu-open';
			$data['tujuan_block'] = 'style="display: block;"';
			$data['peta_active'] = 'class="active"';
		    $data['title'] = 'Peta';

		    $level = $this->session->userdata('level');
		    $pelajaran = $this->session->userdata('pelajaran');
		    $kelas = $this->session->userdata('kelas');

		    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

		    switch ($level) { 
		    	
		    	case 2:
		    	//guru
		    		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_peta WHERE peta_pelajaran = '$pelajaran'");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('peta/index');
				    $this->load->view('v_template_admin/admin_footer');

		    		break;

		    	case 3:
		    	//siswa
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_peta as a JOIN t_pelajaran as b ON a.peta_pelajaran = b.pelajaran_id WHERE concat(',',a.peta_kelas,',') LIKE '%,$kelas,%' order by a.peta_id DESC");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('peta/table');
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
						'peta_pelajaran' => $pelajaran,
						'peta_user' => $user,
						'peta_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['peta_kelas'])),
						'peta_isi' => $_POST['peta_isi'], 
					);

		if ($this->query_builder->count("SELECT * FROM t_peta WHERE peta_pelajaran = '$pelajaran'")) {
			// edit
			$where = ['peta_pelajaran' => $pelajaran];
			$db = $this->query_builder->update('t_peta',$set,$where);
		} else {
			// insert
			$db = $this->query_builder->add('t_peta',$set);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('peta'));
	}
	function view($id){

		$data['tujuan'] = 'menu-open';
		$data['tujuan_block'] = 'style="display: block;"';
		$data['peta_active'] = 'class="active"';
		$data['title'] = 'peta';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_peta WHERE peta_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('peta/view');
		$this->load->view('v_template_admin/admin_footer');
	}
}