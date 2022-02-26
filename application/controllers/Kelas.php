<?php
class Kelas extends CI_Controller{

	function __construct(){ 
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Kelas';
		    $data['kelas'] = 'class="active"';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0 order by kelas_id DESC");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('kelas/index');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	} 
	function add(){ 
		$set = array(
						'kelas_nama' => $_POST['kelas_nama'],
						'kelas_kepanjangan' => $_POST['kelas_kepanjangan'],
						'kelas_tanggal' => date('Y-m-d'), 
					);

		$db = $this->query_builder->add('t_kelas',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Gagal di tambah');
		}

		redirect(base_url('kelas'));
	}
	function delete($id){

		$set = ['kelas_hapus' => 1];
		$where = ['kelas_id' => $id];
		$db = $this->query_builder->update('t_kelas',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}

		redirect(base_url('kelas'));
	}
	function update($id){

		$set = array(
						'kelas_nama' => $_POST['kelas_nama'], 
						'kelas_kepanjangan' => $_POST['kelas_kepanjangan'],
					);
		$where = ['kelas_id' => $id];
		$db = $this->query_builder->update('t_kelas',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Gagal di tambah');
		}

		redirect(base_url('kelas'));
	}
}