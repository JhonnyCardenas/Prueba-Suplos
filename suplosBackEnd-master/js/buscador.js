// console.log('algo');

function traer_datos(){
	const xhttp = new XMLHttpRequest();

	xhttp.open('GET', 'data-1.json', true);
	xhttp.send();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {

			let ciudad = JSON.parse(this.responseText);
			let select_ciudad = document.querySelector('#selectCiudad');
			let export_ciudad = document.querySelector('#exportCiudad');
			let select_tipo = document.querySelector('#selectTipo');
			let export_tipo = document.querySelector('#exportTipo');
			select_ciudad.innerHTML = '';
			export_ciudad.innerHTML = '';
			select_tipo.innerHTML = '';
			export_tipo.innerHTML = '';
			let ciudades = [...new Set(ciudad.map(({Ciudad})=>Ciudad))];
			let tipo = [...new Set(ciudad.map(({Tipo})=>Tipo))] ;

			for (var i = ciudades.length - 1; i >= 0; i--) {
				select_ciudad.innerHTML +=`<option value="${ciudades[i]}" selected>${ciudades[i]}</option>`					 
				export_ciudad.innerHTML +=`<option value="${ciudades[i]}" selected>${ciudades[i]}</option>`					 
			}
			for (var i = tipo.length - 1; i >= 0; i--) {
				select_tipo.innerHTML +=`<option value="${tipo[i]}" selected>${tipo[i]}</option>`					 
				export_tipo.innerHTML +=`<option value="${tipo[i]}" selected>${tipo[i]}</option>`					 
			}

		}
	}
}
traer_datos();

