<?php
class Pilihan extends CI_Controller{

	function __construct(){ 
		parent::__construct(); 
	}  
	function index(){ 
		if ( $this->session->userdata('login') == 1) { 
		
			$data['tugas_pilihan_active'] = 'class="active"';
	  		$data['open_tugas'] = 'menu-open';
	  		$data['block_tugas'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');
 
			switch ($level) { 
				case 1:
					// admin
					$data['data'] = $this->query_builder->view("SELECT * FROM t_pilihan as a JOIN t_pelajaran as b ON a.pilihan_pelajaran = b.pelajaran_id WHERE a.pilihan_hapus = 0");
					break;
				case 2:
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_pilihan as a JOIN t_pelajaran as b ON a.pilihan_pelajaran = b.pelajaran_id WHERE a.pilihan_hapus = 0 AND a.pilihan_pelajaran = '$pelajaran'");
					break;
				case 3:
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_pilihan as a JOIN t_pelajaran as b ON a.pilihan_pelajaran = b.pelajaran_id WHERE a.pilihan_hapus = 0 AND concat(',',pilihan_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

			$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
			$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		    $data['title'] = 'Pilihan Ganda';
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pilihan/index');
		    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	} 
	function add(){
		$data['tugas_pilihan_active'] = 'class="active"';
	  	$data['open_tugas'] = 'menu-open';
	  	$data['block_tugas'] = 'style="display: block;"';

		$data['title'] = 'Pilihan Ganda';

		$cek = $this->query_builder->view_row("SELECT * FROM t_pilihan order by pilihan_id DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['pilihan_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}
		
		$set = array(	
						'idsoal' => $idsoal,
						'judul' => $_POST['pilihan_judul'],
						'jumlah' => $_POST['pilihan_jumlah'],
						'acak' => $_POST['pilihan_acak'],
						'pelajaran' => $_POST['pilihan_pelajaran'], 
						'kelas' => str_replace(['"','[',']'], '', json_encode($_POST['pilihan_kelas'])), 
					);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pilihan/add',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function insert(){

		$iduser = $this->session->userdata('id');

		$jum = $_POST['pilihan_jumlah'];
		$path = 'assets/img/pilihan';
		$idsoal = $_POST['pilihan_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$set = array(
						'pilihan_acak' => $_POST['pilihan_acak'],
						'pilihan_id' => $idsoal,
						'pilihan_guru' => $iduser,
						'pilihan_judul' => $_POST['pilihan_judul'],
						'pilihan_jumlah' => $jum,
						'pilihan_pertanyaan' => json_encode($_POST),
						'pilihan_tanggal' => date('Y-m-d'), 
						'pilihan_pelajaran' => $_POST['pilihan_pelajaran'],
						'pilihan_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['pilihan_kelas'])),				
					);

		$db = $this->query_builder->add('t_pilihan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pilihan'));
	}
	function edit($id){
		$data['tugas_pilihan_active'] = 'class="active"';
	  $data['open_tugas'] = 'menu-open';
	  $data['block_tugas'] = 'style="display: block;"';
		
		$data['title'] = 'ujian';
		$db = $this->query_builder->view_row("SELECT * FROM t_pilihan WHERE pilihan_id = '$id'");
		$set = array(	
						'idsoal' => $db['pilihan_id'],
						'judul' => $db['pilihan_judul'],
						'jumlah' => $db['pilihan_jumlah'],
						'kelas' => $db['pilihan_kelas'],
						'pelajaran' => $db['pilihan_pelajaran'], 
					);


		//soal di pecah bentuk array//
		$soal = '['.$db['pilihan_pertanyaan'].']';
		$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
		$data['soal'] = json_decode($v,true);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pilihan/edit',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$jum = $_POST['pilihan_jumlah'];
		$path = 'assets/img/pilihan';
		$idsoal = $_POST['pilihan_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$set = array(
						'pilihan_acak' => $_POST['pilihan_acak'],
						'pilihan_id' => $idsoal,
						'pilihan_judul' => $_POST['pilihan_judul'],
						'pilihan_jumlah' => $jum,
						'pilihan_pertanyaan' => json_encode($_POST),
						'pilihan_pelajaran' => $_POST['pilihan_pelajaran'],
						'pilihan_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['pilihan_kelas'])), 
					);

		$where = ['pilihan_id' => $id];
		$db = $this->query_builder->update('t_pilihan',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di edit');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('pilihan'));
	}
	function delete($id){
		$set = ['pilihan_hapus' => 1];
		$where = ['pilihan_id' => $id];
		$db = $this->query_builder->update('t_pilihan',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pilihan'));
	}
	function kerjakan($id){
		$user = $this->session->userdata('id');
		$cek = $this->query_builder->count("SELECT * FROM t_pilihan_hasil where pilihan_hasil_siswa = '$user' AND pilihan_hasil_soal = '$id'");

		if ($cek == 1) {
			$this->session->set_flashdata('gagal','Soal sudah di kerjakan');
			redirect(base_url('pilihan'));

		}else{

			$data['tugas_pilihan_active'] = 'class="active"';
	  	$data['open_tugas'] = 'menu-open';
	  	$data['block_tugas'] = 'style="display: block;"';

			$db = $this->query_builder->view_row("SELECT * FROM t_pilihan WHERE pilihan_id = '$id'");
			$set = array(	
							'idsoal' => $db['pilihan_id'],
							'judul' => $db['pilihan_judul'],
							'jumlah' => $db['pilihan_jumlah'], 
							'acak' => $db['pilihan_acak'],
						);


			//soal di pecah bentuk array//
			$soal = '['.$db['pilihan_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$this->load->view('v_template_admin/admin_header',$data);
			$this->load->view('pilihan/kerjakan',$set);
			$this->load->view('v_template_admin/admin_footer');
		}
	}
	function hasil($id){
	  $jum = $_POST['pilihan_jumlah'];

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
						'pilihan_hasil_siswa' => $this->session->userdata('id'),
						'pilihan_hasil_soal' => $id,
						'pilihan_hasil_jawaban' => json_encode($jawaban),
						'pilihan_hasil_nilai' => $nilai, 
					);

		$db = $this->query_builder->add('t_pilihan_hasil',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Jawaban berhasil di kirim');
		}else{
			$this->session->set_flashdata('gagal','Jawaban gagal di kirim');
		}

		redirect(base_url('pilihan'));
	}
	function koreksi(){
		if ( $this->session->userdata('login') == 1) {

			$kelas = $this->session->userdata('kelas');
			$pelajaran = $this->session->userdata('pelajaran');

			switch ($this->session->userdata('level')) {
				case '1':
					// admin
				$data['data'] = $this->query_builder->view("SELECT * FROM t_pilihan_hasil as a join t_pilihan as b ON a.pilihan_hasil_soal = b.pilihan_id join t_user as c ON c.user_id = a.pilihan_hasil_siswa WHERE a.pilihan_hasil_hapus = 0");
					break;
				
				case '2':
					// guru
				$data['data'] = $this->query_builder->view("SELECT * FROM t_pilihan_hasil as a join t_pilihan as b ON a.pilihan_hasil_soal = b.pilihan_id join t_user as c ON c.user_id = a.pilihan_hasil_siswa WHERE a.pilihan_hasil_hapus = 0 AND b.pilihan_pelajaran = '$pelajaran'");
					break;

				case '3':
					// siswa
				$data['data'] = $this->query_builder->view("SELECT * FROM t_pilihan_hasil as a join t_pilihan as b ON a.pilihan_hasil_soal = b.pilihan_id join t_user as c ON c.user_id = a.pilihan_hasil_siswa WHERE a.pilihan_hasil_hapus = 0 AND concat(',',b.pilihan_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

		  $data['tugas_koreksi_pilihan_active'] = 'class="active"';
		  $data['open_koreksi_tugas'] = 'menu-open';
		  $data['block_koreksi_tugas'] = 'style="display: block;"';
		  
		  $data['title'] = 'Koreksi Pilihan Ganda';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('pilihan/koreksi');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_detail($id,$soal){
		if ( $this->session->userdata('login') == 1) {

			$db_hasil = $this->query_builder->view_row("SELECT * FROM t_pilihan_hasil WHERE pilihan_hasil_id = '$id'");

			$data['jawaban'] = json_decode($db_hasil['pilihan_hasil_jawaban']);

			$db_ujian = $this->query_builder->view_row("SELECT * FROM t_pilihan WHERE pilihan_id = '$soal'");

			$set = array(	
							'judul' => $db_ujian['pilihan_judul'],
							'jumlah' => $db_ujian['pilihan_jumlah'],
							 
						);


			//soal di pecah bentuk array//
			$soal = '['.$db_ujian['pilihan_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$data['tugas_koreksi_pilihan_active'] = 'class="active"';
		  $data['open_koreksi_tugas'] = 'menu-open';
		  $data['block_koreksi_tugas'] = 'style="display: block;"';
			
		  $data['title'] = 'Koreksi Pilihan Ganda';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('pilihan/koreksi_detail',$set);
		  $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function koreksi_delete($id){
		
		$set = ['pilihan_hasil_hapus' => 1];
		$where = ['pilihan_hasil_id' => $id];
		$db = $this->query_builder->update('t_pilihan_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pilihan/koreksi'));
	}
}