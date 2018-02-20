<?php
require "rb-mysql.php";

R::setup('mysql:host=127.0.0.1;dbname=rb_test', 'root', '');

if( !R::testConnection()){
	exit('Нет подключения к БД');
}
/*
$user = R::dispense('user');
$user -> username = 'root2';
$user -> password = '321';

R::store($user);*/


if(!isset($_COOKIE['user_id'])) {
	if(isset($_POST['submit'])) {
		$user_username = substr(htmlspecialchars(trim($_POST['username'])), 0, 100);
		$user_password = substr(htmlspecialchars(trim($_POST['password'])), 0, 50);

		if(!empty($user_username) && !empty($user_password)) {

			$users = R::find('user', 'username = ? AND password = ?', [$user_username, $user_password]);
			$data = R::count('user','username = ? AND password = ?', [$user_username, $user_password]);
			if( $data == 1) {
				foreach($users as $user){
				setcookie('user_id', $user->id, time() + (60*60*24*30));
				setcookie('username', $user->username, time() + (60*60*24*30));
				$home_url = 'http://' . $_SERVER['HTTP_HOST'];
				header('Location: '. $home_url);
				}
			}
			else {
				echo 'Извините, вы должны ввести правильные имя пользователя и пароль';
			}
		}
		else {
			echo 'Извините вы должны заполнить поля правильно';
		}
	}
}

?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<label for="username">Логин:</label>
	<input type="text" name="username">
	<label for="password">Пароль:</label>
	<input type="password" name="password">
	<button type="submit" name="submit">Вход</button>
	<a href="signup.php">Регистрация</a>
	</form>