# RSS and atom feed validator

Uses W3.org feed validator to check if there are any errors in the feed.

## Install

```bash
composer require fungku/feed-validator-php
```

## Usage

```php
use Fungku\FeedValidator\FeedValidator;

$validator = new FeedValidator();

$feed = 'http://www.w3.org/QA/news.rss';

if ($validator->validate($feed)) {
    echo "Feed is valid";
} else {
    echo "Feed is not valid.";
}
```
