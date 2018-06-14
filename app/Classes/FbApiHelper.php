<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 23.05.2018
 * Time: 20:48
 */

namespace App\Classes;


class FbApiHelper
{
    public static $client_id = '233480197204268'; // app id
    public static $secret_id = '526211dca363fe199aff2b6a4d74dc24'; // secret key application


    public static function getLinkAuthCode($redirect_uri){
        $params = [
            'client_id' => self::$client_id,
            'redirect_uri' => $redirect_uri,
            'scope' => 'public_profile, email',
            'response_type' => 'code',
        ];
        $url = 'https://www.facebook.com/dialog/oauth?' . urldecode( http_build_query($params) );

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
        $urlAccessToken = "https://graph.facebook.com/oauth/access_token";

        $params = [
            'client_id' => self::$client_id,
            'client_secret' => self::$secret_id,
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
            return throwException($exception);
        }
    }

    /**
     * Get information about user
     * @param $access_token
     * @return mixed|string
     */
    public function getInfoUser($access_token){
        $urlGetUser = 'https://graph.facebook.com/me';

        $params = [
            'access_token' => $access_token,
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