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

									<!-- kayarak gelen butonlar -->

									<a href="survey/create#create" data-hash data-hash-offset="0" data-hash-offset-lg="100" class="btn btn-outline custom-btn-outline btn-primary rounded-0 font-weight-semibold text-color-light bg-color-hover-primary custom-btn-with-arrow text-4 btn-px-4 py-3 mt-2 ms-2 appear-animation surveyButons" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1100">Create Survey</a>

									 <a href="survey#all" data-hash data-hash-offset="0" data-hash-offset-lg="100" class="btn btn-outline custom-btn-outline btn-primary rounded-0 font-weight-semibold text-color-light bg-color-hover-primary custom-btn-with-arrow text-4 btn-px-4 py-3 mt-2 ms-2 appear-animation surveyButons" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1100">All Surveys</a>
									 
									<!-- sayfa görüntülenme -->  
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
						<?php  // pre($list); ?>
						
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
								  <form action="survey/survey_vote/<?php echo id_encode($item->survey_id);?>" role="form" id="survey_vote"   >
								  	<?php //echo $item->title; ?>
								 
									  <table class="table table-hover">
									  	 <h4>Survey Questions</h4>
										  <?php 
										  foreach ($list as $key => $value) {?>
										  	 <tr>
										  	 	<td>
										  	 		<?=++$key .") ". $value->text;?>
										  	 		<br>
										  	 		<!-- #<?php echo $value->question_id ?> nolu soru  -->
										  	 	</td>
										  	 	<td> </td>
										  	 	<td>
										  	 		<?php 
										  	 			$options_arr =  json_decode($value->options);
										  	 			//pre($options_arr);

	 									  	 			foreach ($options_arr as $key => $option) {?>
	 									  	 				<div class="form-check ">
																<label class="form-check-label">
																	<input class="form-check-input" type="radio" name="<?=$value->question_id;?>" id="<?=$value->question_id;?>_<?=$key;?>" value="<?=$key;?>" required > <?php echo $option;?>
																</label>
															</div>
	 
										  	 			<?php }
										  	 		?>
										  	 	</td>
										  	 </tr>
										  <?php } ?>

									  </table>



									  <div class="text-center">

									  	<?php if($item->is_approved == 1){?>
									  			<button type="button" class="btn btn-outline-secondary btn-lg" id="finishSurvey" onclick="survey_vote(event);"><i class="fas fa-clipboard-check"></i> Finish Survey</button>
									  	<?php }else{?>
									  			<div class="text-primary"> Bu anket henüz onaylanmadığı için oy vermek işlemi yapılamaz. </div>
									  	<?php } ?>

 									  	

									  </div>

								   </form>
 										
 										<div class="mt-3">
 											<?php loading_image_html(); ?>
						 					<div id="result" class="text-center"></div>
 										</div>	
 
							</div>
						</div>	 

						

						<!-- /  survey --> 

							 
						 

						</div>
					</div>
				</section>


				<script>
					
	 function survey_vote(e)
	{
 
		let error;
		let form = document.getElementById("survey_vote");
        let formAction = form.action;
        let formData = new FormData(form);

        // loading image
        let load_image = document.querySelector("#load_image");
        load_image.style.display="block";


        /* tüm .form-control classına sahip olan elementleri al */ 
        let elements = document.querySelectorAll(".form-check-input")
        //console.log(elements);


 

    var xmlhttp = ajaxReq();
 		xmlhttp.open("POST", formAction, true);  
		//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(formData); 

		xmlhttp.onreadystatechange = function () {
		    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		       try {
 
		           let result = JSON.parse(xmlhttp.responseText);

		           load_image.style.display = "none";
 
			 		// result div i temizle 
			 		document.getElementById("result").innerHTML='';
			 		 
		           	if(result.error){
		           		//error_show(result.user_name_error,'user_name_error');
		           		document.getElementById("result").innerHTML = result.message;

		           	}else{
		           		document.getElementById("result").innerHTML = result.message;
 		           		//window.location.href = "<?=base_url('survey/');?>";
 		           		setTimeout(function(){ 
                      window.location.reload();
                  }, 2000);
 
		           	} 


		       } catch (error) {
		          // throw Error;
		          load_image.style.display = "none";
		          document.getElementById("result").innerHTML = error;
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
     // window.location="survey";
  }
}, 1000);
</script>