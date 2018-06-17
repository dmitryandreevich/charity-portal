<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 22.05.2018
 * Time: 22:26
 */

namespace App\Classes;


use http\Env\Request;

class VkApiHelper
{
    public static $client_id = '6487662';

    /**
     * Generate link authorization code
     *
     * @return string
     *
     */
    public static function getLinkAuthCode($redirect_uri){
        $params = [
            'client_id' => self::$client_id,
            'display' => 'popup',
            'redirect_uri' => $redirect_uri,
            'scope' => 'email',
            'response_type' => 'code',
            'test' => 'test',
            'v' => '5.76',
        ];
        $url = 'https://oauth.vk.com/authorize?' . urldecode( http_build_query($params) );

        return $url;
    }
    /**
     * Get an access token vk.
     *
     * @param $code
     *
     * @return array|mixed
     */
    public function getAccessData($code, $redirect_uri){
        $urlAccessToken = "https://oauth.vk.com/access_token";

        $params = [
            'client_id' => self::$client_id,
            'client_secret' => 'SneyrLQ7kZGMcFLdilWH',
            'redirect_uri' => $redirect_uri,
            'code' => $code
        ];
        $url = $urlAccessToken."?".urldecode( http_build_query($params) );
         try{
             $httpClient= new \GuzzleHttp\Client();
             $response = $httpClient->request('GET', $url );

             $data = self::getDataByResponse($response);
             return $data;

         }catch (\Exception $exception){
             return $exception;
         }
    }

    /**
     * Get information about user
     * @param $access_token
     * @return mixed|string
     */
    public function getInfoUser($access_token){
        $urlGetUser = 'https://api.vk.com/method/users.get';

        $params = [
            'fields' => 'city, photo_200_orig, phone, email',
            'access_token' => $access_token,
            'v' => '5.76'
        ];
        $url = $urlGetUser . '?' . urldecode( http_build_query($params) );
        try{
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url);

            $data = $this->getDataByResponse($response);
            return $data;
        }catch (\Exception $exception){
            return $exception;
        }
    }
    /**
     * Get information from the answer
     *
     * @param $response
     *
     * @return mixed
     */
    public function getDataByResponse($response){
        return collect( json_decode( $response->getBody() ) );
    }

}