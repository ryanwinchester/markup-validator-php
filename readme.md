# Markup Validator

Someday I'll add other things, but right now it is a feed validator.

## Install

```bash
composer require fungku/markup-validator-php
```

### RSS and atom feed validator

Uses W3.org feed validator to check if there are any errors in the feed.

#### Usage

```php
use Fungku\MarkupValidator\FeedValidator;

$validator = new FeedValidator();

$feed = 'http://www.w3.org/QA/news.rss';

if ($validator->validate($feed)) {
    echo "Feed is valid";
} else {
    echo "Feed is not valid.";
}
```
