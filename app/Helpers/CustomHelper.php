<?php

namespace App\Helpers;

class CustomHelper
{
    public static function printCurrency()
    {
        return env('JOBPOST_CURRENCY');
    }

    public static function getSimpleJobPostCost()
    {
        return env('SIMPLE_JOBPOST_COST');
    }

    public static function getPremiumJobPostCost()
    {
        return env('PREMIUM_JOBPOST_COST');
    }

    public static function getTotalJobPostCostForPremiumJobs()
    {
        return (float)env('SIMPLE_JOBPOST_COST') + (float)env('PREMIUM_JOBPOST_COST');
    }
	
	public static function createJobUrl($jobId, $companyId) {
        return base64_encode($jobId.'::'.$companyId.'::'.'jobfindercustomsignature');
    }
	
	public static function sendEmail($data)
    {
        if(!empty($data) && isset($data['subject']) && isset($data['to']) && isset($data['htmlBody'])) {
            $configuration = new \ElasticApiConfiguration([
                'apiUrl' => 'https://api.elasticemail.com/v2/',
                'apiKey' => '6D76024A20958ECAA7E3478ED15D57A8349EEF712A3DDFE6AFADD59AC773E469C2027AC62FEDA946285FC07FF09BEE30'
            ]);
        
            $client = new \ElasticClient($configuration);

            $result = $client->Email->Send(
                $data['subject'],
                "vince@metaphix.com",
                "Creatrhq.com",
                null,
                null,
                null,
                null,
                null,
                null,
                array($data['to']),
                array(),
                array(),
                array(),
                array(),
                array(),
                null,
                null,
                null,
                $data['htmlBody'],
                null
            );
        }
    }
}