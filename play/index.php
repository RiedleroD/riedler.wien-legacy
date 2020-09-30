<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<?php
		$id=$_GET["id"];
		if($id==NULL){
			$title="Play: Nothing";
			$track=NULL;
		}else{
			$json=file_get_contents("../data.json");
			$data=json_decode($json);
			if(array_key_exists($id,$data)){
				$track=$data[count($data)-$id-1];
				$title="Play: ".$track[1];
			}else{
				$track=NULL;
				$title="Play: Invalid";
			}
		}
		echo "<title>$title</title>";
		?>
		<link rel="icon" type="image/png" href="/favicon.png"/>
		<style>
			#prev,
			#nxt,
			#home{
				position:absolute;
				top:0.2em;
				background:linear-gradient(to bottom,#444 0%,#333 10%,#222 100%);
				padding:0.2em;
				border-radius:0.2em;
				color:#FFF;
				text-decoration:none;}
			#prev:hover,
			#nxt:hover,
			#home:hover{
				background:linear-gradient(to bottom,#454545 0%,#353535 10%,#252525 100%);}
			#prev{
				left:0.2em;}
			#nxt{
				right:0.2em;}
			#home{
				left:50%;
				transform:translate(-50%,0);}
			:root{
				background-color:#000;
				color:#FFF;}
			body{
				margin:0;
				margin-top:2em;
				padding:0.2em;
				padding-bottom:0.1em;
				background:linear-gradient(to bottom,#000 0em,#333 0.2em,#333 calc(100% - 0.2em),#000 100%);}
			button:hover{
				cursor:pointer;/*because it isn't by standard for some reason*/}
			iframe{
				padding-right:0.2em;}
			iframe.invers{
				filter:invert(1) hue-rotate(180deg) brightness(0.6) saturate(1.5);}
			.wtyp{
				background-color:#FFF;
				padding:0.2em;
				border:none;
				border-radius:0.2em;
				color:#EEE;
				text-decoration:none;}
			.o{
				background-color:#383;}
			.r{
				background-color:#AA0;}
			.rcomm{
				background-color:#C60;}
			.ocomm{
				background-color:#638;}
			.comment{
				font-style:italic;
				margin-top:0.2em;
				margin-bottom:0.5em;
				color:#AAA;}
			a:link,
			a:visited{
				color:#418BA4;}
			a:link:hover,
			a:visited:hover{
				color:#6AC;}
			a.btn{
				height:2em;
				display:inline-block;
				padding-right:0.2em;}
			a.btn.yt{
				content:url("/sfto/youtube.svg");}
			a.btn.lmms{
				content:url("/sfto/lmms.svg");}
			a.btn.sc{
				content:url("/sfto/soundcloud.svg");}
			a.btn.bl{
				content:url("/sfto/bandlab.svg");}
			a.btn.rw{
				content:url("/favicon.svg");}
			a.btn.dl{
				content:url("/sfto/download.svg");}
		</style>
	</head>
	<body>
		<?php
		if($id==NULL){
			echo "<p>No id specified</p>";
		}else if($track==NULL){
			echo "<p>Invalid id specified</p>";
		}else{
			$work=[
				"r" => "Riedlerfiziert",
				"o" => "Original",
				"rcomm" => "Riedlerfiziert",
				"ocomm" => "Commission"];
			$nxt=$id+1;
			$prv=$id-1;
			if(array_key_exists($prv,$data)){
				echo "<a id='prev' href='./?id=$prv'>← Previous</a>";
			}
			echo "<a id='home' href='../'>↑ Up ↑</a>";
			if(array_key_exists($nxt,$data)){
				echo "<a id='nxt' href='./?id=$nxt'>Next →</a>";
			}
			$wtyp=$track[0];
			echo "<a style='font-size:2em;font-variant:petite-caps'>$track[1]</a> <a class='wtyp $wtyp'>$work[$wtyp]</a> <sub>$track[4]</sub><br/>";
			if($track[3]){
				echo "<sub>Requested by $track[3]</sub><br/>";
			}
			if(array_key_exists(6,$track)){#checks if a comment is present & puts it if it is
				echo "<p class=\"comment\">$track[6]</p>";
			}else{
				echo "<br/>";
			}
			foreach($track[5] as $type => $lnk){
				if($type=="yt"){
					echo "<iframe width=\"560\" height=\"315\" src=\"https://www.youtube-nocookie.com/embed/$lnk\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
				}else if ($type=="sci"){
					echo "<button onclick=\"document.getElementById('scl').outerHTML='<iframe class=\\'invers\\' width=\\'560\\' height=\\'180\\' scrolling=\\'no\\' frameborder=\\'no\\' src=\\'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/$lnk&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true\\'></iframe>'\" id=\"scl\">Soundcloud – Open if you want cookies only</button>";
				}else if ($type=="bli"){
					echo "<iframe class=\"invers\" width=\"560\" height=\"315\" src=\"https://www.bandlab.com/embed/?id=$lnk&blur=true\" frameborder=\"0\" allowfullscreen></iframe>";
				}
			}
			echo "<br/>";
			foreach($track[5] as $type => $lnk){
				if($type=="yt"){
					echo "<a class=\"btn yt\" href=\"https://youtu.be/$lnk\"></a>";
				}else if($type=="lmms"){
					echo "<a class=\"btn lmms\" href=\"https://lmms.io/lsp/?action=show&file=$lnk\"></a>";
				}else if ($type=="sc"){
					echo "<a class=\"btn sc\" href=\"https://soundcloud.com/riedler-musics/$lnk\"></a>";
				}else if ($type=="bl"){
					echo "<a class=\"btn bl\" href=\"https://www.bandlab.com/riedler/$lnk\"></a>";
				}if($type=="dl"){
					echo "<a class=\"btn dl\" title=\"$lnk\" href=\"../download/?id=$id\"></a>";
				}
			}
		}
		?>
	</body>
</html>
