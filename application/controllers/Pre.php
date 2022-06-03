<?php
class Pre extends CI_Controller{

	function __construct(){ 
		parent::__construct();  
	}  
	function index(){   
		if ( $this->session->userdata('login') == 1) {
		 
			$data['pre_active'] = 'class="active"';
		  $data['open_test'] = 'menu-open';
		  $data['block_test'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');

			switch ($level) {   
				case 1: 
					// admin  
					$data['data'] = $this->query_builder->view("SELECT * FROM t_pre as a JOIN t_pelajaran as b ON a.pre_pelajaran = b.pelajaran_id WHERE a.pre_hapus = 0");
					break;
				case 2:
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_pre as a JOIN t_pelajaran as b ON a.pre_pelajaran = b.pelajaran_id WHERE a.pre_hapus = 0 AND a.pre_pelajaran = '$pelajaran'");
					break;
				case 3:
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_pre as a JOIN t_pelajaran as b ON a.pre_pelajaran = b.pelajaran_id WHERE a.pre_hapus = 0 AND concat(',',pre_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

			$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
			$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
			$data['semester_data'] = $this->query_builder->view("SELECT * FROM t_semester");

	    $data['title'] = 'pre';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pre/index');
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
		$data['pre_active'] = 'class="active"';
		$data['open_test'] = 'menu-open';
		$data['block_test'] = 'style="display: block;"';

		$data['title'] = 'pre';

		$cek = $this->query_builder->view_row("SELECT * FROM t_pre order by pre_key DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['pre_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}
		
		$set = array(	
						'idsoal' => $idsoal,
						'jumlah' => $_POST['pre_jumlah'],
						'pelajaran' => $_POST['pre_pelajaran'], 
						'kelas' => str_replace(['"','[',']'], '', json_encode($_POST['pre_kelas'])), 
						'semester' => $_POST['semester'],
						'pertemuan' => $_POST['pertemuan'],
					);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pre/add',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function insert(){
		$jum = $_POST['pre_jumlah'];
		$path = 'assets/img/pre';
		$idsoal = $_POST['pre_id'];

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
						'pre_id' => $idsoal,
						'pre_jumlah' => $jum,
						'pre_pertanyaan' => json_encode($_POST),
						'pre_tanggal' => date('Y-m-d'), 
						'pre_pelajaran' => $_POST['pre_pelajaran'],
						'pre_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['pre_kelas'])),
						'pre_pelaksanaan' => $_POST['pre_pelaksanaan'],
						'pre_durasi' => $_POST['pre_durasi'],
						'pre_petunjuk' => $_POST['pre_petunjuk'],
						'pre_judul' => $_POST['pre_judul'],
						'pre_semester' => $_POST['pre_semester'],
						'pre_pertemuan' => $_POST['pre_pertemuan'],				
					);

		$db = $this->query_builder->add('t_pre',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pre'));
	}
	function edit($id){
		$data['pre_active'] = 'class="active"';
		$data['open_test'] = 'menu-open';
		$data['block_test'] = 'style="display: block;"';
		
		$data['title'] = 'pre';
		$db = $this->query_builder->view_row("SELECT * FROM t_pre WHERE pre_id = '$id'");
		$set = array(	
						'idsoal' => $db['pre_id'],
						'jumlah' => $db['pre_jumlah'],
						'kelas' => $db['pre_kelas'],
						'pelajaran' => $db['pre_pelajaran'],
						'tanggal' => $db['pre_pelaksanaan'],
						'durasi' => $db['pre_durasi'], 
						'petunjuk' => $db['pre_petunjuk'],
						'judul' => $db['pre_judul'],
					);


		//pre di pecah bentuk array//
		$soal = '['.$db['pre_pertanyaan'].']';
		$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
		$data['soal'] = json_decode($v,true);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_materi WHERE materi_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pre/edit',$set);
		$this->load->view('v_template_admin/admin_footer');

		// echo '<pre>';
		// print_r($data['soal']);
		// echo '</pre>';
	}
	function update($id){
		$jum = $_POST['pre_jumlah'];
		$path = 'assets/img/pre';
		$idsoal = $_POST['pre_id'];

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
						'pre_id' => $idsoal,
						'pre_jumlah' => $jum,
						'pre_pertanyaan' => json_encode($_POST),
						'pre_pelajaran' => $_POST['pre_pelajaran'],
						'pre_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['pre_kelas'])), 
						'pre_pelaksanaan' => $_POST['pre_pelaksanaan'],
						'pre_durasi' => $_POST['pre_durasi'],
						'pre_petunjuk' => $_POST['pre_petunjuk'],
						'pre_judul' => $_POST['pre_judul'],	
					);

		$where = ['pre_id' => $id];
		$db = $this->query_builder->update('t_pre',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di edit');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('pre'));
	}
	function delete($id){
		$set = ['pre_hapus' => 1];
		$where = ['pre_id' => $id];
		$db = $this->query_builder->update('t_pre',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pre'));
	}
	function kerjakan($id){
		
		$user = $this->session->userdata('id');
		$curdate = date('Y-m-d H:i:s');

		$cek_pelaksanaan = $this->query_builder->count("SELECT * FROM t_pre WHERE pre_id = '$id' AND pre_pelaksanaan <= '$curdate'");

		$cek_status = $this->query_builder->count("SELECT * FROM t_pre_hasil where pre_hasil_siswa = '$user' AND pre_hasil_soal = '$id'");

		if ($cek_pelaksanaan < 1) {
			
			// sudah
			$this->session->set_flashdata('gagal','Ujian belum di mulai');
			redirect(base_url('pre'));
		
		}else{
			
			if ($cek_status > 0) {
				
				// sudah
				$this->session->set_flashdata('gagal','Ujian sudah di kerjakan');
				redirect(base_url('pre'));
			
			} else {
				
				//belum
				$data['pre_active'] = 'class="active"';
			  $data['open_test'] = 'menu-open';
			  $data['block_test'] = 'style="display: block;"';
				
				$db = $this->query_builder->view_row("SELECT * FROM t_pre WHERE pre_id = '$id'");
				
				$set = array(	
								'idsoal' => $db['pre_id'],
								'jumlah' => $db['pre_jumlah'],
								'timer' => $db['pre_durasi'], 
								'petunjuk' => $db['pre_petunjuk'],
								'judul' => $db['pre_judul'],
							);

				//pre di pecah bentuk array//
				$soal = '['.$db['pre_pertanyaan'].']';
				$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
				$data['soal'] = json_decode($v,true);

				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('pre/kerjakan',$set);
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

		$set = array(
						'pre_hasil_siswa' => $user,
						'pre_hasil_soal' => $id,
						'pre_hasil_jawaban' => json_encode($jawaban),
						'pre_hasil_nilai' => $nilai,
						'pre_hasil_sisa' => $_POST['timer'], 
					);

		$cek = $this->query_builder->view_row("SELECT * FROM t_pre_hasil WHERE pre_hasil_siswa = '$user' AND pre_hasil_soal = '$id'");
		$id_hasil = $cek['pre_hasil_id'];

		if ($cek) {
			// sudah
			$where = ['pre_hasil_id' => $id_hasil];
			$db = $this->query_builder->update('t_pre_hasil',$set,$where);
		} else {
			// belum
			$db = $this->query_builder->add('t_pre_hasil',$set);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Jawaban berhasil di kirim');
		}else{
			$this->session->set_flashdata('gagal','Jawaban gagal di kirim');
		}

		redirect(base_url('pre'));
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
						$data['data'] = $this->query_builder->view("SELECT * FROM t_pre_hasil as a join t_pre as b ON a.pre_hasil_soal = b.pre_id join t_user as c ON c.user_id = a.pre_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.pre_hasil_hapus = 0 AND a.pre_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_pre_hasil as a join t_pre as b ON a.pre_hasil_soal = b.pre_id join t_user as c ON c.user_id = a.pre_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.pre_hasil_hapus = 0 AND b.pre_pelajaran = '$pelajaran' AND a.pre_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");

						break;
				}

			}else{

				switch ($level) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_pre_hasil as a join t_pre as b ON a.pre_hasil_soal = b.pre_id join t_user as c ON c.user_id = a.pre_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.pre_hasil_hapus = 0");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_pre_hasil as a join t_pre as b ON a.pre_hasil_soal = b.pre_id join t_user as c ON c.user_id = a.pre_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.pre_hasil_hapus = 0 AND b.pre_pelajaran = '$pelajaran'");

						break;
					case '3':
						// mahasiswa
						$data['data'] = $this->query_builder->view("SELECT * FROM t_pre_hasil as a join t_pre as b ON a.pre_hasil_soal = b.pre_id join t_user as c ON c.user_id = a.pre_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.pre_hasil_hapus = 0 AND concat(',',b.pre_kelas,',') LIKE '%,$kelas,%' AND a.pre_hasil_siswa = '$id'");
							
						break;
				}
			}

			//materi
		  switch ($this->session->userdata('level')) {
		  	case '1':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_pre WHERE pre_hapus = 0");
		  		break;
		  	case '2':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_pre WHERE pre_hapus = 0 AND pre_pelajaran = '$pelajaran'");
		  		break;
		  	
		  }

		  $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

			$data['pre_hasil_active'] = 'class="active"';
			$data['open_test'] = 'menu-open';
			$data['open_test_nilai'] = 'menu-open';
			$data['block_test'] = 'style="display: block;"';
			$data['block_test_nilai'] = 'style="display: block;"';
		  
		  $data['title'] = 'Hasil pre';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('pre/hasil');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_detail($id,$soal){
		if ( $this->session->userdata('login') == 1) {

			$db_hasil = $this->query_builder->view_row("SELECT * FROM t_pre_hasil WHERE pre_hasil_id = '$id'");

			$data['jawaban'] = json_decode($db_hasil['pre_hasil_jawaban']);

			$db_pre = $this->query_builder->view_row("SELECT * FROM t_pre WHERE pre_id = '$soal'");

			$set = array(	
							'jumlah' => $db_pre['pre_jumlah'],
							 
						);


			//pre di pecah bentuk array//
			$soal = '['.$db_pre['pre_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$data['pre_hasil_active'] = 'class="active"';
			$data['open_test'] = 'menu-open';
			$data['open_test_nilai'] = 'menu-open';
			$data['block_test'] = 'style="display: block;"';
			$data['block_test_nilai'] = 'style="display: block;"';
			
		  $data['title'] = 'Hasil pre';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('pre/detail',$set);
		  $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_delete($id){
		
		$set = ['pre_hasil_hapus' => 1];
		$where = ['pre_hasil_id' => $id];
		$db = $this->query_builder->update('t_pre_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pre/hasil_view'));
	}
}