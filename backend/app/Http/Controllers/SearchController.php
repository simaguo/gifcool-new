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
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    protected $client;

    public function index($keyword)
    {
        /*if ($keyword) {
            $keyword = urldecode($keyword);
            $result = Gif::query()->where('title', 'like', '%' . $keyword . '%')->paginate();

            return $this->response->paginator($result, new GifTransformer());
        }*/

        return $this->response->noContent();
    }

    public function elasticsearch(Request $request, $keyword)
    {
        $keyword = urldecode($keyword);
        $page = Input::get('page', 1);
        $size = Input::get('size', 3);
        $from = ($page - 1) * $size;

        $client = $this->getElasticClient();
        $params = [
            'index' => 'gifcool-new',
            'type' => 'gifs',
            'body' => [
                'query' => [
                    'match' => [
                        'title' => $keyword
                    ]
                ],
                'size' => $size,
                'from' => $from
            ]
        ];
        $result = $client->search($params);
        $data = collect($result['hits']['hits'])->map(function ($hit) {
            return (object)$hit['_source'];
        });
        $paginate = new LengthAwarePaginator($data, $result['hits']['total'], $size, $page, [
            'path' => $request->getUriForPath($request->getPathInfo())
        ]);
        return $this->response->paginator($paginate, new GifTransformer());
    }

    /**
     * @return Client
     */
    protected function getElasticClient()
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