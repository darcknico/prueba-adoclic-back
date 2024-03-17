<?php
namespace App\Services;

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use App\Models\{Entity,Category};

class PublicApiConnect {

    private $client;

    static function HTTP() : Client
    {
        $client = new Client([
            'verify' => false,
        ]);
        return $client;
    }


    static function getEntries($category = '')
    {
        $result = null;
        try {
            $response = self::HTTP()->request('GET',"https://api.publicapis.org/entries?category=${category}");
            $result = json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $error = Psr7\Message::toString($e->getResponse());
            Log::error("PublicApiConnect:getEntries ${error}");
        }
        return $result;
    }

    static function extractByCategories(array $categories)
    {
        $result = [];
        foreach ($categories as $category) {
            $categoryModel = Category::where('category', $category)->first();
            if(!$categoryModel) continue;

            $entries = self::getEntries($category);
            if($entries) {
                foreach ($entries['entries'] as $entry) {

                    $model = Entity::updateOrCreate(
                        [
                            'api' => $entry["API"],
                        ],
                        [
                            'description' => $entry["Description"],
                            'link' => $entry["Link"],
                            'category_id' => $categoryModel->id,
                        ]
                    );
                    $result[] = $model;
                }
            };
        }
        return $result;
    }
}
