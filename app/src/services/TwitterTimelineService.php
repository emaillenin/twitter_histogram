<?php
namespace TwitterHistogram;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterTimelineService
{
    private $userName;
    private $connection;

    public function __construct($userName)
    {
        $this->userName = $userName;
        $this->connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET,
            TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET);
        $this->connection->setTimeouts(60, 60);
        $this->twitterIteratorService = new TwitterIteratorService($this->connection, $this->userName);
    }

    public function getTweetsByHour()
    {
        $tweets = $this->twitterIteratorService->getAllTweets();
        $get_hour = function ($tweet) {
            return date_parse($tweet->created_at)['hour'];
        };

        return array_count_values(array_map($get_hour, $tweets));
    }
}