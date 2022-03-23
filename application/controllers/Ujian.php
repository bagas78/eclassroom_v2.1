<?php
class Ujian extends CI_Controller{

	function __construct(){ 
		parent::__construct(); 
	}  
	function index(){ 
		if ( $this->session->userdata('login') == 1) {
		
			$data['ujian_soal_active'] = 'class="active"';
		  $data['open_ujian'] = 'menu-open';
		  $data['block_ujian'] = 'style="display: block;"';

			$level = $this->session->userdata('level');
			$pelajaran = $this->session->userdata('pelajaran');
			$kelas = $this->session->userdata('kelas');

			switch ($level) { 
				case 1:
					// admin
					$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian as a JOIN t_pelajaran as b ON a.ujian_pelajaran = b.pelajaran_id WHERE a.ujian_hapus = 0");
					break;
				case 2:
					// guru
					$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian as a JOIN t_pelajaran as b ON a.ujian_pelajaran = b.pelajaran_id WHERE a.ujian_hapus = 0 AND a.ujian_pelajaran = '$pelajaran'");
					break;
				case 3:
					// siswa
					$data['data'] = $this->query_builder->view("SELECT * FROM t_ujian as a JOIN t_pelajaran as b ON a.ujian_pelajaran = b.pelajaran_id WHERE a.ujian_hapus = 0 AND concat(',',ujian_kelas,',') LIKE '%,$kelas,%'");
					break;
			}

			$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
			$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

	    $data['title'] = 'Ujian';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('ujian/index');
	    $this->load->view('v_template_admin/admin_footer',$data);
 
		}
		else{
			redirect(base_url('login')); 
		}
	} 
	function add(){
		$data['ujian_soal_active'] = 'class="active"';
		$data['open_ujian'] = 'menu-open';
		$data['block_ujian'] = 'style="display: block;"';

		$data['title'] = 'ujian';

		$cek = $this->query_builder->view_row("SELECT * FROM t_ujian order by ujian_id DESC limit 1");

		//generate idsoal
		if (@$cek == null) {
			$idsoal = 'SOAL1';
		}else{
			$num = str_replace('SOAL', '', $cek['ujian_id']);
			$i = $num + 1;
			$idsoal = 'SOAL'.$i;
		}
		
		$set = array(	
						'idsoal' => $idsoal,
						'judul' => $_POST['ujian_judul'],
						'jumlah' => $_POST['ujian_jumlah'],
						'timer' => $_POST['ujian_timer'],
						'berakhir' => $_POST['ujian_berakhir'],
						'pelajaran' => $_POST['ujian_pelajaran'], 
						'kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_kelas'])), 
					);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('ujian/add',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function insert(){
		$jum = $_POST['ujian_jumlah'];
		$path = 'assets/img/soal';
		$idsoal = $_POST['ujian_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$set = array(
						'ujian_id' => $idsoal,
						'ujian_judul' => $_POST['ujian_judul'],
						'ujian_jumlah' => $jum,
						'ujian_pertanyaan' => json_encode($_POST),
						'ujian_timer' => $_POST['ujian_timer'],
						'ujian_tanggal' => date('Y-m-d'), 
						'ujian_berakhir' => $_POST['ujian_berakhir'],
						'ujian_pelajaran' => $_POST['ujian_pelajaran'],
						'ujian_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_kelas'])),				
					);

		$db = $this->query_builder->add('t_ujian',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('ujian'));
	}
	function edit($id){
		$data['ujian_soal_active'] = 'class="active"';
		$data['open_ujian'] = 'menu-open';
		$data['block_ujian'] = 'style="display: block;"';
		
		$data['title'] = 'ujian';
		$db = $this->query_builder->view_row("SELECT * FROM t_ujian WHERE ujian_id = '$id'");
		$set = array(	
						'idsoal' => $db['ujian_id'],
						'judul' => $db['ujian_judul'],
						'jumlah' => $db['ujian_jumlah'],
						'timer' => $db['ujian_timer'],
						'kelas' => $db['ujian_kelas'],
						'berakhir' => $db['ujian_berakhir'],
						'pelajaran' => $db['ujian_pelajaran'], 
					);


		//soal di pecah bentuk array//
		$soal = '['.$db['ujian_pertanyaan'].']';
		$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
		$data['soal'] = json_decode($v,true);

		$data['kelas_data'] = $this->query_builder->view("SELECT * FROM t_kelas WHERE kelas_hapus = 0");
		$data['pelajaran_data'] = $this->query_builder->view("SELECT * FROM t_pelajaran WHERE pelajaran_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('ujian/edit',$set);
		$this->load->view('v_template_admin/admin_footer');
	}
	function update($id){
		$jum = $_POST['ujian_jumlah'];
		$path = 'assets/img/soal';
		$idsoal = $_POST['ujian_id'];

		for ($i=1; $i < $jum+1 ; $i++) { 
			move_uploaded_file($_FILES['file'.$i]['tmp_name'], $path.'/'.$idsoal.'_'.$i.'.jpeg');
		}

		$set = array(
						'ujian_id' => $idsoal,
						'ujian_judul' => $_POST['ujian_judul'],
						'ujian_jumlah' => $jum,
						'ujian_pertanyaan' => json_encode($_POST),
						'ujian_timer' => $_POST['ujian_timer'],
						'ujian_berakhir' => $_POST['ujian_berakhir'],
						'ujian_pelajaran' => $_POST['ujian_pelajaran'],
						'ujian_kelas' => str_replace(['"','[',']'], '', json_encode($_POST['ujian_kelas'])), 
					);

		$where = ['ujian_id' => $id];
		$db = $this->query_builder->update('t_ujian',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di edit');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('ujian'));
	}
	function delete($id){
		$set = ['ujian_hapus' => 1];
		$where = ['ujian_id' => $id];
		$db = $this->query_builder->update('t_ujian',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('ujian'));
	}
	function kerjakan($id,$exp){
		$user = $this->session->userdata('id');
		$cek = $this->query_builder->count("SELECT * FROM t_hasil where hasil_siswa = '$user' AND hasil_soal = '$id'");

		if ($cek == 1) {
			$this->session->set_flashdata('gagal','Soal sudah di kerjakan');
			redirect(base_url('ujian'));

		}else{

			if ($exp <= date('Y-m-d')) {

				$this->session->set_flashdata('gagal','Waktu ujian sudah berakhir');
				redirect(base_url('ujian'));

			}else{

				$data['ujian'] = 'class="active"';
				$data['title'] = 'ujian';
				$db = $this->query_builder->view_row("SELECT * FROM t_ujian WHERE ujian_id = '$id'");
				$set = array(	
								'idsoal' => $db['ujian_id'],
								'judul' => $db['ujian_judul'],
								'jumlah' => $db['ujian_jumlah'],
								'timer' => $db['ujian_timer'], 
							);


				//soal di pecah bentuk array//
				$soal = '['.$db['ujian_pertanyaan'].']';
				$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
				$data['soal'] = json_decode($v,true);

				$this->load->view('v_template_admin/admin_header',$data);
				$this->load->view('ujian/kerjakan',$set);
				$this->load->view('v_template_admin/admin_footer');
			
			}
		}
	}
	function hasil($id){
	  $jum = $_POST['ujian_jumlah'];

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
						'hasil_siswa' => $this->session->userdata('id'),
						'hasil_soal' => $id,
						'hasil_jawaban' => json_encode($jawaban),
						'hasil_nilai' => $nilai,
						'hasil_sisa' => $_POST['ujian_timer'], 
					);

		$db = $this->query_builder->add('t_hasil',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Jawaban berhasil di kirim');
		}else{
			$this->session->set_flashdata('gagal','Jawaban gagal di kirim');
		}

		redirect(base_url('ujian'));
	}
	function hasil_view(){
		if ( $this->session->userdata('login') == 1) {
			$data['data'] = $this->query_builder->view("SELECT * FROM t_hasil as a join t_ujian as b ON a.hasil_soal = b.ujian_id join t_user as c ON c.user_id = a.hasil_siswa JOIN t_kelas as d ON c.user_kelas = d.kelas_id WHERE a.hasil_hapus = 0");

			$data['ujian_koreksi_active'] = 'class="active"';
			$data['open_ujian'] = 'menu-open';
			$data['block_ujian'] = 'style="display: block;"';
		  
		  $data['title'] = 'Hasil ujian';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('ujian/hasil');
		  $this->load->view('v_template_admin/admin_footer',$data);

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_detail($id,$soal){
		if ( $this->session->userdata('login') == 1) {

			$db_hasil = $this->query_builder->view_row("SELECT * FROM t_hasil WHERE hasil_id = '$id'");

			$data['jawaban'] = json_decode($db_hasil['hasil_jawaban']);

			$db_ujian = $this->query_builder->view_row("SELECT * FROM t_ujian WHERE ujian_id = '$soal'");

			$set = array(	
							'judul' => $db_ujian['ujian_judul'],
							'jumlah' => $db_ujian['ujian_jumlah'],
							 
						);


			//soal di pecah bentuk array//
			$soal = '['.$db_ujian['ujian_pertanyaan'].']';
			$v = str_replace(',"soal_pertanyaan', '},{"soal_pertanyaan', $soal);
			$data['soal'] = json_decode($v,true);

			$data['ujian_koreksi_active'] = 'class="active"';
			$data['open_ujian'] = 'menu-open';
			$data['block_ujian'] = 'style="display: block;"';
			
		  $data['title'] = 'Hasil ujian';

		  $this->load->view('v_template_admin/admin_header',$data);
		  $this->load->view('ujian/detail',$set);
		  $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	}
	function hasil_delete($id){
		
		$set = ['hasil_hapus' => 1];
		$where = ['hasil_id' => $id];
		$db = $this->query_builder->update('t_hasil',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		}else{
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('ujian/hasil_view'));
	}
}