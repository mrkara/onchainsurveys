<section class="section custom-circles-container section-angled bg-dark border-0 m-0" style="background-image: url(assets/onchainsurveys/img/bg/bg-1.jpg); background-size: cover; background-position: center;" id="home_allsurveys" >
 

					<span class="custom-circle custom-circle-1 bg-color-light custom-circle-blur appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="100" data-plugin-options="{'forceAnimation': true}"></span>
					<span class="custom-circle custom-circle-2 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="200" data-plugin-options="{'forceAnimation': true}"></span>
					<span class="custom-circle custom-circle-3 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="300" data-plugin-options="{'forceAnimation': true}"></span>
					<span class="custom-circle custom-circle-1 bg-color-light custom-circle-blur appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400" data-plugin-options="{'forceAnimation': true}"></span>
					<span class="custom-circle custom-circle-2 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="500" data-plugin-options="{'forceAnimation': true}"></span>
					<span class="custom-circle custom-circle-3 bg-color-primary appear-animation" data-appear-animation="zoomIn" data-appear-animation-delay="600" data-plugin-options="{'forceAnimation': true}"></span>
					<div class="section-angled-layer-bottom section-angled-layer-increase-angle"></div>
					<div class="section-angled-content">
						<div class="container pt-md-5 pb-lg-4 mt-5 mb-lg-5">
							<div class="row pb-lg-5 mt-5 mb-lg-5">
								<div class="col-lg-7 pt-5 pt-md-0 pb-lg-5 mt-5 mb-md-5">
									<h1 class="text-color-light font-weight-extra-bold text-10 text-md-12-13 line-height-2 mb-4 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="850">Survey Details</h1>

 
									<a href="survey/create#create" data-hash data-hash-offset="0" data-hash-offset-lg="100" class="btn btn-outline custom-btn-outline btn-primary rounded-0 font-weight-semibold text-color-light bg-color-hover-primary custom-btn-with-arrow text-4 btn-px-4 py-3 mt-2 ms-2 appear-animation surveyButons" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1100">Create Survey</a>

									 <a href="survey#all" data-hash data-hash-offset="0" data-hash-offset-lg="100" class="btn btn-outline custom-btn-outline btn-primary rounded-0 font-weight-semibold text-color-light bg-color-hover-primary custom-btn-with-arrow text-4 btn-px-4 py-3 mt-2 ms-2 appear-animation surveyButons" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1100">All Surveys</a>
									 
 									<div id="all_surveys" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1100"></div>

								</div>
							</div>
							<div class="spacer py-5 mt-lg-5 mb-md-5"></div>
						</div>
					</div>
				</section>

				<section class="custom-cards p-relative mb-5 pb-5 z-index-2">
					<div class="container">
						<div class="row">


						<!-- survey --> 
						<?php  //pre($item); ?>
						<?php  //pre($list); ?>

						 
						
 						<div class="col-lg-12" id="all_surveys2">
							<div class="card border-0 bg-color-dark rounded-0 z-index-1 p-5 appear-animation table-responsive" data-appear-animation="maskUp" data-appear-animation-delay="100">

								<div class="d-flex justify-content-end">
									<?php go_back(); ?>
								</div>

								<hr>

								<table class="text-white">
									<h4>About Survey</h4>
									<tr>
										<td>Survey Title :</td>
										<td><?php echo $item->title; ?></td>
									</tr>
									<tr>
										<td>Survey Type :</td>
										<td><?php echo $item->type; ?></td>
									</tr>
									<tr>
										<td>Survey Start Date :</td>
										<td> <?php echo $item->start_date; ?></td>
									</tr>
									<tr>
										<td>Survey End Date :</td>
										<td><?php echo $item->end_date; ?></td>
									</tr>

									<tr>
										<td>Approval :</td>
										<td><?php echo is_approval_icon($item->is_approved); ?></td>
									</tr>


								</table>
								<hr>
								<div id="time" class="text-center" style="font-size: 25px;"></div>
 								 <hr>

								  <table class="table table-hover">
								  	 <h4>Survey Questions</h4>
									  <?php 
 									  foreach ($list as $key => $value) {  //pre($value);
 									 	$questions_arr = get_question_participate($value->question_id);
 									 	//pre($all_answers);
  									 	
  									 	if($questions_arr){
 									 		$total_vote = count($questions_arr);
 									 	}else{
 									 		$total_vote = 0;
 									 	}
 									 	 
 									 	//$answer_arr = get_questions_answer($value->question_id);

									 	//pre($questions_arr);
									   ?>
									  	 <tr>
									  	 	<td style="min-width: 250px;">
									  	 		<?=++$key .") ". $value->text;?>
									  	 	</td>
									  	 	<td>
									  	 		<ul style="list-style-type: none;">
									  	 		<?php 
									  	 			$options_arr =  json_decode($value->options);
									  	 			 // pre($options_arr);
 									  	 			foreach ($options_arr as $key => $option) { ?>
 									  	 				<li> 
	 									  	 				<span ><?=$key.' ) ';?></span> 
	 									  	 				<?=$option;?>   
 									  	 				</li>
 									  	 				<!-- <span><?=$key.' ) ';?></span> <?=$option.'<br>';?> -->
									  	 			<?php } ?>
								  	 			</ul>
									  	 	</td>
									  	 		

									  	 	<td>
									  	 		 
 									  	 	</td>
									  	 </tr>
									  <?php } ?>

								  </table>


								  		<form action="survey/approve_update/<?=$item->survey_id;?>" id="approve_form" class=""  method="POST"  onsubmit="return false;">
								  			<div class="row">
								  				<div class="col-md-4 offset-3">
									  				<div class="form-group">
															<div class="text-center">
																	<select name="is_approved" id="is_approved" class="form-control rounded-0 text-color-light bg-color-secondary"> <!--  border-0 -->
																		<option value="">Select option</option>
																		<option value="1" <?=$item->is_approved == 1 ? ' selected' : null;?> >Approved</option>
																		<option value="0" <?=$item->is_approved == 0 ? ' selected' : null;?> >Waiting For Approval
																		<option value="2" <?=$item->is_approved == 2 ? ' selected' : null;?> >Reject</option>
 																	</select>
																	<span id="is_approve_error" class="form_error"></span>

															</div>
														</div>
									  			</div>

									  			<div class="col-md-4">
									  					<div class="form-group">
									  						<div class="text-left">
									  							<button type="button" class="btn btn-outline-secondary btn-lg" id="surveyApprove" onclick="approve(event);"><i class="fas fa-clipboard-check"></i> Save</button>
 									  						 	
 									  						 	<?php go_back(); ?>
 									  						</div>
									  					</div>
									  			</div>
 
								  			</div>
								  			  
								  		</form>
 
								</div>
							</div>	 


									<?php // loading_image_html(); // buttons_helper ?>

									<div  class="d-flex justify-content-center" >
									  <div id="load_image" class="spinner-border text-primary" role="status" style="display: none;">
									    <span class="visually-hidden">Loading...</span>
									  </div>
									</div>

 								 <!-- <div id="load_image" class="spinner-border text-primary" style="display: none; position: absolute;left: 50%;" role="status"><span class="sr-only ">Loading...</span></div>
  							-->
									<div class="row justify-content-center text-center" id="result"></div>

									



						<!-- /  surveys --> 
 

						</div>
					</div>
				</section>





				<script>
					
					function approve(e)
					{

						let form = document.getElementById("approve_form");
		        let formAction = form.action;
		        let formData = new FormData(form);

		        // alert(formAction);

		        // loading image
		       	let load_image = document.querySelector("#load_image");
		 						load_image.style.display="block";

	 					var xmlhttp = ajaxReq();
				 		xmlhttp.open("POST", formAction, true);  
						//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xmlhttp.send(formData); 

						xmlhttp.onreadystatechange = function () {
				    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				       try {
		 					
					 						load_image.style.display = "none";

					           let result = JSON.parse(xmlhttp.responseText);

					           let form_errors = document.querySelectorAll('.form_error');

											for(let i = 0; i < form_errors.length; i++){
												form_errors[i].innerHTML="";
									 		}

									 		// result div i temizle 
									 		document.getElementById("result").innerHTML='';
									 		
					           	if(result.error){
					           		 
	           		 				error_show(result.is_approve_error,'is_approve_error');
	           						document.getElementById("result").innerHTML = result.message;

					           	}else{
					           		document.getElementById("result").innerHTML = result.message;
						           		// window.location.href = "<?=base_url('');?>";
					           	}


						       } catch (error) {
						          // throw Error;
						          console.log(error);
				 		       }
						    }
						}
 
							e.preventDefault();


					}
				</script>

				

<script>
// Set the date we're counting down to
//var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
var countDownDate = new Date("<?=$item->end_date;?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("time").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "EXPIRED";
    //alert('EXPIRED');
    // window.location="survey";
  }
}, 1000);
</script>