<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />                                    
	<link rel="apple-touch-icon" sizes="76x76" href="assets/theme/img/favicon.jpg">  <!--apple-icon.png -->
	<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>assets/theme/img/favicon.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>                
	   <?php
			/* title currently page */
			$title = explode("sys_", $this->uri->segment(1));

			$newTitle = "";
			foreach ($title as $value) {
				/* si el texto posee guiones bajos se eliminan y se separan las palabras */
				$value = str_replace("_"," ",$value);
				$newTitle .= $value ." ";
			}
			echo ucwords( $newTitle );
		?>
    </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


     <!-- Bootstrap core CSS     -->
    <link href="<?=base_url()?>assets/theme/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="<?=base_url()?>assets/theme/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?=base_url()?>assets/theme/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=base_url() ?>assets/theme/css/animate.css" />
    <!--  Fonts and icons     -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?=base_url()?>assets/theme/css/themify-icons.css" rel="stylesheet">

</head>
<body>