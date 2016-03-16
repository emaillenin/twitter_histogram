<?php
namespace TwitterHistogram;

class TwitterTimelineService
{
    private $userName;

    public function __construct($userName)
    {
        $this->userName = $userName;
        $this->twitterIteratorService = new TweetIteratorService($this->userName);
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