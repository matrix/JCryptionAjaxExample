<?php

	session_start();

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

	$keyLength = 1024;
   $jCryption = new jCryption();

	if(isset($_GET["generateKeypair"]))
	{
		require_once 'include/100_1024_keys.inc.php';
		$keys = $arrKeys[mt_rand(0, 100)];

		$_SESSION["e"] = array("int" => $keys["e"], "hex" => $jCryption->dec2string($keys["e"],16));
		$_SESSION["d"] = array("int" => $keys["d"], "hex" => $jCryption->dec2string($keys["d"],16));
		$_SESSION["n"] = array("int" => $keys["n"], "hex" => $jCryption->dec2string($keys["n"],16));

		echo '{"e":"'.$_SESSION["e"]["hex"].'","n":"'.$_SESSION["n"]["hex"].'","maxdigits":"'.intval($keyLength*2/16+3).'"}';
	}
	else if (isset($_GET["handshake"]))
	{
		$key = $jCryption->decrypt($_POST['key'], $_SESSION["d"]["int"], $_SESSION["n"]["int"]);

		unset($_SESSION["e"]);
		unset($_SESSION["d"]);
		unset($_SESSION["n"]);
		$_SESSION["key"] = $key;

		echo json_encode(array("challenge" => AesCtr::encrypt($key, $key, 256)));
	}
	else
	{
		$request = array();

		if (!empty($_POST))
		{
			$tmp = AesCtr::decrypt($_POST['jCryption'], $_SESSION["key"], 256);
			parse_str($tmp, $request);
		}
		else if (!empty($_GET))
		{
			$tmp = AesCtr::decrypt($_GET['jCryption'], $_SESSION["key"], 256);
			parse_str($tmp, $request);
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
	}

?>
