<?php

namespace Unetway\Recaptcha;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Recaptcha
{

    /**
     * @var Client $client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $apiUrl = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * @var string
     */
    private string $secretKey;

    /**
     * Recaptcha constructor.
     * @param string $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->client = new Client();
        $this->secretKey = $secretKey;
    }

    /**
     * @param string $response
     * @param string $ip
     * @return bool
     */
    public function siteVerify(string $response, string $ip): bool
    {
        try {
            $response = $this->client->post($this->apiUrl, [
                'form_params' => [
                    'secret' => $this->secretKey,
                    'response' => $response,
                    'remoteip' => $ip,
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            return $result['success'];
        } catch (ClientException $exception) {
            error_log($exception->getMessage());
        }

        return false;
    }

}
