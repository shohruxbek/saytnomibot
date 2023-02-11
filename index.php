<?php

define('API_KEY',"#"); //token
//echo "https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME'];

function bot($method, $datas = []){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id= $message->message_id;
$chat_id = $message->chat->id;
$text = $message->text;
$first_name= $message->from->first_name;



if(!$chat_id){
    $chat_id = $update->callback_query->message->chat->id;
    $message_id = $update->callback_query->message->message_id;
}
$data = $update->callback_query->data;
$callmid = $update->callback_query->message->message_id;


include ('function.php');

$key = json_encode(['keyboard'=>[
            [['text'=>"Info"]]
            ], 'resize_keyboard'=>true]);


if($message->chat->type!="private"){
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"Bot lichkasiga yozing: @saytnomibot"
    ]);
    exit();
}


if($text=="/start"){
   bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"Sayt nomini yozing:\n\nMasalan Kun.uz",
        'reply_markup'=>$key
        ]);
   exit();
}


if($text=='Info'){
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"Mavjud zonalar => [uz][com][net][org][biz][info][ru]\n\nBot faqat 1-tipdagi saytlarni qidirishga moslashgan. Masalan: \npepsi.uz ni qidira oladi\npepsi.com.uz ni qidira olmaydi",
    ]);
    exit();
}


if($text and $text!="Info"){
    if(mb_stripos($text,".") !== false){

        $text = explode(".", $text);
        if($text[0] and $text[1]){
            sayt($chat_id,$text[0],$text[1]);
        }else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"Sayt nomini yozing:\n\nMasalan Kun.uz",
        'reply_markup'=>$key
        ]);
   exit();
        }
    }else{
       bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"Sayt nomini yozing:\n\nMasalan Kun.uz",
        'reply_markup'=>$key
        ]);
   exit(); 
    }
}

?>