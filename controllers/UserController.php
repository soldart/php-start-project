<?php 

/**
* 
*/
class UserController
{
	public function actionRegister()
	{
		$name = '';
		$email = '';
		$password = '';
		$result = false;
		
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			if (!User::checkName($name)) {
				// echo '<br>$name ok';
				$errors[] = 'Имя не должно быть короче 2-х символов';
			}

			if (!User::checkEmail($email)) {
				// echo '<br>$email ok';
				$errors[] = 'Неправильный email';
			}

			if (!User::checkPassword($password)) {
				// echo '<br>$password ok';
				$errors[] = 'Пароль не должен быть короче 6-ти символов';
			}

			if (User::checkEmailExists($email)) {
				$errors[] = 'Такой email уже используется';
			}

			if ($errors == false) {
				$result = User::register($name, $email, $password);
			}

			// if (isset($name)) {
			// 	echo '<br>name: '.$name;
			// }
			// if (isset($email)) {
			// 	echo '<br>email: '.$email;
			// }
			// if (isset($password)) {
			// 	echo '<br>password: '.$password;
			// }
		}

		require_once(ROOT . '/views/user/register.php');

		return true;
	}

	public function actionLogin()
	{
		$email = '';
		$password = '';

		if (isset($_POST['submit'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			if (!User::checkEmail($email)) {
				$errors[] = "Неправильный email";
			}

			if (!User::checkPassword($password)) {
				$errors[] = "Пароль не должен быть короче 6-ти символов";
			}

			//Существует ли пользователь
			$userId = User::checkUserData($email, $password);

			if ($userId == false) {
				//Если данные неправильные - показываем ошибку
				$errors[] = 'Неправильные данные для входа на сайт';
			}else {
				//Если данные правильные, запоминаем пользователя (сессия)
				User::auth($userId);

				//Перенаправляем пользователя в закрытую часть - кабинет
				header("Location: /cabinet/");
			}
		}

		require_once(ROOT . '/views/user/login.php');

		return true;
	}

	// deleting users from session
	public function actionLogout()
	{
		// session_start();
		unset($_SESSION["user"]);
		header("Location: /");
	}
}