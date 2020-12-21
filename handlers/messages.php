<?php
include('../connect.php');
session_start();
switch ($_REQUEST['action']) {
  case "sendMessage":

    $queary = $conn->prepare("INSERT INTO messages SET message = ? , User = ?");

    $queary->execute(array($_REQUEST['message'], $_SESSION['username']));



    break;

  case "getmessages":

    $queary = $conn->prepare("SELECT * FROM messages  ");

    $queary->execute();

    $rs = $queary->fetchAll(PDO::FETCH_OBJ);

    $chat = '';
    foreach ($rs as $message) {
      if ($message->User == $_SESSION['username']) {
        $chat .= '<div class="message-x message">
                  <p>' . $message->User . ': </p> <br>' . $message->message . '<br>
                  <span>' . date('m-d h:i a', strtotime($message->Date)) . '</span>
                </div>';
      }

      if ($message->User != $_SESSION['username']) {
        $chat .= '<div class="message-y message">
                  <p>' . $message->User . ': </p><br>' . $message->message . '<br>
                  <span>' . date('m-d h:i a', strtotime($message->Date)) . '</span>
                </div>';
      }
    }
    echo $chat;
    break;
}
