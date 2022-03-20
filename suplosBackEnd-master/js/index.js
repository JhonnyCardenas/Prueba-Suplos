/*
  Creación de una función personalizada para jQuery que detecta cuando se detiene el scroll en la página
*/
$.fn.scrollEnd = function(callback, timeout) {
  $(this).scroll(function(){
    var $this = $(this);
    if ($this.data('scrollTimeout')) {
      clearTimeout($this.data('scrollTimeout'));
    }
    $this.data('scrollTimeout', setTimeout(callback,timeout));
  });
};
/*
  Función que inicializa el elemento Slider
*/

let valueSliderFrom = 200;
let valueSliderTo = 100000;

function inicializarSlider(){
  $("#rangoPrecio").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 100000,
    from: 200,
    to: 80000,
    prefix: "$",
    onChange: function (data) {
        valueSliderFrom = data.from;
        valueSliderTo = data.to;
    }
  });
}
/*
  Función que reproduce el video de fondo al hacer scroll, y deteiene la reproducción al detener el scroll
*/
function playVideoOnScroll(){
  var ultimoScroll = 0,
      intervalRewind;
  var video = document.getElementById('vidFondo');
  $(window)
    .scroll((event)=>{
      var scrollActual = $(window).scrollTop();
      if (scrollActual > ultimoScroll){
       
     } else {
        //this.rewind(1.0, video, intervalRewind);
        // video.play();
     }
     ultimoScroll = scrollActual;
    })
    .scrollEnd(()=>{
      // video.pause();
    }, 10)
}

inicializarSlider();
playVideoOnScroll();


function guardar_datos($id){
  $.ajax({
    url: 'procesos/guardar_datos.php',
    type: 'POST',
    dataType: 'JSON',
    data: {id: $id},
  })
  .done(function(respuesta) {
    if (respuesta){
      window.alert("Terreno comprado");
    } else {
      window.alert("Lo lamento no se pudo comprar el terreno"); 
    }
  })
}

function eliminar_datos($id){
  $.ajax({
    url: 'procesos/eliminar_datos.php',
    type: 'POST',
    dataType: 'JSON',
    data: {id: $id},
  })
  .done(function(respuesta) {
    if (respuesta){
      window.alert("Terreno no comprado");
    } else {
      window.alert("Lo lamento le toco comprarlo"); 
    }
  })
  .fail(function() {
    console.log("error")
  });
}


function mostrar_comprado(){  
  $.ajax({
    url: 'procesos/mostrar_datos_comprados.php',
    type: 'POST',
    dataType: 'JSON',
    data: {estado: 'comprado'},
  })
  .done(function(respuesta) {
    var guardados = document.getElementById('resultados_guardados');
    if (respuesta){
      guardados.innerHTML = respuesta.tabla+'<br>';
    } else {
      guardados.innerHTML = "No se tienen bienes comprados"; 
    }
  })
  .fail(function() {
    console.log("error")
  });
}



function filtro_datos(){

  var ciudadFilter = document.getElementById('selectCiudad');
  var tipoFilter = document.getElementById('selectTipo');
  var rangoFilterFrom = valueSliderFrom;
  var rangoFilterTo = valueSliderTo;

  $.ajax({
    url: 'procesos/mostrar_datos.php',
    type: 'POST',
    dataType: 'JSON',
    data: {ciudadFilter: ciudadFilter.value,
           tipoFilter: tipoFilter.value,
           rangoFilterFrom: rangoFilterFrom,
           rangoFilterTo: rangoFilterTo
          },
  })
  .done(function(respuesta) {
    var div = document.getElementById('resultados_datos');
    if (respuesta){
      div.innerHTML = respuesta.tabla+'<br>';
    } else {
      div.innerHTML = "No se tienen datos con el filtro aplicado"; 
    }
  })
  .fail(function() {
    console.log("error")
  });
}

function mostrar_todos_datos(){

  const xhttp = new XMLHttpRequest();

  xhttp.open('GET', 'data-1.json', true);
  xhttp.send();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {

      let ciudad = JSON.parse(this.responseText);
      let resultados = document.querySelector('#resultados_datos');
      resultados.innerHTML='';

      for (let items of ciudad) {
        resultados.innerHTML += `
        <table id='tabla_items_${items.Id}'>
          <tr>
             <td rowspan='8'></td>
             <td rowspan='8'>
              <img style='width: 80% ' src='img/home.jpg' /> 
             </td>
            </tr>
            <tr>
             <td scope='row'>Direccion: </td>
             <td>${items.Direccion}</td>
            </tr>
            <tr>
             <td>Ciudad: </td>
             <td>${items.Ciudad}</td>
            </tr>
            <tr>
             <td>Telefono: </td>
             <td>${items.Telefono}</td>
            </tr>
            <tr>
             <td>Codigo postal: </td>
             <td>${items.Codigo_Postal}</td>
            </tr>
            <tr>
             <td>Tipo: </td>
             <td>${items.Tipo}</td>
            </tr>
            <tr>
             <td>Precio: </td>
             <td>${items.Precio}</td>
            </tr>
            <tr>
             <td></td>
             <td><button class='btn green' onclick='guardar_datos(${items.Id})' id='btn_casa_${items.Id}' type='button'>Guardar</button></td>
            </tr>         
          </table><br>
          <div class="divider"></div>`;
      }
    }
  }
} 