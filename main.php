<?php
class Data
{
	protected $name, $lastname, $email, $telephone, $pay, $topic, $date, $ip;
	protected $content = [];
	protected $topics = [
		1 => 'Бизнес',
    	2 => 'Технологии',
    	3 => 'Реклама и Маркетинг',
	];
	protected $paymethod = [
		1 => 'WebMoney',
		2 => 'Яндекс.Деньги',
		3 => 'PayPal',
		4 => 'Кредитная карта',
	];
}

class Registration extends Data
{
	private function write_bd(){
		$dbname = 'test';
		$username = 'root';
		$password = '';
		$mysql = new PDO('mysql:host=localhost;dbname=' . $dbname,$username,$password);
		$mysql->exec('SET NAMES "utf8";');
		$sql = $mysql->prepare('INSERT INTO participants (date,ip,name, lastname, email, telephone, topic, pay) VALUES (:date,:ip,:name, :lastname, :email, :telephone, :topic, :pay);');
		$sql->execute([
			':name'=>$this->name,
			':lastname'=>$this->lastname,
			':email'=>$this->email,
			':telephone'=>$this->telephone,
			':topic'=>$this->topic,
			':pay'=>$this->pay,
			':date'=>$this->date,
			':ip'=>$this->ip
		]);
		header('Location: form.php');
		$_SESSION['name']='';
		$_SESSION['lastname']='';
		$_SESSION['email']='';
		$_SESSION['telephone']='';
	}
	public function email($str){
		return preg_match('/^\w+@[A-Za-z]+\.+[A-Za-z]+$/', $str);
	}
	public function telephone($str){
		return preg_match('/^(\+79|89)\d{9}$/', $str);
	}
	public function name($str){
		return preg_match('/^[А-ЯЁ]{1}[а-яё]+$/', $str);
	}
	public function __construct(){
		if($this->check()){
			$this->read();
			$this->write_bd(); 
		}
	}
	public function check(){
		if ($_POST){
			foreach ($_POST as $i=>$value){
				$_SESSION[$i]=$value;
			}
      		foreach ($_POST as $i=>$value){
        		if (!isset($value) or $value=='' or count($_POST)<6){
          			echo 'Вы ввели не все данные'.'<br>';
          			return false;
        		}
      		}
      		if ($this->email($_SESSION['email'])==0){
      			echo 'Введите электронный адрес корректно';
        		return false;
      		}
      		if ($this->telephone($_SESSION['telephone'])==0){
      			echo 'Введите номер телфеона в формате +79991234566';
        		return false;
      		}
      		/if ($this->name($_SESSION['name'])==0){
      			echo 'Введите имя корректно (с заглавной буквы)';
        		return false;
      		}
      		if ($this->name($_SESSION['lastname'])==0){
      			echo 'Введите фамилию корректно (с заглавной буквы)';
        		return false;
      		}
      		return true;
      	}else{
			$_SESSION['name']='';
			$_SESSION['lastname']='';
			$_SESSION['email']='';
			$_SESSION['telephone']='';
			return false;
		}
	}
	private function read(){
		foreach ($_POST as $i=>$value){
			$this->name=$_POST['name'];
     		$this->lastname=$_POST['lastname'];
      		$this->email=$_POST['email'];
      		$this->telephone=$_POST['telephone'];
      		$this->topic=$this->topics[$_POST['topic']];
      		$this->pay=$this->paymethod[$_POST['pay']];
      		$this->date=date("Y-m-d-H:i:s");
      		$this->ip=$_SERVER['REMOTE_ADDR'];
      	} 
	}
}
