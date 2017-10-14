
        <?php
        
        $isCommandLine = commandLineCheck();
        $currentDir = __DIR__;
        
        function printDirectory(string $directory, string $displayType, int $level= 0) {
		if ($displayType === "console") {
                    echo str_repeat("\t", $level).$directory."\n";
		}
		else {
                    $margin = 40 * $level;
                    echo "<p style=\"margin-left: ".$margin."px\">".$directory."</p>";
		}
	}
        
	function commandLineCheck() {
                $sapi = php_sapi_name();
                if (($sapi=='cli') || (substr($sapi,0,3)=='cgi')){
                    $displayType = "console";
                }
                else {
                    $displayType = "browser";
                }
		return $displayType;
	}
	
	function search(string $currentDir, string $displayType, int $level = 1) {
		$files = array_diff(scandir($currentDir),array(".",".."));
		foreach ($files as $value) {
			$newDirectory = $currentDir."/".$value;
			if (is_dir($newDirectory)) {
				printDirectory($newDirectory, $displayType, $level);
				search($newDirectory, $displayType, $level+1);
			}
			else {
				printDirectory($newDirectory, $displayType, $level);
			}
		}
	}
	printDirectory($currentDir, $isCommandLine);
	search($currentDir, $isCommandLine);
