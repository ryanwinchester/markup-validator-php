<?php

namespace Fungku\FeedValidator\Contracts;

interface FeedValidator
{
    /**
     * Validate an atom or rss feed.
     *
     * @param string $feed
     * @return bool
     */
    public function validate($feed);
}