<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
.radio-dark {
    appearance: none;
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    background-color: #333; /* Couleur de fond sombre */
    border: 2px solid #666; /* Bordure sombre */
    border-radius: 50%;
    position: relative;
    cursor: pointer;
}

.radio-dark:checked {
    background-color: #444; /* Couleur de fond sombre lorsqu'il est sélectionné */
}

.radio-dark:checked::after {
    content: '';
    width: 10px;
    height: 10px;
    background-color: #fff; /* Couleur de l'indicateur */
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

<nav class="navbar navbar-expand-lg navbar-dark bg-black">
  <a class="navbar-brand" href="#">PCR - 52</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <p class="display-4">Promotion Du 50ere de la Reunification</p>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0" >
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <a href="../logout.php" class='text-light'> <b style=" font-size: 22px;> <i class=fa fa-sign-out"> </b></i> <b style=" font-size: 22px; font-family:Times  " > LOGOUT </b></a>
    </form>
  </div>
</nav>
	 
	  <div class="content-wrapper" style="background-color: #F1E9D2 ">
	    <div class="container" style="background-color: #F1E9D2 ">

	      <!-- Main content -->
	      <section class="content">
	      	<?php
	      		$parse = parse_ini_file('admin/config.ini', FALSE, INI_SCANNER_RAW);
    			$title = $parse['election_title'];
	      	?>
	      	<h1 class="page-header text-center title display-3"><b><?php echo strtoupper($title); ?></b></h1>
	        <div class="row">
	        	<div class="col-sm-10 col-sm-offset-1">
	        		<?php
				        if(isset($_SESSION['error'])){
				        	?>
				        	<div class="alert alert-danger alert-dismissible">
				        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        	<ul>
					        		<?php
					        			foreach($_SESSION['error'] as $error){
					        				echo "
					        					<li>".$error."</li>
					        				";
					        			}
					        		?>
					        	</ul>
					        </div>
				        	<?php
				         	unset($_SESSION['error']);

				        }
				        if(isset($_SESSION['success'])){
				          	echo "
				            	<div class='alert alert-success alert-dismissible'>
				              		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				              		<h4><i class='icon fa fa-check'></i> Success!</h4>
				              	".$_SESSION['success']."
				            	</div>
				          	";
				          	unset($_SESSION['success']);
				        }

				    ?>
 
				    <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
		        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        	<span class="message"></span>
			        </div>

				    <?php
				    	$sql = "SELECT * FROM votes WHERE id = '".$voter['id']."'";
				    	$vquery = $conn->query($sql);
				    	if($vquery->num_rows > 0){
				    		?>
				    		<div class="text-center" style="color:black ; font-size: 35px; font-family:Times" >
					    		<h3>You have already voted for this election.</h3>
					    		<a href="#view" data-toggle="modal" class="btn btn-curve btn-primary btn-lg" style="background-color: #4682B4 ;color:black ; font-size: 22px; font-family:Times">View Ballot</a>
					    	</div>
				    		<?php
				    	}
				    	else{
				    		?>
			    			<!-- Voting Ballot -->
						    <form method="POST" id="ballotForm" action="submit_ballot.php">
				        		<?php
				        			include 'includes/slugify.php';

				        			$candidate = '';
				        			$sql = "SELECT * FROM positions ORDER BY priority ASC";
									$query = $conn->query($sql);
									while($row = $query->fetch_assoc()){
										$sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
										$cquery = $conn->query($sql);
										while($crow = $cquery->fetch_assoc()){
											$slug = slugify($row['description']);
											$checked = '';
											if(isset($_SESSION['post'][$slug])){
												$value = $_SESSION['post'][$slug];
										
												if($value == $crow['id']){
													$checked = 'checked';
												}
											}
											$input = '<input type="radio" class="h1 bg-dark mx-5 radio-dark '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
											$image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';
											$candidate .= '
												<li>
													'.$input.'<button type="button" class="btn btn-primary btn-sm btn-curve platform" style="background-color: #4682B4 ;color:black ; font-size: 12px; font-family:Times" data-platform="'.$crow['platform'].'" data-fullname="'.$crow['firstname'].' '.$crow['lastname'].'"><i class="fa fa-search"></i> Platform</button><img src="'.$image.'" height="100px" width="100px" class="clist"><span class="cname clist">'.$crow['firstname'].' '.$crow['lastname'].'</span>
												</li>
											';
										}

										$instruct = 'Select only one candidate';

										echo '
											<div class="row">
												<div class="col-xs-12">
													<div class="box box-solid" style="background-color: #d8d1bd" id="'.$row['id'].'">
														<div class="box-header with-border" style="background-color: #d8d1bd">
															<h3 class="box-title"><b>'.$row['description'].'</b></h3>
														</div>
														<div class="box-body" >
															<p>'.$instruct.'
																<span class="pull-right">
																
																	<button type="button" class="btn btn-success btn-sm btn-curve reset" style="background-color:#9CD095 ;color:black ; font-size: 12px; font-family:Times"  data-desc="'.slugify($row['description']).'"><i class="fa fa-refresh"></i> Reset</button>
																</span>
															</p>
															<div id="candidate_list">
																<ul>
																	'.$candidate.'
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										';

										$candidate = '';

									}	

				        		?>
				        		<div class="text-center">
					        		<button type="button" class="btn btn-success btn-curve" style='background-color: #9CD095 ;color:black ; font-size: 12px; font-family:Times' id="preview"><i class="fa fa-file-text"></i> Preview</button> 
					        		<button type="submit" class="btn btn-primary btn-curve" style='background-color: #4682B4 ;color:black ; font-size: 12px; font-family:Times'name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
					        	</div>
				        	</form>
				        	<!-- End Voting Ballot -->
				    		<?php
				    	}

				    ?>

	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/ballot_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('.content').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	});

	$(document).on('click', '.reset', function(e){
	    e.preventDefault();
	    var desc = $(this).data('desc');
	    $('.'+desc).iCheck('uncheck');
	});

	$(document).on('click', '.platform', function(e){
		e.preventDefault();
		$('#platform').modal('show');
		var platform = $(this).data('platform');
		var fullname = $(this).data('fullname');
		$('.candidate').html(fullname);
		$('#plat_view').html(platform);
	});

	$('#preview').click(function(e){
		e.preventDefault();
		var form = $('#ballotForm').serialize();
		if(form == ''){
			$('.message').html('You must vote atleast one candidate');
			$('#alert').show();
		}
		else{
			$.ajax({
				type: 'POST',
				url: 'preview.php',
				data: form,
				dataType: 'json',
				success: function(response){
					if(response.error){
						var errmsg = '';
						var messages = response.message;
						for (i in messages) {
							errmsg += messages[i]; 
						}
						$('.message').html(errmsg);
						$('#alert').show();
					}
					else{
						$('#preview_modal').modal('show');
						$('#preview_body').html(response.list);
					}
				}
			});
		}
		
	});

});
</script>
</body>
</html>