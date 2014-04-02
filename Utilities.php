<?php
#═══════════════════════════════════════════════════════════════════════════════
# [work]
# Nexocentric Studios Site (defines)
# [copyright]
# (c) 2014 Dodzi Y. Dzakuma (http://www.nexocentric.com)
# See LICENSE file for more information.
# [summary]
# This is the bootstrap file that should be included by every PHP file
# in this site. Without this file, most of the files will not run.
#═══════════════════════════════════════════════════════════════════════════════

#───────────────────────────────────────────────────────────────────────────────
# Script Settings
#───────────────────────────────────────────────────────────────────────────────

#───────────────────────────────────────────────────────────────────────────────
# Script Settings
#───────────────────────────────────────────────────────────────────────────────
class Utilities
{
	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# This function checks if a superglobal parameter is set in
	# specified superglobal. If no superglobal is specified this
	# function will check the $_REQUEST superglobal by default.
	# [parameters]
	# 1) parameter name to check
	# 2) value to return if not set (optional)
	# 3) name of superglobal array to search (optional)
	# [return]
	# 1) the value of spefcified parameter
	# 2) the default value if specified parameter doesn't exist
	# 3) null if no default value spcified
	#===========================================================
	public static function checkRequest(
		$variableName, 
		$defaultValue = "", 
		$functionName = ""
	) {
		$superglobalArray = null;
		if (stripos($functionName, "get") !== false) {
			$superglobalArray = &$_GET;
		} else if (stripos($functionName, "files") !== false) {
			$superglobalArray = &$_FILES;
			if (!isset($superglobalArray[$variableName]['tmp_name'])) {
				return ($defaultValue ? $defaultValue : null);
			}
		} else if (stripos($functionName, "post") !== false) {
			$superglobalArray = &$_POST;
		} else if (stripos($functionName, "cookie") !== false) {
			$superglobalArray = &$_COOKIE;
		} else if (stripos($functionName, "session") !== false) {
			$superglobalArray = &$_SESSION;
		} else{
			$superglobalArray = &$_REQUEST;
		}
	 
		#
		if (!isset($superglobalArray[$variableName])) {
			return ($defaultValue ? $defaultValue : null);
		}
		return $superglobalArray[$variableName];
	}

	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# This function checks if a parameter is set in the 
	# $_COOKIE superglobal array.
	# [parameters]
	# 1) parameter name to check
	# 2) value to return if not set (optional)
	# [return]
	# 1) the value of spefcified parameter
	# 2) the default value if specified parameter doesn't exist
	# 3) null if no default value specified parameter 
	#    doesn't exist
	#===========================================================	 
	public static function checkCookie($variableName, $defaultValue = "")
	{
		return self::checkRequest($variableName, $defaultValue, __FUNCTION__);
	}

	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# This function checks if a parameter is set in the 
	# $_POST superglobal array.
	# [parameters]
	# 1) parameter name to check
	# 2) value to return if not set (optional)
	# [return]
	# 1) the value of spefcified parameter
	# 2) the default value if specified parameter doesn't exist
	# 3) null if no default value specified parameter 
	#    doesn't exist
	#===========================================================
	public static function checkPost($variableName, $defaultValue = "")
	{
		return self::checkRequest($variableName, $defaultValue, __FUNCTION__);
	}
	
	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# This function checks if a parameter is set in the 
	# $_FILES superglobal array.
	# [parameters]
	# 1) parameter name to check
	# 2) value to return if not set (optional)
	# [return]
	# 1) the value of spefcified parameter
	# 2) the default value if specified parameter doesn't exist
	# 3) null if no default value specified parameter 
	#    doesn't exist
	#=========================================================== 
	public static function checkFiles($variableName, $defaultValue = "")
	{
		return self::checkRequest($variableName, $defaultValue, __FUNCTION__);
	}
	
	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# This function checks if a parameter is set in the 
	# $_GET superglobal array.
	# [parameters]
	# 1) parameter name to check
	# 2) value to return if not set (optional)
	# [return]
	# 1) the value of spefcified parameter
	# 2) the default value if specified parameter doesn't exist
	# 3) null if no default value specified parameter 
	#    doesn't exist
	#===========================================================
	public static function checkGet($variableName, $defaultValue = "")
	{
		return self::checkRequest($variableName, $defaultValue, __FUNCTION__);
	}

	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# This function checks if a parameter is set in the 
	# $_SESSION superglobal array.
	# [parameters]
	# 1) parameter name to check
	# 2) value to return if not set (optional)
	# [return]
	# 1) the value of spefcified parameter
	# 2) the default value if specified parameter doesn't exist
	# 3) null if no default value specified parameter 
	#    doesn't exist
	#===========================================================
	public static function checkSession($variableName, $defaultValue = "")
	{
		return self::checkRequest($variableName, $defaultValue, __FUNCTION__);
	}

	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# Compresses a string using gzencode and then encodes the
	# string from digital transmission.
	# [parameters]
	# 1) string to compress
	# [return]
	# 1) the compressed string
	#===========================================================
	public static function compressString($string)
	{
		return base64_encode(gzencode($string, 9));
	}

	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# Decodes a string used for digital transmission then
	# decompresses it.
	# [parameters]
	# 1) a base64 encoded gzencoded string
	# [return]
	# 1) a decompressed string
	#===========================================================
	public static function decompressString($string)
	{
		return gzdecode(base64_decode($string));
	}
	
