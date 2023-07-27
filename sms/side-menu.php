<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">
    <div class="sidebar-wrapper" id="sideLinks">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    School Management
                </a>
            </div>
            <ul class="nav">
                <li class="" id="dashboard">
                    <a href="index.php" class="menu-link">
                        <i class="ti-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li id="students">
                    <a href="students.php" class="menu-link">
                        <i class="ti-user"></i>
                        <p>Student</p>
                    </a>
                </li>
                <li id="classes">
                    <a href="classes.php" class="menu-link">
                        <i class="ti-crown"></i>
                        <p>Classes</p>
                    </a>
                </li>
				<li id="sections">
                    <a href="sections.php" class="menu-link">
                        <i class="ti-crown"></i>
                        <p>Sections</p>
                    </a>
                </li>
                <li id="teacher">
                    <a href="teacher.php" class="menu-link">
                        <i class="ti-home"></i>
                        <p>Teacher</p>
                    </a>
                </li>
				<li id="subjects">
                    <a href="subjects.php" class="menu-link">
                        <i class="ti-home"></i>
                        <p>Subjects</p>
                    </a>
                </li>
				<li id="attendance">
                    <a href="attendance.php" class="menu-link">
                        <i class="ti-bar-chart-alt"></i>
                        <p>Attendance</p>
                    </a>
                </li>  
				<li id="attendance_report">
					<a href="attendance_report.php" class="menu-link">
					<i class="ti-bar-chart-alt"></i>
					<p>Attendance Report</p>
					</a>
				</li>   				
            </ul>
    	</div>
    </div>

<div class="main-panel">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar bar1"></span>
					<span class="icon-bar bar2"></span>
					<span class="icon-bar bar3"></span>
				</button>
				<a class="navbar-brand" href="#">School Management System</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="ti-user"></i>
						<p class="notification"></p>
						<p><strong><?php echo $_SESSION["admin"]; ?></strong></p>
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
						<li><a href="profile.php"><i class="fa fa-user"></i> <strong>Profile</strong> </a></li>
						<li>               
						<a href="settings.php"><i class="fa fa-cog"></i> <strong>Settings</strong></a>
						</li>
						<li>
						<a href="logout.php"><i class="fa fa-power-off"></i> <strong>Logout</strong></a>
						</li>
						</ul>
					</li>
				</ul>
				</li>
				</ul>
			</div>
		</div>
	</nav>