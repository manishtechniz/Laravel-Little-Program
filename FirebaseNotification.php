<?php 


    $serverKey = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';            
    $notifyData=array(
        "body"=>"Send Firebase Notification with Laravel", // Your Notification Message
        "title"=> "Firebase Notification"
    );

    $registrationlds = $tokens; // This Tokens is User Device Token
    $fields = array(
        // NOTE: `registration_ids` is used for bulk message whereas `to` used for single message
        count($tokens)>1?"registration_ids":"to"=>count($tokens)>1?$registrationlds:$registrationlds[0],
        'notification'=>$notifyData,
        'priority'=>"high"
    ); 

    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey; // Get Server key from Firebase Accoun  		
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true ); 
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch);
    if ($result === FALSE) 
    {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
   