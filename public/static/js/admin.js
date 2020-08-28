var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
document.addEventListener('DOMContentLoaded', function(){
	var btn_search = document.getElementById('btn_search');
	var form_search = document.getElementById('form_search');
	if(btn_search){
		btn_search.addEventListener('click', function(e){
			e.preventDefault();
			if(form_search.style.display === 'block'){
				document.getElementById('form_search').style.display='none';
			}else{
				document.getElementById('form_search').style.display='block';
			}
			/*
			if(document.getElementById('form_search').style.display='none'){
				document.getElementById('form_search').style.display='block';

			}

			if(document.getElementById('form_search').style.display='block'){
				document.getElementById('form_search').style.display='none';
			}*/
		});

	}
	//evento para la galeri
	if(route == "product_edit"){

		var btn_product_file_image = document.getElementById('btn_product_file_image');
		var product_file_image = document.getElementById('product_file_image');
		btn_product_file_image.addEventListener('click', function(){
			product_file_image.click()
		}, false);

		
		product_file_image.addEventListener('change', function(){
			document.getElementById('form_product_gallery').submit();
		})
	}
	//evento para el mouse over del menu
	route.active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');

	//boton eliminar
	btn_deleted = document.getElementsByClassName('btn-deleted');
	for(i=0; i < btn_deleted.length; i++){
		btn_deleted[i].addEventListener('click', delete_object);
	}
	

	
})

function delete_object(e){
	e.preventDefault();
	var object = this.getAttribute('data-object');
	var action = this.getAttribute('data-action');
	var path = this.getAttribute('data-path');
	var url = base + '/' + path + '/' + object + '/' + action;
	var title, text, icon;
	if (action == "delete") {
		title = "¿Estas seguro de Eliminar este registro?";
		text = "Recuerda que esta accion enviara este elemento a la papelera o lo eliminara de forma definitiva.!"; 
		icon = "warning"; 
	}
	if (action == "restore") {
		title = "¿Quieres Restaurar este elemento?";
		text = "Esta accion restaurara este elemento y estara activo en la base de datos.!"; 
		icon = "info"; 
	}
	swal.fire({
		title: title,
		text: text,
		icon: icon,
		showCancelButton: true,
		cancelButtonText: 'No, cancelar!',

		//buttons: true,
		//dangerMode: true,
	}).then((result) => {
	//.then((willDelete) => {
	 	//if (willDelete) {
	 	if (result.value) {
	    	/*swal("Poof! Your imaginary file has been deleted!", {
	      	icon: "success",

	    });*/
	    	window.location.href = url;
	  	} /*else {
	    	swal("Your imaginary file is safe!");
	  	}*/
	});
}







$(document).ready(function(){
	editor_init('editor');
});

function editor_init(field){
	//CKEDITOR.plugins.addExternal( 'codesnippet', base+'/static/libs/ckeditor/plugins/codesnippet/', 'plugin.js');
	CKEDITOR.replace(field,{
		skin: 'moono',
		//extraPlugins: 'codesnippet,ajax,xml,textmatch,autocomplete,textwatcher,emoji,panelbutton,preview,wordcount'
		toolbar:[
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote' ] },
		{ name: 'document', items: [ 'CodeSnippet', 'EmojiPanel', 'Preview', 'Source' ] }
		]
	});
}