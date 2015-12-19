var responseStr;

var showMessage = function(msg_header, msg_body) {
  document.getElementById(msg_header).style.fontWeight = 'normal';
  messageRead2(msg_header, msg_body);
  if (document.getElementById(msg_body).style.display == 'block') {
    document.getElementById(msg_body).style.display = 'none';
  } else {
    document.getElementById(msg_body).style.display = 'block';
  }
};

var repeatAjax = function() {
  var intervalId = setInterval(function() {
    messageRead();
  }, 7000);
};

var messageRead = function() {
  var xhr = new XMLHttpRequest();
  var url = 'read_message.php';

  xhr.open('GET', url, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      responseStr = xhr.responseText;
      document.querySelector('#msg_table').innerHTML = responseStr;
    }
  };
  xhr.send();
};

var reply = function(id, pos) {
    var msgId = id.slice(1,id.length);
    var url;

    if (pos == 'Administrator') {
        url = 'mess.php?message_id=' + msgId;
    } else {
        url = 'mess2.php?message_id=' + msgId;
    }
    window.location.href = url;
};

var messageRead2 = function(msg_header, msg_body) {
  var xhr = new XMLHttpRequest();
  var recipientId = msg_header.slice(1, msg_header.length);
  var msgId = msg_body.slice(1,msg_body.length);
  var url = 'read_message.php?msg_id=' + msgId;

  xhr.open('GET', url, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
    }
  };
  xhr.send();
};
