<?php 

/**
* 
*/
class CabinetController
{
	
	public function actionIndex()
	{
		$userId = User::checkLogged();

		// echo $userId;

		$user = User::getUserById($userId);

		require_once(ROOT . '/views/cabinet/index.php');

		return true;
	}
}