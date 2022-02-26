<?php
class Diskusi extends CI_Controller{

	function __construct(){  
		parent::__construct();
	} 
	function kelas(){ 
		if ( $this->session->userdata('login') == 1) {
		    $data['kelas_diskusi_active'] = 'class="active"';
		    $data['open_diskusi'] = 'menu-open';
		    $data['block_diskusi'] = 'style="display: block;"';

		    $id = $this->session->userdata('id');
		    $kelas = $this->session->userdata('kelas');

		    $data['text'] = $this->query_builder->view("SELECT * FROM t_diskusi AS a JOIN t_user AS b ON a.diskusi_siswa = b.user_id WHERE a.diskusi_where = '$kelas' AND a.diskusi_type = 'kelas'");

		    $data['tanggal'] = $this->query_builder->view("SELECT diskusi_tanggal FROM t_diskusi WHERE diskusi_where = '$kelas' GROUP BY diskusi_tanggal ORDER BY diskusi_tanggal ASC");

		    //setting
		    $data['type'] = 'kelas';
		    $data['where'] = $kelas;

		    $kls = $this->query_builder->view_row("SELECT kelas_kepanjangan as kls FROM t_kelas WHERE kelas_id = '$kelas'");

		    $data['title'] = $kls['kls'];

		    //update view
			$db = $this->query_builder->view("SELECT * FROM t_diskusi WHERE NOT FIND_IN_SET('$id', diskusi_view) AND diskusi_type = 'kelas' AND diskusi_where = '$kelas'");

			if ($db) {
				
				foreach ($db as $key) {
					$view = $key['diskusi_view'].','.$id;

					$set = ['diskusi_view' => $view];
					$where = ['diskusi_id' => $key['diskusi_id']];
					$db = $this->query_builder->update('t_diskusi',$set,$where);
				}

			}
			//

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('diskusi/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function materi(){
		if ( $this->session->userdata('login') == 1) {
		    $data['materi_diskusi_active'] = 'class="active"';
		    $data['open_diskusi'] = 'menu-open';
		    $data['block_diskusi'] = 'style="display: block;"';

		    $kelas = $this->session->userdata('kelas');

    		$data['data'] = $this->query_builder->view("SELECT * FROM t_materi as a JOIN t_pelajaran as b ON a.materi_pelajaran = b.pelajaran_id WHERE materi_hapus = 0 AND concat(',',materi_kelas,',') LIKE '%,$kelas,%' order by a.materi_id DESC");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('diskusi/materi');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function materi_room($materi_id){

		$data['materi_diskusi_active'] = 'class="active"';
		    $data['open_diskusi'] = 'menu-open';
		    $data['block_diskusi'] = 'style="display: block;"';

		    $id = $this->session->userdata('id');
		    $kelas = $this->session->userdata('kelas');

		    $data['text'] = $this->query_builder->view("SELECT * FROM t_diskusi AS a JOIN t_user AS b ON a.diskusi_siswa = b.user_id WHERE b.user_kelas = '$kelas' AND diskusi_type = 'materi' AND a.diskusi_where = '$materi_id'");

		    $data['tanggal'] = $this->query_builder->view("SELECT a.diskusi_tanggal FROM t_diskusi as a JOIN t_user as b ON a.diskusi_siswa = b.user_id WHERE b.user_kelas = '$kelas' AND a.diskusi_type = 'materi' AND a.diskusi_where = '$materi_id' GROUP BY a.diskusi_tanggal ORDER BY a.diskusi_tanggal ASC");

		    //setting
		    $data['type'] = 'materi';
		    $data['where'] = $materi_id;

		    $mtr = $this->query_builder->view_row("SELECT materi_judul as judul FROM t_materi WHERE materi_id = '$materi_id'");

		    $data['title'] = $mtr['judul'];

		    //update view
			$db = $this->query_builder->view("SELECT * FROM t_diskusi as a JOIN t_user as b ON a.diskusi_siswa = b.user_id WHERE NOT FIND_IN_SET('$id', a.diskusi_view) AND a.diskusi_type = 'materi' AND b.user_kelas = '$kelas' AND a.diskusi_where = '$materi_id'");

			if ($db) {
				
				foreach ($db as $key) {
					$view = $key['diskusi_view'].','.$id;

					$set = ['diskusi_view' => $view];
					$where = ['diskusi_id' => $key['diskusi_id']];
					$db = $this->query_builder->update('t_diskusi',$set,$where);
				}

			}
			//

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('diskusi/index');
		    $this->load->view('v_template_admin/admin_footer');

	}
	function kelompok(){

		$data['kelompok_diskusi_active'] = 'class="active"';
	    $data['open_diskusi'] = 'menu-open';
	    $data['block_diskusi'] = 'style="display: block;"';

	    $id = $this->session->userdata('id');
	    $kelas = $this->session->userdata('kelas');

	    $kelompok_db = $this->query_builder->view_row("SELECT * FROM t_kelompok WHERE FIND_IN_SET('$id', kelompok_siswa)");

	    $kelompok_id = $kelompok_db['kelompok_id'];

	    if (@$kelompok_db) {
	    	// ada

	    	$data['text'] = $this->query_builder->view("SELECT * FROM t_diskusi AS a JOIN t_user AS b ON a.diskusi_siswa = b.user_id WHERE b.user_kelas = '$kelas' AND diskusi_type = 'kelompok' AND a.diskusi_where = '$kelompok_id'");

		    $data['tanggal'] = $this->query_builder->view("SELECT a.diskusi_tanggal FROM t_diskusi as a JOIN t_user as b ON a.diskusi_siswa = b.user_id WHERE b.user_kelas = '$kelas' AND a.diskusi_type = 'kelompok' AND a.diskusi_where = '$kelompok_id' GROUP BY a.diskusi_tanggal ORDER BY a.diskusi_tanggal ASC");

		    //setting
		    $data['type'] = 'kelompok';
		    $data['where'] = $kelompok_id;

		    $data['title'] = $kelompok_db['kelompok_nama'];

		    //update view
			$db = $this->query_builder->view("SELECT * FROM t_diskusi as a JOIN t_user as b ON a.diskusi_siswa = b.user_id WHERE NOT FIND_IN_SET('$id', a.diskusi_view) AND a.diskusi_type = 'kelompok' AND b.user_kelas = '$kelas' AND a.diskusi_where = '$kelompok_id'");

			if ($db) {
				
				foreach ($db as $key) {
					$view = $key['diskusi_view'].','.$id;

					$set = ['diskusi_view' => $view];
					$where = ['diskusi_id' => $key['diskusi_id']];
					$db = $this->query_builder->update('t_diskusi',$set,$where);
				}

			}
			//

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('diskusi/index');
		    $this->load->view('v_template_admin/admin_footer');

	    } else {
	    	// tidak ada
	    	$this->session->set_flashdata('gagal','Anda belum terdaftar di kelompok manapun');
	    	redirect(base_url('dashboard'));
	    }

	}
	function send(){
		$id = $this->session->userdata('id');

		if (@$_FILES['file']['name']) {

			//type file
			$typefile = explode('/', $_FILES['file']['type']);

			//replace Karakter name foto
			$filename = $_FILES['file']['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$new_name = md5(time()).'.'.$type[$no];
	    	/////////////////////
			
			// exist file
			  $config = array(
			  'upload_path' 	=> './assets/diskusi',
			  'allowed_types' 	=> "gif|jpg|png|jpeg|doc|docx|pdf|txt|xlsx",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "10000",
			  'file_name'		=> $new_name,
			  );

	          //Load upload library
	          $this->load->library('upload',$config);

			if ($this->upload->do_upload('file')) {

				$set = array(
						'diskusi_type' => $_POST['type'],
						'diskusi_siswa' => $id,
						'diskusi_text' => $_POST['text'],
						'diskusi_file' => $new_name,
						'diskusi_file_type' => $typefile[0],
						'diskusi_where' => $_POST['where'],
						'diskusi_view' => $id,
						'diskusi_tanggal' => date('Y-m-d'), 
					);

				$db = $this->query_builder->add('t_diskusi',$set);

				if ($db == 1) {
					$response = $this->query_builder->view_row("SELECT * FROM t_diskusi as a JOIN t_user as b ON a.diskusi_siswa = b.user_id WHERE diskusi_siswa = '$id' ORDER BY diskusi_id DESC");
				} 
			
			}else{

				//lebih dari 10 mb
				$response = 'large';
			}

		} else {
			
			// no file
			$set = array(
						'diskusi_type' => $_POST['type'],
						'diskusi_siswa' => $id,
						'diskusi_text' => $_POST['text'],
						'diskusi_where' => $_POST['where'],
						'diskusi_view' => $id,
						'diskusi_tanggal' => date('Y-m-d'), 
					);

			$db = $this->query_builder->add('t_diskusi',$set);

			if ($db == 1) {
				$response = $this->query_builder->view_row("SELECT * FROM t_diskusi as a JOIN t_user as b ON a.diskusi_siswa = b.user_id WHERE diskusi_siswa = '$id' ORDER BY diskusi_id DESC");
			} 
		}

		echo json_encode($response);

	}
	function delete(){
		$id = $_POST['id'];
		
		$file = $this->query_builder->view_row("SELECT * FROM t_diskusi WHERE diskusi_id = '$id'");

		$where = ['diskusi_id' => $id];
		$this->query_builder->delete('t_diskusi',$where);

		$response = 1;
		echo json_encode($response);

		//delete file
		if (@$file['diskusi_file'] != '') {
			unlink('./assets/diskusi/'.$file['diskusi_file']);
		}
	}
	function newchat(){
		$id = $this->session->userdata('id');
		$kelas = $this->session->userdata('kelas');
		$where = $_POST['where'];
		$type = $_POST['type'];

		switch ($type) {
			case 'kelas':
				$response = $this->query_builder->view_row("SELECT * FROM t_diskusi as a JOIN t_user as b ON a.diskusi_siswa = b.user_id WHERE NOT FIND_IN_SET('$id', a.diskusi_view) AND a.diskusi_type = '$type' AND b.user_kelas = '$where' AND diskusi_type = 'kelas' ORDER BY diskusi_id DESC");
				break;
			case 'materi':
				$response = $this->query_builder->view_row("SELECT * FROM t_diskusi AS a JOIN t_user AS b ON a.diskusi_siswa = b.user_id WHERE NOT FIND_IN_SET('$id', a.diskusi_view) AND b.user_kelas = '$kelas' AND diskusi_type = 'materi' AND a.diskusi_where = '$where'");
				break;
			case 'kelompok':
				$response = $this->query_builder->view_row("SELECT * FROM t_diskusi AS a JOIN t_user AS b ON a.diskusi_siswa = b.user_id WHERE NOT FIND_IN_SET('$id', a.diskusi_view) AND b.user_kelas = '$kelas' AND diskusi_type = 'kelompok' AND a.diskusi_where = '$where'");
				break;
				
		}

		echo json_encode($response);

		//update
		$diskusi_id = $response['diskusi_id'];
		$view = $response['diskusi_siswa'].','.$id;

		$set = ['diskusi_view' => $view];
		$where = ['diskusi_id' => $diskusi_id];
		$db = $this->query_builder->update('t_diskusi',$set,$where);
	}
}