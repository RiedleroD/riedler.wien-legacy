<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Riedler Patrons</title>
		<style>
			:root,body{
				background-color:#000;
				color:#CCC;
				padding:0;
				margin:0;}
			h1{
				margin-top:0.5em;
				margin-bottom:0.5em;}
			ul.tier{
				list-style:none;
				padding-left:0;
				margin-top:0;
				margin-bottom:0.2rem;}
			ul.tier.B>li,
			ul.tier.A>li>a,
			ul.tier.S>li>a{
				background-color:#333;
				color:#DDD;
				display:inline;
				padding:0.2em;
				line-height:1.6em;
				border-radius:0.2em;
				margin-right:0.2em;}
			ul.tier.A>li,
			ul.tier.S>li{
				margin-bottom:0.2rem;}
			ul.tier.A>li::after,
			ul.tier.S>li::after{
				content:"\A";
				white-space:pre;}
			h2{
				display:inline-block;
				padding-right:0.2em;
				margin-bottom:0;
				margin-top:0.2rem;}
			hr{
				margin-bottom:0;
				margin-top:0.2rem;}
			h2+sub{
				color:#AAA;
				font-style:italic;}
			ul.tier>li>sub{
				color:#CCC;
				font-style:italic;
				font-size:0.8em;}
			div.card{
				background-color:#151515;
				border-radius:0.2em;
				padding:0.5em;
				margin:0.5em 0.5em 0 0.5em;}
			a.btn{
				background-color:#333;
				border-radius:0.2em;
				padding:0.2em;
				padding-top:calc(0.2em - 1px);
				color:#CCC;
				text-decoration:none;
				border-top:solid 1px #555;}
			a.btn:hover{
				color:#EEE;
				background-color:#444;
				border-top-color:#888;}
			ul.tier>li.err,
			ul.tier>li>a.err{
				color:#F00;}
		</style>
	</head>
	<body>
		<?php
			$json=file_get_contents("./data.json");
			$data=json_decode($json,true);
			if($data==NULL){
				$S=NULL;
				$A=NULL;
				$B=NULL;
			}else{
				$S=$data["S"];
				$A=$data["A"];
				$B=$data["B"];
			}
		?>
		<div class="card">
			<a class="btn" href="..">←Back</a>
			<h1>My Patrons :)</h1>
		</div>
		<div class="card">
			<h2>Riedler Muses</h2><sub>20€+</sub>
			<ul class="tier S">
				<?php
					if($S==NULL){
						echo "<li><a class=\"err\">couldn't get tier S patrons</a></li>";
					}else{
						foreach($S as $name => $desc){
							echo "<li><a>$name</a><sub>$desc</sub></li>";
						}
					}
				?>
			</ul>
			<hr/>
			<h2>Riedler Enthusiasts</h2><sub>10€+</sub>
			<ul class="tier A">
				<?php
					if($A==NULL){
						echo "<li><a class=\"err\">couldn't get tier A patrons</a></li>";
					}else{
						foreach($A as $name => $desc){
							echo "<li><a>$name</a><sub>$desc</sub></li>";
						}
					}
				?>
			</ul>
			<hr/>
			<h2>Riedler Supporters</h2><sub>5€+</sub>
			<ul class="tier B">
				<?php
					if($B==NULL){
						echo "<li class=\"err\">couldn't get tier B patrons</li>";
					}else{
						foreach($B as $name){
							echo "<li>$name</li>";
						}
					}
				?>
			</ul>
			<hr/>
		</div>
	</body>
</html>
