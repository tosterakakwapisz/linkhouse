<?php

namespace App\Controller;

use App\Service\FeedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    /**
     * Returns collection of articles from `https://linkhouse.pl/feed/`.
     */
    #[Route('/articles', name: 'readArticleCollection', methods: ['GET'])]
    public function readArticleCollection(
        FeedService $feedService
    ): Response {
        $articles = $feedService->fetchFeedData();
        if ($articles === null) {
            return $this->json([
                'message' => 'There was a problem getting articles',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $mappedArticles = array_map(function (array $article) {
            return [
                'guid' => $article['guid'],
                'title' => $article['title'],
                'pubDate' => $article['pubDate'],
                'category' => $article['category'],
            ];
        }, $articles);

        return $this->json($mappedArticles, Response::HTTP_OK);
    }

    /**
     * Returns single article from `https://linkhouse.pl/feed/` by guid.
     *
     * Guid has to be integer, because guid that looks like this `https://linkhouse.pl/?p=30523` will make Symfony think that it's not that specific route.
     * I even tried to user requirements in Route attribute, but I couldn't get around `?` character.
     * E.g. to return article with guid `https://linkhouse.pl/?p=30523` would have to extract `30523` and use in this endpoint.
     */
    #[Route('/article/{guid}', name: 'readArticle', methods: ['GET'])]
    public function readArticle(
        FeedService $feedService,
        int $guid
    ): Response {
        $articles = $feedService->fetchFeedData();
        if ($articles === null) {
            return $this->json([
                'message' => 'There was a problem getting article',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $key = array_search($guid, array_map(
            function (string $originalGuid) {
                preg_match('/p=(\d+)/', $originalGuid, $matches);

                return $matches[1];
            },
            array_column($articles, 'guid')
        ));
        if ($key === false) {
            return $this->json([
                'message' => 'Article with guid: '.$guid.' was not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        $article = $articles[$key];

        return $this->json([
            'guid' => $article['guid'],
            'title' => $article['title'],
            'link' => $article['link'],
            'description' => $article['description'],
            'category' => $article['category'],
        ], Response::HTTP_OK);
    }
}
