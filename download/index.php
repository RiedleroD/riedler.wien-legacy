<?php
$id=$_GET["id"];
$fn=$_GET["fn"];
$fext=$_GET["ext"];
$err=NULL;
if($id==NULL or $fn==NULL or $fext==NULL){
	$err="Missing parameters: at least id, fn and ext are required.";
}else{
	chdir("../");
	function get_data($fn){
		GLOBAL $CONF;
		$json=file_get_contents($CONF["data_dir"].$fn.".json");
		return json_decode($json,true);
	}
	$CONF=array("data_dir"=>"./");
	$CONF=get_data("conf");
	$data=get_data("data");
	if(array_key_exists($id,$data)){
		$track=$data[count($data)-$id-1];
		$lnks=$track[5];
		if(array_key_exists("dl",$lnks)){
			if(array_key_exists($fn,$lnks["dl"])){
				if(in_array($fext,$lnks["dl"][$fn])){
					$fp=$CONF["dl_dir"].$fn.'.'.$fext;
					$fs=-1;
					if(file_exists($fp)){
						$fs=filesize($fp);
					}else if(preg_match("/^(https?|ftp)\:\/\//i", $fp)){
						header("Location: $fp");
						exit();
					}else{
						$err="File not found";
					}
					if($fs>0){
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename="'.$lnks[$dlt].'"');
						header('Expires: 0');
						header('Cache-Control: must-revalidate');
						header('Pragma: public');
						header('Content-Length: '.$fs);
						flush();
						readfile($fp);
					}else if($fs==0){
						$err="File $fn.$fext is empty";
					}
				}else{
					$err="File $fn in track $id doesn't have an .$fext extension.</span><br/><span>Existing extensions include .".implode($lnks["dl"][$fn],", .");
				}
			}else{
				$err="Filename \"$fn\" doesn't exist in track $id</span><span><br/><span>Existing filenames include \"".implode(array_keys($lnks["dl"]),"\", \"")."\"";
			}
		}else{
			$err="Track $id has no downloads defined";
		}
	}else{
		$err="Track $id doesn't exist";
	}
}
if($err!=NULL){
	echo "<html><head></head><body><span style=\"color:red\"><b>ERROR:</b> $err</span><body></html>";
}
?>
