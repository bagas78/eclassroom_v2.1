<?php
class Video extends CI_Controller{
 
	function __construct(){ 
		parent::__construct();
	} 
	function index($page = 0){ 
		if ( $this->session->userdata('login') == 1) {

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');

			switch ($level) {
				case '1':
					// admin 
					$data['data'] = $this->query_builder->view("SELECT * FROM t_album as a JOIN t_pelajaran as b ON a.album_pelajaran = b.pelajaran_id WHERE a.album_jenis = 'video' AND a.album_hapus = 0 order by a.album_id desc");
					break; 
				
				case '2':
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_album as a JOIN t_pelajaran as b ON a.album_pelajaran = b.pelajaran_id WHERE a.album_jenis = 'video' AND a.album_hapus = 0 AND b.pelajaran_id = '$pelajaran' order by a.album_id desc");
					break;

				case '3':
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_album as a JOIN t_pelajaran as b ON a.album_pelajaran = b.pelajaran_id WHERE a.album_jenis = 'video' AND a.album_hapus = 0 AND concat(',',album_kelas,',') LIKE '%,$kelas,%' order by a.album_id desc");
					break;
			} 

			$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
			$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
			
			$data['video'] = 'class="active"';
			$this->load->view('v_template_admin/admin_header',$data);
			$this->load->view('video/index');
			$this->load->view('v_template_admin/admin_footer');
		}else{
			redirect(base_url('login'));
		}
	}
	function album(){ 

		$data = $this->input->post();

		//save database
		$set = array(
		 				'album_name' => $data['album_name'],
		 				'album_tanggal' => date('Y-m-d'),
		 				'album_jenis' => 'video',
		 				'album_pelajaran' => $data['album_pelajaran'],
		 				'album_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['album_kelas'])),
		 				);

		$db = $this->query_builder->add('t_album',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Data Gagal di simpan');
		}

		redirect(base_url('video'));

	}
	function album_edit($id){

		$data = $this->input->post();

		//save database
		$set = array(
		 				'album_name' => $data['album_name'],
		 				'album_tanggal' => date('Y-m-d'),
		 				'album_jenis' => 'video',
		 				'album_pelajaran' => $data['album_pelajaran'],
		 				'album_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['album_kelas'])),
		 				);

		$where = ['album_id' => $id];
		$db = $this->query_builder->update('t_album',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('video'));
	}
	function album_delete($id){

		//hapus album
		$set = ['album_hapus' => 1];
		$where = ['album_id' => $id];
		$db = $this->query_builder->update('t_album',$set,$where);

		//hapus semua galery
		$set = ['video_hapus' => 1];
		$where = ['video_album' => $id];
		$this->query_builder->update('t_video',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Playlist berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Playlist gagal di hapus');
		}

		redirect(base_url('video'));
	}
	function upload($id = '',$name = ''){

		$data = $this->input->post();

        //hilangkan link
        $preg = substr($data['video_link'], 0, strpos($data['video_link'], "="));
        $replace_link = str_replace($preg.'=', '', $data['video_link']); 

        $set = array(
	 				'video_judul' => $data['video_name'],
	 				'video_album' => $id,
	 				'video_link' => $replace_link,
	 				'video_tanggal' => date('Y-m-d'),

	 				);

		$db = $this->query_builder->add('t_video',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Video berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Video gagal di simpan');
		}
		
		redirect(base_url('video/index_video/').$id.'/'.$name);
	}
	function edit($id,$album,$name){

        //hilangkan link
        $preg = substr($_POST['video_link'], 0, strpos($_POST['video_link'], "="));
        $replace_link = str_replace($preg.'=', '', $_POST['video_link']);

        print_r($replace_link);

        $set = array(
	 				'video_judul' => $_POST['video_judul'],
	 				'video_link' => $replace_link,
	 				);

        $where = ['video_id' => $id];
		$db = $this->query_builder->update('t_video',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Video berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Video gagal di simpan');
		}

		redirect(base_url('video/index_video/').$album.'/'.$name);
	}
	function delete($id,$album,$name){
		$set = ['video_hapus' => 1];
		$where = ['video_id' => $id];
		$db = $this->query_builder->update('t_video',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Video berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Video gagal di hapus');
		}

		redirect(base_url('video/index_video/').$album.'/'.$name);
	}	
	function index_video($id,$name,$page = 0){
		$limit = 12;
		$mulai = $limit * $page;

		//pagignation
		if ($page == 0) {
			$data['data'] = $this->query_builder->view("SELECT * FROM t_video WHERE video_album = '$id' AND video_hapus = 0 order by video_id desc limit $limit"); 
		}
		else{
			$data['data'] = $this->query_builder->view("SELECT * FROM t_video WHERE video_album = '$id' AND video_hapus = 0 order by video_id desc limit $mulai,$limit");
		}

		$x = $this->query_builder->count("SELECT * FROM t_video WHERE video_album = '$id'");
		$data['paging'] = $x / 8; 

		$data['video'] = 'class="active"';
		$data['title'] = str_replace('%20', ' ', $name);
		$data['id'] = $id;
		$data['limit'] = $limit;
		$data['row'] = $x;
		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('video/video');
		$this->load->view('v_template_admin/admin_footer');
	}
	
}