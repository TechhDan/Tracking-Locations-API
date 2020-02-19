<?php

/**
 * Nonce Authentication
 *
 * Nonce authentication uses a one-time signature that is valid only for a specific request
 * and a short period of time. With this authentication method, you will get a unique
 * Client ID and API secret when you register with FourKites as an API user. The secret is 
 * never passed over the network. Instead, it will be used to generate a signature using
 * HMAC SHA1 algorithm that is unique to a request. The below article elaborates on how to
 * generate the one-time signature for Nonce Authentication.
 */

namespace FourKites;

class FourKitesAPI
{
    const FOURKITES_PRODUCTION = 'https://tracking-api.fourkites.com';
    const FOURKITES_STAGING = 'https://tracking-api-staging.fourkites.com';

    protected $clientId;
    protected $clientSecret;
    protected $host;
    protected $timeStamp;

    public function __construct($clientId, $clientSecret)
    {
        $this->timeStamp = time();
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->host = self::FOURKITES_PRODUCTION;
    }

    public function setStagingEnvironment(bool $stagingEnabled): void
    {
        $this->host = $stagingEnabled ?
            self::FOURKITES_STAGING :
            self::FOURKITES_PRODUCTION;
    }

    public function setTimeStamp(int $timeStamp): void
    {
        $this->timeStamp = $timeStamp;
    }

    public function calculateSignature($path)
    {
        $hash = hash_hmac('sha1', $path, $this->clientSecret, true);
        $hash = base64_encode($hash);
        $hash = str_replace('+', '-', $hash);
        $hash = str_replace('/', '_', $hash);
        return $hash;
    }

    public function getSignatureURL($uri, $params)
    {
        $params['client_id'] = $this->clientId;
        $params['timestamp'] = $this->timeStamp;
        $path = $uri . '?' . http_build_query($params);
        $path .= '&signature=' . $this->calculateSignature($path);
        $url = $this->host . $path;
        return $url;
    }

    public function sendRequest($uri, $params, $payload): array
    {
        $url = $this->getSignatureURL($uri, $params);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        $json_response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($json_response, true);
        return $response;
    }
}
