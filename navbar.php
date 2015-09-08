<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
						<img alt="Slambook" src="brand.png">
					</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Slambook</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<ul class="nav navbar-nav navbar-left">
			      		<li class="active"><a href="myview.php">Side View<span class="sr-only">(current)</span></a></li>
				        <li><a href="#">Amigos</a></li>
				    </ul>
				    <ul class="nav navbar-nav navbar-right">
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a href="settings.php">Settings</a></li>
				            <li role="separator" class="divider"></li>
				            <form action="signupsubmit.php" method="post">
				            	<li><button class="btn btn-danger col-sm-offset-1" name="logoffsubmit" value="Log Off">Log Off</button></li>
				            </form>
				          </ul>
				        </li>
				      </ul>
				    <form class="navbar-form navbar-right" action="signupsubmit.php" method="post">
				        <div class="form-group">
				        	<input type="search" class="form-control" placeholder="Search" name="search" Required>
							<button type="submit" class="btn btn-default" name="searchsubmit">Search</button>
						</div>
					</form>    
				</div>
			</div>
		</div>
	</nav>
	<br>
	<br>