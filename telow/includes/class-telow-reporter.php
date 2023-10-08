<?php


class Telow_Reporter {

    public function report($message, $type, $URL, $language, $code){
        $telow_account = get_option('telow_account');
        $apiUrl = "https://rest.telow.com/streams/bugs/report";
        
        if($telow_account){

            // Data to send in the request
            $data = array(
                "PartitionKey" => $telow_account,
                "Data" => array(
                    "url" => $URL, 
                    "type" => $type, 
                    "instanceId" => $telow_account, 
                    "message" => $message,
                    "language" => $language,
                    "code" => $code,
                    "createdAt" => time()
                )
            );

            // Convert the data to JSON
            $jsonData = json_encode($data);
            
            // echo '<pre>';
            // var_dump($jsonData);
            // echo '</pre>';
            
            try {
                // Initialize cURL session
                $ch = curl_init($apiUrl);

                // Set cURL options
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                ));

                // Execute the cURL request and get the response
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    throw new Exception('cURL error: ' . curl_error($ch));
                }

                // Close cURL session
                curl_close($ch);
                
                // Print the API response
                echo 'Reported to Telow: '.$response;

            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}