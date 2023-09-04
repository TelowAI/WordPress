<?php

use Aws\Firehose\FirehoseClient; 
use Aws\Exception\AwsException;

class Telow_Reporter {

    public function report($message, $type, $URL, $language, $code){
        $telow_account = get_option('telow_account');
        $name = "TelowFirehoseStream";
        
        if($telow_account){
            $reportItem = array(
                "URL" => $URL, 
                "Type" => $type, 
                "Account" => $telow_account, 
                "Message" => $message,
                "Language" => $language,
                "Code" => $code
            );
        
            $firehoseClient = new Aws\Firehose\FirehoseClient([
                'version' => '2015-08-04',
                'region' => 'us-east-1',
                'credentials'=> array(
                    'key' => 'AKIAWHGAKZO7GKYU2AOS',
                    'secret' => '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'
                )
            ]);
            
            try {
                $result = $firehoseClient->putRecord([
                    'DeliveryStreamName' => $name,
                    'Record' => [
                        'Data' => json_encode($reportItem),
                    ],
                ]);
                // var_dump($result);
            } catch (AwsException $e) {
                // output error message if fails
                echo $e->getMessage();
                echo "\n";
            }
        }
    }
}