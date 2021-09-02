<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/magicquotes.php'; ?>
<?php

	try {
		include $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/connection.aprms.php';

		$sql = 'SELECT patientid, lastname, firstname, middle FROM patients';
		$qry = $pdo->prepare($sql); 
		$qry->execute();

		$result = $qry->fetchAll();
	} catch (Exception $e) {
		echo $e;
	}


	if(isset($_POST['personid'])){
			
			encodePersonsData($_POST['personid']);
			vitalsDataQuery($_POST['personid']);
			setMedicalData($_POST['personid']);
			setDiagnoseData($_POST['personid']);

	}

	function encodePersonsData($id){
		try {
			include $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/connection.aprms.php';

			$qry = 'SELECT * FROM patients WHERE patientid = :patientid';
			$res = $pdo->prepare($qry);
			$res->bindValue(':patientid', $id);
			$res->execute();

			$result = $res->fetchAll();

			foreach ($result as $rows) {
				$person[] = array(
					'patientid' => $rows['patientid'],
					'lastname' => $rows['lastname'],
					'firstname' => $rows['firstname'],
					'middle' => $rows['middle'],
					'address' => $rows['address'],
					'birthdate' => $rows['birthdate'],
					'age' => $rows['age'],
					'birthplace' => $rows['birthplace'],
					'religion' => $rows['religion'],
					'sex' => $rows['sex'],
					'status' => $rows['status'],
					'height' => $rows['height'],
					'weight' => $rows['weight']
				);
			}
		} catch (PDOException $e) {
			echo $e;
			exit();
		}

		$list = json_encode($person);		
		file_put_contents('person_data.json', $list);
	}

	if (isset($_POST['lname']) && isset($_POST['fname']) && isset($_POST['middle']) && isset($_POST['address']) && isset($_POST['bdate']) && isset($_POST['age']) && isset($_POST['placeb']) && isset($_POST['religion']) && isset($_POST['sex']) && isset($_POST['status']) && isset($_POST['height']) && isset($_POST['weight']) && isset($_POST['patient_id'])) {

		try {
			$query = 'UPDATE patients SET lastname=:lastname, firstname=:firstname, middle=:middle, address=:address, birthdate=:birthdate, age=:age, birthplace=:birthplace, religion=:religion, sex=:sex, status=:status, height=:height,  weight=:weight WHERE patientid=:patientid';
			$stmt = $pdo->prepare($query);
			$stmt->bindValue(':lastname', $_POST['lname']);
			$stmt->bindValue(':firstname', $_POST['fname']);
			$stmt->bindValue(':middle', $_POST['middle']);
			$stmt->bindValue(':address', $_POST['address']);
			$stmt->bindValue(':birthdate', $_POST['bdate']);
			$stmt->bindValue(':age', $_POST['age']);
			$stmt->bindValue(':birthplace', $_POST['placeb']);
			$stmt->bindValue(':religion', $_POST['religion']);
			$stmt->bindValue(':sex', $_POST['sex']);
			$stmt->bindValue(':status', $_POST['status']);
			$stmt->bindValue(':height', $_POST['height']);
			$stmt->bindValue(':weight', $_POST['weight']);
			$stmt->bindValue(':patientid', $_POST['patient_id']);
			$stmt->execute();

			vitalsDataQuery($_POST['patient_id']);
		} catch (PDOException $e) {
			echo $e;
			exit();
		}

	}

	if (isset($_POST['l_name']) && isset($_POST['f_name']) && isset($_POST['mid']) && isset($_POST['addr']) && isset($_POST['bdate']) && isset($_POST['age']) && isset($_POST['placeb']) && isset($_POST['religion']) && isset($_POST['sex']) && isset($_POST['status']) && isset($_POST['height']) && isset($_POST['weight'])) {

		try {
			$query = 'INSERT INTO patients SET lastname=:lastname, firstname=:firstname, middle=:middle, address=:address, birthdate=:birthdate, age=:age, birthplace=:birthplace, religion=:religion, sex=:sex, status=:status, height=:height,  weight=:weight';
			$stmt = $pdo->prepare($query);
			$stmt->bindValue(':lastname', $_POST['l_name']);
			$stmt->bindValue(':firstname', $_POST['f_name']);
			$stmt->bindValue(':middle', $_POST['mid']);
			$stmt->bindValue(':address', $_POST['addr']);
			$stmt->bindValue(':birthdate', $_POST['bdate']);
			$stmt->bindValue(':age', $_POST['age']);
			$stmt->bindValue(':birthplace', $_POST['placeb']);
			$stmt->bindValue(':religion', $_POST['religion']);
			$stmt->bindValue(':sex', $_POST['sex']);
			$stmt->bindValue(':status', $_POST['status']);
			$stmt->bindValue(':height', $_POST['height']);
			$stmt->bindValue(':weight', $_POST['weight']);
			$stmt->execute();

			//vitalsDataQuery($_POST['patient_id']);
		} catch (PDOException $e) {
			echo $e;
			exit();
		}

	}

	function vitalsDataQuery($patientID){
		include $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/connection.aprms.php';

		$query = 'SELECT * FROM patientvitals WHERE patient_id = :patient_id';
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':patient_id', $patientID);
		$stmt->execute();

		$vitals = $stmt->fetchAll();

		foreach ($vitals as $key) {
			$vitals_data[] = array('vitals_id' => $key['vitals_id'] ,'date' => $key['date_entry'],'bp' => $key['bp'], 'rr' => $key['rr'], 'pr' => $key['pr'], 'temp' => $key['temp']);
		}
		$v_datas = json_encode($vitals_data);
		file_put_contents('vitals.json', $v_datas);
	}

	// Saving new Vitals from user//
	if (isset($_POST['bp']) && isset($_POST['rr']) && isset($_POST['pr']) && isset($_POST['temp']) && isset($_POST['p_id'])) {
		try {
		 	$sql = 'INSERT INTO patientvitals SET date_entry=CURDATE(), bp=:bp, rr=:rr, pr=:pr, temp=:temp, patient_id=:patient_id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':bp' , $_POST['bp']);
			$stmt->bindValue(':rr' , $_POST['rr']);
			$stmt->bindValue(':pr' , $_POST['pr']);
			$stmt->bindValue(':temp' , $_POST['temp']);
			$stmt->bindValue(':patient_id' , $_POST['p_id']);
			$stmt->execute();

			vitalsDataQuery($_POST['p_id']);

		} catch (PDOException $e) {
			echo $e;
			exit();
		}
	}
	if (isset($_POST['vitalid']) && isset($_POST['b_p']) && isset($_POST['r_r']) && isset($_POST['p_r']) && isset($_POST['te_mp'])){

		try {
		 	$sql = 'UPDATE patientvitals SET bp=:bp, rr=:rr, pr=:pr, temp=:temp WHERE vitals_id = :id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':bp' , $_POST['b_p']);
			$stmt->bindValue(':rr' , $_POST['r_r']);
			$stmt->bindValue(':pr' , $_POST['p_r']);
			$stmt->bindValue(':temp' , $_POST['te_mp']);
			$stmt->bindValue(':id' , $_POST['vitalid']);
			$stmt->execute();

			vitalsDataQuery($_POST['p_id']);

		} catch (PDOException $e) {
			echo $e;
			exit();
		}
	}
 	// add new medicines data and update actions
	if (isset($_POST['med_name']) && isset($_POST['med_dos']) && isset($_POST['med_timing']) && isset($_POST['pid'])) {
		try {
			$sql = 'INSERT INTO patientmed SET med_date = CURDATE() , med_name = :med_name, med_dosage = :med_dosage, med_timing = :med_timing, patient_id = :patient_id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':med_name' , $_POST['med_name']);
			$stmt->bindValue(':med_dosage', $_POST['med_dos']);
			$stmt->bindValue(':med_timing', $_POST['med_timing']);
			$stmt->bindValue(':patient_id', $_POST['pid']);
			$stmt->execute();

			setMedicalData($_POST['pid']);
		} catch (PDOException $e) {
			echo 'Error adding medicines datas ' . $e;
			exit();
		}
	}

	if (isset($_POST['medname']) && isset($_POST['meddos']) && isset($_POST['medtiming']) && isset($_POST['medID'])) {
		try {
			$sql = 'UPDATE patientmed SET med_name = :med_name, med_dosage = :med_dosage, med_timing = :med_timing WHERE med_id = :med_id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':med_name' , $_POST['medname']);
			$stmt->bindValue(':med_dosage', $_POST['meddos']);
			$stmt->bindValue(':med_timing', $_POST['medtiming']);
			$stmt->bindValue(':med_id', $_POST['medID']);
			$stmt->execute();

			setMedicalData($_POST['pid']);
		} catch (PDOException $e) {
			echo 'Error adding medicines datas ' . $e;
			exit();
		}
	}

	if (isset($_POST['med_id']) && isset($_POST['pid'])) {
		try {
			$sql = 'DELETE FROM patientmed WHERE med_id = :medID';
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':medID', $_POST['med_id']);
			$stmt->execute();

			setMedicalData($_POST['pid']);
		} catch (PDOException $e) {
			echo 'Failed to delete medicine datas '. $e;
			exit();
		}
	}

	function setMedicalData($patientID){
		include $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/connection.aprms.php';

		$qry = 'SELECT * FROM patientmed WHERE patient_id = :id';
		$stmt = $pdo->prepare($qry);
		$stmt->bindValue(':id', $patientID);
		$stmt->execute();

		$med = $stmt->fetchAll();

		foreach ($med as $row) {
			$med_datas[] = array('med_id' => $row['med_id'], 'med_date' => $row['med_date'], 'med_name' => $row['med_name'] ,'med_dosage' => $row['med_dosage'], 'med_timing' => $row['med_timing']);
		}

		$m_datas = json_encode($med_datas);
		file_put_contents('medicine.json', $m_datas);
	}

	//adding new diagnoses data
	if (isset($_POST['dia_sub']) && isset($_POST['dia_obj']) && isset($_POST['dia_ass']) && isset($_POST['dia_pla']) && isset($_POST['pid'])) {
		try {
			$sql = 'INSERT INTO patient_diagnosis SET diagnose_date=CURDATE(), subjective=:sub, objective=:obj, assesment=:ass, plan=:pla , patient_ID=:pid';
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':sub', $_POST['dia_sub']);
			$stmt->bindValue(':obj', $_POST['dia_obj']);
			$stmt->bindValue(':ass', $_POST['dia_ass']);
			$stmt->bindValue(':pla', $_POST['dia_pla']);
			$stmt->bindValue(':pid', $_POST['pid']);
			$stmt->execute();

			setDiagnoseData($_POST['pid']);
			
		} catch (PDOException $e) {
			echo "Error adding new diagnoses " . $e;
			exit();
		}
	}

	if (isset($_POST['diasub']) && isset($_POST['diaobj']) && isset($_POST['diaass']) && isset($_POST['diapla']) && isset($_POST['pid']) && isset($_POST['diaID'])) {
		try {
			$sql = 'UPDATE patient_diagnosis SET subjective=:sub, objective=:obj, assesment=:ass, plan=:pla WHERE diagnosis_id =:did';
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':did', $_POST['diaID']);
			$stmt->bindValue(':sub', $_POST['diasub']);
			$stmt->bindValue(':obj', $_POST['diaobj']);
			$stmt->bindValue(':ass', $_POST['diaass']);
			$stmt->bindValue(':pla', $_POST['diapla']);
			$stmt->execute();

			setDiagnoseData($_POST['pid']);
			
		} catch (PDOException $e) {
			echo "Error adding new diagnoses " . $e;
			exit();
		}
	}

	function setDiagnoseData($patient_ID){
		include $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/connection.aprms.php';

		$qry = 'SELECT * FROM patient_diagnosis WHERE patient_ID = :id';
		$stmt = $pdo->prepare($qry);
		$stmt->bindValue(':id', $patient_ID);
		$stmt->execute();

		$dia = $stmt->fetchAll();

		foreach ($dia as $row) {
			$dia_datas[] = array('diagnosis_id' => $row['diagnosis_id'], 'diagnose_date' => $row['diagnose_date'], 'subjective' => $row['subjective'] ,'objective' => $row['objective'], 'assesment' => $row['assesment'], 'plan' => $row['plan']);
		}

		$d_datas = json_encode($dia_datas);
		file_put_contents('diagnose.json', $d_datas);
	}

	if (isset($_POST['diaid']) && isset($_POST['pid'])) {
		try {
			$qry = 'DELETE FROM patient_diagnosis WHERE diagnosis_id = :id';
			$stmt = $pdo->prepare($qry);
			$stmt->bindValue(':id', $_POST['diaid']);
			$stmt->execute();
		} catch (PDOException $e) {
			echo 'Error deletion entry on diagnosis ' . $e;
			exit();
		}
		setDiagnoseData($_POST['pid']);
	}
	//////////////////////////////////////

	if (isset($_POST['tdId']) && isset($_POST['pId'])) {
		try {
			$qry = 'DELETE FROM patientvitals WHERE vitals_id = :vitals_id';
			$stmt = $pdo->prepare($qry);
			$stmt->bindValue(':vitals_id', $_POST['tdId']);
			$stmt->execute();
		} catch (PDOException $e) {
			echo 'Error deletion entry on vitals ' . $e;
			exit();
		}
		vitalsDataQuery($_POST['pId']);
	}

	//Output the patient list on the UI
	foreach ($result as $row) {
	 	$patient_lists[] = array('patientid' => $row['patientid'], 'lastname' => $row['lastname'],'firstname' => $row['firstname'], 'middle' => $row['middle']);
	}


	function encodePatientList(){
		include $_SERVER['DOCUMENT_ROOT'] . '/aprms/includes/connection.aprms.php';
		try {
			$query = 'SELECT patientid , concat(lastname ," ", firstname ) AS namelist FROM patients';
			$qry_data = $pdo->prepare($query); 
			$qry_data->execute();

			$res = $qry_data->fetchAll();

			foreach ($res as $keys) {
				$searchlist[] = array('patientid' => $keys['patientid'] , 'namelist' => $keys['namelist']);
			}

			$patient_searchlist = json_encode($searchlist);
			file_put_contents('searchlist.json', $patient_searchlist);
		} catch (PDOException $e) {
			echo 'Error ecoding patient list to json ' . $e;
			exit();
		}
	}
	encodePatientList();

	//to encode search data to json file from search

	if (isset($_POST['id'])) {
		encodePersonsData($_POST['id']);
		vitalsDataQuery($_POST['id']);
		setMedicalData($_POST['id']);
		setDiagnoseData($_POST['id']);
	}

	include 'patient_list.php';
?>