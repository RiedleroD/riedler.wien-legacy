<?php
$id=$_GET["id"];
$dlt=$_GET["dlt"];
if($id==NULL or $dlt==NULL){
	$track=NULL;
}else{
	$json=file_get_contents("../data.json");
	$data=json_decode($json,true);
	if(array_key_exists($id,$data)){
		$track=$data[count($data)-$id-1];
		$lnks=$track[5];
		if(array_key_exists($dlt,$lnks)){
			$filepath="../HosenToastKönig/".$lnks[$dlt];
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.$lnks[$dlt].'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: '.filesize($filepath));
			flush();
			readfile($filepath);
		}else{
			$track=NULL;
		}
	}else{
		$track=NULL;
	}
}
if($track==NULL){
	header('Location: ./notfound.php');
}
?>
