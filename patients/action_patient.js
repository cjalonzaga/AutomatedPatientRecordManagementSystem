$(document).ready(function(){

	/* patient info events */
	$('#new_record').on('click', function(){
		document.getElementById('info_form').reset();
		$('#vitals-table').empty();
		$('#edit_record').prop('disabled', true);
		document.getElementById('addnew').style.display = 'block';
		document.getElementById('update').style.display = 'none';
		$('.form_input').prop('disabled' , false);
	});

	$('#edit_record').on('click', function(){
		document.getElementById('addnew').style.display = 'none';
		document.getElementById('update').style.display = 'block';
		$('.form_input').prop('disabled' , false);
	});


    /*-----------------------------button controllers disabled-------------------------------*/
	$('#edit_record').prop('disabled', true);
	$('.form_input').prop('disabled' , true);
	$('#edit_vitals').prop('disabled' , true);
	$('#add_new_vitals').prop('disabled' , true);
	$('#delete_vitals').prop('disabled' , true);
	$('#add_new_med').prop('disabled' , true);
	$('#edit_med').prop('disabled' , true);
	$('#delete_med').prop('disabled' , true);
	$('#add_new_dia').prop('disabled' , true);
	$('#delete_dia').prop('disabled' , true);
	$('#edit_dia').prop('disabled' , true);

	$('#addnew').on('click', function(e){
		var pid = $('#p_id').val();
	});

	/*--------------*/
	var current = '';
	var prev = 0;
 	$('.patient_name').on('click' , function(){
 		var dataid = $(this).siblings('input');
 		$('#add_new_vitals').prop('disabled' , false);
 		$('#edit_record').prop('disabled' , false);
 		$('#add_new_med').prop('disabled' , false);
 		$('#add_new_dia').prop('disabled' , false);
 		var person_id = dataid.val();

 		//alert(personid);
 		//console.log(personid);
 		if (person_id != '') {
 			$.ajax({
 				url : 'index.php',
 				type : 'POST',
 				data : {
 					personid : person_id
 				},
 				success : function(){
 					setDatas();
 					if (person_id != prev) {
 						$('#vitals-table').empty();
 						$('#med-table').empty();
 						$('#dia-table').empty();
 						setVitals();
 						setMedicineData();
 						setDiagnoseData();
 						prev = person_id;
 					}
 					else{
 						prev = '';
 					}
 				}
 			});
 		}
 	});

 	function setDatas(){
 		var xhr = new XMLHttpRequest();
		xhr.onload = function(){
		if (xhr.status == 200) {
			var data = JSON.parse(xhr.responseText);
				for(var i = 0 ; i < data.length ; i++){
				   $('#p_id').val(data[i].patientid);
				   $('#lastname').val(data[i].lastname);
				   $('#firstname').val(data[i].firstname);
				   $('#middle').val(data[i].middle);
				   $('#address').val(data[i].address);
				   $('#birthdate').val(data[i].birthdate);
				   $('#age').val(data[i].age);
				   $('#birthplace').val(data[i].birthplace);
				   $('#religion').val(data[i].religion);
				   $('#sex').val(data[i].sex);
				   $('#status').val(data[i].status);
				   $('#height').val(data[i].height);
				   $('#weight').val(data[i].weight);

				   console.log(data[i].patientid+' '+data[i].lastname+' '+data[i].firstname);
				}
			}
		}
		xhr.open('GET', 'person_data.json', true);
		xhr.send(null);
 	}

 	$('#update').on('click', function(e){
 		e.preventDefault();
 		var patient_id = $('#p_id').val();
 		if (patient_id == '') {
 			alert('Please select patient to be edited.');
 		}
 		else{
 			actionUpdateInfo(patient_id);
 		}
 	});

 	$('#addnew').on('click', function(e){
 		e.preventDefault();
 		addNewPatient();
 	});

 	function actionUpdateInfo(pid){
 		var input = document.getElementsByClassName('form_input');

 		var lname = input[0].value , fname = input[1].value , middle = input[2].value ,
 		    address = input[3].value, bdate = input[4].value , age = input[5].value , 
 		    placeb = input[6].value, religion = input[7].value , sex = input[8].value, 
 		    status = input[9].value, height = input[10].value, weight = input[11].value;

	 		if (lname != '' && fname != '' && middle != '' && address != '' && bdate != '' && age != '' &&
	 		   	placeb != '' && religion != '' && sex != '' && status != '' && height != '' && weight != '' && pid != '') {

	 		   	$.ajax({
	 		    	url : 'index.php',
	 		    	type : 'POST',
	 		    	data : {
	 		    		lname : lname, 
	 		    		fname : fname, 
	 		    		middle : middle, 
	 		    		address : address,
	 		    		bdate : bdate, 
	 		    		age : age ,
	 		    		placeb : placeb,
	 		    		religion : religion, 
	 		    		sex : sex ,
	 		    		status : status, 
	 		    		height : height, 
	 		    		weight : weight, 
	 		    		patient_id : pid
	 		    	},
	 		    	success : function(){
	 		    		alert('Updated successfully..');
	 		    		location.reload();
	 		    		setDatas();
	 		    	}
	 		    });
	 		}
	 		else{
	 			alert('please complete fields...');
	 		}
 	}
 	function addNewPatient(){
 		var input = document.getElementsByClassName('form_input');

 		var lname = input[0].value , fname = input[1].value , middle = input[2].value ,
 		    address = input[3].value, bdate = input[4].value , age = input[5].value , 
 		    placeb = input[6].value, religion = input[7].value , sex = input[8].value, 
 		    status = input[9].value, height = input[10].value, weight = input[11].value;

	 		if (lname != '' && fname != '' && middle != '' && address != '' && bdate != '' && age != '' &&
	 		   	placeb != '' && religion != '' && sex != '' && status != '' && height != '' && weight != '') {

	 		   	$.ajax({
	 		    	url : 'index.php',
	 		    	type : 'POST',
	 		    	data : {
	 		    		l_name : lname, 
	 		    		f_name : fname, 
	 		    		mid : middle, 
	 		    		addr : address,
	 		    		bdate : bdate, 
	 		    		age : age ,
	 		    		placeb : placeb,
	 		    		religion : religion, 
	 		    		sex : sex ,
	 		    		status : status, 
	 		    		height : height, 
	 		    		weight : weight
	 		    	},
	 		    	success : function(){
	 		    		alert('Added successfully..');
	 		    		location.reload();
	 		    		setDatas();
	 		    	}
	 		    });
	 		}
	 		else{
	 			alert('please complete fields...');
	 		}
 	}
 	/*-----add vitals modal event handler ---------*/
	$('#add_new_vitals').on('click', function(){
		var form = document.getElementById('vitals-form');
		document.getElementById('vital_form').reset();
		$('.vitals_btn').attr('id' , 'save_vitals');
		form.style.display = 'flex';
		$('#save_vitals').val('Save');
		$('#vitalId').val('');
	});

	$('#close_vitals').on('click', function(){
		document.getElementById('vital_form').reset();
		var form = document.getElementById('vitals-form');
		form.style.display = 'none';
		$('#edit_vitals').prop('disabled' , true);
		$('#delete_vitals').prop('disabled' , true);
		$('.active').removeClass('active');
	});

	$('.vitals_btn').on('click', function(e){
		e.preventDefault();
		var attrID = $('.vitals_btn').attr('id');
		var p_id = $('#p_id').val();
		var vitals = $('.vitals-input');
		var vitalid = $('#vitalId').val();
		var bp = vitals[0].value; 
		var rr = vitals[1].value;
		var pr = vitals[2].value;
		var temp = vitals[3].value;

		if(attrID == 'save_vitals'){
			if(p_id != '' && vitals[0].value != '' && vitals[1].value != '' && vitals[2].value != '' && vitals[3].value != ''){
				$.ajax({
					url : 'index.php',
					type : 'POST',
					data : {
						bp : bp,
						rr : rr,
						pr : pr,
						temp : temp,
						p_id :p_id
					},
					success : function(){
						alert('Vitals saved successfully..');
						$('#vitals-table').empty();
						setVitals();
					}
				});
			}
			else{
				alert('Please complete fields ...');
			}
		}
		if(attrID == 'update_vitals'){
			if (vitalid != '' && vitals[0].value != '' && vitals[1].value != '' && vitals[2].value != '' && vitals[3].value != '') {
				$.ajax({
					url : 'index.php',
					type : 'POST',
					data : {
						b_p : bp,
						r_r : rr,
						p_r : pr,
						te_mp : temp,
						p_id :p_id,
						vitalid : vitalid
					},
					success : function(){
						alert('Vitals updated successfully..');
						$('#vitals-table').empty();
						setVitals();
					}
				});
			}
			else{
				alert('Please complete fields ...');
			}
		}

		//console.log(vitalid);
		document.getElementById('vital_form').reset();
		var form = document.getElementById('vitals-form');
		form.style.display = 'none';
		$('#delete_vitals').prop('disabled' , true);
		$('#edit_vitals').prop('disabled' , true);
	});

	$('#vitals-table').on('click', 'tr' ,function(){
		$('#delete_vitals').prop('disabled' , false);
		$('#edit_vitals').prop('disabled' , false);
		$('.active').removeClass('active');
		$(this).addClass('active');

		var theId = '';
		var id = $(this).children('td:first-child').map(function(){
			theId = $(this).text();
		}).get();

		var datas = $(this).children('td').map(function(){
			return $(this).text();
		}).get();

		var array_data = []; 

		for(var i=2; i<datas.length; i++){
			array_data.push(datas[i]);
		}

		getVitalsEdit(array_data);

		var p_id = $('#p_id').val();
		vitalsObject.pid = p_id;
		vitalsObject.tdId = theId;
		$('#vitalId').val(theId);
	});

	$('#delete_vitals').on('click', function(){
		vitalsObject.delete();
	});

	$('#edit_vitals').on('click' , function(){
		var form = document.getElementById('vitals-form');
		form.style.display = 'flex';
		$('.vitals_btn').val('Update');
		$('.vitals_btn').attr('id' , 'update_vitals');
	});

	function getVitalsEdit(vitals){
		$('#bp').val(vitals[0]);
		$('#rr').val(vitals[1]);
		$('#pr').val(vitals[2]);
		$('#temp').val(vitals[3]);
	}

	var vitalsObject ={
		tdId : '',
		pid : '',
		delete : function(){
				$.ajax({
				url : 'index.php',
				type : 'POST',
				data : { tdId : this.tdId , pId : this.pid},
				success : function(){
					alert('Vitals deleted successfully..');
					$('#vitals-table').empty();
					setVitals();
				}
			});
		}
	};

	function setVitals(){
 		var xhr = new XMLHttpRequest();
		xhr.onload = function(){
			if (xhr.status == 200) {
				var vitals = JSON.parse(xhr.responseText);
				if (vitals != null) {
					for(var i = 0 ; i < vitals.length ; i++){
						var tabledata = '<tr class="inner-data"><td class="v-id">'+vitals[i].vitals_id+'</td>'+'<td><p>'+vitals[i].date+'</p></td>'+'<td><p>'+vitals[i].bp+'</p></td>'+'<td><p>'+vitals[i].rr+'</p></td>'+'<td><p>'+vitals[i].pr+'</p></td>'+'<td><p>'+vitals[i].temp+'</p></td></tr>';
						$('#vitals-table').append(tabledata);
					}
				}
			}
		}
		xhr.open('GET', 'vitals.json', true);
		xhr.send(null);
 	}
 	
 	/*----- Medicine taken --------*/

 	$('#add_new_med').on('click', function(){
 		var med_form = document.getElementById('med_form_contain');
 		med_form.style.display = 'flex';
 		document.getElementById('med-form').reset();
 		$('.med-btn').attr('id','addMed');
 		$('.med-btn').val('Save');
 		$('#medId').val('');
 	});
 	$('#close-med').on('click', function(){
 		var med_form = document.getElementById('med_form_contain');
 		med_form.style.display = 'none';
 		document.getElementById('med-form').reset();
 		$('#edit_med').prop('disabled', true);
 		$('#delete_med').prop('disabled', true);
 		$('.active').removeClass('active');
 	});

 	$('#edit_med').on('click', function(){
 		var form = document.getElementById('med_form_contain');
		form.style.display = 'flex';
		$('.med-btn').val('Update');
		$('.med-btn').attr('id', 'update_med');
 	});

 	$('#med-table').on('click', 'tr' ,function(){
 		$('#edit_med').prop('disabled', false);
 		$('#delete_med').prop('disabled', false);
 		$('.active').removeClass('active');
		$(this).addClass('active');

 		var medID = '';
 		$(this).children('td:first-child').map(function(){
 			medID = $(this).text();
 		}).get();

 		var med_data = $(this).children('td').map(function(){
 			return $(this).text();
 		});
 		var datas = [];

 		for(var i = 2; i<med_data.length; i++){
 			datas.push(med_data[i]);
 		}
 		setEditMedData(datas);

 		var p_id = $('#p_id').val();
 		medObject.p_id = p_id;
		medObject.med_Id = medID;
 		$('#medId').val(medID);

 		//medObject.delete();
 	});

 	$('.med-btn').on('click', function(e){
 		e.preventDefault();
 		var pid = $('#p_id').val();
 		var medID = $('#medId').val();
 		var med_data = $('.med-input');
 		var med_name = med_data[0].value;
 		var med_dos = med_data[1].value;
 		var med_timing = med_data[2].value;
 		//console.log(medID);
 		var med_attr_id = $(this).attr('id');

 		if(med_attr_id == 'addMed'){
 			if (med_name != '' && med_dos != '' && med_timing != '') {
 				$.ajax({
 					url : 'index.php',
 					type : 'POST',
 					data: {
 						med_name : med_name,
 						med_dos : med_dos,
 						med_timing : med_timing,
 						pid : pid
 					},
 					success : function(){
 						alert('Medical datas added successfully..');
						$('#med-table').empty();
						setMedicineData();
 					}
 				});
 			}
 			else{
 				alert('Please complete fields...')
 			}
 		}
 	
 		if(med_attr_id == 'update_med'){
 			if (med_name != '' && med_dos != '' && med_timing != '') {
 				$.ajax({
 					url : 'index.php',
 					type : 'POST',
 					data: {
 						medname : med_name,
 						meddos : med_dos,
 						medtiming : med_timing,
 						medID : medID,
 						pid : pid
 					},
 					success : function(){
 						alert('Medical datas updated successfully..');
						$('#med-table').empty();
						setMedicineData();
 					}
 				});
 			}
 			else{
 				alert('Please complete fields...')
 			}
 		}

 		document.getElementById('med-form').reset();
		var form = document.getElementById('med_form_contain');
		form.style.display = 'none';
		$('#delete_med').prop('disabled' , true);
		$('#edit_med').prop('disabled' , true);

 	});

 	function setEditMedData(datas){
 		$('#med-name').val(datas[0]);
 		$('#med-dos').val(datas[1]);
 		$('#med-timing').val(datas[2]);
 	}

 	$('#delete_med').on('click', function(){
 		//console.log(medObject.med_Id+' '+medObject.p_id);
 		medObject.delete();
 	});

 	var medObject ={
		med_Id : '',
		p_id : '',
		delete : function(){
			$.ajax({
				url : 'index.php',
				type : 'POST',
				data : { med_id : this.med_Id , pid : this.p_id},
				success : function(){
					alert('Medicine data deleted successfully..');
					$('#med-table').empty();
					setMedicineData();
				}
			});
		}
	};

 	function setMedicineData(){
 		var xhr = new XMLHttpRequest();
		xhr.onload = function(){
			if (xhr.status == 200) {
				var med = JSON.parse(xhr.responseText);
				if (med != null) {
					for(var i = 0 ; i < med.length ; i++){
						var tabledata = '<tr class="med-data"><td class="m-id">'+med[i].med_id+'</td>'+'<td><p>'+med[i].med_date+'</p></td>'+'<td><p>'+med[i].med_name+'</p></td>'+'<td><p>'+med[i].med_dosage+'</p></td>'+'<td><p>'+med[i].med_timing+'</p></td></tr>';
						$('#med-table').append(tabledata);
					}
				}
			}
		}
		xhr.open('GET', 'medicine.json', true);
		xhr.send(null);
 	}

 	// Diagnoses Section
 	$('#add_new_dia').on('click', function(){
 		var dia_form = document.getElementById('diagnosis_contain');
 		dia_form.style.display = 'flex';
 		document.getElementById('dia-form').reset();
 		$('.dia-btn').attr('id','add_diagnoses');
 		$('.dia-btn').val('Save');
 		$('#diaID').val('');
 	});

 	$('#close-dia').on('click', function(){
 		var dia_form = document.getElementById('diagnosis_contain');
 		dia_form.style.display = 'none';
 		document.getElementById('dia-form').reset();
 		$('#edit_dia').prop('disabled', true);
 		$('#delete_dia').prop('disabled', true);
 		$('.active').removeClass('active');
 	});

 	$('#edit_dia').on('click', function(){
 		var form = document.getElementById('diagnosis_contain');
		form.style.display = 'flex';
		$('.dia-btn').val('Update');
		$('.dia-btn').attr('id', 'update_dia');
 	});

 	$('#dia-table').on('click', 'tr' ,function(){
		$('#delete_dia').prop('disabled' , false);
		$('#edit_dia').prop('disabled' , false);
		$('.active').removeClass('active');
		$(this).addClass('active');

		var theId = '';
		var id = $(this).children('td:first-child').map(function(){
			theId = $(this).text();
		}).get();

		var dia_datas = $(this).children('td').map(function(){
			return $(this).text();
		}).get();

		var array_data = []; 

		for(var i=2; i<dia_datas.length; i++){
			array_data.push(dia_datas[i]);
		}

		getDiagnoseEdit(array_data);

		var p_id = $('#p_id').val();
		diagnoseObject.p_id = p_id;
		diagnoseObject.dia_id = theId;
		$('#diaID').val(theId);
	});

 	$('.dia-btn').on('click', function(e){
 		e.preventDefault();

 		var pid = $('#p_id').val();
 		var diaID = $('#diaID').val();
 		var dia_data = $('.dia-input');
 		console.log(diaID);
 		var dia_s = dia_data[0].value;
 		var dia_o = dia_data[1].value;
 		var dia_a = dia_data[2].value;
 		var dia_p = dia_data[3].value;
 		//console.log(pid);
 		var dia_attr_id = $(this).attr('id');

 		if (dia_attr_id == 'add_diagnoses') {
 			if (dia_s != '' && dia_o !='' && dia_a != '' && dia_p != '') {
 				$.ajax({
 					url : 'index.php',
 					type : 'POST',
 					data: {
 						dia_sub : dia_s,
 						dia_obj : dia_o,
 						dia_ass : dia_a,
 						dia_pla : dia_p,
 						pid : pid
 					},
 					success : function(){
 						alert('Diagnose datas added successfully..');
						$('#dia-table').empty();
						setDiagnoseData();
 					}
 				});
 			}
 			else{
 				alert('Please complete fields...');
 			}
 		}
 		if(dia_attr_id == 'update_dia'){
 			if (dia_s != '' && dia_o !='' && dia_a != '' && dia_p != '') {
 				$.ajax({
 					url : 'index.php',
 					type : 'POST',
 					data: {
 						diasub : dia_s,
 						diaobj : dia_o,
 						diaass : dia_a,
 						diapla : dia_p,
 						pid : pid,
 						diaID : diaID
 					},
 					success : function(){
 						alert('Diagnose datas updated successfully..');
						$('#dia-table').empty();
						setDiagnoseData();
 					}
 				});
 			}
 			else{
 				alert('Please complete fields...');
 			}
 		}

 		document.getElementById('dia-form').reset();
		var dia_form = document.getElementById('diagnosis_contain');
		dia_form.style.display = 'none';
		$('#delete_dia').prop('disabled' , true);
		$('#edit_dia').prop('disabled' , true);
 	});

 	function getDiagnoseEdit(datas){
 		$('#s').val(datas[0]);
 		$('#o').val(datas[1]);
 		$('#a').val(datas[2]);
 		$('#p').val(datas[3]);
 	}

 	$('#delete_dia').on('click', function(){
 		//console.log(diagnoseObject.dia_id+' '+diagnoseObject.p_id);
 		diagnoseObject.delete();
 	});

 	var diagnoseObject = {
 		dia_id : '',
 		p_id : '',
 		delete : function(){
 			$.ajax({
				url : 'index.php',
				type : 'POST',
				data : { diaid : this.dia_id , pid : this.p_id},
				success : function(){
					alert('Diagnosed data deleted successfully..');
					$('#dia-table').empty();
					setDiagnoseData();
				}
			});
 		}
 	};

 	function setDiagnoseData(){
 		var xhr = new XMLHttpRequest();
		xhr.onload = function(){
			if (xhr.status == 200) {
				var dia = JSON.parse(xhr.responseText);
				if (dia != null) {
					for(var i = 0 ; i < dia.length ; i++){
						var tabledata = '<tr class="dia-data"><td class="d-id">'+dia[i].diagnosis_id+'</td>'+'<td><p>'+dia[i].diagnose_date+'</p></td>'+'<td><p>'+dia[i].subjective+'</p></td>'+'<td><p>'+dia[i].objective+'</p></td>'+'<td><p>'+dia[i].assesment+'</p></td>'+'<td><p>'+dia[i].plan+'</p></td></tr>';
						$('#dia-table').append(tabledata);
					}
				}
			}
		}
		xhr.open('GET', 'diagnose.json', true);
		xhr.send(null);
 	}

 	//create a array that will store all autocomplete search list
 	var terms = [];
	var xhr = new XMLHttpRequest();
	xhr.onload = function(){
		if (xhr.status === 200) {
				data = JSON.parse(xhr.responseText);
				for(var i =0; i<data.length; i++){
					terms.push(data[i].namelist);
				}
			}
		}
	xhr.open('GET', 'searchlist.json', true);
	xhr.send(null);

	
	$('#search-patient').autocomplete({
		source : terms,
		minLength: 2
	});

	//if seach button is click the send the person id through ajax and will encode the query result
	$('#search-btn').on('click' ,function(e){
		e.preventDefault();

		var text = $('#search-patient').val();

		if (text != '') {
			$('#vitals-table').empty();//clear table after search to prevent duplicates
	 		$('#med-table').empty();
	 		$('#dia-table').empty();
		}
		//console.log(text);

		var xhr = new XMLHttpRequest();
		xhr.onload = function(){
			if (xhr.status === 200) {
					data = JSON.parse(xhr.responseText);
					for(var i =0; i<data.length; i++){
						if (text == data[i].namelist) {
							var id_for_search = data[i].patientid;
							sendAjaxDataSearch(id_for_search);
						}
					}
				}
			}
		xhr.open('GET', 'searchlist.json', true);
		xhr.send(null);

		$('#search-patient').val('');
	});

	function sendAjaxDataSearch(search_id){
		var s_id = '';
		$.ajax({
			url : 'index.php',
			type : 'POST',
			data : {id : search_id},
			success : function(){
				setDatas();
				if(search_id != s_id){
					setVitals();
					setMedicineData();
					setDiagnoseData();
					s_id = search_id;
				}else{
					s_id = '';
				}
			}
		});
	}
	//search name code ending
});
