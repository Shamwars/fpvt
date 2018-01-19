<?php
	
	$db_hostname = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_database = 'fpvt';

// Database Connection String
$con = mysql_connect($db_hostname,$db_user,$db_password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_database, $con);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
<form action="" method="post">  
Search: <input type="text" name="cat" /><br />  
<input type="submit" value="Submit" />  
</form>  
<?php
if (!empty($_REQUEST['term'])) {

$cat = mysql_real_escape_string($_REQUEST['cat']);     

$sql = "SELECT * FROM storage WHERE Description LIKE '%".$cat."%'"; 
$r_query = mysql_query($sql); 

while ($row = mysql_fetch_array($r_query)){  
echo 'Primary key: ' .$row['PRIMARYKEY'];  
echo '<br /> Artist: ' .$row['artist'];  
echo '<br /> Title: '.$row['title'];  
echo '<br /> Catalogue#: '.$row['cat'];  
echo '<br /> Label: '.$row['label'];
echo '<br /> Year: '.$row['year'];  
echo '<br /> Country: '.$row['country'];  
echo '<br /> Front Image: '.$row['imgf'];
echo '<br /> Back Image: '.$row['imgb'];  
echo '<br /> Label Side A: '.$row['img1'];  
echo '<br /> Label Side B: '.$row['img2'];        
}  

}
?>
    <script type="text/javascript" src="/socket.io/socket.io.js"></script><script type="text/javascript">//
// Reload the app if server detects local change
//
(function() {
    var url = 'http://' + document.location.host + '/__api__/autoreload';

    function postStatus() {
        var xhr = new XMLHttpRequest();
        xhr.open('post', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && /^[2]/.test(this.status)) {
            }
        };
        xhr.send();
    }

    function checkForReload() {
        var xhr = new XMLHttpRequest();
        xhr.open('get', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && /^[2]/.test(this.status)) {
                var response = JSON.parse(this.responseText);
                if (response.content.outdated) {
                    postStatus();
                    window.location.reload();
                }
            }
        };
        xhr.send();
    }

    setInterval(checkForReload, 1000 * 3);
})(window);
</script>
<script type="text/javascript">(function(window) {
    var socket = io('http://' + document.location.host);

    // Copy the functions to avoid stack overflow
    var previousConsole = Object.assign({}, window.console);

    // Overwrite these individually to preserve other log properties
    window.console.log = function() {
        if(previousConsole.log) {
            previousConsole.log.apply(previousConsole, arguments);
        }
        socket.emit('console','log', Array.prototype.slice.call(arguments).join(' '));
    };

    window.console.warn = function() {
        if(previousConsole.warn) {
            previousConsole.warn.apply(previousConsole, arguments);
        }
        socket.emit('console','warn', Array.prototype.slice.call(arguments).join(' '));
    };

    window.console.error = function() {
        if(previousConsole.error) {
            previousConsole.error.apply(previousConsole, arguments);
        }
        socket.emit('console','error', Array.prototype.slice.call(arguments).join(' '));
    };

    window.console.assert = function(assertion) {
        if(previousConsole.assert) {
            previousConsole.assert.apply(previousConsole, arguments);
        }
        if(assertion) {
            socket.emit('console','assert', Array.prototype.slice.call(arguments, 1).join(' '));
        }
    };
})(window);
</script>
<script type="text/javascript">//
// Proxy
///
// Intercept XHR calls that would violate single-origin policy.
// These requests will be proxied through the server.
//
(function() {
    var xhr = {};
    xhr.open = XMLHttpRequest.prototype.open;

    XMLHttpRequest.prototype.open = function(method, url) {
        var parser = document.createElement('a');
        parser.href = url;

        // WP8 does not set hostname on some XHRs
        if (!parser.hostname) {
            parser.hostname = window.location.hostname;
        }

        // proxy the cross-origin request
        if (!parser.hostname.match(window.location.hostname)) {
            url = '/proxy/' + encodeURIComponent(url);
        }

        xhr.open.apply(this, arguments);
    };
})(window);
</script>
<script type="text/javascript">//
// Push notification
//
(function() {
    document.addEventListener('deviceready', function() {
        var oldPushNotification;
        if (window.PushNotification) {
            oldPushNotification = window.PushNotification;
            window.PushNotification.init = function(options) {
                if (options.android) {
                    options.android.senderID = "996231231186";
                    options.android.icon = "pushicon";
                    options.android.iconColor = "blue";
                }
                var pgdevPush = new oldPushNotification.PushNotification(options);
                pgdevPush.on('registration', function(data) {
                    console.log('Device Push ID: \n' + data.registrationId);
                });
                return pgdevPush;
            };
        }
    });
})(window);
</script>
</body>
</html>