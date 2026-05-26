<?php
$myXMLData = 
"<?xml version='1.0' encoding='UTF-8'?>
<document>
  <title>¿Cuarenta qué?</title>
  <from>Joe</from>
  <to>Jane</to>
  <body>
    Sé que esa es la respuesta, pero, 
    ¿cuál es la pregunta?
  </body>
</document>";

// Carga el string y lo convierte en objeto
$xml = simplexml_load_string($myXMLData) or die("Error: Cannot create object");

// Muestra la estructura del objeto
echo "<pre>"; // Esta etiqueta ayuda a que se vea ordenado como en tu manual
print_r($xml);
echo "</pre>";
?>