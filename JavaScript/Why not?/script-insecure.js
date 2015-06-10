// Look's like weak JavaScript auth script :)
			$(".c_submit").click(function(event) {
				event.preventDefault();
				var k = new Array(176,214,205,246,264,255,227,237,242,244,265,270,283);
				var u = $("#cuser").val();
				var p = $("#cpass").val();
				var t = true;

				if(u == "administrator") {
					for(i = 0; i < u.length; i++) {
						if((u.charCodeAt(i) + p.charCodeAt(i) + i * 10) != k[i]) {
							$("#cresponse").html("<div class='alert alert-danger'>Wrong password sorry.</div>");
							t = false;
							break;
						}
					}
				} else {
					$("#cresponse").html("<div class='alert alert-danger'>Wrong password sorry.</div>");
					t = false;
				}
				if(t) {
					if(document.location.href.indexOf("?p=") == -1) {
						document.location = document.location.href + "?p=" + p;
               			}
				}
			});


/*
 *  Codice commentato
*/

  var k = new Array(176,214,205,246,264,255,227,237,242,244,265,270,283);

  //variabile settata manualmente per effetture dei test
  var u = 'administrator';
  //variabile settata manualmente per effetture dei test
  var p = 'prova';

  var t = true;

  // L'utenza è administrator
  if(u == "administrator") {
    for(i = 0; i < u.length; i++) {

      /*
       * Per evitare che sia vera la condizione dell'IF che segue occorre fare in modo che:
       *
       * (u.charCodeAt(i) + p.charCodeAt(i) + i * 10) == k[i]
       *
       * per determinare quale sia carattere corretto per ogni posizione della stringa,
       * bisogna ricostruire il ciclo for riposizionando opportunamente i vari fattori della
       * condizione dell'IF
      */
      if((u.charCodeAt(i) + p.charCodeAt(i) + i * 10) != k[i]) {

        //$("#cresponse").html("<div class='alert alert-danger'>Wrong password sorry.</div>");
        console.log('Wrong password sorry. Note: cycle for');

        t = false;
        break;
      }

    }
  } else {

    //$("#cresponse").html("<div class='alert alert-danger'>Wrong password sorry.</div>");
    console.log('Wrong password sorry. Note: user must be administator');

    t = false;
  }

  /*
  // commentato perchè non necessario in fase di test

  if(t) {
    if(document.location.href.indexOf("?p=") == -1) {
      document.location = document.location.href + "?p=" + p;
               }
  }
  */
