<?php
class ujian_pilihan extends CI_Controller{

	function __construct(){ 
		parent::__construct();  
	}   
	function index(){  
		if ( $this->session->userdata('login') == 1) {
		
			$data['ujian_pilihan_active'] = 'class="active"';
		  $data['open_ujian'] = 'menu-open';
		  $data['block_ujian'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');

			switch ($level) {  
				case 1:
					// admin 
					$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan as a JOIN t_pelajaran as b ON a.ujian_pilihan_pelajaran = b.pelajaran_id WHERE a.ujian_pilihan_hapus = 0");
					break;
				case 2:
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan as a JOIN t_pelajaran as b ON a.ujian_pilihan_pelajaran = b.pelajaran_id WHERE a.ujian_pilihan_hapus = 0 AND a.ujian_pilihan_pelajaran = '$pelajaran'");
					break;
				case 3:
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan as a JOIN t_pelajaran as b ON a.ujian_pilihan_pelajaran = b.pelajaran_id WHERE a.ujian_pilihan_hapus = 0 AND concat(',',ujian_pilihan_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

			$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
			$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");
			$data['semester_data'] = $this->query_builder->view("SELECT * FROM t_semester");

	    $data['title'] = 'ujian_pilihan';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('ujian_pilihan/index');
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
		$data['ujian_pilihan_active'] = 'class="active"';
		$data['open_ujian'] = 'menu-open';
		$data['block_ujian'] = 'style="display: block;"';

		$data['title'] = 'ujian_pilihan';

		$cek = $this->query_builder->view_row("SELECT * FROM t_ujian_pilihan order by ujian_pilihan_key DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['ujian_pilihan_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}
		
		$set = array(	
						'idsoal' => $idsoal,
						'jumlah' => $_POST['ujian_pilihan_jumlah'],
						'pelajaran' => $_POST['ujian_pilihan_pelajaran'], 
						'kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_pilihan_kelas'])), 
						'semester' => $_POST['semester'],
						'pertemuan' => $_POST['pertemuan'],
					);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('ujian_pilihan/add',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function insert(){
		$jum = $_POST['ujian_pilihan_jumlah'];
		$path = 'assets/img/ujian_pilihan';
		$idsoal = $_POST['ujian_pilihan_id'];

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
						'ujian_pilihan_id' => $idsoal,
						'ujian_pilihan_jumlah' => $jum,
						'ujian_pilihan_pertanyaan' => json_encode($_POST),
						'ujian_pilihan_tanggal' => date('Y-m-d'), 
						'ujian_pilihan_pelajaran' => $_POST['ujian_pilihan_pelajaran'],
						'ujian_pilihan_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_pilihan_kelas'])),
						'ujian_pilihan_pelaksanaan' => $_POST['ujian_pilihan_pelaksanaan'],
						'ujian_pilihan_judul' => $_POST['ujian_pilihan_judul'],
						'ujian_pilihan_durasi' => $_POST['ujian_pilihan_durasi'],
						'ujian_pilihan_kesempatan' => $_POST['ujian_pilihan_kesempatan'],
						'ujian_pilihan_petunjuk' => $_POST['ujian_pilihan_petunjuk'],
						'ujian_pilihan_semester' => $_POST['ujian_pilihan_semester'],
						'ujian_pilihan_pertemuan' => $_POST['ujian_pilihan_pertemuan'],				
					);

		$db = $this->query_builder->add('t_ujian_pilihan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('ujian_pilihan'));
	}
	function edit($id){
		$data['ujian_pilihan_active'] = 'class="active"';
		$data['open_ujian'] = 'menu-open';
		$data['block_ujian'] = 'style="display: block;"';
		
		$data['title'] = 'ujian_pilihan';
		$db = $this->query_builder->view_row("SELECT * FROM t_ujian_pilihan WHERE ujian_pilihan_id = '$id'");
		$set = array(	
						'idsoal' => $db['ujian_pilihan_id'],
						'jumlah' => $db['ujian_pilihan_jumlah'],
						'kelas' => $db['ujian_pilihan_kelas'],
						'pelajaran' => $db['ujian_pilihan_pelajaran'],
						'tanggal' => $db['ujian_pilihan_pelaksanaan'],
						'judul' => $db['ujian_pilihan_judul'],
						'durasi' => $db['ujian_pilihan_durasi'], 
						'kesempatan' => $db['ujian_pilihan_kesempatan'],
						'petunjuk' => $db['ujian_pilihan_petunjuk'],
					);


		//ujian_pilihan di pecah bentuk array//
		$soal = '['.$db['ujian_pilihan_pertanyaan'].']';
		$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
		$data['soal'] = json_decode($v,true);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('ujian_pilihan/edit',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function update($id){
		$jum = $_POST['ujian_pilihan_jumlah'];
		$path = 'assets/img/ujian_pilihan';
		$idsoal = $_POST['ujian_pilihan_id'];

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
						'ujian_pilihan_id' => $idsoal,
						'ujian_pilihan_jumlah' => $jum,
						'ujian_pilihan_pertanyaan' => json_encode($_POST),
						'ujian_pilihan_pelajaran' => $_POST['ujian_pilihan_pelajaran'],
						'ujian_pilihan_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_pilihan_kelas'])), 
						'ujian_pilihan_pelaksanaan' => $_POST['ujian_pilihan_pelaksanaan'],
						'ujian_pilihan_judul' => $_POST['ujian_pilihan_judul'],
						'ujian_pilihan_durasi' => $_POST['ujian_pilihan_durasi'],
						'ujian_pilihan_kesempatan' => $_POST['ujian_pilihan_kesempatan'],
						'ujian_pilihan_petunjuk' => $_POST['ujian_pilihan_petunjuk'],	
					);

