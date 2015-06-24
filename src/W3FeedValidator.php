<?php

namespace Fungku\FeedValidator;

use Fungku\FeedValidator\Contracts\FeedValidator;

class W3FeedValidator implements FeedValidator
{
    /**
     * Validate the atom or rss feed.
     *
     * @param string $feed The url of the feed to validate.
     * @return bool
     */
    public function validate($feed)
    {
        $validator = "http://validator.w3.org/feed/check.cgi?output=soap12&url={$feed}";
        $response = file_get_contents($validator);

        return $this->isValid($response);
    }

    /**
     * Determine if the feed is valid.
     *
     * @param string $response
     * @return bool
     */
    protected function isValid($response)
    {
        $xml = simplexml_load_string($response, null, null, 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('env', 'http://www.w3.org/2003/05/soap-envelope/');
        $xml->registerXPathNamespace('m', 'http://www.w3.org/2005/10/markup-validator');

        $value = $xml->xpath('//m:errorcount');

        $valid = !empty($value) ? (int) $value[0] : 0;

        return $valid < 1;
    }
}
