<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<?php
		chdir("../");
		function get_data($fn){
			GLOBAL $CONF;
			$json=file_get_contents($CONF["data_dir"].$fn.".json");
			return json_decode($json,true);
		}
		if(array_key_exists("id",$_GET)){
			$id=$_GET["id"];
		}else{
			$id=NULL;
		}
		if($id==NULL){
			$title="Play: Nothing";
			$track=NULL;
		}else{
			$CONF=array("data_dir"=>"./");
			$CONF=get_data("conf");
			$data=get_data("data");
			if(array_key_exists($id,$data)){
				$track=$data[count($data)-$id-1];
				$title="Play: ".$track[1];
			}else{
				$track=NULL;
				$title="Play: Invalid";
			}
			$json=file_get_contents($CONF["data_dir"]."linking_data.json");
			$linking_data=json_decode($json,true);
		}
		echo "<title>$title</title>";
		?>
		<link rel="icon" type="image/svg" href="/favicon.svg"/>
		<style>
			/*scrollbar*/
			::-webkit-scrollbar,
			::-webkit-scrollbar-track-piece{
				background-color:#333 !important;}
			::-webkit-scrollbar-corner,
			::-webkit-scrollbar-thumb{
				background-color:#555 !important;}
			:root{/*Because Firefox doesn't have the ::-moz-scrollbar selectors*/
				scrollbar-width:thin;
				scrollbar-color:#555 #333;}
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
				font-family:sans-serif;
				background:linear-gradient(to bottom,#000 0em,#333 0.2em,#333 calc(100% - 0.2em),#000 100%);}
			button:hover{
				cursor:pointer;/*because it isn't by standard for some reason*/}
			iframe{
				border:none;
				width:49.5%;
				height:40vh}
			iframe:nth-child(2n){
				margin-right:1%;}
			/*single column on mobile*/
			@media(hover:none){
				iframe{
					width:100%;
					margin-right:0;
					height:25vh;
				}
			}
			iframe.invers{
				filter:invert(1) hue-rotate(180deg) brightness(0.6) saturate(1.5);}
			details{
				padding:0.5rem;
				margin:0 0.5rem;
				background-color:#222;
				box-shadow:0 0 0.1rem #222,inset 0.15rem 0.2rem 0.2rem -0.2rem #444,inset -0.15rem -0.2rem 0.2rem -0.2rem #151515;}
			summary{
				font-size:1.5rem;
				margin-left:0.25rem;
				cursor:pointer;}
			details[open]>summary{
				margin-bottom:0.25rem;}
			summary:focus-visible{
				outline:none;}
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
			a.btn.rw{
				content:url(<?php echo $CONF["root_dir"]."favicon.svg"; ?>);}
			a.btn.dl{
				content:url(<?php echo $CONF["root_dir"]."sfto/download.svg"; ?>);}
			<?php
				foreach($linking_data as $serviceid => $servicedata){
					echo "a.btn.$serviceid{content:url(\"".$CONF["icon_dir"]."$serviceid.svg\")}";
				}
			?>
			.verweis{
				display:flex;
				align-items:center;
				padding-bottom:0.2em;}
			.verweis>i{
				color:#AAA;
				font-size:0.75em;
				align-self:end;
				margin-left:0.3em;}
			/*hack to display both chrome and firefox audio players dark*/
			audio{
				filter:invert(0.9);}
			@-moz-document url-prefix(){
				audio{
					filter:none;}
			}
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
			$iframes="";
			foreach($track[5] as $type => $lnk){
				if($type=="yt"){
					$iframes.="<iframe src=\"https://www.youtube-nocookie.com/embed/$lnk\" allowfullscreen load=\"lazy\"></iframe>";
				}else if ($type=="sci"){
					$iframes.="<iframe class=\"invers\" scrolling=\"no\" src=\"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/$lnk\" sandbox=\"allow-scripts allow-same-origin\" load=\"lazy\"></iframe>";
				}else if ($type=="bli"){
					$iframes.="<iframe class=\"invers\" src=\"https://www.bandlab.com/embed/?id=$lnk&blur=true\" allowfullscreen load=\"lazy\"></iframe>";
				}else if ($type=="vimeo"){
					$iframes.="<iframe src=\"https://player.vimeo.com/video/$lnk\" frameborder=\"0\" allow=\"autoplay; fullscreen\" sandbox=\"allow-scripts allow-same-origin allow-popups\" allowfullscreen load=\"lazy\"></iframe>";
				}else if ($type=="sy"){
					$iframes.="<iframe src=\"https://open.spotify.com/embed/track/$lnk\" load=\"lazy\"></iframe>";
				}
			}
			if($iframes!=""){
				echo "<details><summary>Embeds</summary>$iframes</details>";
			}
			echo "<br/>";
			$flinks=array();
			$links="";
			foreach($track[5] as $type => $lnk){
				if($type=="dl"){
					foreach($lnk as $fn => $fexts){
						foreach($fexts as $fext){
							$flink="../download/?id=$id&fn=".urlencode($fn)."&ext=$fext";
							$thisfile=$CONF["dl_dir"].$fn.'.'.$fext;
							if(file_exists($thisfile)){
								$fs=number_format(filesize($thisfile)/1048576,2,".","");
								$fss="[${fs}MiB]";
							}else if(preg_match("/^(https?|ftp)\:\/\//i", $thisfile)){
								$fss="Remote file";
								$flink=$thisfile;
							}else{
								$fss="File not found";
							}
							$links.="<span class=\"verweis\"><a class=\"btn dl\" title=\"$fn.$fext\" href=\"$flink\"></a> Download .$fext File<i>$fss</i></span>";
							$flinks[$flink]=$fext;
						}
					}
				}else if(array_key_exists($type,$linking_data)){
					list($tpre,$tpost,$tdesc)=$linking_data[$type];
					if($type=="lbry"){
						$links.="<span class=\"verweis\"><a class=\"btn $type\" href=\"lbry://$tpre$lnk$tpost\"></a> $tdesc</span>";
						list($tpre,$tpost,$tdesc)=$linking_data["oy"];
						$links.="<span class=\"verweis\"><a class=\"btn oy\" href=\"https://$tpre$lnk$tpost\"></a> $tdesc</span>";
					}else{
						$links.="<span class=\"verweis\"><a class=\"btn $type\" href=\"https://$tpre$lnk$tpost\"></a> $tdesc</span>";
					}
				}
			}
			if(!empty($flinks)){
				echo "<audio controls>";
				foreach($flinks as $flink => $ext){
					$type="audio";
					if($ext=="opus"){
						$type.="/opus";
					}elseif($ext=="flac"){
						$type.="/flac";
					}elseif($ext=="wav"){
						$type.="/wav";
					}elseif($ext=="mp3"){
						$type.="/mpeg";//this is the only reason I had to do this huge if/else
					}elseif($ext=="ogg"){
						$type.="/ogg";
					}
					echo "<source src=\"$flink\" type=\"$type\"/>";
				}
				echo "</audio>";
			}
			echo $links;
		}
		?>
		<script>
			<?php
				echo "window.addEventListener(\"keyup\", function(event) { if (event.key === \"ArrowLeft\") { location.href = \"./?id=$prv\"; } });";
				echo "window.addEventListener(\"keyup\", function(event) { if (event.key === \"ArrowRight\") { location.href = \"./?id=$nxt\"; } });";
				echo "window.addEventListener(\"keyup\", function(event) { if (event.key === \"ArrowUp\") { location.href = \"../\"; } })";
			?>
		</script>
	</body>
</html>
