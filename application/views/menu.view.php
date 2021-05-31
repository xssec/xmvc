<div class="sidebar-header">
	<div class="user-pic">
		<img class="img-thumbnail img-rounded" src="https://cdn3.iconfinder.com/data/icons/49handdrawing/256x256/user-admin.png" alt="User picture">
	</div>
	<div class="user-info">
		<span class="user-name"><strong><?php echo strtoupper(htmlspecialchars(USERNAME, ENT_QUOTES));?></strong></span>
		<span class="user-role">Level: <?php echo ucfirst(htmlspecialchars(ROLE, ENT_QUOTES));?></span>
		<span class="user-status">
			<i class="fa fa-circle"></i>
			<span id="online-stats">Offline</span>
		</span>
		<span class="user-status">
			<i class="fa fa-desktop"></i>
			<span id="local-ip">IP
				<?php
				require_once ROOT."/library/netinfo.class.php";
				$env = new NetInfo($_SERVER['HTTP_USER_AGENT']);
				echo $env->ip();
				?>
			</span>
		</span>
	</div>
</div>
<!-- sidebar-header  -->
<div class="sidebar-search">
	<div>
		<div class="input-group">
			<input type="text" class="form-control search-menu" placeholder="Search...">
			<div class="input-group-append">
				<span class="input-group-text">
					<i class="fa fa-search" aria-hidden="true"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<!-- sidebar-search  -->


<div class="sidebar-menu">
	<ul>
		<li class="header-menu"><span>General</span></li>
		<?php
			//Membuat menu pada sidebar
			create_menu("dashboard", "fas fa-home", "Dashboard");
			menu_drop("fas fa-rocket","App");
				menu_drop_child("app/xs", "XS");
			close_menu();

			if (ROLE == 'super') {
				echo '<li class="header-menu"><span>System</span></li>';
				menu_drop("fas fa-cogs","Configuration");
					menu_drop_child("users", "Users");
					menu_drop_child("preferences", "Preferences");
				close_menu();
				create_menu("logs", "fas fa-fingerprint", "Logs");
			}

		?>
</ul>
</div>

<script type="text/javascript">
  // auto-check online stats
    onlineStats();
		function onlineStats(){
			if(navigator.onLine){
				$("#online-stats").removeClass();
				$("#online-stats").toggleClass("text-success");
				$("#online-stats").html("Online");
			} else {
				myFunction();
				$("#online-stats").removeClass();
				$("#online-stats").toggleClass("text-danger");
				$("#online-stats").html("Offline");
			}}$(function(){setInterval(onlineStats, 1000);});
</script>

<style>
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  top: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 30px; opacity: 1;}
}

@keyframes fadein {
  from {top: 0; opacity: 0;}
  to {top: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {top: 30px; opacity: 1;}
  to {top: 0; opacity: 0;}
}

@keyframes fadeout {
  from {top: 30px; opacity: 1;}
  to {top: 0; opacity: 0;}
}
</style>

<div id="snackbar">Your internet connection lost...</div>

<script>
function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
