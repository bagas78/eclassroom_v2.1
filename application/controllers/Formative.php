<?php
class Formative extends CI_Controller{

	function __construct(){ 
		parent::__construct();  
	}  
	function index(){   
		if ( $this->session->userdata('login') == 1) {
		
			$data['formative_active'] = 'class="active"';
		  $data['open_test'] = 'menu-open';
		  $data['block_test'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');

			switch ($level) {  
				case 1: 
					// admin  
					$data['data'] = $this->query_builder->view("SELECT * FROM t_formative as a JOIN t_pelajaran as b ON a.formative_pelajaran = b.pelajaran_id WHERE a.formative_hapus = 0");
					break;
				case 2:
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_formative as a JOIN t_pelajaran as b ON a.formative_pelajaran = b.pelajaran_id WHERE a.formative_hapus = 0 AND a.formative_pelajaran = '$pelajaran'");
					break;
				case 3:
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_formative as a JOIN t_pelajaran as b ON a.formative_pelajaran = b.pelajaran_id WHERE a.formative_hapus = 0 AND concat(',',formative_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

			$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
			$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

	    $data['title'] = 'formative';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('formative/index');
	    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	} 
	function add(){
		$data['formative_active'] = 'class="active"';
		$data['open_test'] = 'menu-open';
		$data['block_test'] = 'style="display: block;"';

		$data['title'] = 'formative';

		$cek = $this->query_builder->view_row("SELECT * FROM t_formative order by formative_id DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['formative_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}
		
		$set = array(	
						'idsoal' => $idsoal,
						'jumlah' => $_POST['formative_jumlah'],
						'pelajaran' => $_POST['formative_pelajaran'], 
						'kelas' => str_replace(['"','[',']'], '', json_encode($_POST['formative_kelas'])), 
					);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('formative/add',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function insert(){
		$jum = $_POST['formative_jumlah'];
		$path = 'assets/img/formative';
		$idsoal = $_POST['formative_id'];

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
						'formative_id' => $idsoal,
						'formative_jumlah' => $jum,
						'formative_pertanyaan' => json_encode($_POST),
						'formative_tanggal' => date('Y-m-d'), 
						'formative_pelajaran' => $_POST['formative_pelajaran'],
						'formative_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['formative_kelas'])),
						'formative_pelaksanaan' => $_POST['formative_pelaksanaan'],
						'formative_durasi' => $_POST['formative_durasi'],
						'formative_petunjuk' => $_POST['formative_petunjuk'],		
						'formative_judul' => $_POST['formative_judul'],				
					);

		$db = $this->query_builder->add('t_formative',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('formative'));
	}
	function edit($id){
		$data['formative_active'] = 'class="active"';
		$data['open_test'] = 'menu-open';
		$data['block_test'] = 'style="display: block;"';
		
		$data['title'] = 'formative';
		$db = $this->query_builder->view_row("SELECT * FROM t_formative WHERE formative_id = '$id'");
		$set = array(	
						'idsoal' => $db['formative_id'],
						'jumlah' => $db['formative_jumlah'],
						'kelas' => $db['formative_kelas'],
						'pelajaran' => $db['formative_pelajaran'],
						'tanggal' => $db['formative_pelaksanaan'],
						'judul' => $db['formative_judul'],
						'durasi' => $db['formative_durasi'], 
						'petunjuk' => $db['formative_petunjuk'],
					);


		//formative di pecah bentuk array//
		$soal = '['.$db['formative_pertanyaan'].']';
		$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
		$data['soal'] = json_decode($v,true);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('formative/edit',$set);
		$this->load->view('v_template_admin/admin_footer');

		// echo '<formative>';
		// print_r($data['soal']);
		// echo '</formative>';
	}
	function update($id){
		$jum = $_POST['formative_jumlah'];
		$path = 'assets/img/formative';
		$idsoal = $_POST['formative_id'];

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
						'formative_id' => $idsoal,
						'formative_jumlah' => $jum,
						'formative_pertanyaan' => json_encode($_POST),
						'formative_pelajaran' => $_POST['formative_pelajaran'],
						'formative_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['formative_kelas'])), 
						'formative_pelaksanaan' => $_POST['formative_pelaksanaan'],
						'formative_durasi' => $_POST['formative_durasi'],
						'formative_petunjuk' => $_POST['formative_petunjuk'],
						'formative_judul' => $_POST['formative_judul'],	
					);

		$where = ['formative_id' => $id];
		$db = $this->query_builder->update('t_formative',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di edit');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('formative'));
	}
	function delete($id){
		$set = ['formative_hapus' => 1];
		$where = ['formative_id' => $id];
		$db = $this->query_builder->update('t_formative',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('formative'));
	}
	function kerjakan($id){
		
		$user = $this->session->userdata('id');
		$curdate = date('Y-m-d H:i:s');

		$cek_pelaksanaan = $this->query_builder->count("SELECT * FROM t_formative WHERE formative_id = '$id' AND formative_pelaksanaan <= '$curdate'");

		if ($cek_pelaksanaan < 1) {
			
			// sudah
			$this->session->set_flashdata('gagal','Ujian belum di mulai');
			redirect(base_url('formative'));
		
		}else{
			
			//belum
			$data['formative_active'] = 'class="active"';
		  $data['open_test'] = 'menu-open';
		  $data['block_test'] = 'style="display: block;"';
			
			$db = $this->query_builder->view_row("SELECT * FROM t_formative WHERE formative_id = '$id'");
			
			$set = array(	
							'idsoal' => $db['formative_id'],
							'jumlah' => $db['formative_jumlah'],
							'timer' => $db['formative_durasi'], 
							'petunjuk' => $db['formative_petunjuk'],
							'judul' => $db['formative_judul'],
						);

			//formative di pecah bentuk array//
			$soal = '['.$db['formative_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$this->load->view('v_template_admin/admin_header',$data);
			$this->load->view('formative/kerjakan',$set);
			$this->load->view('v_template_admin/admin_footer');
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
						'formative_hasil_siswa' => $user,
						'formative_hasil_soal' => $id,
						'formative_hasil_jawaban' => json_encode($jawaban),
						'formative_hasil_nilai' => $nilai,
						'formative_hasil_sisa' => $_POST['timer'],
					);

		$db = $this->query_builder->add('t_formative_hasil',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Jawaban berhasil di kirim');
		}else{
			$this->session->set_flashdata('gagal','Jawaban gagal di kirim');
		}

		redirect(base_url('formative'));
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
						$data['data'] = $this->query_builder->view("SELECT * FROM t_formative_hasil as a join t_formative as b ON a.formative_hasil_soal = b.formative_id join t_user as c ON c.user_id = a.formative_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.formative_hasil_hapus = 0 AND a.formative_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas' GROUP BY a.formative_hasil_siswa");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_formative_hasil as a join t_formative as b ON a.formative_hasil_soal = b.formative_id join t_user as c ON c.user_id = a.formative_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.formative_hasil_hapus = 0 AND b.formative_pelajaran = '$pelajaran' AND a.formative_hasil_soal = '$filter_materi' AND c.user_kelas = '$filter_kelas' GROUP BY a.formative_hasil_siswa");

						break;
				}

			}else{

				switch ($level) {
					case '1':
						// admin
						$data['data'] = $this->query_builder->view("SELECT * FROM t_formative_hasil as a join t_formative as b ON a.formative_hasil_soal = b.formative_id join t_user as c ON c.user_id = a.formative_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.formative_hasil_hapus = 0 GROUP BY a.formative_hasil_siswa");

						break;
					case '2':
						// dosen
						$data['data'] = $this->query_builder->view("SELECT * FROM t_formative_hasil as a join t_formative as b ON a.formative_hasil_soal = b.formative_id join t_user as c ON c.user_id = a.formative_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.formative_hasil_hapus = 0 AND b.formative_pelajaran = '$pelajaran' GROUP BY a.formative_hasil_siswa");

						break;
					case '3':
						// mahasiswa
						$data['data'] = $this->query_builder->view("SELECT * FROM t_formative_hasil as a join t_formative as b ON a.formative_hasil_soal = b.formative_id join t_user as c ON c.user_id = a.formative_hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.formative_hasil_hapus = 0 AND concat(',',b.formative_kelas,',') LIKE '%,$kelas,%' GROUP BY a.formative_hasil_siswa");
							
						break;
				}
			}

			//materi
		  switch ($this->session->userdata('level')) {
		  	case '1':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_formative WHERE formative_hapus = 0");
		  		break;
		  	case '2':
		  		$data['materi_data'] = $this->query_builder->view("SELECT * FROM t_formative WHERE formative_hapus = 0 AND formative_pelajaran = '$pelajaran'");
		  		break;
		  	
		  }

		  $data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");

			$data['formative_hasil_active'] = 'class="active"';
			$data['open_test'] = 'menu-open';
			$data['open_test_nilai'] = 'menu-open';
			$data['block_test'] = 'style="display: block;"';
			$data['block_test_nilai'] = 'style="display: block;"';
		  
		  $data['title'] = 'Hasil formative';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('formative/hasil');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_detail($id,$soal){
		if ( $this->session->userdata('login') == 1) {

			$db_hasil = $this->query_builder->view_row("SELECT * FROM t_formative_hasil WHERE formative_hasil_id = '$id'");

			$data['jawaban'] = json_decode($db_hasil['formative_hasil_jawaban']);

			$db_formative = $this->query_builder->view_row("SELECT * FROM t_formative WHERE formative_id = '$soal'");

			$set = array(	
							'jumlah' => $db_formative['formative_jumlah'],
							 
						);


			//formative di pecah bentuk array//
			$soal = '['.$db_formative['formative_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$data['formative_hasil_active'] = 'class="active"';
			$data['open_test'] = 'menu-open';
			$data['open_test_nilai'] = 'menu-open';
			$data['block_test'] = 'style="display: block;"';
			$data['block_test_nilai'] = 'style="display: block;"';
			
		  $data['title'] = 'Hasil formative';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('formative/detail',$set);
		  $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_delete($siswa,$soal){
		
		$set = ['formative_hasil_hapus' => 1];
		$where = ['formative_hasil_siswa' => $siswa, 'formative_hasil_soal' => $soal];
		$db = $this->query_builder->update('t_formative_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('formative/hasil_view'));
	}
	function get_nilai(){
		$id = $_POST['id'];

		$db = $this->query_builder->view("SELECT * FROM t_formative_hasil WHERE formative_hasil_siswa = '$id' AND formative_hasil_hapus = 0");

		echo json_encode($db);
	}
}