<?php

namespace Fungku\FeedValidator;

use Fungku\FeedValidator\Contracts\FeedValidatorInterface;

class FeedValidator
{
    /**
     * The default feed validator implementation to use.
     *
     * @var string
     */
    protected $defaultFeedValidator = 'W3CFeedValidator';

    /**
     * @var FeedValidatorInterface
     */
    protected $feedValidator;

    /**
     * Create a new feed validator instance.
     *
     * @param FeedValidatorInterface $feedValidator
     */
    public function __construct(FeedValidatorInterface $feedValidator = null)
    {
        $this->feedValidator = $feedValidator ?: new $this->defaultFeedValidator();
    }

    /**
     * Validate the atom or rss feed.
     *
     * @param string $feed The url of the feed to validate.
     * @return bool
     */
    public function validate($feed)
    {
        return $this->feedValidator->validate($feed);
    }
}