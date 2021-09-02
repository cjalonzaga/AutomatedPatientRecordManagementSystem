<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/helper.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Patients List</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../plugins/jquery-ui.css">
</head>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/aprms/templates/header.php'; ?>
	<div class="patient-contain">
		<div class="container-list">
			<div class="search-container">
				<form method="post" action="" class="form-search">
					<input type="text" placeholder="Search patients here..." id="search-patient">
					<input type="submit" name="" value="Search" id="search-btn">
				</form>
			</div>
			<div class="patient-list">
				<div class="title"><span>Patient List</span></div>
				<?php foreach($patient_lists as $list): ?>
					<form>
						<input type="hidden" name="id" value="<?php htmlout($list['patientid']); ?>">
						<p class="patient_name"><?php htmlout($list['lastname'] .' '. $list['firstname']) ; ?></p>
					</form>
				<?php endforeach; ?>
			</div>
			<div class="button-list">
				<button id="new_record">New Record</button>
				<button id="edit_record">Edit Record</button>
			</div>
		</div>
		<div class="patient-infos">
			<ul id="tab">
				<li><a href="#person_info">Personal Info</a></li>
				<li><a href="#vitals">Vitals</a></li>
				<li><a href="#med-taken">Medicines Taken</a></li>
				<li><a href="#diagnosis">Diagnoses</a></li>
			</ul>
			<div class="tab-pane" id="person_info">
				<form method="post" class="tab-form" id="info_form">
					<input type="hidden" name="id" id="p_id">
					<div>
						<label for="lastname">Lastname: </label>
						<input type="text" name="lastname" placeholder="lastname" class="form_input" id="lastname"> 
					</div>
					<div>
						<label>Firstname: </label>
						<input type="text" name="firstname" placeholder="firstname" class="form_input" id="firstname">
					</div>
					<div>
						<label for="middlename">Middle: </label>
						<input type="text" name="middlename" placeholder="middlename" class="form_input" id="middle">
					</div>
					<div>
						<label for="firstname">Address: </label>
						<input type="text" name="address" placeholder="address" class="form_input" id="address">
					</div>
					<div>
						<label for="date">Date of Birth: </label>
						<input type="date" name="date" class="short-input form_input" id="birthdate">
					</div>
					<div>
						<label for="age">Age: </label>
						<input type="text" name="age" class="short-input form_input" placeholder="Age" id="age">
					</div>
					<div>
						<label for="birthplace">Place of Birth: </label>
						<input type="text" name="birthplace" placeholder="address" class="form_input" id="birthplace">
					</div>
					<div>
						<label for="religion">Religion: </label>
						<input type="text" name="religion" placeholder="religion" class="form_input" id="religion">
					</div>
					<div>
						<label for="sex">Sex: </label>
						<select name="sex" class="short-input form_input" id="sex">
							<option value="">Select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div>
						<label for="status">Status: </label>
						<select name="status" class="short-input form_input" id="status">
							<option value="">Select</option>
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="Widowed">Widowed</option>
						</select>
					</div>
					<div>
						<label for="height">Height: </label>
						<input type="text" name="height" class="short-input form_input" placeholder="height" id="height">
					</div>
					<div>
						<label for="weight">Weight: </label>
						<input type="text" name="weight" class="short-input form_input" placeholder="weight" id="weight">
					</div>
					<div class="button-group" id="submit-contain">
						<input type="submit" value="Add New" name="add_new" id="addnew">
						<input type="submit" value="Update" name="edit" id="update">
					</div>
				</form>
			</div>
			<div class="" id="vitals">
				<div class="vitals-form" id="vitals-form">
					<div class="vitals-contain">
						<div class="div-header"></div>
						<form method="post" id="vital_form">
							<input type="hidden" value="" id="vitalId">
							<span><label for="bp">Blood Pressure:</label>
							<input type="text" name="bp" placeholder="Blood Pressure" id="bp" class="vitals-input"></span>
							<span><label for="rr">Respiratory Rate:</label>
							<input type="text" name="rr" placeholder="Respiratory Rate" id="rr" class="vitals-input"></span>
							<span><label for="pr">Pulse Rate:</label>
							<input type="text" name="pr" placeholder="Pulse Rate" id="pr" class="vitals-input"></span>
							<span><label for="temp">Temperature:</label>
							<input type="text" name="temp" placeholder="Temperature" id="temp" class="vitals-input"></span>
							<input type="button" name="add_vitals" value="" id="" class="vitals_btn">
							<input type="button" value="Close" id="close_vitals">
						</form>
					</div>
				</div>
				<table id="header-table">
					<tr>
						<th>Date</th>
						<th>Blood Pressure</th>
						<th>Respiratory Rate</th>
						<th>Pulse Rate</th>
						<th>Temperature</th>
					</tr>
				</table>	
				<table id="vitals-table">
					
				</table>
				<button id="add_new_vitals">Add New</button>
				<button id="edit_vitals">Edit</button>
				<button id="delete_vitals">Delete</button>
			</div>
			<div class="" id="med-taken">
				<div class="med-form-contain" id="med_form_contain">
					<div class="med-contain">
						<div class="div-header"></div>
						<form method="post" id="med-form">
							<input type="hidden" value="" id="medId">
							<span><label for="med-name">Medicine: </label>
						    <input type="text" name="med-name" id="med-name" placeholder="Medicine taken" class="med-input"></span>
						    <span><label for="dosage">Dosage: </label>
						    <input type="text" name="dosage" id="med-dos" placeholder="Dosage" class="med-input"></span>
						    <span><label for="timing">Timing: </label>
						    <input type="text" name="timing" id="med-timing" placeholder="Timing" class="med-input"></span>
						    <input type="submit" name="ad_med" value="" id="" class="med-btn">
						    <input type="button" value="Close" id="close-med">
						</form>
					</div>
				</div>

				<table id="header-table">
					<tr>
						<th>Date</th>
						<th>Medicine</th>
						<th>Dosage</th>
						<th>Timing</th>
					</tr>
				</table>

				<table id="med-table">
					
				</table>
				
				<button id="add_new_med">Add New</button>
				<button id="edit_med">Edit</button>
				<button id="delete_med">Delete</button>
			</div>
			<div class="" id="diagnosis">
				<div class="diagnosis-contain" id="diagnosis_contain">
					<div class="dia-contain">
						<div class="div-header"></div>
						<form method="post" id="dia-form">
							<input type="hidden" value="" id="diaID">
							<span><label for="s">Subjective: </label>
						    <input type="text" name="s" id="s" placeholder="S" class="dia-input"></span>
						    <span><label for="o">Objective: </label>
						    <input type="text" name="o" id="o" placeholder="O" class="dia-input"></span>
						    <span><label for="a">Assesment: </label>
						    <input type="text" name="a" id="a" placeholder="A" class="dia-input"></span>
						    <span><label for="p">Plan: </label>
						    <input type="text" name="p" id="p" placeholder="P" class="dia-input"></span>
						    <input type="submit" name="ad_dia" value="" id="" class="dia-btn">
						    <input type="button" value="Close" id="close-dia">
						</form>
					</div>
				</div>

				<table id="header-table">
					<tr>
						<th>Date</th>
						<th>S</th>
						<th>O</th>
						<th>A</th>
						<th>P</th>
					</tr>
				</table>

				<table id="dia-table">
					
				</table>
				
				<button id="add_new_dia">Add New</button>
				<button id="edit_dia">Edit</button>
				<button id="delete_dia">Delete</button>
			</div>
		</div>
	</div>
	<script src="../plugins/jquery.js"></script>
	<script src="action_patient.js"></script>
	<script src="../plugins/jquery-ui.js"></script>
	<script>
		$('.patient-infos').tabs();
	</script>
</body>
</html>