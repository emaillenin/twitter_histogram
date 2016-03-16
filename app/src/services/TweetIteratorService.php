<?php
namespace TwitterHistogram;

class TwitterIteratorService
{
    private $userName;
    private $connection;

    const MAX_TWEETS = 200;
    const USER_TIMELINE = "statuses/user_timeline";

    public function __construct($connection, $userName)
    {
        $this->userName = $userName;
        $this->connection = $connection;
    }

    public function getAllTweets()
    {
        $all_tweets = array();
        $pagination_id = null;
        do {
            $tweets = $this->getTweets($pagination_id);
            $pagination_id = $this->getNextPaginationId($tweets);
            $all_tweets = array_merge($all_tweets, $tweets);
        } while ($this->hasMoreTweets($tweets));

        return $all_tweets;
    }

    private function getTweets($pagination_id)
    {
        $requestParams = ["screen_name" => $this->userName, "count" => self::MAX_TWEETS,
            "include_rts" => true, "exclude_replies" => false];
        if ($pagination_id != null) $requestParams = array_merge($requestParams, ["max_id" => $pagination_id]);

        return $this->connection->get(self::USER_TIMELINE, $requestParams);
    }

    private function hasMoreTweets($tweets)
    {
        return count($tweets) > 0;
    }

    private function getNextPaginationId($tweets)
    {
        if(!$this->hasMoreTweets($tweets)) return 0;

        $minById = function ($a, $b) {
            return $a->id > $b->id ? $b : $a;
        };

        return (array_reduce($tweets, $minById, array_shift($tweets))->id)-1;
    }
}