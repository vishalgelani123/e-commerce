<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>404 HTML Template by Colorlib</title>
	<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('error/style.css')); ?>" />
</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
			</div>
			<h2>Oops, The Page you are looking for can't be found!</h2>
			<form class="notfound-search">
				<input type="text" placeholder="Search...">
				<button type="button">Search</button>
			</form>
			<a href="<?php echo e(URL::to('/')); ?>"><span class="arrow"></span>Return To Homepage</a>
			<h4 style="font-size : 24px;font-weight : bold;color : #FF508E;">dastkarshop.com</h4>
		</div>
	</div>

</body>

</html>
<?php /**PATH E:\laragon\www\adaajaipur\resources\views/errors/404.blade.php ENDPATH**/ ?>