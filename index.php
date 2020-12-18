<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Riedler's Music</title>
		<link rel="icon" type="image/png" href="/favicon.png"/>
		<style>
			body{
				margin:0;
				padding:0.5rem;
				background-color:#000;
				color:#EEE;}
			#maintable{
				display:table;
				width:calc(100% + 1rem);
				margin-left:-0.5rem;
				margin-bottom:1em;
				margin-top:0.5rem;
				color:#000;}
			#maintable>a{
				display:table-row;
				text-decoration:none;
				color:#000;}
			#maintable>a:first-child>div{
				background:linear-gradient(to bottom,#151515 0%,#333 10%,#151515 80%,#000 100%);
				color:#EEE;
				border:none;}
			#maintable>a>:nth-child(4){
				border-right:none;
			}
			#maintable>a>:last-child{
				border-left:none;
			}
			#maintable>a:not(:first-child):hover{
				filter:brightness(1.2);
				box-shadow:-0.5em 0 0.5em 0 #000;}
			#maintable>a:not(:first-child):hover>*{
				filter:brightness(0.9);}
			#maintable>a>div{
				display:table-cell;
				padding:0 0 0.1em 0;
				white-space:nowrap;}
			#maintable>a>div:first-child{
				width:0;}
			#maintable>a>div:last-child{
				vertical-align:middle;}
			#maintable>a:first-child>div{
				text-align:center;
				font-weight:bold;}
			#maintable a>div>object{
				display:flex;
				align-items:baseline;
				flex-direction:row-reverse;
				justify-content:flex-start;}
			a:link,
			a:visited{
				color:#418BA4;}
			a:link:hover,
			a:visited:hover{
				color:#6AC;}
			label{
				padding:0.2em;
				border-radius:0.2em;
				line-height:2em;
				color:#000;
				background-color:#CCC;}
			#ocb:not(:checked)~#maintable .o,
			#rcb:not(:checked)~#maintable .r,
			#rcommcb:not(:checked)~#maintable .rcomm,
			#ocommcb:not(:checked)~#maintable .ocomm,
			#stat0cb:not(:checked)~#maintable .stat0,
			#stat1cb:not(:checked)~#maintable .stat1,
			#stat2cb:not(:checked)~#maintable .stat2,
			#stat3cb:not(:checked)~#maintable .stat3,
			#stat4cb:not(:checked)~#maintable .stat4{
				display:none;}
			.o{
				background:linear-gradient(to right,#383 10vw,#464 90vw,#121 95vw,#000 98vw);}
			.r{
				background:linear-gradient(to right,#AA0 10vw,#883 90vw,#331 95vw,#000 98vw);}
			.rcomm{
				background:linear-gradient(to right,#C60 10vw,#A43 90vw,#321 95vw,#000 98vw);}
			.ocomm{
				background:linear-gradient(to right,#638 10vw,#436 90vw,#112 95vw,#000 98vw);}
			.btn{
				height:1em;
				width:1em;
				display:inline-block;
				padding:0;
				background-size:1em 1em;
				cursor:pointer;}
			#maintable .btn:first-child{
				margin-right:0.2em;}
			#maintable .btn:last-child{
				margin-left:0.2em;}
			.btn.yt{
				content:url("/sfto/youtube.svg");}
			.btn.lmms{
				content:url("/sfto/lmms.svg");}
			.btn.sc{
				content:url("/sfto/soundcloud.svg");}
			.btn.bl{
				content:url("/sfto/bandlab.svg");}
			.btn.vimeo{
				content:url("/sfto/vimeo.svg");}
			.btn.az{
				content:url("/sfto/amazon.svg");}
			.btn.am{
				content:url("/sfto/amazon_music.svg");}
			.btn.bp{
				content:url("/sfto/boomplay.svg");}
			.btn.dz{
				content:url("/sfto/deezer.svg");}
			.btn.sy{
				content:url("/sfto/spotify.svg");}
			.btn.rw{
				content:url("/favicon.svg");}
			.btn.play{
				background-image:url("/sfto/arrleft.svg");}
			.patreon{
				background-color:#E34;
				color:#FFF !important;
				text-decoration:none;
				border-radius:1em;
				padding:0.2em 0.5em 0.2em 0.5em;
				font-weight:bold;}
			.patreon>svg{
				vertical-align:middle;
				fill:#FFF;
				stroke-width:1.2px;
				height:1em;
				width:1em;
				padding-right:0.2em;
				display:inline-block;}
			.miniplayer{
				display:inline-flex;
				width:auto;
				margin:0 0.2em;
				z-index:2;
				position:relative;
				vertical-align:super;}
			.miniplayer audio{
				height:1em;
				width:auto;
				cursor:pointer;
				display:none;}
			.miniplayer:focus-within>audio{
				display:inline-block;}
			.miniplayer:focus-within>.play{
				display:none;}
			.miniplayer:focus-within{
				vertical-align:sub;/*don't ask*/}
			.miniplayer>.btn{
				border:none;
				appearance:none;
				background-color:#0000;}
		</style>
	</head>
	<body>
		<h1>Riedler's Music</h1>
		<p>
			You can request any song for Riedlerfiziert <a href="https://forms.gle/poA5LsSr8HwNEV3a9">here</a>. It's completely free! <br/>
			You can also comission me to make original music, but in that case, please email me at comm@riedler.wien and describe precisely what you want. I usually respond within 1 to 3 days. If I don't, please re–send the mail.<br/>
			I've also got a patreon page now: <a class="patreon" href="https://www.patreon.com/bePatron?u=36947670"><svg viewBox="0 0 569 546" xmlns="http://www.w3.org/2000/svg"><g><circle cx="362.589996" cy="204.589996" data-fill="1" id="Oval" r="204.589996"></circle><rect data-fill="2" height="545.799988" id="Rectangle" width="100" x="0" y="0"></rect></g></svg>Become a patreon</a><br/>
			All patrons are visible <a href="./patrons/">here</a>.
		</p>
		<p>
			Here's a queue for you – it's updated by me personally once something changes.<br/>
			<a class="btn rw"></a> Riedler.wien<br/>
			<a class="btn yt"></a> YouTube<br/>
			<a class="btn lmms"></a> LMMS Sharing Platform<br/>
			<a class="btn bl"></a> BandLab<br/>
			<a class="btn sc"></a> SoundCloud<br/>
			<a class="btn vimeo"></a> Vimeo<br/>
			<a class="btn az"></a> Amazon<br/>
			<a class="btn am"></a> Amazon Music<br/>
			<a class="btn bp"></a> Boomplay<br/>
			<a class="btn dz"></a> Deezer<br/>
			<a class="btn play" style="background-color:#555"></a> Mini-Player
		</p>
		<input type="checkbox" checked id="rcb"/><label for="rcb" class="r">Riedlerfiziert</label>
		<input type="checkbox" checked id="rcommcb"/><label for="rcommcb" class="rcomm">Riedlerfiziert Requests</label>
		<input type="checkbox" checked id="ocb"/><label for="ocb" class="o">Originals</label>
		<input type="checkbox" checked id="ocommcb"/><label for="ocommcb" class="ocomm">Commissions</label>
		<br/>
		<input type="checkbox" checked id="stat0cb"/><label for="stat0cb">Requested</label>
		<input type="checkbox" checked id="stat1cb"/><label for="stat1cb">Planned</label>
		<input type="checkbox" checked id="stat2cb"/><label for="stat2cb">Drafted</label>
		<input type="checkbox" checked id="stat3cb"/><label for="stat3cb">Finished</label>
		<input type="checkbox" checked id="stat4cb"/><label for="stat4cb">Uploaded</label>
		<div id="maintable">
			<a>
				<div>▶️</div>
				<div>Name</div>
				<div>Status</div>
				<div>Requestor</div>
				<div>Release Date</div>
				<div>Links</div>
			</a>
			<?php
				$json=file_get_contents("./data.json");
				$data=json_decode($json,true);
				$json=file_get_contents("./linking_data.json");
				$linking_data=json_decode($json,true);
				if($data==NULL){
					echo "<a><div><b style='color:red'>Error reading json file, please be patient until this is fixed</b></div></a>\n";
				}else if($linking_data==NULL){
					echo "<a><div><b style='color:red'>Error reading linking information, please be patient until this is fixed</b></div></a>\n";
				}else{
					$stati=["Requested","Planned","Drafted","Finished","Uploaded"];
					$i=count($data);
					foreach($data as $row){
						$i-=1;
						$lnks="";
						foreach($row[5] as $type => $lnk){
							if(array_key_exists($type,$linking_data)){
								list($tpre,$tpost,$tdesc)=$linking_data[$type];
								$lnks.="<a class=\"btn $type\" href=\"https://$tpre$lnk$tpost\"></a>";
							}
						}
						if($lnks!="" or array_key_exists(6,$row)){
							$lnks="<a class=\"btn rw\" href=\"./play?id=$i\"></a>".$lnks;
						}
						$stat=$row[2];
						$anysource=false;
						if(array_key_exists("dl",$row[5])){
							$sources="<div class=\"miniplayer\"><button type=\"submit\" class=\"btn play\"></button><audio controls preload=none>";
							foreach($row[5]["dl"] as $fn => $fexts){
								foreach($fexts as $fext){
									$urlfn=urlencode($fn);
									$sources.="<source src=\"./download/?id=$i&fn=$urlfn&ext=$fext\"/>";
									$anysource=true;
								}
							}
						}
						if(!$anysource){
							$sources="";
						}else{
							$sources.="</audio></div>";
						}
						echo "<a class=\"$row[0] stat$stat\" href=\"./play/?id=$i\"><div>$sources</div><div>$row[1]</div><div>$stati[$stat]</div><div>$row[3]&nbsp;</div><div>$row[4]&nbsp;</div><div><object>$lnks</object></div></a>";
					}
				}
			?>
		</div>
	</body>
</html>