		$where = ['ujian_pilihan_id' => $id];
		$db = $this->query_builder->update('t_ujian_pilihan',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di edit');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('ujian_pilihan'));
	}
	function delete($id){
		$set = ['ujian_pilihan_hapus' => 1];
		$where = ['ujian_pilihan_id' => $id];
		$db = $this->query_builder->update('t_ujian_pilihan',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('ujian_pilihan'));
	}
	function kerjakan($id){
		
		$user = $this->session->userdata('id');
		$curdate = date('Y-m-d H:i:s');

		$cek_pelaksanaan = $this->query_builder->count("SELECT * FROM t_ujian_pilihan WHERE ujian_pilihan_id = '$id' AND ujian_pilihan_pelaksanaan <= '$curdate'");

		$cek_status = $this->query_builder->count("SELECT * FROM t_ujian_pilihan_hasil where ujian_pilihan_hasil_siswa = '$user' AND ujian_pilihan_hasil_soal = '$id' AND ujian_pilihan_hasil_kesempatan < 1");

		if ($cek_pelaksanaan < 1) {
			
			// sudah
			$this->session->set_flashdata('gagal','Ujian belum di mulai');
			redirect(base_url('ujian_pilihan'));
		
		}else{
			
			if ($cek_status > 0) {
				
				// sudah
				$this->session->set_flashdata('gagal','Ujian sudah di kerjakan / Kesempatan sudah habis');
				redirect(base_url('ujian_pilihan'));
			
			} else {
				
				//belum
				$data['ujian_pilihan'] = 'class="active"';
				$data['title'] = 'ujian_pilihan';
				
				$db = $this->query_builder->view_row("SELECT * FROM t_ujian_pilihan WHERE ujian_pilihan_id = '$id'");

				$cek = $this->query_builder->view_row("SELECT * FROM t_ujian_pilihan_hasil WHERE ujian_pilihan_hasil_siswa = '$user' AND ujian_pilihan_hasil_soal = '$id'");

				if ($cek) {
					// sudah
					$kesempatan = $cek['ujian_pilihan_hasil_kesempatan'] - 1;
				} else {
					// belum
					$kesempatan = $db['ujian_pilihan_kesempatan'] - 1;
				}
				
				$set = array(	
								'idsoal' => $db['ujian_pilihan_id'],
								'jumlah' => $db['ujian_pilihan_jumlah'],
								'timer' => $db['ujian_pilihan_durasi'], 
								'petunjuk' => $db['ujian_pilihan_petunjuk'],
								'kesempatan' => $kesempatan, 
								'judul' => $db['ujian_pilihan_judul'],
							);

				//ujian_pilihan di pecah bentuk array//
				$soal = '['.$db['ujian_pilihan_pertanyaan'].']';
				$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
				$data['soal'] = json_decode($v,true);

				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('ujian_pilihan/kerjakan',$set);
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
						'ujian_pilihan_hasil_siswa' => $user,
						'ujian_pilihan_hasil_soal' => $id,
						'ujian_pilihan_hasil_jawaban' => json_encode($jawaban),
						'ujian_pilihan_hasil_nilai' => $nilai,
						'ujian_pilihan_hasil_sisa' => $_POST['timer'], 
						'ujian_pilihan_hasil_kesempatan' => $_POST['kesempatan'],
					);

		$cek = $this->query_builder->view_row("SELECT * FROM t_ujian_pilihan_hasil WHERE ujian_pilihan_hasil_siswa = '$user' AND ujian_pilihan_hasil_soal = '$id'");
		$id_hasil = $cek['ujian_pilihan_hasil_id'];

		if ($cek) {
			// sudah
			$where = ['ujian_pilihan_hasil_id' => $id_hasil];
			$db = $this->query_builder->update('t_ujian_pilihan_hasil',$set,$where);
		} else {
			// belum
			$db = $this->query_builder->add('t_ujian_pilihan_hasil',$set);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Jawaban berhasil di kirim');
		}else{
			$this->session->set_flashdata('gagal','Jawaban gagal di kirim');
		}

		redirect(base_url('ujian_pilihan'));
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
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan_hasil as a join t_ujian_pilihan as b ON a.ujian_pilihan_hasil_soal = b.ujian_pilihan_id join t_user as c ON c.user_id = a.ujian_pilihan_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_pilihan_hasil_hapus = 0 AND a.ujian_pilihan_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan_hasil as a join t_ujian_pilihan as b ON a.ujian_pilihan_hasil_soal = b.ujian_pilihan_id join t_user as c ON c.user_id = a.ujian_pilihan_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_pilihan_hasil_hapus = 0 AND b.ujian_pilihan_pelajaran = '$pelajaran' AND a.ujian_pilihan_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas'");

						break;
				}

			}else{

				switch ($level) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan_hasil as a join t_ujian_pilihan as b ON a.ujian_pilihan_hasil_soal = b.ujian_pilihan_id join t_user as c ON c.user_id = a.ujian_pilihan_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_pilihan_hasil_hapus = 0");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan_hasil as a join t_ujian_pilihan as b ON a.ujian_pilihan_hasil_soal = b.ujian_pilihan_id join t_user as c ON c.user_id = a.ujian_pilihan_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_pilihan_hasil_hapus = 0 AND b.ujian_pilihan_pelajaran = '$pelajaran'");

