<?php 
    session_start();
    if(isset($_SESSION['userid'])){
        include_once "mysqli_connect.php";
        $outgoing_id = $_SESSION['userid'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN user ON users.userID = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= "<div class=\"chat incoming\">
                                <img class=\"card-img-top img-thumbnail\" src=\"data:image;base64,".base64_encode($row["profile_picture"])."\" alt=\"Image.jpg\">
                                <div class=\"details\">
                                    <p>". $row['msg'] ."</p>
                                </div>
                                </div>";
                }
            }
        }else{
            $output .= '<div class="text">No messages are available.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>