	#===========================================================
	# [author]
	# Dodzi Y. Dzakuma
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function inArray($needle, $haystack, $strict = true)
	{
		foreach ($haystack as $item) {
			if (
				($strict ? $item === $needle : $item == $needle) || 
				(is_array($item) && inArray($needle, $item, $strict)) 
			) {
				return true;
			}
		}
		return false;
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function isMultidimensional($array)
	{
		if (count($array) == count($array, COUNT_RECURSIVE)) {
			return false;
		}
		return true;
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function scanDirectoryForFiles($workingDirectory, $acceptableExtension = "", $sortDescending = false) 
	{
		$scannedDirectory = scandir($workingDirectory, (int)$sortDescending);
		$fileList = array();
		
		foreach ($scannedDirectory as $file) {
			//current and parent directories shouldn't be included
			if ($file === '.' || $file === '..') {
				continue;
			}
			if (!empty($acceptableExtension)) {
				$fileInfo = pathinfo("$workingDirectory/$file");
				//file has no extension or the extension doesn't match'
				if (!isset($fileInfo['extension']) || strtolower($fileInfo['extension']) != $acceptableExtension) {
					continue;
				}
			}
			
			if (is_file("$workingDirectory/$file")) {
				$fileList[basename("$workingDirectory/$file")] = "$workingDirectory/$file";
			}
			if (is_dir("$workingDirectory/$file")) {
				$fileList[basename("$workingDirectory/$file")] = "$workingDirectory/$file";
				$subDirectories = scanDirectoryForFiles("$workingDirectory/$file");
				$fileList = array_merge($fileList, $subDirectories);
			}
		}
		return $fileList;
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function implodeRecursive($glue, $array)
	{
		$parsedString = "";
		
		foreach ($array as $item) {
			if (is_array($item)) {
				$parsedString .= implodeRecursive($glue, $array) . $glue;
			} 
			else {
				$parsedString .= $item . $glue;
			}
		}
		$parsedString = substr($parsedString, 0, 0 - strlen($glue));
		return $parsedString;
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function includeFile($fileName)
	{
		//saftey check
		// require_once("DirectoryTree.php");
		// $directoryTree = new DirectoryTree(getcwd());
		// $file = $directoryTree->getFilePath("${fileName}.php");
		// $readable = $directoryTree->checkFilePermissions($file);
		// if (!$readable) {
		// 	return "erorr!";
		// }
		// include_once($file);
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function callFromString($functionName, $argumentsArray = "")
	{
		//safety check
		if ($argumentsArray == "" && is_array($argumentsArray) == false) {
			return;
		}
		
		//initializations
		$parsedArguments = implode(", ", $argumentsArray);
		return call_user_func($functionName, $parsedArguments);
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function convertToArray($arrayExpected)
	{
		if (!is_array($arrayExpected)) {
			$arrayExpected = array($arrayExpected);
		}
		return $arrayExpected;
	}

	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function formatUnderscoresCaps($originalString, $capsFirstLetters = true)
	{				
		$formattedString = str_replace("_", " ", $originalString);
		if ($capsFirstLetters) {
			$formattedString = ucwords($formattedString);
		}
		return $formattedString;
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function trueStrict($parameter = false)
	{
		//objects will cause an error so safty check
		if (is_object($parameter)) {
			return false;
		}
		
		//actual evaluation
		if (is_integer($parameter)) {
			return false;
		}
		return $parameter == 1;
	}
	
	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function falseStrict($parameter)
	{	
		if (is_null($parameter)) {
			return true;
		}
		return $parameter;
	}
	
	public static function inspect($label, $val = "__undefin_e_d__")
	{
		if ($val == "__undefin_e_d__") {

			$val = $label;

			$bt = debug_backtrace();
			$src = file($bt[0]["file"]);
			$line = $src[ $bt[0]['line'] - 1 ];

			// let's match the function call and the last closing bracket
			preg_match("#watchVariable\((.+)\)#", $line, $match);

			/* let's count brackets to see how many of them actually belongs 
			   to the var name
			   Eg:   die(inspect($this->getUser()->hasCredential("delete")));
					  We want:   $this->getUser()->hasCredential("delete")
			*/
			$max = strlen($match[1]);
			$varname = "";
			$c = 0;
			for($i = 0; $i < $max; $i++){
				if (    $match[1]{$i} == "(") $c++;
				elseif ($match[1]{$i} == ")") $c--;
				if ($c < 0) break;
				$varname .=  $match[1]{$i};
			}
			$label = $varname;
		}
	}

	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function flattenArray(array $array) {
		$return = array();
		array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
		return $return;
	}

	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function htmlPrintf($string)
	{
		printf("<p>${string}</p>");
	}

	#===========================================================
	# [author]
	# Dzakuma, Dodzidenu
	# [summary]
	# [parameters]
	# [return]
	#===========================================================
	public static function now($str_user_timezone,
		$str_server_timezone = CONST_SERVER_TIMEZONE,
		$str_server_dateformat = CONST_SERVER_DATEFORMAT) {
		define('CONST_SERVER_TIMEZONE', 'UTC');
 
	/* server dateformat */
	define('CONST_SERVER_DATEFORMAT', 'YmdHis');
		// set timezone to user timezone
		date_default_timezone_set($str_user_timezone);

		$date = new DateTime('now');
		$date->setTimezone(new DateTimeZone($str_server_timezone));
		$str_server_now = $date->format($str_server_dateformat);

		// return timezone to server default
		date_default_timezone_set($str_server_timezone);

		return $str_server_now;
	}
}

#───────────────────────────────────────────────────────────────────────────────
# Script Settings
#───────────────────────────────────────────────────────────────────────────────
class Pair
{
	public function __construct()
	{
		
	}
}

#───────────────────────────────────────────────────────────────────────────────
# Script Settings
#───────────────────────────────────────────────────────────────────────────────	
define("NDS_TIMER_MILLISECONDS", "NDS_TIMER_MILLISECONDS");
define("NDS_TIMER_SECONDS", "NDS_TIMER_SECONDS");
define("NDS_TIMER_MINUTES", "NDS_TIMER_MINUTES");
class Timer
{
	private $runTime;
	private $startTime;
	private $endTime;
	
	public function __construct()
	{
		$this->startTime = new DateTime();
	}
	
	public function finish()
	{
		return $this->runTime;
	}
}

class DatabaseInterface
{
	private $databaseHandle = null;
	private $hostname = null;
	private $databaseName = null;
	private $username = null;
	private $password = null;
	private $statementHandle = null;
	
	public function __construct($hostname, $databaseName, $username, $password)
	{
		$this->hostname = $hostname;
		$this->databaseName = $databaseName;
		$this->username = $username;
		$this->password = $password;
	}

	public function initialize($databaseType = "mysql")
	{
		#-------------------------------
		# initializations
		#-------------------------------
		$hostname = $this->hostname;
		$databaseName = $this->databaseName;
		$username = $this->username;
		$password = $this->password;

		try {
			# MySQL with PDO_MYSQL
			$this->databaseHandle = new PDO(
				"$databaseType:host=$hostname;dbname=$databaseName", 
				$username, 
				$password
			);
			$this->databaseHandle->setAttribute(
				PDO::ATTR_ERRMODE, 
				PDO::ERRMODE_WARNING
			);
		}
		catch (PDOException $e) {
			printf("<p>Fail!</p>");
			$this->databaseHandle = null;
			echo $e->getMessage();
			return false;
		}
		return true;
	}

	public function prepareStatement($statement)
	{
		#-------------------------------
		# initializations
		#-------------------------------
		$databaseHandle = $this->databaseHandle;
		$statementHandle = null;
		
		#-------------------------------
		# safety check
		#-------------------------------
		if (is_null($databaseHandle)) {
			return false;
		}

		#-------------------------------
		# prepare the statement
		#-------------------------------
		$statementHandle = $databaseHandle->prepare($statement);
		if (!is_object($statementHandle)) {
			# failure
			return false;
		}

		#-------------------------------
		# save the statement handle
		#-------------------------------
		$this->statementHandle = $statementHandle;
		return true;
	}

	public function executeQuery($boundParameters = null)
	{
		#-------------------------------
		# initializations
		#-------------------------------
		$databaseHandle = $this->databaseHandle;
		$statementHandle = $this->statementHandle;
		# all parameters need to be arrays
		if (!is_null($boundParameters) && !is_array($boundParameters)) {
			$boundParameters = (array)$boundParameters;
		}

		#-------------------------------
		# safety check
		#-------------------------------
		if (is_null($databaseHandle) || is_null($statementHandle)) {
			return false;
		}

		#-------------------------------
		# run the query
		#-------------------------------
		$results =  $statementHandle->execute();
		$this->statementHandle = null;
		return $results;
	}
}

#═══════════════════════════════════════════════════════════════════════════════
# [work]
# Nexocentric Studios Site (defines)
# [copyright]
# (c) 2014 Dodzi Y. Dzakuma (http://www.nexocentric.com)
# See LICENSE file for more information.
# [summary]
# This is the bootstrap file that should be included by every PHP file
# in this site. Without this file, most of the files will not run.
#═══════════════════════════════════════════════════════════════════════════════