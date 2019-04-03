<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Popper JS -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="../webroot/css/connexion/style_connexion.css">
<link rel="stylesheet" href="../webroot/css/style_global.css">
<title>ScolNet</title>

</head>

<body>

<div class=" container row mt-5">
    <div class="col col-lg-3 col-sm-4  offset-lg-6 offset-lg-6    col-md-8 offset-md-6  mt-5 text-center">
                        <div id="logo" class="">
                            <span id="logo-1">S</span>
                            <span id="logo-2">c</span>
                            <span id="logo-3">o</span>
                            <span id="logo-4">l</span>
                            <span id="logo-5">N</span>
                            <span id="logo-6">e</span>
                            <span id="logo-7">t</span>
                        </div>
            <form  class="text-center form_login" action="" method="post">
                <div class="form-group">
                <input class="input-form" type="email" name="email" value="" placeholder="Adresse mail">
                </div>
                <p align="center"  class="warningError bg-warning small " id="my" ></p>
			    
             
                <div class="form-group">
                <input class="input-form" type="code" name="code" value="" placeholder="Code d'accès">
                <p align="center"  class="warningError bg-warning small" id="my1" ></p>
                <p class="text-danger ">
                 <input type="hidden" name="form_login_sended" value="1">
                 </p>
                </div>
                <div class="form-group mt-4">
                <a class="button-link" href="#"> Mot de passe oublié</a>
                </div>
                <div class="form-group">
                <button class="button btn-login" type="button" name="button">Se connecter</button>
                </div>
            </form>
    </div>
          
</div>

        <footer>
            <div>
                <hr>
                <span>ScolNet 2019 ©</span>
            </div>
        </footer>
 
    
</body>
<script>
	$(document).on('click','.btn-login', function(){ 
				 var data_login_form = $(".form_login").serialize(); 
					$.ajax({
						type: "POST",
						async: false,
						dataType: "JSON",
						url:"<?php echo SCOLNET.'users/loginTrait';?>",
						data: data_login_form,
						success: function (data){ 
                             $('#my').html(data.email);
							 $('#my1').html(data.code); 
	
                         if( $('#my').text() == '' &&  $('#my1').text() == ''){
                           window.location.href = ' <?php echo SCOLNET.'users/MonCompte';?>';
						}   
                         
						} 
                  
					});   
							
				});
				

</script>

</html>