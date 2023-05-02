<div class = "row">
	<form action="?act=edit" method="POST">
		<h2 style = "color:#008000">Edit your information</h2><br>
		<div class="form-group">
			<div class="row">
			    <div class="col-xs-6 col-sm-6 col-md-6">
			    	<div class="form-group">
			            <input style = "height:40px; font-size:15px" type="text" name="name" id="first_name" class="form-control input-sm" placeholder="Name">
			    	</div>
			    </div>
			</div>

			<div class = "row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="form-group">
						<input style = "height:40px; font-size:15px" type="text" name="surname" id="last_name" class="form-control input-sm" placeholder="Surname">
					</div>
				</div>
			</div>	

			<div class = "row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="form-group">
						<input style = "height:40px; font-size:15px" type="text" name="age" id="last_name" class="form-control input-sm" placeholder = "Age">
					</div>
				</div>
			</div>	

			<div class="form-group">
			    <input style = "height:40px ; width:460px; font-size:15px" type="text" name="login" id="email" class="form-control input-sm" placeholder = "Login">
			</div>

			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="form-group">
						<input style = "height:40px; font-size:15px" type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
					</div>
				</div>
			</div>
			<hr>
		</div>

		<div class="form-group">
			<input class="btn btn-success" type="submit" value="Change" style="width:110px ; height:40px ; font-size:20px"></input>
			<input class="btn btn-success" type="submit" value="Go Back" style="width:100px ; height:40px ; font-size:20px"></input><br><br>
				
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style = "background-color:#009900">
				 Show your old information
				</button> 

				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel" style = "color:#009900"><strong>Old information</strong></h4>
				      </div>
				      <div class="modal-body">
					    <?php
					    	$id = $_SESSION['user']['id'];
							
							$query = $connection->query("SELECT * FROM users WHERE id = $id");
							if($row=$query->fetch_object()){

								echo "<label><h5>N A M E:</h5></label> "." ".$row->name."<br>";	
								echo "<label><h5>S U R N A M E:</h5></label> "." ".$row->surname."<br>";	
								echo "<label><h5>A G E:</h5></label> "." ".$row->age."<br>";	
								echo "<label><h5>L O G I N:</h5></label> "." ".$row->login."<br>";	
							
							}
						?>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>
		</div>
	</form>	
</div>	