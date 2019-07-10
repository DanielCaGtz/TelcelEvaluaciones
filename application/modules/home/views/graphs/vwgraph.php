<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Telcel | Gráficas</title>
		<script type="text/javascript">window.url = {base_url:"<?php echo nombre_ruta_host(); ?>"};</script>
		<script src="<?php echo base_url(); ?>js/jquery-1.11.3.js"></script>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>img/icon.png">
		<style type="text/css"></style>
	</head>
	<body>
		<script src="<?php echo base_url(); ?>addons/code/highcharts.js"></script>
		<script src="<?php echo base_url(); ?>addons/code/modules/exporting.js"></script>
		<div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
		<div id="container2" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
		<script type="text/javascript">
			$(document).ready(function(){
				$.post(window.url.base_url+"home/ctrgraph/get_data_from_graph",{},function(resp){
					resp=JSON.parse(resp);
					if(resp.success!==false){
						Highcharts.chart('container', {
							chart: {type: resp.type_main},
							title: {text: resp.title},
							subtitle: {text: resp.subtitle},
							xAxis: {categories: resp.categories},
							yAxis: {title: {text: 'Escala'}},
							plotOptions: {line: {dataLabels: {enabled: true},enableMouseTracking: true}},
							/*
							series: [{
								name: resp.name1,
								data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 2.1]
							}, {
								name: resp.name2,
								data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
							}]*/
							series: resp.data_main
						});
					}else{
						$("#container").html("Hubo un error. Intente más tarde o póngase en contacto con los administradores del sistema.");
					}
				});
			});
		</script>
	</body>
</html>
