<?php
    session_start();
    require_once dirname(__DIR__, 1) . '/mysqli_connect.php';

    $outgoing_id = $_SESSION['userid'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM user WHERE username LIKE '%{$searchTerm}%'";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            
            $userId = $row['userid'];
            $sql2 = "SELECT * FROM messages 
                    WHERE 
                    (incoming_msg_id = '$userId' OR outgoing_msg_id = '$userId') 
                    AND 
                    (outgoing_msg_id = '$outgoing_id'  OR incoming_msg_id = '$outgoing_id') ORDER BY msg_id DESC LIMIT 1";
                    
            $query2 = mysqli_query($conn, $sql2);

            while($row2 = mysqli_fetch_assoc($query2)){
                (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
                (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
                if(isset($row2['outgoing_msg_id'])){
                    ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
                }else{
                    $you = "";
                }
                
                ($outgoing_id == $row['userid']) ? $hid_me = "hide" : $hid_me = "";
        
                $output .= "<a href=\"chat.php?user_id=". $row['userid'] .">
                            <div class=\"content\">
                            <img class=\"card-img-top img-thumbnail\" src=\"data:image;base64,".base64_encode($row["profile_picture"])."\" alt=\"Image.jpg\">
                            <div class=\"details\">
                                <span>". $row['username']."</span>
                                <p>". $you . $msg ."</p>
                            </div>
                            </div>
                        </a>";
            }
            
        }
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>