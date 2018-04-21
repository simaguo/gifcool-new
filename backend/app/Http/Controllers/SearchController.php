<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-16
 * Time: 9:58
 */

namespace App\Http\Controllers;


use App\Models\Gif;
use App\Transformers\GifTransformer;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class SearchController extends Controller
{
    protected $client;

    public function index($keyword)
    {
        if ($keyword) {
            $keyword = urldecode($keyword);
            $result = Gif::query()->where('title', 'like', '%' . $keyword . '%')->paginate();
            return $this->response->paginator($result, new GifTransformer());
        }

        return $this->response->noContent();
    }

    public function elasticsearch($keyword)
    {
        $keyword = urldecode($keyword);
        $client = $this->getElasticClient();
        $params = [
            'index' => 'gifcool-new',
            'type' => 'gifs',
            'body' => [
                'query' => [
                    'match' => [
                        'title' => $keyword
                    ]
                ]
            ]
        ];

        return $client->search($params);
    }

    protected function getElasticClient(): Client
    {
        if (is_null($this->client)) {
            $this->client = ClientBuilder::create()->build();
        }
        return $this->client;
    }

    protected function deleteAllIndexes()
    {
        $client = $this->getElasticClient();
        $params = [
            'index' => 'gifcool-new'
        ];
        $client->indices()->delete($params);
    }

    public function indexesAll()
    {
        //$this->deleteAllIndexes();
        $gifs = Gif::query()->get();
        $client = $this->getElasticClient();
        foreach ($gifs as $body) {
            $params = [
                'index' => 'gifcool-new',
                'type' => 'gifs',
                'id' => $body->id,
                'body' => $body
            ];
            $response = $client->index($params);
        }


        return $response;
    }
}