<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Riedler's Code</title>
		<style>
			body{
				background-color:#080808;
				color:#CCC;}
			section{
				position:relative;
				z-index:0;
				display:inline-block;
				background-color:#151515;
				border:solid 1px #151515;
				border-radius:0.5rem;
				padding:0.2rem;
				margin-bottom:1rem;
				vertical-align:middle;}
			#title{
				display:flex;
				justify-content:center;}
			#title>h1{
				display:inline;
				background:url("/favicon.svg") no-repeat;
				background-position:center;
				background-size:cover;
				background-clip:text;
				color:#CCC3;
				margin-bottom:0;}
			h1,h2,h3,h4{
				text-align:center;
				font-variant:petite-caps;}
			section>h3{
				margin:calc(-0.2rem - 1px);
				border:solid 1px #222;
				border-radius:0.5rem;
				background-color:#222;
				z-index:2;
				position:relative;
				padding-left:0.2rem;}
			section>.pocket{
				margin:0 calc(-0.2rem - 1px);
				padding:0.5rem 0.2rem 0.3rem 0.2rem;
				border:solid 1px #222;
				border-radius:0 0 0.5rem 0.5rem;
				background-color:#000;
				z-index:1;
				position:relative;}
			a:link{
				color:#418BA4;}
			a:link:hover{
				color:#6AC;}
			a:visited{
				color:#8B41A4;}
			a:visited:hover{
				color:#A6C;}
			a.badge{
				color:#CCC;
				text-decoration:none;
				background-color:#222;
				padding:0 0.1em;
				border-radius:0.3em;
				border-top:solid 1px #555;}
			a.badge:hover{
				color:#EEE;
				background-color:#282828;}
			p{/*why the fuck is there so much margin by default????*/
				margin:0.5rem 0.2rem;}
			.divisor{
				width:100%;}
			.divisor>div{
				height:2em;
				margin-bottom:-2em;
				border-top:solid 1px #888;
				border-radius:0.3em;}
			.secsec{/*section section, duh*/
				width:calc(50% - 1rem);
				box-sizing:border-box;
				display:inline-block;
				vertical-align:top;
				margin:0 0.5rem;}
			.survival{
				color:#AAA;
				font-size:small;
				font-variant-numeric:oldstyle-nums;
				display:inline-block;
				background-color:#000;
				border:solid 1px #333;
				padding:0 0.2rem;}
			nav{
				position:fixed;
				top:0;
				left:0;
				width:100%;
				display:flex;
				justify-content:flex-start;
				align-items:top;
				background-color:#000;
				padding:0.2rem;
				box-shadow:inset 0 -0.1rem 0.1rem #080808,0 0.1rem 0.1rem #111;
				z-index:999;}
			/*text selections*/
			::-moz-selection{/*for firefox and derivatives*/
				background:#000;}
			::selection{/*for most other browsers that support this*/
				background:#000;}
			/*scrollbar*/
			::-webkit-scrollbar,::-webkit-scrollbar-track-piece{
				background-color:#000 !important;}
			::-webkit-scrollbar-corner,::-webkit-scrollbar-thumb{
				background-color:#333 !important;
				border-radius:0.4em;}
			:root{/*Because Firefox doesn't have the ::-moz-scrollbar selectors*/
				scrollbar-width:thin;
				scrollbar-color:#333 #000;}
		</style>
	</head>
	<body>
		<!--TODO: generate this bullcrap from a json file-->
		<nav>
			<a class="badge" href="../">↑Back</a>
		</nav>
		<div id="title"><h1>Riedler's Code</h1></div>
		<h2 class="divisor">Relatively new stuff<div></div></h2>
		<div class="lefthand secsec">
			<section>
				<h3>BASAV Legacy</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/BASAV">GitHub</a>
				</div>
				<span class="survival">06.2020 - 01.2021</span>
				<p>
					BASAV stands for <b>B</b>ucket-<b>a</b>ware <b>S</b>orting <b>A</b>lgorithm <b>V</b>isualizer, and is basically that. A sorting algorithm visualizer that displays every bucket.<br/>
				</p>
				<p>
					This project came to be through my frustration that many sorting algorithms <a href="https://youtu.be/QmOtL6pPcI0?t=48">seemed like magic</a> by completely disregarding the operations outside the main array.
					So I made my own visualisation program that shows every operation, with an API that would guarantee that every step is countent and properly displayed while also simplifying the steps to add a new algorithm.
				</p>
				<p>
					<b>UPDATE</b> <span class="survival">01.2021</span><br/>
					Right now, it's in a kind of limbo since It's kinda slow because… well, it's python. I also don't have the time to work on it anymore, and don't really know a compiled language well enough yet.<br/>
					I do plan on learning Rust soon though, and I <i>will</i> completely rewrite BASAV from scratch once I have some free time again. That's a promise.<br/>
					I already have some plans for a new compiled version, including a DSL for creating algorithms, which would give me better control of what the algorithms are doing.
				</p>
				<p>
					<b>UPDATE</b> <span class="survival">08.2021</span><br/>
					BASAV is actively being rewritten. I have learned Rust and the UI is already half finished.
					The bulk of the work will go into the new DSL and its interpreter. Keep your ears peeled!
				</p>
				<p>
					<b>UPDATE</b> <span class="survival">09.2021</span><br/>
					Well, so school is taking away my time again, so there'll be another hiatus, probably until <span class="survival">12.2021</span>.
					I think it's still going to take at least a year until I can publish the first stable version though.
				</p>
			</section>
			<section>
				<h3>Dodge to Drums</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/DodgeToDrums">GitHub</a>
				</div>
				<span class="survival">07.2020 - 08.2020 (tiny update on 29.12.2020)</span>
				<p>
					Dodge to Drums is a rythm-based bullet hell. A lot of inspiration came from Just shapes and Beats.
				</p>
				<p>
					Sadly, the development of this project is completely halted due to the suicide of its co-founder and artist, Sage.
					It's not that I can't find another artist to get a few sprites, but I can't get myself to finish it.
					I just hope I will eventually be able to finish it, because it <i>was</i> the most ambitious project I've ever started.
				</p>
			</section>
			<section>
				<h3>Rastar</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/rastar">GitHub</a>
				</div>
				<span class="survival">08.2020</span>
				<p>
					Rastar is a tiny program written with pyglet that demonstrates the use of the A* pathfinding algorithm in a grid. (raster + A star = rastar)<br/>
					The original code stems from someone that asked in the pyglet discord why his code was so slow - I basically rewrote it so he could learn from someone that suffered more than him.
				</p>
			</section>
		</div><!--
		--><div class="righthand secsec">
			<section>
				<h3>Dark Userstyles</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/userstyles-riedler">GitHub</a>
					<a class="badge" href="https://userstyles.world/user/Riedler">Userstyles.world</a>
				</div>
				<span class="survival">04.2019 - now</span>
				<p>
					I'm very fond of the idea of a dark themed internet. That's why I actively try to create new dark themes for websites I visit often.
				</p>
			</section>
			<section>
				<h3>RYTD</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/RYTD">GitHub</a>
				</div>
				<span class="survival">03.2019 - 02.2021</span>
				<p>
					A YouTube downloader using the popular youtube-dl tool. It dumps all videos from a specified playlist into your music folder, so you don't have to manually download every single track.
				</p>
				<p>
					This is a controversial one… it's so old that the codebase is complete and utter crap, and despite it being probably the most helpful tool I've ever created.
					I don't want to touch the code to add new features or fix one of the hundred of bugs… I kinda do still maintain it, but only for myself since my whole music library is built on top of it.
					The repo said it's in the middle of being rewritten, but I've stopped rewriting it a long time ago &amp; it'd need another one now.
					It still kinda works, and as long as that's the case, I don't see a reason to rewrite it properly.
				</p>
				<p>
					<b>UPDATE</b> <span class="survival">09.2021</span><br/>
					I've decided to stop maintaining this project since it's shitty, works for my usecase though, and my last commit was 7 months ago anyway.
					Maybe one day I'll rewrite it.
				</p>
			</section>
			<section>
				<h3>Rtris</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/DodgeToDrums">GitHub</a>
				</div>
				<span class="survival">10.2019 - 07.2020</span>
				<p>
					Rtris is very similar to Tetris, but not the same because else I would get a nice little lawsuit from Nintendo.
				</p>
				<p>
					I didn't like the way that modern Tetris variants handled the tetris formula. I wanted something that feels more like classic tetris, like on the gameboy.
					So I made that. Except it's not Tetris, it's Rtris. Not afilliated with Nintendo or the Tetris company.
				</p>
				<p>
					Also, I included a track that is also known as the 'main tetris theme', which is also Korobeiniki, a russian folk song, which has been in the public domain for a long time.
					The other tracks I included with the game are also either in the public domain or original compositions:
				</p>
				<ul>
					<li>Flight of the Bumblebee</li>
					<li>Moonlight Sonata</li>
					<li>The Four Seasons - Summer</li>
				</ul>
			</section>
		</div>
		<h2 class="divisor">
			Ancient stuff
			<div></div>
		</h2>
		<div class="lefthand secsec">
			<section>
				<h3>RGraphics</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/rgraphics">GitHub</a>
				</div>
				<span class="survival">12.2018 - 04.2019</span>
				<p>
					RGraphics is a graphical engine made for and with python. It's moderately fast, but you won't get 60fps even with low resolution, let me tell you that.
					<del>Apparrently I've never bothered to upload it to github or pypi, so it's lost to time.</del> It has nothing to do with the hundreds of other project called rgraphics.
					In hindsight, that's a pretty stupid name for a graphics engine written with <i>python</i> and not Rust. I don't think I've known Rust at that time though.
				</p>
				<p>
					<b>Update</b>: 5 minutes after writing the above, I've found a super old repository containing the whole project.
					I've now uploaded it to github, along with the other repositories I found.
				</p>
			</section>
			<section>
				<h3>commoncodes.py</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/commoncodes.py">GitHub</a>
					<a class="badge" href="https://pypi.org/project/commoncodes/">PyPI</a>
					<a class="badge" href="https://mfederczuk.github.io/commoncodes/v2.html">Documentation</a>
				</div>
				<span class="survival">11.2019 - 04.2020</span>
				<p>
					My friend mfederczuk made a standard called 'commoncodes' for standardized exit codes and didn't immedeatly release a python version of it >:( what a lazy bastard. So I made it for him.
				</p>
				<p>
					My python implementation is a bit lacking in terms of printing concise output, but hey, at least it works, right? In all seriousness, I should probably rewrite it someday.<br/>
					Despite it being not perfectly professional, it's available on <a href="https://pypi.org/project/commoncodes/">pypi</a>.
				</p>
			</section>
		</div><!--
		--><div class="righthand secsec">
			<section>
				<h3>Snek</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/Snek">GitHub</a>
				</div>
				<span class="survival">03.2019 - 03.2020</span>
				<p>
					Ever wanted to play snake? Me too, that's why I made this. It's just snake.
				</p>
				<p>
					I fiddled around with custom maps (selectable with i-don't-remember). I also tried to make an AI that plays snake perfectly. It's basically just A* doing it's thing.
					I also tried to make an AI with a neural network, but that didn't turn out that well, so I scrapped it.
				</p>
				<p>
					<del>This is also the first and only finished game to use rgraphics, at least as far as I know.</del>
					The source includes a symlink to where rgraphics.py was at the time, which is pretty stupid imo but eh. It was a different time.
					I recall uploading rgraphics to pypi, but I can't find it, so… :shrugs:
				</p>
				<p>
					<b>Update</b>: I've found RPong which might or might not be even older than Snek, also written with rgraphics.
				</p>
			</section>
			<section>
				<h3>RPong</h3>
				<div class="pocket">
					<a class="badge" href="https://github.com/RiedleroD/RPong">GitHub</a>
				</div>
				<span class="survival">03.2019</span>
				<p>
					A Pong implementation with RGraphics.
				</p>
				<p>
					It's not just pong, but the most advanced demo of RGraphics I have - which is saying more about RGraphics than RPong.
				</p>
				<p>
					I've had some issues regarding the ball sometimes flying right through the bats. I'm not sure if I ever fixed this, but to check, I'd have to read the code, and I'm not willing to do that.
				</p>
			</section>
		</div>
	</body>
</html>
