Soluzione:

Questa è la condizione che si deve verificare affinche si possa determinare il codice di
ogni carattere corretto:

(u.charCodeAt(i) + p.charCodeAt(i) + i * 10) == k[i]

per determinare p.charCodeAt(i) "l'equazione" cambia nel seguente modo:

p.charCodeAt(i) = k[i] - i * 10 - u.charCodeAt(i)

Settare nuovamente le variabili e ricostruire lo stesso ciclo for presente nell script.


<script>
var k = new Array(176,214,205,246,264,255,227,237,242,244,265,270,283);
var u = 'administrator';
//var p = 'prova';
var t = true;

var charCode,
    strin = '';

for(i = 0; i < u.length; i++)
{
  charCode = k[i] - ( i * 10 ) - u.charCodeAt(i);
  strin += String.fromCodePoint(charCode);
}

console.log(strin);
</script>
