$(document).ready(function(){
	$('#log-btn').on('click', function(){
		var form = document.getElementById('log-form');
		form.style.display = 'flex';
	});
	$('#cancel-btn').on('click', function(){
		var form = document.getElementById('log-form');
		form.style.display = 'none';
	});
});