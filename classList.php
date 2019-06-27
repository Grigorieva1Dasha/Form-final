<?php
class Participants_list{
    	private $dbname = 'test';
    	private $username = 'root';
    	private $password = '';
		private $mysql;
		public function delete_db($id){
			$mysql1 = $this->mysql->prepare('DELETE FROM participants WHERE id=:id;');
			$mysql1->execute([
				':id'=>$id
			]);
		}
		public function read_db(){
			$mysql1 = $this->mysql->prepare('SELECT id, date, ip, name, lastname, email, telephone, topic, pay FROM participants;');
			$mysql1->execute();
			$clients = $mysql1->fetchALL(PDO::FETCH_ASSOC);
			return $clients;
		}
		public function __construct(){
			$this->mysql = new PDO('mysql:host=localhost;dbname='.$this->dbname,$this->username,$this->password);
			$this->mysql->exec('set names utf8');
			$this->print_form();
		}
		private function print_form(){
			if($_POST){
				foreach ($_POST as $i => $value) {
					$this->delete_db($i);
				}
				echo '<center>Удалено<br></center>';
			}
			echo '<center><form method="POST">';
			echo '<table>';
			echo 	'<tr>
						<td>Id</td>
						<td>Date</td>
						<td>IP</td>
						<td>Name</td>
						<td>Lastname</td>
						<td>Email</td>
						<td>Telephone</td>
						<td>Topic</td>
						<td>Pay</td>
						<td>DELETE</td>
					</tr>';
			$strings=$this->read_db();
			if($strings){
				foreach ($strings as $i => $string) {
					if($string){
						echo '<tr>';
						foreach ($string as $i) {
							echo '<td>'.$i.'</td>';
						}
						echo '<td><input type="checkbox" name='.$string['id'].'></td>';
						echo '</tr>';
					}
				}
			}
			echo '</table>';
			echo '<p><input type="submit" value="Удалить" class="button1"> ';
			echo '<input type="submit" value="Обновить" class="button1"></p>';
			echo '<p><a href="/ls/form10">Вернуться к форме</p></center>';
		}
	}
