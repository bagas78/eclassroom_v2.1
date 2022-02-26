<?php
class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Admin';
		    $data['admin_active'] = 'class="active"';
		    $data['open'] = 'menu-open';
		    $data['block'] = 'style="display: block;"';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_level = 1 AND user_hapus = 0");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('admin/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function add(){ 
		$email = $_POST['email'];
		$cek = $this->query_builder->count("SELECT * FROM t_user WHERE user_email = '$email'");

		if (@$cek) {
			$this->session->set_flashdata('gagal','Email sudah di gunakan !!');
			redirect(base_url('admin'));
		}else{
			
			$set = array(
							'user_name' => $_POST['name'], 
							'user_email' => $email, 
							'user_password' => md5($x),
							'user_level'	=> 1, 
						);
			$db = $this->query_builder->add('t_user',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di tambah');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di tambah');
			}
			
			redirect(base_url('admin'));
		}
	}
	function delete($id){

		$user = $this->session->userdata('id');

		if ($id == $user) {
			$this->session->set_flashdata('gagal','Tidak bisa menghapus akun sendiri');
		} else {

			$set = ['user_hapus' => 1];
			$where = ['user_id' => $id];
			$db = $this->query_builder->update('t_user',$set,$where);
			
			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di hapus');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di hapus');
			}
		}
		
		redirect(base_url('admin'));
	}
	function update($id){
		$email = $_POST['email'];
		$set = array(
						'user_name' => $_POST['name'], 
						'user_email' => $email, 
						'user_password' => md5($x),
					);
		$where = ['user_id' => $id];
		$db = $this->query_builder->update('t_user',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('admin'));
	}
}