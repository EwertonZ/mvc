<?php 

trait AuthService
{

	public function getAuthUserInstance()
	{
		return new UserModel();
	}

	public function verifySession()
	{

		if(!isset($_SESSION))
		{
			session_start();
		}
		if (isset($_SESSION) && !empty($_SESSION) && $_SESSION['AuthUser'] !== null) {
			return true;
		} else {
			return false;
		}		
	}

	public function verifyCredentials($user_email, $user_password)
	{
		if ($user_email == '' || $user_email == null || $user_password == '' || $user_password == null) {
			return false;
		} 
		
		$authUser = $this->getAuthUserInstance()->readByAtributes('user_email', $user_email, 'UserModel');
		if ($authUser->getUser_password() !== $user_password) {
			return false;
		} else {
			return $this->signIn($authUser);
		}		
	}

	public function signIn($authUser)
	{		
		if(!isset($_SESSION))
		{
			session_start();
		}
		$_SESSION['AuthUser'] = $authUser;			
		return true;
	}

}

?>