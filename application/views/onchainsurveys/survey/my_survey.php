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
									<h1 class="text-color-light font-weight-extra-bold text-10 text-md-12-13 line-height-2 mb-4 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="850">My Surveys</h1>

									<!-- kayarak gelen butonlar -->

									<a href="survey/create#create" data-hash data-hash-offset="0" data-hash-offset-lg="100" class="btn btn-outline custom-btn-outline btn-primary rounded-0 font-weight-semibold text-color-light bg-color-hover-primary custom-btn-with-arrow text-4 btn-px-4 py-3 mt-2 ms-2 appear-animation surveyButons" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1100">Create Survey</a>

									  
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


						<!-- all_surveys --> 

						<?php //pre($list); ?>
						
 						<div class="col-lg-12" id="all_survey2">
							<div class="card border-0 bg-color-dark rounded-0 z-index-1 p-5 appear-animation table-responsive" data-appear-animation="maskUp" data-appear-animation-delay="100">
								 
								<table class="table table-hover table_link" id="my_survey" >
									<thead>
										<tr >
											<th>
												#
											</th>
											<th>
												Survey Name
											</th>
											<th>
												Created
											</th>
											<th>
												Start Date - End Date
											</th>
											<th>
												Participated
											</th>
											<!-- <th>
												Type
											</th> -->
											<th class="text-center">
												Approval
											</th>
											 
											<th>
												Status
											</th>
										</tr>
									</thead>
									<tbody>
										 
									<?php foreach ($list as $key => $value) {?>
										 <tr onclick="go('survey/detail/<?=$value->survey_id;?>');">
										 		<td>
													 #<?=$value->survey_id; ?>
												</td>
												<td>
													<a href="survey/detail/<?=$value->survey_id; ?>">
														 <?=$value->title; ?>
													</a>
												</td>
												<td>
													<?=@get_user($value->user_id,'user_name')->user_name; ?>
												</td>
												<td>
													<?php 
														# start date explode
														$start_date_arr = explode(' ',$value->start_date); 
													?> 
 													<?=$start_date_arr[0];?> 
 													<span class="surver_time"><?=$start_date_arr[1];?></span> <br>

 													<?php 
 														# end date explode
 														$end_date_arr = explode(' ',$value->end_date); 
 													?> 
 													<?=$end_date_arr[0];?> 
 													<span class="surver_time"><?=$end_date_arr[1];?></span>  

 												</td>

 												<td>
 													<?php 
 														if(is_participated($value->survey_id)){
 															echo '<i class="fas fa-check btn btn-success btn-sm"></i>';  
 														}else{
 															echo '<button class="btn btn-outline-secondary btn-sm"> Participate </button> ';
 														}
 														

 													 ?> 
 												</td>

 												<!-- <td>
 													<?//=$value->type;?>
 												</td> -->
 												<td class="text-center">
 													<?=is_approval_icon($value->is_approved);?>
 												</td>
												 
												<td>

													<?php 

														# şuanki zaman
														$now = date('Y-m-d H:i:s');
 														
 														# end_date büyük ise anktet devam ediyor
														if($value->end_date > $now){
															survey_continue_btn();
														}else{
															 survey_end_btn();
														}
 
													 ?>
  
												</td>
										 </tr>
									<?php } ?>

									</tbody>
								</table>
								
								  

							</div>
						</div>	 

						<!-- / all_surveys --> 

							 
						 

						</div>
					</div>
				</section>