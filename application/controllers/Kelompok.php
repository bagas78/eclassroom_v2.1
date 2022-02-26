<?php
class Kelompok extends CI_Controller{

	function __construct(){ 
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Kelompok';
		    $data['kelompok'] = 'class="active"';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_kelompok as a JOIN t_kelas as b ON a.kelompok_kelas = b.kelas_id WHERE a.kelompok_hapus = 0 order by a.kelompok_id DESC");

		    $data['kelas_data'] = $this->db->query("SELECT * FROM t_kelas WHERE kelas_hapus = 0")->result_array();

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('kelompok/index');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	} 
	function get_siswa(){
		$kelas = $_POST['kelas'];

		$db = $this->db->query("SELECT * FROM t_user WHERE user_kelas = '$kelas' AND user_hapus = 0")->result_array();
		echo json_encode($db);
	}
	function add(){ 

		$set = array(
						'kelompok_nama' => $_POST['kelompok_nama'],
						'kelompok_kelas' => $_POST['kelompok_kelas'],
						'kelompok_siswa' => implode(',', $_POST['kelompok_siswa']), 
					);

		$db = $this->query_builder->add('t_kelompok',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Gagal di tambah');
		}

		redirect(base_url('kelompok'));
	}
	function delete($id){

		$set = ['kelompok_hapus' => 1];
		$where = ['kelompok_id' => $id];
		$db = $this->query_builder->update('t_kelompok',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}

		redirect(base_url('kelompok'));
	}
	function update($id){

		$set = array(
						'kelompok_nama' => $_POST['kelompok_nama'],
						'kelompok_kelas' => $_POST['kelompok_kelas'],
						'kelompok_siswa' => implode(',', $_POST['kelompok_siswa']), 
					);

		$where = ['kelompok_id' => $id];
		$db = $this->query_builder->update('t_kelompok',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Gagal di tambah');
		}

		redirect(base_url('kelompok'));
	}
}