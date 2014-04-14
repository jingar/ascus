<?php

	function uniqueFileName()
	{
		$date = new DateTime();
		return $date->getTimeStamp() . rand(10000,99999);
	}
?>