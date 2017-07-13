<?php

	session_start();

	require_once 'include/sqAES.php';
	require_once 'include/JCryption.php';

	function login($data)
	{
		if (!isset($data['username']) || empty($data['username']))
		{
			echo 0;
			exit();
		}

		if (!isset($data['password']) || empty($data['password']))
		{
			echo 0;
			exit();
		}

		if ($data['username'] == "admin" && $data['password'] == "password")
		{
			session_regenerate_id(true);
			$_SESSION['LoggedIn'] = 1;
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	function logout()
	{
		$_SESSION = array();
		session_destroy();
		echo 1;
	}

	function getData()
	{
		if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1)
		{
			printf("%s", (isset($_SESSION['data']) && !empty($_SESSION['data'])) ? $_SESSION['data'] : 1);
		}
		else
		{
			echo 0;
		}
	}

	function setData($data)
	{
		if (isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == 1)
		{
			if (isset($data['data']) && !empty($data['data']))
			{
				$_SESSION['data'] = $data['data'];
				echo $_SESSION['data'];
			}
			else
			{
				echo 1;
			}
		}
		else
		{
			echo 0;
		}
	}

	$request = array();

	if (!empty($_POST))
	{
		JCryption::decryptPost();
		$request = $_POST;
	}
	else if (!empty($_GET))
	{
		JCryption::decryptGet();
		$request = $_GET;
	}

	if (!empty($request))
	{
		if (isset($request['action']))
		{
			$action = $request['action'];

			switch($action)
			{
				case 'login' : login($request); break;
				case 'logout' : logout(); break;
				case 'getData' : getData(); break;
				case 'setData' : setData($request); break;
			}
		}
	}

?>
