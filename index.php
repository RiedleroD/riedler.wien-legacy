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
			table{
				border-collapse:collapse;
				width:calc(100% + 1rem);
				margin-left:-0.5rem;
				margin-bottom:-0.5rem;
				color:#000;}
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
			#ocb:not(:checked)~table .o,
			#rcb:not(:checked)~table .r,
			#rcommcb:not(:checked)~table .rcomm,
			#ocommcb:not(:checked)~table .ocomm,
			#stat0cb:not(:checked)~table .stat0,
			#stat1cb:not(:checked)~table .stat1,
			#stat2cb:not(:checked)~table .stat2,
			#stat3cb:not(:checked)~table .stat3,
			#stat4cb:not(:checked)~table .stat4{
				display:none;}
			.o{
				background:linear-gradient(to right,#383 10vw,#464 90vw,#000 95vw);}
			.r{
				background:linear-gradient(to right,#AA0 10vw,#883 90vw,#000 95vw);}
			.rcomm{
				background:linear-gradient(to right,#C60 10vw,#A43 90vw,#000 95vw);}
			.ocomm{
				background:linear-gradient(to right,#638 10vw,#436 90vw,#000 95vw);}
			tr:first-child>th{
				background:linear-gradient(to bottom,#151515 0%,#333 10%,#151515 80%,#000 100%);
				color:#EEE;
				border:none;}
			tr>:nth-child(4){
				border-right:none;
			}
			tr>:last-child{
				border-left:none;
			}
			a.btn{
				height:1em;
				vertical-align:sub;
				display:inline-block;}
			a.btn:first-child{
				padding-left:0.2em;}
			a.btn:last-child{
				padding-right:0.2em;}
			td{
				padding:0;}
			td>a:not(.btn){
				cursor:pointer;
				color:#000;
				padding-left:0.2em;
				padding-right:0.2em;
				text-decoration:none;
				display:block;}
			td>a:not(.btn):hover{
				color:#000;
			}
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
		</style>
	</head>
	<body>
		<h1>Riedler's Music</h1>
		<p>
			You can request any song for Riedlerfiziert <a href="https://forms.gle/poA5LsSr8HwNEV3a9">here</a>. It's completely free! <br/>
			You can also comission me to make original music, but in that case, please email me at comm@riedler.wien and describe precisely what you want. I usually respond within 1 to 3 days. If I don't, please re–send the mail.
		</p>
		<p>Here's a queue for you – it's updated by me personally once something changes.<br/>
		<a class="btn rw"></a> Riedler.wien<br/>
		<a class="btn yt"></a> YouTube<br/>
		<a class="btn lmms"></a> LMMS Sharing Platform<br/>
		<a class="btn bl"></a> BandLab<br/>
		<a class="btn sc"></a> SoundCloud</p>
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
		<table border=1>
			<tr>
				<th>Name</th>
				<th>Status</th>
				<th>Requestor</th>
				<th>Release Date</th>
				<th>Links</th>
			</tr>
			<?php
				$json=file_get_contents("./data.json");
				$data=json_decode($json);
				if($data==NULL){
					echo "<tr><td><b style='color:red'>Error reading json file, please be patient until this is fixed</b></td></tr>\n";
				}else{
					$stati=["Requested","Planned","Drafted","Finished","Uploaded"];
					$i=count($data);
					foreach($data as $row){
						$i-=1;
						$lnks="";
						foreach($row[5] as $type => $lnk){
							if($type=="yt"){
								$lnks.="<a class=\"btn yt\" href=\"https://youtu.be/$lnk\"></a>";
							}else if($type=="lmms"){
								$lnks.="<a class=\"btn lmms\" href=\"https://lmms.io/lsp/?action=show&file=$lnk\"></a>";
							}else if ($type=="sc"){
								$lnks.="<a class=\"btn sc\" href=\"https://soundcloud.com/riedler-musics/$lnk\"></a>";
							}else if ($type=="bl"){
								$lnks.="<a class=\"btn bl\" href=\"https://www.bandlab.com/riedler/$lnk\"></a>";
							}
						}
						if($lnks!="" or array_key_exists(6,$row)){
							$lnks="<a class=\"btn rw\" href=\"./play/?id=$i\"></a>".$lnks;
						}
						$stat=$row[2];
						echo "<tr class=\"$row[0] stat$stat\"><td><a href=\"./play/?id=$i\">$row[1]</a></td><td><a href=\"./play/?id=$i\">$stati[$stat]</a></td><td><a href=\"./play/?id=$i\">$row[3]&nbsp;</a></td><td><a href=\"./play/?id=$i\">$row[4]&nbsp;</a></td><td>$lnks</td></tr>";
					}
				}
			?>
		</table>
	</body>
</html>
