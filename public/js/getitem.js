function getitem($route, $id){
	if ($id.length > 0) {
        fetch($route + "/" + $id ).then(function(response) {
          var contentType = response.headers.get("content-type");
          if(contentType && contentType.indexOf("application/json") !== -1) {
            return response.json().then(function(json) {
              // process your JSON further


                            //console.log(json);
                            $("tbody").children().remove()
                            
                            if(json.erro){
                            
                            	den_item.value  = "";
                            	cod_unid_med.value  = "";
                            	
                            	
                            	$('#msg').show();
                            	setInterval(function () {
							    	 $('#msg').hide(); // show next div
							    }, 5 * 2000); // do this every 10 seconds    
                            } else {
                            	 den_item.value  = json.den_item;
                            	 cod_unid_med.value  = json.cod_unid_med;
                            	
                            }

                           
                            



            });

          } else {
            console.log("Oops, we haven't got JSON!");
          }
        });
    
    } else {
        console.log("Cep invalido");
		modal("Cep invalido ou não encotrado");
    }
}