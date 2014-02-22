<?php header("Content-type: text/html; charset=utf-8");


	function fix_apos($needle, $replace, $haystack)
	{
		for ($i=0; $i < strlen($haystack); $i++)
		{
			if ($haystack["$i"] == $needle)
			{
				$haystack = substr_replace($haystack, $replace, $i, strlen($needle));
				$i++;
			}
		}
		return $haystack;
	}

	$pvarx = "";
	$trows = 0;
		/*
		$database = "treksoft_smapp";
		$username="treksoft_trksft";
		$password = "tr3ks0ft";
		*/
		$database = "zepsom_zeps";
		$username="zepsom_trksft";
		$password = "tr3ks0ft";
		
		@mysql_connect($localhost, $username, $password);
		@mysql_query("SET NAMES 'utf8'");
		@mysql_select_db($database);		// or die ("-er-sql-" . mysql_error());

		$querySQL = "select id from users";
		$resultu = @mysql_query($querySQL);		 //or die ("-er-sql-" . mysql_error());
		if ($resultu)
		{
			echo "Working ...";
			echo "<br/>";
			while ($row = mysql_fetch_array($resultu))
			{
				$iid = $row[id];
				$querySQL = "select distinct idusr, pphase from activity where idp='" .$iid. "' order by pphase desc";
				//$querySQL = "select distinct idusr from activity where idp='" .$iid. "' order by pphase desc";
				$result = @mysql_query($querySQL);		// or die ("-er-sql-" . mysql_error());
				if($result)
				{
					$a = "";
					while ($row = mysql_fetch_array($result))
					{
						$a = $a . $row[idusr] . "_" . $row[pphase] . " ";
						//$a = $a . $row[idusr] . " ";
					}
					if ($a == " ") { $a = ""; }
					if ($a != "")
					{
						$querySQL = "update users set cust8='" .$a. "' where id='" .$iid. "'";
						$resultx = @mysql_query($querySQL);		// or die ("-er-sql-" . mysql_error());
					}
				}
			}
		}
		echo "DONE";

	@mysql_close();
?>