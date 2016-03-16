<?php
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterTimelineService
{
    private $userName;
    private $connection;

    public function __construct($userName)
    {
        $this->userName = $userName;
        $this->connection = $connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET,
            TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET);;
    }

    public function getTweetsByHour()
    {

    }
}