<?php

namespace MyWebsite\Controllers\User\SignInOperation;

require_once('src/model/user.php');

use MyWebsite\Lib\Database\DatabaseConnection;
use MyWebsite\Model\User\UserRepository;

/**
 * class that allows to sign in
 */
class SignInOperation{

	/**
     * function that allows to sign in
     * 
     * @param array $input get the form inputs
     * @throws exception if forms data are invalid or if the password is wrong compared to the one saved in the database
     */
	public function execute(array $input) : void
	{
		$name = null;
		$email = null;
		$password = null;

		if(!empty($input['email']) && !empty($input['password'])) {
			$email = htmlspecialchars($input['email']);
			$password = htmlspecialchars($input['password']);

		} else {
			header('Location: index.php?action=signin&err=wrong');
		}

		$userRepository = new UserRepository();
		$userRepository->connection = new DatabaseConnection();
		if($userRepository->doesUserExist($email)) {
			$user = $userRepository->connectUser($email, $password);
			
			if(!$user) {
				header('Location: index.php?action=signin&err=error');
			} else {
				$_SESSION['user'] = $user['name'];
				$_SESSION['user_email'] = $user['email'];
				$_SESSION['user_admin'] = $userRepository->isAdmin($email);
				header('Location: index.php');
			}
		} else {
			header('Location: index.php?action=signin&err=unknown');
		}
	}
}
