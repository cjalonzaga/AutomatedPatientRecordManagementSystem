<!DOCTYPE html>
<html>
<head>
	<title>Automated Patent Record Managemant System</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../plugins/jquery-ui.css">
</head>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/aprms/templates/header.php'; ?>
	<div class="dash-container">
		<ul class="links">
			<li><button>Today Schedule</button></li>
			<li><button>Completed</button></li>
		</ul>
		<div class="inner-header">
			<h3>Today</h3>
			<?php echo date('M , d, Y'); ?>
		</div>
		<div class="dash-table">
			<table class="header-table">
				<tr>
					<th>Patient Name</th>
					<th>Time</th>
				</tr>
			</table>
			<table>
				
			</table>
		</div>
	</div>
	<script src="../plugins/jquery.js"></script>
	<script src="../plugins/jquery-ui.js"></script>
	<script>$('#date-picker').datepicker();</script>
</body>
</html>