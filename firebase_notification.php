sendNotification("Ben php üzerinden gönderildim!", "Php - Firebase bağlantısı böyle çalışır.", ["new_post_id" => "605"], "new_post", "YOUR_SERVER_KEY");

function sendNotification($title = "", $body = "", $customData = [], $topic = "", $serverKey = ""){
if($serverKey != ""){
ini_set("allow_url_fopen", "On");
$data =
[
"to" => '/topics/all',
"notification" => [
"body" => $body,
"title" => $title,
],
"data" => $customData
];

$options = array(
'http' => array(
'method' => 'POST',
'content' => json_encode( $data ),
'header'=> "Content-Type: application/json

" .
"Accept: application/json

" .
"Authorization:key=".$serverKey
)
);

$context = stream_context_create( $options );
$result = file_get_contents( "https://fcm.googleapis.com/fcm/send", false, $context );
return json_decode( $result );
}
return false;
}