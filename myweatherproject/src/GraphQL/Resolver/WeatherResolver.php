<?php

namespace App\GraphQL\Resolver;

use App\Entity\Weather;
use Metaer\CurlWrapperBundle\CurlWrapper;
use Overblog\GraphQLBundle\Error\UserError;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WeatherResolver implements ResolverInterface, AliasedInterface
{
    protected $parameters;
    protected $curl_wrapper;

    public function __construct(CurlWrapper $curl_wrapper, ParameterBagInterface $parameters)
    {
        $this->parameters = $parameters;
        $this->curl_wrapper = $curl_wrapper;
    }
    private function buildBaseString($baseURI, $method, $params) {
      $r = array();
      ksort($params);
      foreach($params as $key => $value) {
          $r[] = "$key=" . rawurlencode($value);
      }
      return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
    }
    private function buildAuthorizationHeader($oauth) {
      $r = 'Authorization: OAuth ';
      $values = array();
      foreach($oauth as $key=>$value) {
          $values[] = "$key=\"" . rawurlencode($value) . "\"";
      }
      $r .= implode(', ', $values);
      return $r;
    }
    public function predict($city)
    {
        $weather_webservice = $this->parameters->get('curl_wrapper')['clients']['weather'];
        $query = array(
            'location' => $city,
            'format' => 'json',
        );
        $oauth = array(
            'oauth_consumer_key' => $weather_webservice['CONSUMER_KEY'],
            'oauth_nonce' => uniqid(mt_rand(1, 1000)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0'
        );
        $base_info = $this->buildBaseString($weather_webservice['baseurl'] , 'GET', array_merge($query, $oauth));
        $composite_key = rawurlencode($weather_webservice['CONSUMER_SECRET']) . '&';
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;
        $header = array(
          $this->buildAuthorizationHeader($oauth),
          'X-Yahoo-App-Id: ' . $weather_webservice['APPID']
        );
        $options = [
            CURLOPT_URL => $weather_webservice['baseurl'] . '?' . http_build_query($query),
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ];
        try {
            $data = $this->curl_wrapper->getQueryResult($options);
            $data = json_decode($data, true);
            $weather = new Weather($data);

        } catch (CurlWrapperException $e) {

        }

        return $weather->getData();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases()
    {
        return [
            'predict' => 'predict'
        ];
    }

}
