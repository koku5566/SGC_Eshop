<?php
    require __DIR__ . '/header.php'
?>

<?php

?>


<!-- Begin Page Content --------------------------------------------------------------------------------------------->
<div class="container-fluid" style="width:80%">		
	
	<div class="d-flex flex-row ppparent">
	  <div class="p-2 pp">Flex item 1</div>
	  <div class="p-2 pp">Flex item 2</div>
	  <div class="p-2 pp">Flex item 3</div>
	  <div class="p-2 pp">Flex item 4</div>
	  <div class="p-2 pp">Flex item 5</div>
	</div>
	
	

		
		
</div>
<!-- /.container-fluid ----------------------------------------------------------------------------------------------->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
.pp{
	width: 100%;
	border: 1px solid purple;
}
.ppparent{
	
	display: flex;
	flex-wrap: wrap;
}
.ppparent > div {
	flex:50%;
	box-shadow: 0 0 0 1px black;
	margin-bottom: 10px
}
</style>
<script>



</script>