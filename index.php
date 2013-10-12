<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="es">
	<head>
	   <meta charset="utf-8">
	    <title>arbeico</title>	
	  	<link href="css/default.css" rel="stylesheet">    
	  	<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">    
	  	<link href="css/jquery.mobile-1.3.2.css" rel="stylesheet">    
	  	


		
		<script type="text/javascript" language="javascript" src="js/default.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" language="javascript" src="./js/jquery-migrate-1.2.0.js"></script>
		<script type="text/javascript" language="javascript" src="js/utiles.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.mobile-1.3.2.js"></script>
		
		
	  </head>

	  <body>
	  	<div class="header"><img src="img/arbeicogris.png"></div>
	  	<div class="maincontent">
	  		<div class="content">
	  			<div id="divestado">
	  				<img src="img/arbeico.png" width="100px">
	  				<br>
	  				<span class="demorado">Selecciona tu estado</span>
	  				<br>
	  				<select name="estado" id="estado" class="combo">
						<option value="1"><span>Aguascalientes</span></option><option value="2"  ><span>Baja California</span></option><option value="3"  ><span>Baja California Sur</span></option><option value="4"  ><span>Campeche</span></option><option value="5"  ><span>Coahuila de Zaragoza</span></option><option value="6"  ><span>Colima</span></option><option value="7"  ><span>Chiapas</span></option><option value="8"  ><span>Chihuahua</span></option><option value="9"  ><span>Distrito Federal</span></option><option value="10"  ><span>Durango</span></option><option value="11"  ><span>Guanajuato</span></option><option value="12"  ><span>Guerrero</span></option><option value="13"  ><span>Hidalgo</span></option><option value="14"  ><span>Jalisco</span></option><option value="15"  ><span>México</span></option><option value="16"  ><span>Michoacán de Ocampo</span></option><option value="17"  ><span>Morelos</span></option><option value="18"  ><span>Nayarit</span></option><option value="19"  ><span>Nuevo León</span></option><option value="20"  ><span>Oaxaca</span></option><option value="21"  ><span>Puebla</span></option><option value="22"  ><span>Querétaro</span></option><option value="23"  ><span>Quintana Roo</span></option><option value="24"  ><span>San Luis Potosí</span></option><option value="25"  ><span>Sinaloa</span></option><option value="26"  ><span>Sonora</span></option><option value="27"  ><span>Tabasco</span></option><option value="28"  ><span>Tamaulipas</span></option><option value="29"  ><span>Tlaxcala</span></option><option value="30"  ><span>Veracruz</span></option><option value="31"  ><span>Yucatán</span></option><option value="32"  ><span>Zacatecas</span></option>
					</select>
					<br>
					<button id="btnestado">Siguiente</button>
	  			</div>
	  			<div id="divciudad" style="display:none">
	  				<div id="logoestadociudad"></div>
	  				<div id="nombreestadociudad"></div>
	  				<br>
	  				<span class="demorado">Selecciona tu ciudad</span>
	  				<br>
	  				<select name="ciudad" id="ciudad" class="combo">
						<option></option>
						
					</select>
					<br>
					<button id="btnempleos">Ver empleos</button>
					<button id="btnbackestados">Regresar</button>
	  			</div>
	  			<div id="divempleos" style="display:none">
	  				<div id="logoestadoempleos"></div>
	  				<div id="nombreestadoempleos"></div>
	  				<div id="nombreciudadempleos"></div>
	  				<br>
	  				<div id="listaempleos"></div>
	  				<button id="btnbackciudades">Regresar</button>
	  				<br>
	  			</div>

	  		</div>


	  	</div>
	  </body>
</html>

<script>
	var base_url="http://www.arbeico.com.mx/tmp/";
	$(function(){
		$('#btnestado').live('click',function(){
			var resp=get_object('mobil/getciudades/','estado='+$('#estado').val());
			$('#ciudad option').remove();
			$.each(resp,function(k,v){
				$('#ciudad').append('<option value="'+v.loc_id+'">'+v.loc_nombre+'</option>');
			});
			$("#divciudad").show("drop", {
                    direction: "right"
                },
                1000);
			$('#divestado').hide();
			var escu=get_object('mobil/getescudo/','estado='+$('#estado').val());
			$('#logoestadociudad,#logoestadoempleos').empty().append('<img src="'+base_url+'images/escudos/'+escu.est_imagen+'">');
			$('#nombreestadociudad,#nombreestadoempleos').empty().append(escu.est_nombre);
		});

		$('#btnbackestados').live('click',function(){
			$('#divciudad').hide();
			$("#divestado").show("drop", {
                    direction: "right"
                },
                1000);
		});



		$('#btnempleos').live('click',function(){
			var ciudad=$( "#ciudad option:selected" ).text();
			$('#nombreciudadempleos').empty().append(ciudad);
			var resp=get_object('mobil/getEmpleos','localidad='+$('#ciudad').val());
			$('#listaempleos').empty();
			var empleo='';
			$.each(resp,function(k,v){
				empleo='';
				empleo+='<div class="empleo" data-role="collapsible">';
   				empleo+='<h3>'+v.pub_titulo+'</h3>';
   				empleo+='<p>'+v.pub_contenido+'</p>';
				empleo+='</div>';
				$('#listaempleos').append(empleo);
			});
			$('div[data-role=collapsible]').collapsible();

			$("#divempleos").show("drop", {
                    direction: "right"
                },
                1000);
			$('#divciudad').hide();
		});

		$('#btnbackciudades').live('click',function(){
			$('#divempleos').hide();
			$("#divciudad").show("drop", {
                    direction: "right"
                },
                1000);
		});
	});
</script>