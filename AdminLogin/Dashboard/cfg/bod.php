<body>
	<header class="header-area">
		<a href="#" class="logo-area">
			<span>TPU SELAPAJANG JAYA</span>
		</a>
		<div class="nav-switch">
			<i class="fa fa-bars"></i>
		</div>
		<div class="phone-number">(021) 55123456</div>
		<nav class="nav-menu" >
			<ul>
				<li class="<?php if(!$_GET['i']){echo'active';}else{echo "";} ?>"><a href="index.php">Home</a></li>
				<li class="<?php if($_GET['i']=='about'){echo'active';}else{echo "";} ?>"><a href="?i=about">About us</a></li>
				<li class="<?php if($_GET['i']=='register'){echo'active';}else{echo "";} ?>"><a href="?i=register">Register</a></li>
				<li class="<?php if($_GET['i']=='login'){echo'active';}else{echo "";} ?>"><a href="?i=login">Login</a></li>
				<?php if (isset($_SESSION['email'])): ?>
					<li class="<?php if($_GET['i']=='profile'){echo'active';}else{echo "";} ?>"><a href="?i=profile">Profile</a></li>
					<li class="<?php if($_GET['i']=='myorder'){echo'active';}else{echo "";} ?>"><a href="?i=myorder">My Order</a></li>
					<li class="<?php if($_GET['i']=='order'){echo'active';}else{echo "";} ?>"><a href="?i=order">Order</a></li>
					<li class="<?php if($_GET['i']=='logout'){echo'active';}else{echo "";} ?>"><a href="?i=logout">Logout</a></li>
				<?php else: ?>
					<li class="<?php if($_GET['i']=='register'){echo'active';}else{echo "";} ?>"><a href="?i=register">Register</a></li>
					<li class="<?php if($_GET['i']=='login'){echo'active';}else{echo "";} ?>"><a href="?i=login">Login</a></li>
				<?php endif ?>
			</ul>
		</nav>
	</header>
	<!-- Header section end -->   

<!-- Hero section start -->
<section class="hero-section">
<!-- left social link ber -->
<div class="left-bar"">
	<div class="left-bar-content">
	</div>
</div>

<!-- hero slider area -->
<div class="hero-slider">
	<div class="hero-slide-item set-bg" data-setbg="assets/img/bg.jpg">
		<div class="slide-inner">
			<div class="slide-content">
			<h2>Selamat datang di<br><span>TPU Selapajang Jaya</span><br>Kota Tangerang<br>
			<?php 
			
			if (isset($_SESSION['nama'])) {
				echo "<div style='color:green;'>".$_SESSION['nama']."</div>";}

			?></h2>
			</div>	
		</div>
	</div>	

	<div class="hero-slide-item set-bg" data-setbg="assets/img/bg.jpg">
	</div>	
	</div>
</section>
<!-- Hero section end -->