<?php
class Chat extends CI_Controller{

	function __construct(){
		parent::__construct();
	} 
	function index(){ 
		if ( $this->session->userdata('login') == 1) {
			$data['chat'] = 'class="active"';
		    $data['title'] = 'Chatting Room';
 
		    $level = $this->session->userdata('level');
		    $kelas = $this->session->userdata('kelas'); 
		    $id = $this->session->userdata('id');

		    $data['data'] = $this->query_builder->view("SELECT * from t_chat AS a JOIN t_user AS b ON REPLACE(a.chat_target, '$id,', '') = b.user_id WHERE FIND_IN_SET('$id', chat_target) AND chat_id IN (SELECT dupid FROM (SELECT MAX(chat_id) AS dupid,COUNT(*) AS dupcnt FROM t_chat GROUP BY chat_name HAVING COUNT(*) > 0) AS duptable) ORDER BY chat_id DESC");

		    if ($level == 3) {
		    	$data['user_data'] = $this->query_builder->view("SELECT * FROM t_user as a LEFT JOIN t_kelas as b ON a.user_kelas = b.kelas_id LEFT JOIN t_pelajaran as c ON a.user_pelajaran = c.pelajaran_id WHERE NOT a.user_id = '$id' AND a.user_level > 1 AND a.user_kelas = '$kelas'");

		    }else{
		    	$data['user_data'] = $this->query_builder->view("SELECT * FROM t_user as a LEFT JOIN t_kelas as b ON a.user_kelas = b.kelas_id LEFT JOIN t_pelajaran as c ON a.user_pelajaran = c.pelajaran_id WHERE NOT a.user_id = '$id' AND a.user_level > 1");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('chat/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	} 

	function room($target){

		$id = $this->session->userdata('id');

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_user as a LEFT JOIN t_kelas as b ON a.user_kelas = b.kelas_id LEFT JOIN t_pelajaran as c ON a.user_pelajaran = c.pelajaran_id WHERE a.user_id = '$target'");

		$data['tanggal'] = $this->query_builder->view("SELECT chat_tanggal FROM t_chat WHERE FIND_IN_SET('$target', chat_target) AND FIND_IN_SET('$id', chat_target) AND chat_type = 'personal' GROUP BY chat_tanggal");
		$data['text'] = $this->query_builder->view("SELECT * FROM t_chat WHERE FIND_IN_SET('$target', chat_target) AND FIND_IN_SET('$id', chat_target) AND chat_type = 'personal'");

		$data['type'] = 'personal';
		$data['target'] = $data['data']['user_id'];
		$data['name'] = $data['target'] + $id;

		//update view
		$db = $this->query_builder->view("SELECT * FROM t_chat WHERE NOT FIND_IN_SET('$id', chat_view) AND FIND_IN_SET('$target', chat_target) AND FIND_IN_SET('$id', chat_target) AND chat_type = 'personal'");

		if ($db) {
			
			foreach ($db as $key) {
				$view = $key['chat_view'].','.$id;

				$set = ['chat_view' => $view];
				$where = ['chat_id' => $key['chat_id']];
				$db = $this->query_builder->update('t_chat',$set,$where);
			}

		}
		//

		$data['chat'] = 'class="active"';
		$data['title'] = 'Chatting Room';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('chat/room');
	    $this->load->view('v_template_admin/admin_footer');

	}
	function send(){

		//save
		$id = $this->session->userdata('id');
		$target = $_POST['target'];
		$type = $_POST['type'];
		$name = $_POST['name'];

		if ($type == 'personal') {
			$arr = str_replace(['"','[',']'], '', json_encode([$id, $target]));
		} else {
			$arr = $target;
		}
		
		$set = array(
						'chat_user' => $id,
						'chat_target' => $arr,
						'chat_text' => $_POST['text'],
						'chat_type' => $type, 
						'chat_view'	=> $id,
						'chat_name' => $name,
					);

		$this->query_builder->add('t_chat',$set);

		if ($type == 'personal') {
			//personal
			$response = $this->query_builder->view_row("SELECT * FROM t_chat WHERE FIND_IN_SET('$id', chat_target) AND FIND_IN_SET('$target', chat_target) AND chat_user = '$id' AND chat_type = '$type' ORDER BY chat_id DESC");
		} else {
			//group
			$response = $this->query_builder->view_row("SELECT * FROM t_chat WHERE chat_target = '$arr' AND chat_user = '$id' AND chat_type = '$type' ORDER BY chat_id DESC");
		}

		echo json_encode($response);
	}
	function delete(){
		$id = $_POST['id'];

		$where = ['chat_id' => $id];
		$this->query_builder->delete('t_chat',$where);

		$response = 1;
		echo json_encode($response);
	}
	function newchat(){

		$id = $this->session->userdata('id');
		$target = $_POST['target'];
		$type = $_POST['type'];
		$name = $_POST['name'];

		if ($type == 'personal') {
			// personal
			$response = $this->query_builder->view_row("SELECT * FROM t_chat WHERE NOT FIND_IN_SET('$id', chat_view) AND FIND_IN_SET('$id', chat_target) AND FIND_IN_SET('$target', chat_target) AND chat_type = '$type' ORDER BY chat_id DESC");
		} else {
			// group
			$response = $this->query_builder->view_row("SELECT * FROM t_chat WHERE NOT FIND_IN_SET('$id', chat_view) AND chat_name = '$name' AND chat_type = '$type' ORDER BY chat_id DESC");
		}

		echo json_encode($response);

		//update
		$chat_id = $response['chat_id'];
		$view = $response['chat_user'].','.$id;

		$set = ['chat_view' => $view];
		$where = ['chat_id' => $chat_id];
		$db = $this->query_builder->update('t_chat',$set,$where);
	}
	function group($chat_id = ''){

		$id = $this->session->userdata('id');

		if ($chat_id) {
			//index
			$db_chat = $this->query_builder->view_row("SELECT * FROM t_chat WHERE chat_id = '$chat_id'");
			$user = explode(' ', str_replace(',', ' ', $db_chat['chat_target']));
			$name = $db_chat['chat_name'];
			$target = implode(',', $user);
		}else{
			//new group
			$user = $_POST['user'];
			$name = $_POST['name'];
			$target = $id.','.implode(',', $user);
		}

		if ($user) {
			$data['target'] = $target;
			$data['type'] = 'group';
			$data['name'] = $name;
			$data['jumlah'] = count($user);

			$data['chat'] = 'class="active"';
			$data['title'] = 'Chatting Room';

			$data['tanggal'] = $this->query_builder->view("SELECT chat_tanggal FROM t_chat WHERE chat_name = '$name' AND chat_type = 'group' GROUP BY chat_tanggal");

			$data['text'] = $this->query_builder->view("SELECT * FROM t_chat as a JOIN t_user as b ON a.chat_user = b.user_id WHERE a.chat_name = '$name' AND a.chat_type = 'group'");

			//update view
			$db = $this->query_builder->view("SELECT * FROM t_chat WHERE NOT FIND_IN_SET('$id', chat_view) AND chat_name = '$name' AND chat_type = 'group'");

				if ($db) {
				
					foreach ($db as $key) {
					$view = $key['chat_view'].','.$id;

					$set = ['chat_view' => $view];
					$where = ['chat_id' => $key['chat_id']];
					$db = $this->query_builder->update('t_chat',$set,$where);

				}

			}

			$this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('chat/room');
		    $this->load->view('v_template_admin/admin_footer');	

		}else{
			$this->session->set_flashdata('gagal','User belum ada yang di pilih');
			redirect(base_url('chat'));
		}
	}
	function view_user(){
		$target = $_POST['target'];
		$data = $this->query_builder->view("SELECT * FROM t_user as a LEFT JOIN t_kelas as b ON a.user_kelas = b.kelas_id LEFT JOIN t_pelajaran as c ON a.user_pelajaran = c.pelajaran_id WHERE a.user_id IN($target)");
		echo json_encode($data);
	}
	function notif(){
		$id = $_POST['id'];
		$response = $this->query_builder->view("SELECT chat_name AS chat_name, COUNT(*) AS not_open FROM t_chat WHERE NOT FIND_IN_SET('$id', chat_view) AND FIND_IN_SET('$id', chat_target) GROUP BY chat_name ORDER BY chat_id DESC");
		echo json_encode($response);
	}
}