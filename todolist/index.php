<?php  

$p = "";

if (isset($_GET['p'])) {
	$p = $_GET['p']; 
} else {
	$p = "login";
}


?>

<?php include("core/layout/header.php") ?>
<body>
	
	<section id="p">
		<?php include("core/view/" . $p . ".php") ?>
	</section>

<?php include("core/layout/footer.php") ?>
</body>
</html>