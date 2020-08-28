var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
document.addEventListener('DOMContentLoaded', function(){
	var form_avatar_change = document.getElementById('form_avatar_change');
	var btn_avatar_edit = document.getElementById('btn_avatar');
	var avatar_change_overlay = document.getElementById('avatar_change_overlay');
	var input_file_avatar = document.getElementById('input_file_avatar');
	if(btn_avatar_edit){
		btn_avatar_edit.addEventListener('click', function(e){
			e.preventDefault();
			input_file_avatar.click();
		})
	}
	if(input_file_avatar){
		input_file_avatar.addEventListener('change', function(){
			/*Configurar el icon de cargando, visitar la pagina loading.io para descargar un icono*/
			var load_img = '<img src="'+base+'/static/images/loader.svg" alt="" />'
			avatar_change_overlay.innerHTML = load_img;
			avatar_change_overlay.style.display = 'flex';
			form_avatar_change.submit();
		})
	}	
});