<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

class FeedService
{
    public function fetchFeedData(): ?array
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://linkhouse.pl/feed/');

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            return null;
        }

        $content = $response->getContent();
        $xml = simplexml_load_string($content);

        $data = [];
        foreach ($xml->channel->item as $item) {
            $data[] = [
                'guid' => (string) $item->guid,
                'title' => (string) $item->title,
                'pubDate' => (string) $item->pubDate,
                'category' => (string) $item->category,
                'description' => (string) $item->description,
                'link' => (string) $item->link,
            ];
        }

        return $data;
    }
}
