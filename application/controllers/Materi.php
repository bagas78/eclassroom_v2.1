<?php
class Materi extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['materi'] = 'class="active"';
		    $data['title'] = 'Materi';
		    $level = $this->session->userdata('level');
		    $pelajaran = $this->session->userdata('pelajaran');
		    $kelas = $this->session->userdata('kelas');

		    switch ($level) { 
		    	case 1:
		    	//admin
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_materi as a JOIN t_pelajaran as b ON a.materi_pelajaran = b.pelajaran_id WHERE materi_hapus = 0 order by a.materi_id DESC");
		    		break;
		    	
		    	case 2:
		    	//guru
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_materi as a JOIN t_pelajaran as b ON a.materi_pelajaran = b.pelajaran_id WHERE materi_hapus = 0 AND materi_pelajaran = '$pelajaran' order by a.materi_id DESC");
		    		break;

		    	case 3:
		    	//siswa
		    		$data['data'] = $this->query_builder->view("SELECT * FROM t_materi as a JOIN t_pelajaran as b ON a.materi_pelajaran = b.pelajaran_id WHERE materi_hapus = 0 AND concat(',',materi_kelas,',') LIKE '%,$kelas,%' order by a.materi_id DESC");
		    		break;
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('materi/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function insert(){
		$data['materi'] = 'class="active"';
	    $data['title'] = 'Materi';

	    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
	    $data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('materi/insert');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function add(){ 

		$set = array(
						'materi_user' => $this->session->userdata('id'),
						'materi_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['materi_kelas'])),
						'materi_judul' => $_POST['materi_judul'],
						'materi_isi' => $_POST['materi_isi'],
						'materi_tanggal' => date('Y-m-d'), 
						'materi_pelajaran' => $_POST['materi_pelajaran'],
					);

		$db = $this->query_builder->add('t_materi',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Gagal di tambah');
		}
		
		redirect(base_url('materi'));
	}
	function delete($id){

		$set = ['materi_hapus' => 1];
		$where = ['materi_id' => $id];
		$db = $this->query_builder->update('t_materi',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Gagal di hapus');
		}
		
		redirect(base_url('materi'));
	}
	function edit($id){
		$data['materi'] = 'class="active"';
	    $data['title'] = 'Materi';
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_materi WHERE materi_hapus = 0 AND materi_id = '$id'");
	    $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
	    $data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('materi/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){
		$set = array(
						'materi_judul' => $_POST['materi_judul'],
						'materi_isi' => $_POST['materi_isi'],
						'materi_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['materi_kelas'])),
						'materi_pelajaran' => $_POST['materi_pelajaran'],
					);

		$where = ['materi_id' => $id];
		$db = $this->query_builder->update('t_materi',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Gagal di simpan');
		}

		redirect(base_url('materi'));
	}
	function view($id){
		$data['materi'] = 'class="active"';
	    $data['title'] = 'Materi';
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_materi WHERE materi_hapus = 0 AND materi_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('materi/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
}