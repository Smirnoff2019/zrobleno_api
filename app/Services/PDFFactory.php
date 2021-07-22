<?php

namespace App\Services;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Http;

class PDFFactory
{
    /**
     * The faker instance
     *
     * @var Faker
     */
    public $faker;

    /**
     * The service api_endpoint
     *
     * @var string
     */
    protected $api_endpoint = "https://selectpdf.com/api2/convert/";

    /**
     * The service api key
     *
     * @var string
     */
    protected $key = '83bc7fbb-4b10-4018-a2dd-ee000bdd5d88';

    /**
     * The url
     *
     * @var string
     */
    protected $url;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->faker = Faker::create();
        $this->url   = $url;
    }

    /**
     * Make new data for project
     *
     * @param string $url
     * @return array
     */
    public static function create(string $url = null)
    {
        $service = new static($url);

        $urls = "$service->api_endpoint?" . http_build_query([
            'key' => $service->key,
            'url' => $service->url,
        ]);

        return response(
            Http::get($urls)
        )->withHeaders([
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * Make new instance
     *
     * @return static
     */
    public static function make(...$args)
    {
        return new static(...$args);
    }

}
