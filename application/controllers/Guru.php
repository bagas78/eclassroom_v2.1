<?php
class Guru extends CI_Controller{

	function __construct(){  
		parent::__construct();
	} 
	function index(){ 
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Guru';
		    $data['guru_active'] = 'class="active"';
		    $data['open'] = 'menu-open';
		    $data['block'] = 'style="display: block;"';
		    
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_user as a JOIN t_pelajaran as b ON a.user_pelajaran = b.pelajaran_id WHERE user_level = 2 AND user_hapus = 0");
		    
		    $data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('guru/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function add(){ 
		$email = $_POST['email'];
		$cek = $this->query_builder->count("SELECT * FROM t_user WHERE user_email = '$email'");

		if ($cek > 0) {
			$this->session->set_flashdata('gagal','NIP sudah di gunakan !!');
			redirect(base_url('guru'));
		}else{
						
			$set = array(
							'user_name' => $_POST['name'], 
							'user_email' => $email, 
							'user_password' => md5($email),
							'user_tanggal'	=> date('Y-m-d'),
							'user_level'	=> 2,
							'user_kelas'	=> str_replace(['"','[',']'], '', json_encode($_POST['kelas'])),
							'user_pelajaran' => $_POST['pelajaran'], 
						);
			$db = $this->query_builder->add('t_user',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di tambah');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di tambah');
			}
			
			redirect(base_url('guru'));
		}
	}
	function delete($id){

		$set = ['user_hapus' => 1];
		$where = ['user_id' => $id];
		$db = $this->query_builder->update('t_user',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('guru'));
	}
	function update($id){
		$email = $_POST['email'];
		$set = array(
						'user_name' => $_POST['name'], 
						'user_email' => $email, 
						'user_password' => md5($email),
						'user_kelas'	=> str_replace(['"','[',']'], '', json_encode($_POST['kelas'])),
						'user_pelajaran' => $_POST['pelajaran'], 
					);
		$where = ['user_id' => $id];
		$db = $this->query_builder->update('t_user',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('guru'));
	}
}