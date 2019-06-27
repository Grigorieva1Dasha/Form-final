<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Form</title>
    <link href="css/view.css" rel="stylesheet">
</head>
<body>
	<center>
		<h1>Форма регистрации на конферецию</h1>
	</center>
	<?php
	include('classRegistration.php');
	$r = new Registration();
	?>
	<center>
		<form method="POST" class="form">
        	<p><input class="input" placeholder="Имя" type="text" name="name" value = "<?= isset($_POST['name']) ? $_POST['name']: ''?>" required></p>
        	<p><input class="input" placeholder="Фамилия" type="text" name="lastname" value = "<?= isset($_POST['lastname']) ? $_POST['lastname']: ''?>" required></p>
        	<p><input class="input" placeholder="Электронный адрес" type="email" name="email" value = "<?= isset($_POST['email']) ? $_POST['email']: ''?>" required></p>
        	<p><input class="input" placeholder="Номер телефона" type="text" name="telephone" value = "<?= isset($_POST['telephone']) ? $_POST['telephone']: ''?>" required></p>
        	<p>Тематика конференции</p>
        	<select name="topic" class="input"> 
            	<optgroup> 
                	<option value="1">Бизнес</option> 
                	<option value="2">Технологии</option>
                	<option value="3">Реклама и Маркетинг</option>
            	</optgroup>
        	</select>
        	<p>Вариант оплаты</p>
        	<select name="pay" class="input"> 
            	<optgroup> 
                	<option value="1">WebMoney</option> 
                	<option value="2">Яндекс.Деньги</option>
                	<option value="3">PayPal</option>
                	<option value="4">Кредитная карта</option>
            	</optgroup>
        	</select>
        	<p><input type="submit" value="Отправить" class="button"></p>
    	</form>
    	<form action="admin.php" class="formbutton">
        	<p><input type="submit" value="Администратор" class="button"></p>
    	</form>
	</center>
    
</body>
</html>
