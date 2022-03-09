<?php
    require __DIR__ . '/header.php'
?>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['restaurant']))
        {
            $_SESSION['Restaurant_ID'] = $_POST['restaurant'];
            echo("<script>window.location.href = \"main.php\";</script>");
        }
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
				<h1>TESTING IN PROGRESS</h1>
				<p>In Greek mythology Cronus was the son of Uranus (Heaven) and Gaea (Earth), being the youngest of the 12 Titans. On the advice of his mother he castrated his father with a harpē, thus separating Heaven from Earth. He now became the king of the Titans, and took for his consort his sister Rhea; she bore by him Hestia, Demeter, Hera, Hades, and Poseidon, all of whom he swallowed because his own parents had warned that he would be overthrown by his own child. When Zeus was born, however, Rhea hid him in Crete and tricked Cronus into swallowing a stone instead. Zeus grew up, forced Cronus to disgorge his brothers and sisters, waged war on Cronus, and was victorious. After his defeat by Zeus, Cronus became, according to different versions of his story, either a prisoner in Tartarus or king in Elysium. According to one tradition, the period of Cronus’s rule was a golden age for mortals.</p>
                    
                </div>    
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

    
</style>

<script>
    
</script>
