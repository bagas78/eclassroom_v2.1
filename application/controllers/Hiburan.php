<?php
class Hiburan extends CI_Controller{

	function __construct(){
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Hiburan';
		    $data['hiburan'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('hiburan/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
}