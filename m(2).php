<?php
$Token = "1973941290:AAHJo7hvXIdlJF7KUKCneLCmBjvtnzKhC5s";//توكن
define('API_KEY',"$Token");
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res);
}
function getupdates($up_id){
  $get = bot('getupdates',[
    'offset'=>$up_id
  ]);
  return end($get->result);
}
function run($update){
$message = $update->message;
$text = $message->text; 
$data = $update->callback_query->data; 
$user = $update->message->from->username; 
$user2 = $update->callback_query->from->username; 
$name = $update->message->from->first_name; 
$name2 = $update->callback_query->from->first_name; 
$message_id = $message->message_id;
$message_id2 = $update->callback_query->message->message_id; 
$chat_id = $message->chat->id; 
$chat_id2 = $update->callback_query->message->chat->id; 
$from_id = $message->from->id;
$from_id2 = $update->callback_query->message->from->id; 
$type = $update->message->chat->type; 
if($text == "/start"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اهلا بك في بوت انشاء استضافه
فقط اضغط علي صنع استضافه و سوف ارسل لك الاستضافه
--------------
By: @KHAFEER ~ @AKIL828",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع استضافه",'callback_data'=>'creat']],
]
])
]);
} if($data == "back"){
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id2,
	'text'=>"اهلا بك في بوت انشاء استضافه
فقط اضغط علي صنع استضافه و سوف ارسل لك الاستضافه
--------------
By: @KHAFEER ~ @AKIL828",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع استضافه",'callback_data'=>'creat']],
]
])
]);
} 
if($data == "creat"){
	function RandomString($n)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
    return $randomString; 
} 

function ak(){
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://newserv.freewha.com/cgi-bin/create_ini.cgi"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_ENCODING , "");
$dom = RandomString("5");
curl_setopt($ch, CURLOPT_POSTFIELDS, "action=validate&domainName=".$dom.".orgfree.com&email=".$dom."%40gmail.com&password=QwpA6qOGSqsB&confirmPassword=QwpA6qOGSqsB&agree=1"); 
$ch = curl_exec($ch);

if(strpos($ch ,"Create your account at Free Web Hosting Area")){
return "$dom";
}else{
return "NO";
}

}
$kj =  ak();
	bot('editMessageText',[
	'chat_id'=>$chat_id2,
	'message_id'=>$message_id2,
	'text'=>"
Done Create Hosting ✅.
---------------------
YOUR LINK: ".$kj.".orgfree.com
FTP ~ USERNAME: ".$kj.".orgfree.com
FTP ~ PASSWORD: QwpA6qOGSqsB
FTP ~ EMAIL : ".$kj."@gmail.com
LOGIN CPANEL: https://newserv.freewha.com
",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع استضافة اخري",'callback_data'=>'creat']],
[['text'=>"رجوع",'callback_data'=>'back']],
]
])
]);
} 
}
while(true){
  $last_up = $last_up??0;
  $get_up = getupdates($last_up+1);
  $last_up = $get_up->update_id;
  run($get_up);
  sleep(1);
}