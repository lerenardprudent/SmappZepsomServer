<?php header("Content-type: text/html; charset=utf-8");

	// what it does: repairs the activity descriptiond

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
	$database = "zepsom_smapp";
	$username="zepsom_trksft";
	$password = "tr3ks0ft";
	
	
	@mysql_connect($localhost, $username, $password);
	@mysql_query("SET NAMES 'utf8'");
	@mysql_select_db($database);		// or die ("-er-sql-" . mysql_error());

	$querySQL = "update activity set description = 'ASSIGNÉ RECRUTEUR' where pstep = 'REC' and pstatus = 'ACT'"; 
	$resultx = @mysql_query($querySQL);		// or die ("-er-sql-" . mysql_error());
	$querySQL = "update activity set description = 'RECRUTEMENT' where pstep = 'REC' and pstatus != 'ACT'"; 
	$resultx = @mysql_query($querySQL);		// or die ("-er-sql-" . mysql_error());
	$querySQL = "update activity set description = 'ASSIGNÉ INTERVIEWER' where pstep = 'INT' and pstatus = 'ACT'"; 
	$resultx = @mysql_query($querySQL);		// or die ("-er-sql-" . mysql_error());
	$querySQL = "update activity set description = 'INTERVIEW (QUESTIONNAIRE)' where pstep = 'INT' and pstatus != 'ACT'"; 
	$resultx = @mysql_query($querySQL);		// or die ("-er-sql-" . mysql_error());
		
	@mysql_close();
?>