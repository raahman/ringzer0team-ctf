// Look's like weak JavaScript auth script :)
			$(".c_submit").click(function(event) {
				event.preventDefault();
				var p = $("#cpass").val();
				if(Sha1.hash(p) == "b89356ff6151527e89c4f3e3d30c8e6586c63962") {
				    if(document.location.href.indexOf("?p=") == -1) {
				        document.location = document.location.href + "?p=" + p;
				    }
				} else {
				    $("#cresponse").html("<div class='alert alert-danger'>Wrong password sorry.</div>");
				}
			});
