<?php

namespace App\Controller;

use App\Service\FeedService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
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
}
