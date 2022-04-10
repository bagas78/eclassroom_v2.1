<?php
class Semester extends CI_Controller{
 
	function __construct(){ 
		parent::__construct();
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) {
			$data['semester'] = 'class="active"';
		    $data['title'] = 'collassion';

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_semester");

		    // $count = $this->query_builder->count("SELECT * FROM t_semester");

		    // $data['current_semester'] = $count + 1;

		    $this->load->view('v_template_admin/admin_header',$data);
			$this->load->view('semester/index');
			$this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function insert(){
		$sem = $_POST['semester_no'];

		$cek = $this->query_builder->count("SELECT * FROM t_semester WHERE semester_no = '$sem'");

		$jum = $_POST['semester_pertemuan'];

		if ($cek > 0) {
			// ada
			$this->session->set_flashdata('gagal','Semester sudah ada');
		} else {
			// kosong
			$set1 = array(
							'semester_no' => $sem,
							'semester_pertemuan' => $jum,
						);

			$db = $this->query_builder->add('t_semester',$set1);

			if ($db == 1) {

				for ($i=1; $i < $jum + 1; $i++) { 
					// save pertemuan
					$set2 = array(	
									'pertemuan_no' => $i,
									'pertemuan_semester' => $sem, 
								);
					$db = $this->query_builder->add('t_pertemuan',$set2);
				}

				$this->session->set_flashdata('success', 'Data berhasil di hapus');
			} else {
				$this->session->set_flashdata('gagal', 'Data gagal di hapus');
			}
		}
		
		
		redirect(base_url('semester'));
	}
	function update(){

		$sem = $_POST['semester_no'];
		$jum = $_POST['semester_pertemuan'];

		$set1 = array(
						'semester_no' => $sem,
						'semester_pertemuan' => $jum,
					);

		$where = ['semester_no' => $sem];
		$db = $this->query_builder->update('t_semester',$set1,$where);

		if ($db == 1) {
			//delete
			$where = ['pertemuan_semester' => $sem];
			$db = $this->query_builder->delete('t_pertemuan',$where);

			//new insert
			for ($i=1; $i < $jum + 1; $i++) { 
				// save pertemuan
				$set2 = array(	
								'pertemuan_no' => $i,
								'pertemuan_semester' => $sem, 
							);
				$db = $this->query_builder->add('t_pertemuan',$set2);
			}

			$this->session->set_flashdata('success', 'Data berhasil di edit');
		} else {
			$this->session->set_flashdata('gagal', 'Data gagal di edit');
		}
		
		redirect(base_url('semester'));
	}
	function delete($id){
		$where = ['semester_no' => $id];
		$db = $this->query_builder->delete('t_semester',$where);

		if ($db == 1) {
			$where = ['pertemuan_semester' => $id];
			$db = $this->query_builder->delete('t_pertemuan',$where);

			$this->session->set_flashdata('success', 'Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal', 'Data gagal di hapus');
		}
		
		redirect(base_url('semester'));
	}
}