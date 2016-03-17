# API Setup

1. Change DocumentRoot in Apache config to `<twitter_histogram_path>/public/`
2. Set `AllowOverride All` and `SetEnv APP_ENV dev`
3. Restart Apache and hit `http://localhost/histogram/<any_twitter_username>`

# Run Tests

1. Run `php phpunit.phar`