<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>USER_HOME</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../webroot/css/HomeUser/style.css">
       
    </head>
    <body>
       
					<div class="text-center mt-5 loadingmessage" style="display: none; z-index:1000; position:fixed; top:100px; left:600px;">
					 <div id="logo" class="mt-5" style="position: relative; top: 50px;">
                            <span class="text-danger h3" id="logo-1 ">S</span>
                            <?php print_r($data);?>
                            <span  class="text-success h3 " id="logo-2 ">c</span>
                            <span class="text-warning  h3 " id="logo-3 ">o</span>
                            <span  class="text-default  h3"  id="logo-4">l</span>
                            <span  class="text-danger  h3" id="logo-5">N</span>
                            <span  class="text-primary  h3" id="logo-6">e</span>
                            <span class="text-success h3 " id="logo-7">t</span>
                        </div>
						<img class="mb-5" src="../../webroot/images/loader1.gif"/>
						
					</div>
	<div class="container-body">
        <!--header-->
        <?php
      include($_SERVER['DOCUMENT_ROOT']."/view/includes/header.php");
        ?>
        <!--header-->
        <div class="container-fluid">
  		<!--sidebar-->
                <?php
                include($_SERVER['DOCUMENT_ROOT']."/view/includes/sidebar.php");
                ?>
                <!--sidebar-->
                <main class="col-12 col-md-9 col-xl-8" role="main">
                    <!--post-input-->
					<form  class="form_add_post" action="" method="POST">
					
                    <div class="flex-colums border post">
					       <p align="center"  class="warningError bg-warning small " id="my" ></p>
						    <p align="center"  class="warningError bg-warning small" id="my1" ></p>
                        <input class="form-control form-control-sm w-50" type="text" placeholder="Sujet" name="subject_post" value="">
						
						 <input class="" type="hidden" name="hidden_add_post" value="1">
                        <hr>
                        <textarea  name="content_post" class="form-control form-control-sm"></textarea>
						     
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-sm btn_add_post" style="margin-top:20px;">Publier</button>
                        </div>
                    </div>
					</form>
                    <!--post-input-->
                    <!--post-->					
					  <div class="display_content_post">
                    </div>
                </main>
								
				<!----***********************************************************************--- modal de l'update d'un post----------**********************------->
				<div class="modal fade" id="myModal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">

							<div class="modal-content ">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel">Editer le post! </h4>
											   
											
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
																	<form class="form_update_post"  action="" method="post">
																	<p align="center"  class="warningError bg-success" id="updated_compte" ></p>
																		<input type="hidden" name="update_post" value="1">   
																			 <p align="center"  class="warningError bg-warning small " id="my" ></p>
																				<p align="center"  class="warningError bg-warning small" id="my1" ></p>
																			<input class="form-control form-control-sm w-50 update_input_post" type="text" placeholder="Sujet" name="subject_post" value="">
																			<hr>
																			<textarea  name="content_post" class="form-control form-control-sm update_textarea"></textarea>
																		
																		<div class="clearfix"></div><br>
																		<div class="text-right">
																		   <input type="hidden" class="input_idToUpdate" name="idToUpdate" value="">
																			<button type="button" class="btn btn-primary btn_update_post ">Mettre à jour</button>
																		</div>
																	</form>
											</div>
								</div>
					</div>
				</div>
				<!----***********************************************************************--- fin modal de d'update du post----------**********************------->
            </div>
        </div>
	
	
	
	
	
	
				
				
				<script>
				
				$(document).on('click','.btn_add_post', function(){ 
				  $('.loadingmessage').show(); 
				 $(".container-body").css("opacity", "0");
				 var data_add_form = $(".form_add_post").serialize(); 
					$.ajax({
						type: "POST",
						dataType: "JSON",
						url:"<?php echo SCOLNET.'users/addPosts';?>",
						data: data_add_form,
						success: function (data) { 
							// Months array
							 var months_arr = ['Jan','Feb','Mars','Avril','Mai','Juin','Juilllet','Aout','Sep','Oct','Nov','Dec'];
							 // Convert timestamp to milliseconds
							 var date = new Date(data.date*1000);
							 // Year
							 var year = date.getFullYear();
							 // Month
							 var month = months_arr[date.getMonth()];
							 // Day
							 var day = date.getDate();
							 // Hours
							 var hours = date.getHours();
							 // Minutes
							 var minutes = "0" + date.getMinutes();
							 // Seconds
							 var seconds = "0" + date.getSeconds();
							 // Display date time in MM-dd-yyyy h:m:s format
							 var convdataTime = day+' '+month+' '+year+' '+hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
							 $(document).find( ".warningError" ).empty(); 
							 $('#my').html(data.subject_error);
							 $('#my1').html(data.content_error);
							row =     '<div class="flex-colums border post">'+
							'<div class="post-info">'+	
                            '<h5 class="post-name update_input_post " >'+data.subject+'</h5>'+
							  '<h6 align="center" class="bg-success alert-new_pub small p-1">Nouvelle Publication</h5>'+
                            '<div class="text-right">'+
                               ' <span class="poster-name bg-secondary p-1"><?php //echo $_SESSION['user_email']; ?></span>'+
                                '<span>—</span>'+
                                '<span class=" btn btn-default btn-xs float-right post-date border update_textarea">'+convdataTime+'</span>'+
                            '</div>'+
                        '</div>'+
                        '<hr>'+
                        '<div class="p-20">'+
                            '<span>'+data.content+'</span>'+
                        '</div>'+
						'<hr>'+
							'<div class="float-right ml-2">'+
							'<button type="button" data='+data.id+' class="btn  btn-dark btn-sm btn_edit_post " >Modifier</button>'+
							'</div>'+
							'<div class="text-right">'+
							'<button type="button" data='+data.id+' class="btn  btn-warning btn-sm btn_delete_post" >Supprimer</button>'+
							'</div>'+
						 '</div>'
						  if($('#my').text() == '' &&  $('#my1').text() == ''  ){
                    $(document).find( ".display_content_post" ).fadeIn( "slow" ).prepend(row); 
						}
						 $('.loadingmessage').hide(); 
						 $(".container-body").css("opacity", "1");
						 $(document).find( ".alert-new_pub" ).delay( 3500 ).fadeOut( "slow" ); 		
						 $(document).find( ".warningError" ).fadeIn( "slow" ).delay( 1500 ).fadeOut( "slow" ); 
						
						} 
					});   
							
				});
				
				
				
				 $.ajax({
						 type: "POST",
						 async:false,
						 dataType: "JSON",
						 url:"<?php echo SCOLNET.'users/displayPosts';?>",
						 data: '',
					 success: function (data) {     
								data.forEach(function(data){
									// Months array
							 var months_arr = ['Jan','Feb','Mars','Avril','Mai','Juin','Juilllet','Aout','Sep','Oct','Nov','Dec'];
							 // Convert timestamp to milliseconds
							 var date = new Date(data.cdate*1000);
							 // Year
							 var year = date.getFullYear();
							 // Month
							 var month = months_arr[date.getMonth()];
							 // Day
							 var day = date.getDate();
							 // Hours
							 var hours = date.getHours();
							 // Minutes
							 var minutes = "0" + date.getMinutes();
							 // Seconds
							 var seconds = "0" + date.getSeconds();
							 // Display date time in MM-dd-yyyy h:m:s format
							 var convdataTime = day+' '+month+' '+year+' '+hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
							 
															
															row =     '<div class="flex-colums border post">'+
												'<div class="post-info">'+
												'<h5 class="post-name">'+data.subject+'</h5>'+
												'<div class="text-right">'+
												   ' <span class=" bg-success p-1  poster-name"><?php //echo $_SESSION['user_email']; ?></span>'+
													'<span>—</span>'+
													'<span class="post-date border">'+convdataTime+'</span>'+
												'</div>'+
											'</div>'+
											'<hr>'+
											'<div class="p-20">'+
												'<span>'+data.content+'</span>'+
											'</div>'+
											'<hr>'+
											
											'<div class="float-right ml-2">'+
											'<button type="button" data='+data.id+' class="btn  btn-dark btn-sm btn_edit_post " >Modifier</button>'+
											'</div>'+
											'<div class="text-right">'+
											'<button type="button"  data ='+data.id+ ' class="btn  btn-warning btn-sm btn_delete_post " >Supprimer</button>'+
											'</div>'+
											 '</div>'
											$('.display_content_post').append(row);
									
								})
						}
					});  





				
			$(document).on('click','.btn_edit_post', function(e){ 
				e.preventDefault();
				$('#myModal_update').modal('show');	
				var update_id = $(this).attr("data");
				 $('.input_idToUpdate').val(update_id);
					console.log(update_id);
            $.ajax({
                url:"<?php echo SCOLNET.'users/updatePosts';?>",
                type: "POST",
                async:false,
                dataType:"JSON",
                data:'update_id='+update_id,
                success : function(response){
                     $('.update_input_post').val(response[0].subject);
                     $('.update_textarea').val(response[0].content);
                }       
            });
				});
				
				 $(document).on('click','.btn_update_post', function(){
							var data = $(".form_update_post").serialize(); 
								$('.loadingmessage').show(); 
								$(".container-body").css("opacity", "0");
									$.ajax({
										type: "POST",
										async:false,
										dataType: "JSON",
										url:"<?php echo SCOLNET.'users/updatePosts';?>",
										data: data,
									success: function (response) { 
										 $('#upda').html(response);
										        setTimeout(function(){
											  	$('#myModal_update').modal('hide');
												}, 1500);   
											$('.loadingmessage').hide(); 
											$(".container-body").css("opacity", "1");
										} 
											 
										}); 
						  
						
					});
				</script>

    </body>
</html>