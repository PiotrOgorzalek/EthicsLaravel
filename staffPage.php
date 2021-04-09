<?php
	session_start();
?>

<!DOCTYPE HTML>
<!--
	Striped by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>ENU Student Ethics Resource</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<script src="https://unpkg.com/vue"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="https://unpkg.com/vuetable-2@next"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/main.css" />
		<script type="text/x-template" id="grid-template">

    </script>
	</head>
	<body class="is-preload">

		<!-- Content -->
			<div id="content">
				<div class="inner">

					<!-- Post -->
						<article class="box post post-excerpt">
							<header>
								<!--
									Note: Titles and subtitles will wrap automatically when necessary, so don't worry
									if they get too long. You can also remove the <p> entirely if you don't
									need a subtitle.
								-->
								<h2>Staff</h2>
								<p></p>
							</header>
							<div id="tableApp">
							<table>
									<tr>
										<th>Researcher name</th>
										<th>email</th>
										<th>Project Title</th>
										<th>typeOfResearch</th>
										<th>Starting date</th>
										<th>Aproved</th>

										<tr v-for="row in allData">
										<td>{{row.userName}}</td>
										<td>{{row.email}}</td>
										<td>{{row.projectTitle}}</td>
										<td>{{row.typeOfResearch}}</td>
										<td>{{row.startDate}}</td>
										<!--  depends on the return from database the output will change -->
										<td v-if="row.approved==1">Approved</td>
										<td v-else="row.approved=null">Approval Pending</td>
										<td><a v-bind:href="'viewApplicationPage.php?usersID=' + row.userId">Review Application</a></td>

							</table>
									</tr>

						</article>
				</div>
			</div>

		<!-- Sidebar -->
			<div id="sidebar">

				<!-- Logo -->
					<h1 id="logo"><a href="index.php"><img src ="images/logo.png"></a></h1>

				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="initialAssessmentPage.php">Start app process</a></li>
							<li><a href="resumeApplicationPage.php">Resume Application</a></li>
							<li><a href="faq.php">FAQ</a></li>
							<li><a href="loginPageStaff.php">Staff Login</a></li>
							<?php if(isset($_SESSION['user'])) //check if user is a user and display buttons
						    {
						    ?>
						    <li><a href="logout.php">Logout</a></li>
							<?php } else { // if user is not logged in then display these buttons?>
								<li><a href="loginPage.php">Login</a></li>
							<?php } ?>
						</ul>
					</nav>

				<!-- Copyright -->
					<ul id="copyright">
						<li>&copy; Napier University</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
			</div>

		<!-- Scripts -->
			<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script> <!-- import vue.js -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script>
						var application = new Vue({
							el:'#tableApp',
							data:{
								allData:'',
							},
							methods:{
								fetchAllData:function(){
									axios.post('staffTable.php',{
										action:'fetchall'
									}).then(function(response){
										application.allData = response.data;
									});
								}
							},
							created:function(){
								this.fetchAllData()
							}
						});
					    </script>
	</body>
</html>
