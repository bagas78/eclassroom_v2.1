<?php
class Pelajaran extends CI_Controller{

	function __construct(){ 
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Pelajaran';
		    $data['pelajaran'] = 'class="active"';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0 order by pelajaran_id DESC");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pelajaran/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function add(){ 
		$set = array(
						'pelajaran_nama' => $_POST['pelajaran_nama'],
						'pelajaran_tanggal' => date('Y-m-d'), 
					);

		$db = $this->query_builder->add('t_pelajaran',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Gagal di tambah');
		}

		redirect(base_url('pelajaran'));
	}
	function delete($id){

		$set = ['pelajaran_hapus' => 1];
		$where = ['pelajaran_id' => $id];

		$db = $this->query_builder->update('t_pelajaran',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}

		redirect(base_url('pelajaran'));
	}
	function update($id){

		$set = array(
						'pelajaran_nama' => $_POST['pelajaran_nama'], 
					);
		$where = ['pelajaran_id' => $id];
		$db = $this->query_builder->update('t_pelajaran',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Gagal di tambah');
		}

		redirect(base_url('pelajaran'));
	}
}