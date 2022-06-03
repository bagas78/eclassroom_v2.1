<?php
class Post extends CI_Controller{

	function __construct(){ 
		parent::__construct();  
	}  
	function index(){   
		if ( $this->session->userdata('login') == 1) {
		
			$data['post_active'] = 'class="active"';
		  $data['open_test'] = 'menu-open';
		  $data['block_test'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');

			switch ($level) {  
				case 1: 
					// admin 
					$data['data'] = $this->query_builder->view("SELECT * FROM t_post as a JOIN t_pelajaran as b ON a.post_pelajaran = b.pelajaran_id WHERE a.post_hapus = 0");
					break;
				case 2:
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_post as a JOIN t_pelajaran as b ON a.post_pelajaran = b.pelajaran_id WHERE a.post_hapus = 0 AND a.post_pelajaran = '$pelajaran'");
					break;
				case 3:
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_post as a JOIN t_pelajaran as b ON a.post_pelajaran = b.pelajaran_id WHERE a.post_hapus = 0 AND concat(',',post_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

			$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
			$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
			$data['semester_data'] = $this->query_builder->view("SELECT * FROM t_semester");

	    $data['title'] = 'post';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('post/index');
	    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	} 
	function get_pertemuan(){
		$no = $_POST['no'];

		$db = $this->query_builder->view("SELECT * FROM t_pertemuan WHERE pertemuan_semester = '$no'");
		echo json_encode($db);
	}
	function add(){
		$data['post_active'] = 'class="active"';
		$data['open_test'] = 'menu-open';
		$data['block_test'] = 'style="display: block;"';

		$data['title'] = 'post';

		$cek = $this->query_builder->view_row("SELECT * FROM t_post order by post_key DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['post_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}
		
		$set = array(	
						'idsoal' => $idsoal,
						'jumlah' => $_POST['post_jumlah'],
						'pelajaran' => $_POST['post_pelajaran'], 
						'kelas' => str_replace(['"','[',']'], '', json_encode($_POST['post_kelas'])), 
						'semester' => $_POST['semester'],
						'pertemuan' => $_POST['pertemuan'],
					);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_materi WHERE materi_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('post/add',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function insert(){
		$jum = $_POST['post_jumlah'];
		$path = 'assets/img/post';
		$idsoal = $_POST['post_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			//upload soal
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');

			//upload jawaban
			if ($_POST['soal_input'.$i] == 'image') {
				move_uploaded_file($_FILES['a'.$i]['tmp_name'], $path.'/'.$idsoal.'_a_'.$i.'.jpeg');
				move_uploaded_file($_FILES['b'.$i]['tmp_name'], $path.'/'.$idsoal.'_b_'.$i.'.jpeg');
				move_uploaded_file($_FILES['c'.$i]['tmp_name'], $path.'/'.$idsoal.'_c_'.$i.'.jpeg');
				move_uploaded_file($_FILES['d'.$i]['tmp_name'], $path.'/'.$idsoal.'_d_'.$i.'.jpeg');
			}
		}

		$set = array(
						'post_id' => $idsoal,
						'post_jumlah' => $jum,
						'post_pertanyaan' => json_encode($_POST),
						'post_tanggal' => date('Y-m-d'), 
						'post_pelajaran' => $_POST['post_pelajaran'],
						'post_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['post_kelas'])),
						'post_pelaksanaan' => $_POST['post_pelaksanaan'],
						'post_durasi' => $_POST['post_durasi'],
						'post_petunjuk' => $_POST['post_petunjuk'],	
						'post_judul' => $_POST['post_judul'],
						'post_semester' => $_POST['post_semester'],
						'post_pertemuan' => $_POST['post_pertemuan'],			
					);

		$db = $this->query_builder->add('t_post',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('post'));
	}
	function edit($id){
		$data['post_active'] = 'class="active"';
		$data['open_test'] = 'menu-open';
		$data['block_test'] = 'style="display: block;"';
		
		$data['title'] = 'post';
		$db = $this->query_builder->view_row("SELECT * FROM t_post WHERE post_id = '$id'");
		$set = array(	
						'idsoal' => $db['post_id'],
						'jumlah' => $db['post_jumlah'],
						'kelas' => $db['post_kelas'],
						'pelajaran' => $db['post_pelajaran'],
						'tanggal' => $db['post_pelaksanaan'],
						'durasi' => $db['post_durasi'], 
						'kesempatan' => $db['post_kesempatan'],
						'petunjuk' => $db['post_petunjuk'],
						'judul' => $db['post_judul'],
					);


		//post di pecah bentuk array//
		$soal = '['.$db['post_pertanyaan'].']';
		$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
		$data['soal'] = json_decode($v,true);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('post/edit',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function update($id){
		$jum = $_POST['post_jumlah'];
		$path = 'assets/img/post';
		$idsoal = $_POST['post_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			//upload soal
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');

			//upload jawaban
			if ($_POST['soal_input'.$i] == 'image') {
				move_uploaded_file($_FILES['a'.$i]['tmp_name'], $path.'/'.$idsoal.'_a_'.$i.'.jpeg');
				move_uploaded_file($_FILES['b'.$i]['tmp_name'], $path.'/'.$idsoal.'_b_'.$i.'.jpeg');
				move_uploaded_file($_FILES['c'.$i]['tmp_name'], $path.'/'.$idsoal.'_c_'.$i.'.jpeg');
				move_uploaded_file($_FILES['d'.$i]['tmp_name'], $path.'/'.$idsoal.'_d_'.$i.'.jpeg');
			}
		}

		$set = array(
						'post_id' => $idsoal,
						'post_jumlah' => $jum,
						'post_pertanyaan' => json_encode($_POST),
						'post_pelajaran' => $_POST['post_pelajaran'],
						'post_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['post_kelas'])), 
						'post_pelaksanaan' => $_POST['post_pelaksanaan'],
						'post_durasi' => $_POST['post_durasi'],
						'post_petunjuk' => $_POST['post_petunjuk'],	
						'post_judul' => $_POST['post_judul'],		
					);

		$where = ['post_id' => $id];
		$db = $this->query_builder->update('t_post',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di edit');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('post'));
	}
	function delete($id){
		$set = ['post_hapus' => 1];
		$where = ['post_id' => $id];
		$db = $this->query_builder->update('t_post',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('post'));
	}
	function kerjakan($id){
		
		$user = $this->session->userdata('id');
		$curdate = date('Y-m-d H:i:s');
		$curtime = date('Y-m-d H');

		$cek_pelaksanaan = $this->query_builder->count("SELECT * FROM t_post WHERE post_id = '$id' AND post_pelaksanaan <= '$curdate'");

		$cek_status = $this->query_builder->count("SELECT * FROM t_post_hasil WHERE post_hasil_siswa = '$user' AND post_hasil_soal = '$id' AND DATE_FORMAT(post_hasil_kesempatan, '%Y-%m-%d %H') = '$curtime' AND post_hasil_nilai_2 != ''");

		if ($cek_pelaksanaan < 1) {
			
			// sudah
			$this->session->set_flashdata('gagal','Ujian belum di mulai');
			redirect(base_url('post'));
		
		}else{
			
			if ($cek_status > 0) {
				
				// sudah
				$this->session->set_flashdata('gagal','Kesempatan sudah habis');
				redirect(base_url('post'));
			
			} else {
				
				//belum
				$data['post'] = 'class="active"';
				$data['title'] = 'post';
				
				$db = $this->query_builder->view_row("SELECT * FROM t_post WHERE post_id = '$id'");

				$cek = $this->query_builder->view_row("SELECT * FROM t_post_hasil WHERE post_hasil_siswa = '$user' AND post_hasil_soal = '$id'");
				
				$set = array(	
								'idsoal' => $db['post_id'],
								'jumlah' => $db['post_jumlah'],
								'timer' => $db['post_durasi'], 
								'petunjuk' => $db['post_petunjuk'],
								'judul' => $db['post_judul'],
							);

				//post di pecah bentuk array//
				$soal = '['.$db['post_pertanyaan'].']';
				$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
				$data['soal'] = json_decode($v,true);

				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('post/kerjakan',$set);
				$this->load->view('v_template_admin/admin_footer');
			}
		}
	}
	function hasil($id){
		$user = $this->session->userdata('id');
	  $jum = $_POST['jumlah'];

      //hitung nilai / bobot
      $sum = 0;
      $jawaban = [];
      for ($i=1; $i < $jum+1; $i++) { 
        
        if ($_POST['soal_kunci_jawaban'.$i] == md5($_POST['soal_jawaban'.$i])) {
          
          $sum += 1;
        } 

        $jawaban[] = $_POST['soal_jawaban'.$i];

      }

      $bobot = round(100 / $jum);
      $selisih = ($jum * $bobot) - 100;

      //nilai
      $nilai = ($sum * $bobot) - $selisih;

		$cek = $this->query_builder->view_row("SELECT * FROM t_post_hasil WHERE post_hasil_siswa = '$user' AND post_hasil_soal = '$id'");
		$id_hasil = $cek['post_hasil_id'];

		if ($cek) {
			// sudah
			$set = array(
						'post_hasil_siswa' => $user,
						'post_hasil_soal' => $id,
						'post_hasil_jawaban' => json_encode($jawaban),
						'post_hasil_nilai_2' => $nilai,
						'post_hasil_sisa' => $_POST['timer'],
					);
			$where = ['post_hasil_id' => $id_hasil];
			$db = $this->query_builder->update('t_post_hasil',$set,$where);
		} else {
			// belum
			$set = array(
						'post_hasil_siswa' => $user,
						'post_hasil_soal' => $id,
						'post_hasil_jawaban' => json_encode($jawaban),
						'post_hasil_nilai_1' => $nilai,
						'post_hasil_sisa' => $_POST['timer'],
					);
			$db = $this->query_builder->add('t_post_hasil',$set);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Jawaban berhasil di kirim');
		}else{
			$this->session->set_flashdata('gagal','Jawaban gagal di kirim');
		}

		redirect(base_url('post'));
	}
	function hasil_view(){
		if ( $this->session->userdata('login') == 1) {

			$pelajaran = $this->session->userdata('pelajaran');
			$level = $this->session->userdata('level');
			$kelas = $this->session->userdata('kelas');
			$id = $this->session->userdata('id');

			//filter
			$filter_materi = @$_POST['materi'];
			$filter_kelas = @$_POST['kelas'];

			if (@$filter_kelas) {

				switch ($level) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_post_hasil as a join t_post as b ON a.post_hasil_soal = b.post_id join t_user as c ON c.user_id = a.post_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.post_hasil_hapus = 0 AND a.post_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_post_hasil as a join t_post as b ON a.post_hasil_soal = b.post_id join t_user as c ON c.user_id = a.post_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.post_hasil_hapus = 0 AND b.post_pelajaran = '$pelajaran' AND a.post_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");

						break;
				}

			}else{

				switch ($level) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_post_hasil as a join t_post as b ON a.post_hasil_soal = b.post_id join t_user as c ON c.user_id = a.post_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.post_hasil_hapus = 0");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_post_hasil as a join t_post as b ON a.post_hasil_soal = b.post_id join t_user as c ON c.user_id = a.post_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.post_hasil_hapus = 0 AND b.post_pelajaran = '$pelajaran'");

						break;
					case '3':
						// mahasiswa
						$data['data'] = $this->query_builder->view("SELECT * FROM t_post_hasil as a join t_post as b ON a.post_hasil_soal = b.post_id join t_user as c ON c.user_id = a.post_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.post_hasil_hapus = 0 AND concat(',',b.post_kelas,',') LIKE '%,$kelas,%' AND a.post_hasil_siswa = '$id'");
							
						break;
				}
			}

			//materi
		  switch ($this->session->userdata('level')) {
		  	case '1':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_post WHERE post_hapus = 0");
		  		break;
		  	case '2':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_post WHERE post_hapus = 0 AND post_pelajaran = '$pelajaran'");
		  		break;
		  	
		  }

		  $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

			$data['post_hasil_active'] = 'class="active"';
			$data['open_test'] = 'menu-open';
			$data['open_test_nilai'] = 'menu-open';
			$data['block_test'] = 'style="display: block;"';
			$data['block_test_nilai'] = 'style="display: block;"';
		  
		  $data['title'] = 'Hasil post';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('post/hasil');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_detail($id,$soal){
		if ( $this->session->userdata('login') == 1) {

			$db_hasil = $this->query_builder->view_row("SELECT * FROM t_post_hasil WHERE post_hasil_id = '$id'");

			$data['jawaban'] = json_decode($db_hasil['post_hasil_jawaban']);

			$db_post = $this->query_builder->view_row("SELECT * FROM t_post WHERE post_id = '$soal'");

			$set = array(	
							'jumlah' => $db_post['post_jumlah'],
							 
						);


			//post di pecah bentuk array//
			$soal = '['.$db_post['post_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$data['post_hasil_active'] = 'class="active"';
			$data['open_test'] = 'menu-open';
			$data['open_test_nilai'] = 'menu-open';
			$data['block_test'] = 'style="display: block;"';
			$data['block_test_nilai'] = 'style="display: block;"';
			
		  $data['title'] = 'Hasil post';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('post/detail',$set);
		  $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_delete($id){
		
		$set = ['post_hasil_hapus' => 1];
		$where = ['post_hasil_id' => $id];
		$db = $this->query_builder->update('t_post_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('post/hasil_view'));
	}
}