						break;
					case '3':
						// mahasiswa
						$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan_hasil as a join t_ujian_pilihan as b ON a.ujian_pilihan_hasil_soal = b.ujian_pilihan_id join t_user as c ON c.user_id = a.ujian_pilihan_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.ujian_pilihan_hasil_hapus = 0 AND concat(',',b.ujian_pilihan_kelas,',') LIKE '%,$kelas,%'");
							
						break;
				}
			}

			//materi
		  switch ($this->session->userdata('level')) {
		  	case '1':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan WHERE ujian_pilihan_hapus = 0");
		  		break;
		  	case '2':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_ujian_pilihan WHERE ujian_pilihan_hapus = 0 AND ujian_pilihan_pelajaran = '$pelajaran'");
		  		break;
		  	
		  }

		  $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

			$data['open_ujian'] = 'menu-open';
		  $data['block_ujian'] = 'style="display: block;"';
		  $data['block_ujian_hasil'] = 'style="display: block;"';
		  $data['ujian_pilihan_hasil_active'] = 'class="active"';
		  
		  $data['title'] = 'Hasil ujian_pilihan';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('ujian_pilihan/hasil');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_detail($id,$soal){
		if ( $this->session->userdata('login') == 1) {

			$db_hasil = $this->query_builder->view_row("SELECT * FROM t_ujian_pilihan_hasil WHERE ujian_pilihan_hasil_id = '$id'");

			$data['jawaban'] = json_decode($db_hasil['ujian_pilihan_hasil_jawaban']);

			$db_ujian_pilihan = $this->query_builder->view_row("SELECT * FROM t_ujian_pilihan WHERE ujian_pilihan_id = '$soal'");

			$set = array(	
							'jumlah' => $db_ujian_pilihan['ujian_pilihan_jumlah'],
							 
						);


			//ujian_pilihan di pecah bentuk array//
			$soal = '['.$db_ujian_pilihan['ujian_pilihan_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$data['open_ujian'] = 'menu-open';
		  $data['block_ujian'] = 'style="display: block;"';
		  $data['block_ujian_hasil'] = 'style="display: block;"';
		  $data['ujian_pilihan_hasil_active'] = 'class="active"';
			
		  $data['title'] = 'Hasil ujian_pilihan';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('ujian_pilihan/detail',$set);
		  $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_delete($id){
		
		$set = ['ujian_pilihan_hasil_hapus' => 1];
		$where = ['ujian_pilihan_hasil_id' => $id];
		$db = $this->query_builder->update('t_ujian_pilihan_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('ujian_pilihan/hasil_view'));
	}
}