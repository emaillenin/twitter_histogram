<?php
namespace TwitterHistogram;

class TwitterTimelineService
{
    private $userName;

    public function __construct($userName, $iterator_service)
    {
        if($iterator_service == null) $iterator_service = new TweetIteratorService($this->userName);

        $this->userName = $userName;
        $this->twitterIteratorService = $iterator_service;
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