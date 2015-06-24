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

        $xml = $this->makeXML($response);

        return $this->isValid($xml) && $this->getErrorCount($xml) < 1;
    }

    /**
     * Make a simple xml object from an xml string.
     *
     * @param string $xml
     * @return \SimpleXMLElement
     */
    private function makeXML($xml)
    {
        $xml = simplexml_load_string($xml, null, null, 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('env', 'http://www.w3.org/2003/05/soap-envelope/');
        $xml->registerXPathNamespace('m', 'http://www.w3.org/2005/10/markup-validator');

        return $xml;
    }

    /**
     * Determine if the feed is valid.
     *
     * @param \SimpleXMLElement $xml
     * @return bool
     */
    private function isValid(\SimpleXMLElement $xml)
    {
        $validity = $xml->xpath('//m:validity');
        $validity = !empty($validity) ? (string) $validity[0] : '';

        return ('true' === $validity) ? true : false;
    }

    /**
     * Get the number of errors.
     *
     * @param \SimpleXMLElement $xml
     * @return int
     */
    private function getErrorCount(\SimpleXMLElement $xml)
    {
        $errors = $xml->xpath('//m:errorcount');
        $errors = !empty($errors) ? (int) $errors[0] : 0;

        return $errors < 1;
    }
}
