<?php
	class File
	{
		
		public static function uniqueFileName($fileName)
		{
			$filename  = basename($fileName);
			$extension = pathinfo($filename, PATHINFO_EXTENSION);

			date_default_timezone_set('Africa/Lagos');
			$date = new DateTime();

			return $date->getTimeStamp() . rand(10000,99999);
		}
}