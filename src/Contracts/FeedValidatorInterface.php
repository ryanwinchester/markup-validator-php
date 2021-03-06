<?php

namespace Fungku\MarkupValidator\Contracts;

interface FeedValidatorInterface
{
    /**
     * Validate an atom or rss feed.
     *
     * @param string $feed
     * @return bool
     */
    public function validate($feed);
}