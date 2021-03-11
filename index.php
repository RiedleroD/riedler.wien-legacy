<!DOCTYPE html>
<?php
	function get_data($fn){
		GLOBAL $CONF;
		return json_decode(file_get_contents($CONF["data_dir"].$fn.".json"),true);
	}
	$CONF=array("data_dir"=>"./");
	$CONF=get_data("conf");
	$data=get_data("data");
	$wldata=get_data("wishlist_data");
	$rjdata=get_data("rejected_data");
	$linking_data=get_data("linking_data");
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
			body{
				margin:0;
				padding:0.5rem;
				background-color:#000;
				color:#EEE;
				font-family:sans-serif;}
			.maintable{
				width:100%;
				overflow:hidden;
				display:inline-grid;}
			.maintable.pub>span>a:nth-child(2n+1){
				justify-content:center;}
			.maintable:is(.queue,.rejected)>span>a:last-child{
				justify-content:flex-end;}
			.maintable.pub{
				grid-template-columns:min-content auto auto auto auto min-content;}
			.maintable:is(.queue,.reject){
				grid-template-columns:auto auto;}
			.maintable>div{
				background:linear-gradient(to bottom,#151515 0%,#333 10%,#151515 80%,#000 100%);
				color:#EEE;
				border:none;
				text-align:center;
				font-weight:bold;}
			.maintable>span{
				display:contents;}
			.maintable>span>a{
				display:flex;
				padding:0 0 0.1em 0.1em;
				background:inherit;
				color:#000;
				text-decoration:none;}
			.maintable>span>a.ocomm{
				color:#CCC;}
			.maintable>span>:first-child{
				margin-left:-0.5rem;
				padding-left:0.7rem;
				align-items:center;}
			.maintable.pub>span:hover>a[href]:first-child{
				filter:none;}
			.maintable>span:hover>a[href]{
				filter:brightness(1.2);
				box-shadow:0.5em 0 0.5em 0 #000;
				z-index:1;
				color:#000;}
			.maintable>span:hover>a[href]>*:not(audio){
				filter:brightness(0.9);}
			.maintable.pub>span>a:last-child{
				align-self:stretch;}
			.maintable>span>a>object{
				display:flex;
				align-items:center;
				flex-direction:row-reverse;
				justify-content:flex-start;
				width:100%;}
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
				cursor:pointer;
				overflow:hidden;}
			input.filter+label>span{
				padding:0.2em;
				color:#000;}
			input.filter+label>span:not(.r,.o,.rcomm,.ocomm){
				background-color:#CCC;}
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
			#ocb:not(:checked)~.tabbed>.maintable>.o>a,
			#rcb:not(:checked)~.tabbed>.maintable>.r>a,
			#rcommcb:not(:checked)~.tabbed>.maintable>.rcomm>a,
			#ocommcb:not(:checked)~.tabbed>.maintable>.ocomm>a,
			#stat0cb:not(:checked)~.tabbed>.maintable>.stat0>a,
			#stat1cb:not(:checked)~.tabbed>.maintable>.stat1>a,
			#stat2cb:not(:checked)~.tabbed>.maintable>.stat2>a,
			#stat3cb:not(:checked)~.tabbed>.maintable>.stat3>a,
			#stat4cb:not(:checked)~.tabbed>.maintable>.stat4>a{
				display:none;}
			.o{
				background-color:#383;}
			.r{
				background-color:#AA0;}
			.rcomm{
				background-color:#C60;}
			.ocomm{
				background-color:#638;}
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
						echo ".btn.$serviceid{content:url(\"".$CONF["icon_dir"]."$serviceid.svg\")}";
					}
				}
			?>
			.btn.fv{
				content:url("https://www.fiverr.com/favicon.ico");
				background-color:#1dbf73;}
			.btn.rw{
				content:url(<?php echo $CONF["root_dir"]."favicon.svg"; ?>);}
			.btn.play{
				background-image:url(<?php echo $CONF["root_dir"]."sfto/arrleft.svg"; ?>);}
			.plaque,
			a.plaque:link,
			a.plaque:visited{
				display:inline-flex;
				background-color:#333;
				border-radius:0.2em;
				overflow:hidden;
				align-items:center;
				height:1.25rem;
				padding:0 0.2em;
				text-decoration:none;
				color:#FFF;
				cursor:pointer;
				vertical-align:sub;
				margin-bottom:0.25rem;}
			.plaque>.btn{
				height:1.25rem;
				width:1.25rem;
				margin-right:0.2rem;
				margin-left:-0.2rem;}
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
			.mpip{
				display:none;}
			.mpip+label{
				margin:0 0.2em 0 0;}
			.mpip+label+audio{
				position:fixed;
				top:0.2rem;
				left:0.2rem;
				cursor:pointer;
				display:none;}
			.mpip:checked+label+audio{
				display:block;}
			.mpip:checked+label{
				display:none;}
			.mpip+.btn{
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
				margin-left:0;
				transition:margin-left 0.2s;
				transition-timing-function:cubic-bezier(.77,0,.18,1);}
			#tab_2:checked~.tabbed>.maintable:first-child{
				margin-left:-100%;}
			#tab_3:checked~.tabbed>.maintable:first-child{
				margin-left:-200%;}
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
			You can also comission me to make original music. In that case, please contact me on <a class="plaque" href="https://www.fiverr.com/s2/1e37f97239"><b class="btn fv"></b>Fiverr</a>
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
		<br/><br/><?php if(array_key_exists("t",$_GET)){$seltab=$_GET["t"];}else{$seltab=1;}?>
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
				<div>▶️</div>
				<div>Name</div>
				<div>Status</div>
				<div>Requestor</div>
				<div>Release Date</div>
				<div>Links</div>
				<?php
					function create_table($data,$linking_data,$ispub){
						if($data==NULL){
							echo "<a><b style='color:red'>Error reading json file, please be patient until this is fixed</b></a>\n";
						}else if($linking_data==NULL){
							echo "<a><b style='color:red'>Error reading linking information, please be patient until this is fixed</b></a>\n";
						}else{
							$stati=["Requested","Planned","Drafted","Finished","Uploaded"];
							$i=count($data);
							foreach($data as $row){
								$i-=1;
								$stat=$row[2];
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
									$anysource=false;
									if(array_key_exists("dl",$row[5])){
										$sources="<audio controls preload=none>";
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
										$mpip="";
									}else{
										$mpip="<input type=\"radio\" id=\"mp$i\" class=\"mpip\" name=\"miniplayer\"></input><label for=\"mp$i\" class=\"btn play\"></label>";
										$sources.="</audio>";
									}
									echo "<span class=\"$row[0] stat$stat\"><a href=\"./play/?id=$i\">$mpip$sources</a><a href=\"./play/?id=$i\">$row[1]</a><a href=\"./play/?id=$i\">$stati[$stat]</a><a href=\"./play/?id=$i\">$row[3]&nbsp;</a><a href=\"./play/?id=$i\">$row[4]&nbsp;</a><a href=\"./play/?id=$i\">$lnks</a></span>";
								}else{
									if(array_key_exists(3,$row)){
										$lnk=" href=\"$row[3]\"";
									}else{
										$lnk="";
									}
									echo "<span class=\"$row[0] stat$stat\"><a$lnk>$row[1]</a><a$lnk>$row[2]&nbsp;</a></span>";
								}
							}
						}
					}
					create_table($data,$linking_data,true);
				?>
			</div><!--
			--><div class="maintable queue">
				<div>Name</div>
				<div>Requestor</div>
				<?php
					create_table($wldata,$linking_data,false);
				?>
			</div><!--
			--><div class="maintable reject">
				<div>Name</div>
				<div>Requestor</div>
				<?php
					create_table($rjdata,$linking_data,false);
				?>
			</div>
		</div>
	</body>
</html>
