<!DOCTYPE html>
<html>

<head>
  <meta charset="utf8">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</head>
<?php 
  session_start();
?>
<body>
  <div id="wrapper">
    <h1 class="h1"><?php echo $_SESSION['username'] ?> chat </h1>
    <div class="chat_wrapper">
      <div id="chat"></div>

      <form method="POST" id="messageFrm">
        <textarea name="message" cols="30" rows="10" class="textarea"></textarea>
      </form>

    </div>
  </div>

  <script>
    LoadChat();

    setInterval(function() {
      LoadChat();
    }, 500);

    function LoadChat() {
      $.post('handlers/messages.php?action=getmessages', function(respone) {
        var scrollpos = $('#chat').scrollTop();
        var scrollpos = parseInt(scrollpos) + 520;
        var scrollHeight = $('#chat').prop('scrollHeight');


        $('#chat').html(respone);


        if (scrollpos < scrollHeight) {
         
        }else{
          $('#chat').scrollTop($('#chat').prop('scrollHeight'));
        }

      })
    }

    $('.textarea').keyup(function(e) {
      if (e.which == 13) {
        $('form').submit();
      }
    });
    $('form').submit(function() {
      var message = $('.textarea').val();
      $.post('handlers/messages.php?action=sendMessage&message=' + message, function(response) {
        if (response == 1) {
          LoadChat();
          document.getElementById('messageFrm').reset();
        }
      });
    });
  </script>
</body>

</html>