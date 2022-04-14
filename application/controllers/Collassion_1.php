<?php
class Collassion extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['collassion'] = 'class="active"';
		    $data['title'] = 'collassion';

		    $level = $this->session->userdata('level');
		    $pelajaran = $this->session->userdata('pelajaran');
		    $kelas = $this->session->userdata('kelas');

		    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

		    switch ($level) { 
		    	
		    	case 2:
		    	//guru
		    		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_collassion WHERE collassion_pelajaran = '$pelajaran'");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('collassion/index');
				    $this->load->view('v_template_admin/admin_footer');

		    		break;

		    	case 3:
		    	//siswa
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_collassion as a JOIN t_pelajaran as b ON a.collassion_pelajaran = b.pelajaran_id WHERE concat(',',a.collassion_kelas,',') LIKE '%,$kelas,%' order by a.collassion_id DESC");

		    		$this->load->view('v_template_admin/admin_header',$data);
				    $this->load->view('collassion/table');
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
						'collassion_pelajaran' => $pelajaran,
						'collassion_user' => $user,
						'collassion_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['collassion_kelas'])),
						'collassion_isi' => $_POST['collassion_isi'], 
					);

		if ($this->query_builder->count("SELECT * FROM t_collassion WHERE collassion_pelajaran = '$pelajaran'")) {
			// edit
			$where = ['collassion_pelajaran' => $pelajaran];
			$db = $this->query_builder->update('t_collassion',$set,$where);
		} else {
			// insert
			$db = $this->query_builder->add('t_collassion',$set);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('collassion'));
	}
	function view($id){

		$data['collassion_active'] = 'class="active"';
		$data['title'] = 'collassion';

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_collassion WHERE collassion_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('collassion/view');
		$this->load->view('v_template_admin/admin_footer');
	}
}