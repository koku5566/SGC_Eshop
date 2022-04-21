<?php
    require __DIR__ . '/header.php'
?>
<?php
    $_SESSION['campusId'] = $_GET['campusId'];
?>
<?php
ublic function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function loginUsers($username, $password){
		$sqlQuery = "
			SELECT userid, username 
			FROM ".$this->chatUsersTable." 
			WHERE username='".$username."' AND password='".$password."'";		
        return  $this->getData($sqlQuery);
	}		
	public function chatUsers($userid){
		$sqlQuery = "
			SELECT * FROM ".$this->chatUsersTable." 
			WHERE userid != '$userid'";
		return  $this->getData($sqlQuery);
	}
	public function getUserDetails($userid){
		$sqlQuery = "
			SELECT * FROM ".$this->chatUsersTable." 
			WHERE userid = '$userid'";
		return  $this->getData($sqlQuery);
	}
	public function getUserAvatar($userid){
		$sqlQuery = "
			SELECT avatar 
			FROM ".$this->chatUsersTable." 
			WHERE userid = '$userid'";
		$userResult = $this->getData($sqlQuery);
		$userAvatar = '';
		foreach ($userResult as $user) {
			$userAvatar = $user['avatar'];
		}	
		return $userAvatar;
	}	
	public function updateUserOnline($userId, $online) {		
		$sqlUserUpdate = "
			UPDATE ".$this->chatUsersTable." 
			SET online = '".$online."' 
			WHERE userid = '".$userId."'";			
		mysqli_query($this->dbConnect, $sqlUserUpdate);		
	}
	public function insertChat($reciever_userid, $user_id, $chat_message) {		
		$sqlInsert = "
			INSERT INTO ".$this->chatTable." 
			(reciever_userid, sender_userid, message, status) 
			VALUES ('".$reciever_userid."', '".$user_id."', '".$chat_message."', '1')";
		$result = mysqli_query($this->dbConnect, $sqlInsert);
		if(!$result){
			return ('Error in query: '. mysqli_error());
		} else {
			$conversation = $this->getUserChat($user_id, $reciever_userid);
			$data = array(
				"conversation" => $conversation			
			);
			echo json_encode($data);	
		}
	}
	public function getUserChat($from_user_id, $to_user_id) {
		$fromUserAvatar = $this->getUserAvatar($from_user_id);	
		$toUserAvatar = $this->getUserAvatar($to_user_id);			
		$sqlQuery = "
			SELECT * FROM ".$this->chatTable." 
			WHERE (sender_userid = '".$from_user_id."' 
			AND reciever_userid = '".$to_user_id."') 
			OR (sender_userid = '".$to_user_id."' 
			AND reciever_userid = '".$from_user_id."') 
			ORDER BY timestamp ASC";
		$userChat = $this->getData($sqlQuery);	
		$conversation = '<ul>';
		foreach($userChat as $chat){
			$user_name = '';
			if($chat["sender_userid"] == $from_user_id) {
				$conversation .= '<li class="sent">';
				$conversation .= '<img width="22px" height="22px" src="userpics/'.$fromUserAvatar.'" alt="" />';
			} else {
				$conversation .= '<li class="replies">';
				$conversation .= '<img width="22px" height="22px" src="userpics/'.$toUserAvatar.'" alt="" />';
			}			
			$conversation .= '<p>'.$chat["message"].'</p>';			
			$conversation .= '</li>';
		}		
		$conversation .= '</ul>';
		return $conversation;
	}
	public function showUserChat($from_user_id, $to_user_id) {		
		$userDetails = $this->getUserDetails($to_user_id);
		$toUserAvatar = '';
		foreach ($userDetails as $user) {
			$toUserAvatar = $user['avatar'];
			$userSection = '<img src="userpics/'.$user['avatar'].'" alt="" />
				<p>'.$user['username'].'</p>
				<div class="social-media">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<i class="fa fa-twitter" aria-hidden="true"></i>
					 <i class="fa fa-instagram" aria-hidden="true"></i>
				</div>';
		}		
		// get user conversation
		$conversation = $this->getUserChat($from_user_id, $to_user_id);	
		// update chat user read status		
		$sqlUpdate = "
			UPDATE ".$this->chatTable." 
			SET status = '0' 
			WHERE sender_userid = '".$to_user_id."' AND reciever_userid = '".$from_user_id."' AND status = '1'";
		mysqli_query($this->dbConnect, $sqlUpdate);		
		// update users current chat session
		$sqlUserUpdate = "
			UPDATE ".$this->chatUsersTable." 
			SET current_session = '".$to_user_id."' 
			WHERE userid = '".$from_user_id."'";
		mysqli_query($this->dbConnect, $sqlUserUpdate);		
		$data = array(
			"userSection" => $userSection,
			"conversation" => $conversation			
		 );
		 echo json_encode($data);		
	}	
	public function getUnreadMessageCount($senderUserid, $recieverUserid) {
		$sqlQuery = "
			SELECT * FROM ".$this->chatTable."  
			WHERE sender_userid = '$senderUserid' AND reciever_userid = '$recieverUserid' AND status = '1'";
		$numRows = $this->getNumRows($sqlQuery);
		$output = '';
		if($numRows > 0){
			$output = $numRows;
		}
		return $output;
	}			
}
?>
<div id="profile">
<?php
include ('Chat.php');
$chat = new Chat();
$loggedUser = $chat->getUserDetails($_SESSION['userid']);
echo '<div class="wrap">';
$currentSession = '';
foreach ($loggedUser as $user) {
	$currentSession = $user['current_session'];
	echo '<img id="profile-img" src="userpics/'.$user['avatar'].'" class="online" alt="" />';
	echo  '<p>'.$user['username'].'</p>';
		echo '<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>';
		echo '<div id="status-options">';
		echo '<ul>';
			echo '<li id="status-online" class="active"><span 
class="status-circle"></span> <p>Online</p></li>';
			echo '<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>';
			echo '<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>';
			echo '<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>';
		echo '</ul>';
		echo '</div>';
		echo '<div id="expanded">';			
		echo '<a href="logout.php">Logout</a>';
		echo '</div>';
}
echo '</div>';
?>
</div>
<div id="contacts">	
<?php
echo '<ul>';
$chatUsers = $chat->chatUsers($_SESSION['userid']);
foreach ($chatUsers as $user) {
	$status = 'offline';						
	if($user['online']) {
		$status = 'online';
	}
	$activeUser = '';
	if($user['userid'] == $currentSession) {
		$activeUser = "active";
	}
	echo '<li id="'.$user['userid'].'" class="contact '.$activeUser.'" data-touserid="'.$user['userid'].'" data-tousername="'.$user['username'].'">';
	echo '<div class="wrap">';
	echo '<span id="status_'.$user['userid'].'" class="contact-status '.$status.'"></span>';
	echo '<img src="userpics/'.$user['avatar'].'" alt="" />';
	echo '<div class="meta">';
	echo '<p class="name">'.$user['username'].'<span id="unread_'.$user['userid'].'" 
class="unread">'.$chat->getUnreadMessageCount($user['userid'], $_SESSION['userid']).'</span></p>';
	echo '<p class="preview"><span id="isTyping_'.$user['userid'].'" class="isTyping"></span></p>';
	echo '</div>';
	echo '</div>';
	echo '</li>'; 
}
echo '</ul>';
?>
</div>
<div class="contact-profile" id="userSection">	
<?php
$userDetails = $chat->getUserDetails($currentSession);
foreach ($userDetails as $user) {										
	echo '<img src="userpics/'.$user['avatar'].'" alt="" />';
		echo '<p>'.$user['username'].'</p>';
		echo '<div class="social-media">';
			echo '<i class="fa fa-facebook" aria-hidden="true"></i>';
			echo '<i class="fa fa-twitter" aria-hidden="true"></i>';
			 echo '<i class="fa fa-instagram" aria-hidden="true"></i>';
		echo '</div>';
}	
?>						
</div>
<div class="messages" id="conversation">		
<?php
echo $chat->getUserChat($_SESSION['userid'], $currentSession);						
?>
</div>
<br>
<?php
    require __DIR__ . '/footer.php'
?>

<style>
    .campus-name{
        color:white;
        height:50px;
        overflow:hidden;
        text-align: center;   

    }


</style>
