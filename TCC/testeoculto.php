<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<script language="javascript" type="text/javascript">function Mudarestado(el) {
  var display = document.getElementById(el).style.display;
  if (display == "none")
    document.getElementById(el).style.display = 'block';
  else
    document.getElementById(el).style.display = 'none';
}</script>
	<div id="minhaDiv" style="display:none">Conteudo</div>
<button type="button" onclick="Mudarestado('minhaDiv')">Mostrar / Esconder</button>


</body>
</html>

