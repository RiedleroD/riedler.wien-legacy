<!DOCTYPE html>
<?php
	$json=file_get_contents("./data.json");
	$data=json_decode($json,true);
	$json=file_get_contents("./wishlist_data.json");
	$wldata=json_decode($json,true);
	$json=file_get_contents("./rejected_data.json");
	$rjdata=json_decode($json,true);
	$json=file_get_contents("./linking_data.json");
	$linking_data=json_decode($json,true);
?>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Riedler's Music</title>
		<link rel="icon" type="image/svg" href="/favicon.svg"/>
		<style>
			@keyframes stretch{
				0%{transform:scale(1,1)}
				50%{transform:scale(1.4,1)}
				100%{transform:scale(1,1)}
			}
			@keyframes squash{
				0%{transform:scale(1,1)}
				30%{transform:scale(0,1)}
				60%{transform:scale(0,1)}
				100%{transform:scale(1,1)}
			}
			@keyframes vanish{
				0%{transform:scale(1,1);visibility:visible}
				100%{transform:scale(0,1);visibility:collapse}
			}
			@keyframes appear{
				0%{transform:scale(0,1);visibility:visible}
				100%{transform:scale(1,1)}
			}
			body{
				margin:0;
				padding:0.5rem;
				background-color:#000;
				color:#EEE;
				font-family:sans-serif;}
			.maintable{
				display:inline-table;
				color:#000;}
			.maintable>a:link,
			.maintable>a:visited,
			.maintable>a:link:hover,
			.maintable>a:visited:hover,
			.maintable>a{
				display:table-row;
				text-decoration:none;
				color:#000;
				position:relative;}
			.maintable>a:first-child>div{
				background:linear-gradient(to bottom,#151515 0%,#333 10%,#151515 80%,#000 100%);
				color:#EEE;
				border:none;}
			.maintable>a>:nth-child(4){
				border-right:none;}
			.maintable>a[href]:not(:first-child):hover{
				filter:brightness(1.2);
				box-shadow:0 0 0.5em 0 #000;
				z-index:1;}
			.maintable>a[href]:not(:first-child):hover>*{
				filter:brightness(0.9);}
			.maintable>a>div{
				display:table-cell;
				padding:0 0 0.1em 0;
				white-space:nowrap;}
			.maintable.pub>a>div:first-child{
				width:0;}
			.maintable.pub>a>div:last-child{
				vertical-align:middle;}
			.maintable.pub>a:first-child>div{
				text-align:center;
				font-weight:bold;}
			.maintable.pub a>div>object{
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
			input.filter{
				display:none;}
			input.filter+label{
				display:inline-flex;
				align-items:center;
				margin:0.5em 0.2em;
				background-color:#333;
				border-radius:0.2em;
				overflow:hidden;
				cursor:pointer;}
			input.filter+label>span{
				padding:0.2em;
				background-color:#CCC;
				color:#000;}
			input.filter+label>b{
				display:inline-block;
				width:0.75em;
				height:0.75em;
				box-sizing:border-box;
				margin:0 0.3em;
				background-size:0;
				background-repeat:no-repeat;
				background-position:center center;
				background-image:linear-gradient(#CCC,#CCC);
				transition:background-size 0s;
				transition-delay:0.1s;
				background-clip:content-box;
				border:solid 1px #0000;
				outline:solid 1px #CCC;
				animation:squash 0.2s 1;}
			input.filter:checked+label>b{
				background-size:100%;
				animation:stretch 0.15s 1;
				animation-delay:0.05s;
				transition-delay:0s;
				transition-duration:0.05s;}
			.maintable>a{
				transform-origin:left;
				animation:appear 0.2s 1;
				animation-fill-mode:forwards;}
			#ocb:not(:checked)~.tabbed>.maintable .o,
			#rcb:not(:checked)~.tabbed>.maintable .r,
			#rcommcb:not(:checked)~.tabbed>.maintable .rcomm,
			#ocommcb:not(:checked)~.tabbed>.maintable .ocomm,
			#stat0cb:not(:checked)~.tabbed>.maintable .stat0,
			#stat1cb:not(:checked)~.tabbed>.maintable .stat1,
			#stat2cb:not(:checked)~.tabbed>.maintable .stat2,
			#stat3cb:not(:checked)~.tabbed>.maintable .stat3,
			#stat4cb:not(:checked)~.tabbed>.maintable .stat4{
				animation:vanish 0.2s 1;
				animation-fill-mode:forwards;}
			.o{
				background-image:linear-gradient(to right,#383 10vw,#464 100vw);}
			.r{
				background-image:linear-gradient(to right,#AA0 10vw,#883 100vw);}
			.rcomm{
				background:linear-gradient(to right,#C60 10vw,#A43 100vw);}
			.ocomm{
				background:linear-gradient(to right,#638 10vw,#436 100vw);
				color:#CCC !important;}
			.btn{
				height:1em;
				width:1em;
				display:inline-block;
				padding:0;
				background-size:1em 1em;
				cursor:pointer;}
			.maintable .btn:first-child{
				margin-right:0.2em;}
			.maintable .btn:last-child{
				margin-left:0.2em;}
			<?php
				if($linking_data!=NULL){
					foreach($linking_data as $serviceid => $servicedata){
						echo ".btn.$serviceid{content:url(\"/sfto/rwicons/$serviceid.svg\")}";
						if($serviceid=="lbry"){
							echo ".btn.oy{content:ulr(\"/sfto/rwicons/oy.svg\")}";
						}
					}
				}
			?>
			.btn.rw{
				content:url("/favicon.svg");}
			.btn.play{
				background-image:url("/sfto/arrleft.svg");}
			.plaque,
			a.plaque:link,
			a.plaque:visited{
				display:inline-flex;
				background-color:#333;
				border-radius:0.2em;
				overflow:hidden;
				align-items:center;
				height:1.25rem;
				padding-right:0.2em;
				text-decoration:none;
				color:#FFF;
				cursor:pointer;
				vertical-align:sub;
				margin:0.25rem;}
			.plaque>.btn{
				margin-right:0.2em;
				height:1.25rem;
				width:1.25rem;}
			.patreon{
				background-color:#E34;
				color:#FFF !important;
				text-decoration:none;
				border-radius:1em;
				padding:0.2em 0.5em 0.2em 0.5em;
				font-weight:bold;}
			.patreon>b{
				vertical-align:sub;
				height:1.25rem;
				width:1.25rem;
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
			.tabbed{
				display:block;
				white-space:nowrap;
				width:100%;
				overflow:hidden;
				box-shadow:inset 0 0 1em #000;}
			.tabbed>.maintable{
				width:100%;
				transform:translate(0);
				transition:transform 0.2s;
				transition-timing-function:cubic-bezier(.77,0,.18,1);}
			#tab_2:checked~.tabbed>.maintable{
				transform:translateX(-100%);}
			#tab_3:checked~.tabbed>.maintable{
				transform:translateX(-200%);}
			input[name="tabs"]{
				display:none;}
			.tabnav{
				display:flex;
				align-items:baseline;
				border-radius:1rem;
				height:1.5rem;
				margin:0.5rem 0;
				background-color:#151515;}
			.tnhl{
				background-color:#333;
				background-clip:content-box;
				box-sizing:border-box;
				padding:0 0.1rem;
				transform:translateX(0);
				transition:transform 0.2s;
				transition-timing-function:cubic-bezier(.77,0,.18,1);
				width:calc(100% / 3);
				height:1.2rem;
				margin-bottom:-1.85rem;
				margin-top:0.5rem;
				border-radius:1.2rem;
				z-index:1;}
			#tab_2:checked~.tnhl{
				transform:translateX(100%);}
			#tab_3:checked~.tnhl{
				transform:translateX(200%);}
			.tabnav>label{
				display:flex;
				width:100%;
				height:100%;
				align-items:center;
				justify-content:center;
				cursor:pointer;
				z-index:2;}
		</style>
	</head>
	<body>
		<h1>Riedler's Music</h1>
		<p>
			You can request any song for Riedlerfiziert <a href="https://forms.gle/poA5LsSr8HwNEV3a9">here</a>. It's completely free! <br/>
			You can also comission me to make original music, but in that case, please email me at comm@riedler.wien and describe precisely what you want. I usually respond within 1 to 3 days. If I don't, please re–send the mail.
		</p>
		<p>
			I've also got a patreon page now, so please <a class="patreon" href="https://www.patreon.com/bePatron?u=36947670"><b class="btn pt"></b>Become a patreon</a>. All patrons are visible in the <a class="plaque" href="./patrons/"><b class="btn pt"></b>patron list</a>.
		</p>
		<div style="user-select:none;">
			<a class="plaque" href="#"><b class="btn rw"></b>riedler.wien</a>
			<a class="plaque" href="https://www.youtube.com/channel/UC0aIZx6FIHB5Fq_sr0TMXSw"><b class="btn yt"></b>YouTube</a>
			<a class="plaque" href="https://lmms.io/lsp/?action=browse&user=Riedler"><b class="btn lmms"></b>LMMS Sharing Platform</a>
			<a class="plaque" href="https://bandlab.com/riedler"><b class="btn bl"></b>BandLab</a>
			<a class="plaque" href="https://open.spotify.com/artist/7k9sRjqYP68ZI8Bw8BwmuG"><b class="btn sy"></b>Spotify</a>
			<a class="plaque" href="https://soundcloud.com/riedler-musics"><b class="btn sc"></b>SoundCloud</a>
			<a class="plaque" href="https://vimeo.com/user125791194"><b class="btn vimeo"></b>Vimeo</a>
			<a class="plaque" href="https://www.amazon.com/s?k=Riedler&i=digital-music&search-type=ss"><b class="btn az"></b>Amazon</a>
			<a class="plaque" href="https://music.amazon.com/artists/B08QG41MYN/riedler"><b class="btn am"></b>Amazon Music</a>
			<a class="plaque" href="https://music.apple.com/gb/artist/riedler/1544612571"><b class="btn apm"></b>Apple Music</a>
			<a class="plaque" href="https://www.boomplay.com/artists/19145926"><b class="btn bp"></b>Boomplay</a>
			<a class="plaque" href="https://music.yandex.com/artist/10521437"><b class="btn yx"></b>Yandex Music</a>
			<a class="plaque" href="https://www.deezer.com/en/artist/116666602"><b class="btn dz"></b>Deezer</a>
			<a class="plaque" href="https://odysee.com/@Riedler:6"><b class="btn oy"></b>Odysee</a>
			<a class="plaque" href="lbry://@Riedler:6"><b class="btn lbry"></b>LBRY</a>
		</div>
		These symbols are hand-crafted by me (with inkscape) and are meant to represent the respective services.<br/>
		<br/>
		<input type="checkbox" class="filter" checked id="rcb"/><label for="rcb"><b></b><span class="r">Riedlerfiziert</span></label>
		<input type="checkbox" class="filter" checked id="rcommcb"/><label for="rcommcb"><b></b><span class="rcomm">Riedlerfiziert Requests</span></label>
		<input type="checkbox" class="filter" checked id="ocb"/><label for="ocb"><b></b><span class="o">Originals</span></label>
		<input type="checkbox" class="filter" checked id="ocommcb"/><label for="ocommcb"><b></b><span class="ocomm">Commissions</span></label>
		<br/>
		<input type="checkbox" class="filter" checked id="stat0cb"/><label for="stat0cb"><b></b><span>Requested</span></label>
		<input type="checkbox" class="filter" checked id="stat1cb"/><label for="stat1cb"><b></b><span>Planned</span></label>
		<input type="checkbox" class="filter" checked id="stat2cb"/><label for="stat2cb"><b></b><span>Drafted</span></label>
		<input type="checkbox" class="filter" checked id="stat3cb"/><label for="stat3cb"><b></b><span>Finished</span></label>
		<input type="checkbox" class="filter" checked id="stat4cb"/><label for="stat4cb"><b></b><span>Uploaded</span></label>
		<br/><br/><?php $seltab=$_GET["t"] ?>
		<input type="radio" name="tabs" id="tab_1" <?php if($seltab!=2 and $seltab!=3){echo "checked";}?>/>
		<input type="radio" name="tabs" id="tab_2" <?php if($seltab==2){echo "checked";}?>/>
		<input type="radio" name="tabs" id="tab_3" <?php if($seltab==3){echo "checked";}?>/>
		<div class="tnhl"></div>
		<div class="tabnav">
			<label for="tab_1">Approved</label>
			<label for="tab_2">Queued</label>
			<label for="tab_3">Rejected</label>
		</div>
		<div class="tabbed">
			<div class="maintable pub">
				<a>
					<div>▶️</div>
					<div>Name</div>
					<div>Status</div>
					<div>Requestor</div>
					<div>Release Date</div>
					<div>Links</div>
				</a>
				<?php
					function create_table($data,$linking_data,$ispub){
						if($data==NULL){
							echo "<a><div><b style='color:red'>Error reading json file, please be patient until this is fixed</b></div></a>\n";
						}else if($linking_data==NULL){
							echo "<a><div><b style='color:red'>Error reading linking information, please be patient until this is fixed</b></div></a>\n";
						}else{
							$stati=["Requested","Planned","Drafted","Finished","Uploaded"];
							$i=count($data);
							foreach($data as $row){
								$i-=1;
								if($ispub){
									$lnks="";
									foreach($row[5] as $type => $lnk){
										if(array_key_exists($type,$linking_data)){
											list($tpre,$tpost,$tdesc)=$linking_data[$type];
											if($type=="lbry"){
												$lnks.="<a class=\"btn $type\" href=\"lbry://$tpre$lnk$tpost\"></a>";
												list($tpre,$tpost,$tdesc)=$linking_data["oy"];
												$lnks.="<a class=\"btn oy\" href=\"https://$tpre$lnk$tpost\"></a>";
											}else{
												$lnks.="<a class=\"btn $type\" href=\"https://$tpre$lnk$tpost\"></a>";
											}
										}
									}
									if($lnks!="" or array_key_exists(6,$row)){
										$lnks="<object><a class=\"btn rw\" href=\"./play?id=$i\"></a>".$lnks."</object>";
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
									echo "<a class=\"$row[0] stat$stat\" href=\"./play/?id=$i\"><div>$sources</div><div>$row[1]</div><div>$stati[$stat]</div><div>$row[3]&nbsp;</div><div>$row[4]&nbsp;</div><div>$lnks</div></a>";
								}else{
									if(array_key_exists(3,$row)){
										$lnk=" href=\"$row[3]\"";
									}else{
										$lnk="";
									}
									echo "<a class=\"$row[0] stat$stat\"$lnk><div>$row[1]</div><div>$row[2]&nbsp;</div></a>";
								}
							}
						}
					}
					create_table($data,$linking_data,true);
				?>
			</div><!--
			--><div class="maintable queue">
				<a>
					<div>Name</div>
					<div>Requestor</div>
				</a>
				<?php
					create_table($wldata,$linking_data,false);
				?>
			</div><!--
			--><div class="maintable reject">
				<a>
					<div>Name</div>
					<div>Requestor</div>
				</a>
				<?php
					create_table($rjdata,$linking_data,false);
				?>
			</div>
		</div>
	</body>
</html>
