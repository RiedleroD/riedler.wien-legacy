<?php
$id=$_GET["id"];
$fn=$_GET["fn"];
$fext=$_GET["ext"];
$err=NULL;
if($id==NULL or $fn==NULL or $fext==NULL){
	$err="Missing parameters: at least id, fn and ext are required.";
}else{
	$json=file_get_contents("../data.json");
	$data=json_decode($json,true);
	if(array_key_exists($id,$data)){
		$track=$data[count($data)-$id-1];
		$lnks=$track[5];
		if(array_key_exists("dl",$lnks)){
			if(array_key_exists($fn,$lnks["dl"])){
				if(in_array($fext,$lnks["dl"][$fn])){
					$fp="../HosenToastKönig/".$fn.'.'.$fext;
					$fs=filesize($fp);
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
					}else{
						$err="File $fn.$fext is empty or doesn't exists";
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
