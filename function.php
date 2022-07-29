
<?php 
$bot_id = "";

$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (($update['message']) != null) {
    
    $from_id = $update['message']['from']['id'];
    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'];
    $message_id = $update['message']['message_id']; 

    $type_msg = "message";

} elseif ($update['callback_query'] != Null) {
    $data_callback = $update['callback_query']['data'];
    $from_id = $update['callback_query']['from']['id'];
    $chat_id = $update['callback_query']['message']['chat']['id'];
    $message_id = $update['callback_query']['message']['message_id'];
    $bot_chat_id = $update['callback_query']['message']['from']['id'];
    
    $type_msg = "callback";
}

?>
<?php



function random_item($array){
    $k = array_rand($array);
return $array[$k];
}

function send_post_data($url,$data){
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */ }
    return $result;
}


function send_image_bot($file,$caption){
    
    
    
    global $bot_id,$chat_id;
    
    $param = array('chat_id'=>$chat_id,'caption'=>"$caption",'photo'=>$file);
$url = "https://api.telegram.org/bot".$bot_id."/sendPhoto";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$param);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');

curl_exec($ch);
}


  function send_document_bot($chat_id,$bot_id,$filepath,$newfilename){
       
       
    $CHAT_ID = $chat_id;
    $BOT = $bot_id;

    $FILENAME = $filepath;

    // Create CURL object
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$BOT."/sendDocument?chat_id=" . $CHAT_ID);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    // Create CURLFile
    $finfo = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $FILENAME);
    
    $cFile = new CURLFile($FILENAME, $finfo);
    $cFile->setPostFilename($newfilename);
    // Add CURLFile to CURL request
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        "document" => $cFile
    ]);

    // Call
    $result = curl_exec($ch);
    

    // Show result and close curl
    curl_close($ch);


     return $result;
     
     
    
       
   }

function send_location_bot($chat_id,$bot_id,$long,$lat){
    $bot_url = "https://api.telegram.org/bot$bot_id/";
    
    return file_get_contents($bot_url . "sendlocation?chat_id=$chat_id&latitude=$lat&longitude=$long");
}


function send_button_url_bot($chat_id,$bot_id,$url_button,$text_button,$text){
    
            $inline_button = array("text"=>"Website","url"=>"http://google.com");
        // $inline_button2 = array("text"=>"ANJAY","callback_data"=>'/sta');
             $inline_button1 = array("text"=>"$text_button","url"=>"$url_button");
             $inline_keyboard = [[$inline_button1]];
             $keyboard=array("inline_keyboard"=>$inline_keyboard);
             $replyMarkup = json_encode($keyboard);
              
              return file_get_contents("https://api.telegram.org/bot$bot_id/sendMessage?chat_id=$chat_id&text=" . urlencode("$text") . "&reply_markup=" .
        $replyMarkup);
}



function send_button_callback_bot($chat_id,$bot_id,$inline_keyboard,$text){
    
            
             $keyboard=array("inline_keyboard"=>$inline_keyboard);
             $replyMarkup = json_encode($keyboard);
              
              return file_get_contents("https://api.telegram.org/bot$bot_id/sendMessage?parse_mode=HTML&chat_id=$chat_id&text=" . urlencode("$text") . "&reply_markup=" .
        $replyMarkup);
             
         
}

function send_message_bot($chat_id,$bot_id,$text){
    
              return file_get_contents("https://api.telegram.org/bot$bot_id/sendMessage?chat_id=$chat_id&text=" . urlencode("$text"));
}
function reply_bot($text){
    global $bot_id,$chat_id;
              return file_get_contents("https://api.telegram.org/bot$bot_id/sendMessage?chat_id=$chat_id&text=" . urlencode("$text"));
}

function kick_member_bot($bot_id,$grup_id,$chat_id){
    file_get_contents("https://api.telegram.org/bot$bot_id/KickChatMember?chat_id=$grup_id&user_id=$chat_id");
}

function unban_member_bot($bot_id,$grup_id,$chat_id){
    file_get_contents("https://api.telegram.org/bot$bot_id/UnbanChatMember?chat_id=$grup_id&user_id=$chat_id");
}

function kick_member_until_bot($bot_id,$grup_id,$chat_id,$until_date){
    
    file_get_contents("https://api.telegram.org/bot$bot_id/KickChatMember?chat_id=$grup_id&user_id=$chat_id&until_date=$until_date");
}
function banned_member_bot($bot_id,$grup_id,$chat_id,$until_date){
    
    file_get_contents("https://api.telegram.org/bot$bot_id/ChatMemberBanned?chat_id=$grup_id&user_id=$chat_id&until_date=$until_date");
}


function copy_message_bot($bot_id,$chat_id,$from_chat_id,$message_id){
    file_get_contents("https://api.telegram.org/bot$bot_id/copyMessage?chat_id=$chat_id&from_chat_id=$from_chat_id&message_id=$message_id");
}

function delete_message_bot($bot_id,$chat_id,$message_id){
    file_get_contents("https://api.telegram.org/bot$bot_id/deleteMessage?chat_id=$chat_id&message_id=$message_id");
    
}



function edit_reply_markup_bot($chat_id,$bot_id,$message_id,$inline_keyboard,$text){
    
            
             $keyboard=array("inline_keyboard"=>$inline_keyboard);
             $replyMarkup = json_encode($keyboard);
              
              return file_get_contents("https://api.telegram.org/bot$bot_id/editMessageText?parse_mode=HTML&message_id=$message_id&chat_id=$chat_id&text=" . urlencode("$text") . "&reply_markup=" .
        $replyMarkup);
             
         
}


function translate_hari($hari){
    if ($hari == "Monday"){
        return "Senin";
    }
    elseif ($hari == "Tuesday"){
        return "Selasa";
    }
    elseif ($hari == "Wednesday"){
        return "Rabu";
    }
    elseif ($hari == "Thursday"){
        return "Kamis";
    }
    elseif ($hari == "Friday"){
        return "Jumat";
    }
    elseif ($hari == "Saturday"){
        return "Sabtu";
    }
    elseif ($hari == "Sunday"){
        return "Minggu";
    }
}
