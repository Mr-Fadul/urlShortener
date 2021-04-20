<?php

namespace Tests\Feature;

use App\Models\UrlShortener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    public function __construct() {
        parent::__construct();
        // Some constructor code.
    }
    /**
     * teste do redirecionamento de url
     * precisa de uma url cadastrada
     * @test
     * @return void
     */
    public function followLink()
    {
        $urlShortener = new UrlShortener;
        $urlShortener = $urlShortener->first();
        $response = $this->get('/'.$urlShortener['shortUrl']);
        $response->assertStatus(200);
    }
    
    /**
     * teste para receber a string aleatória 
     *
     * @return void
     * @test
     */
    public function urlShort()
    {   $urlShortener = new UrlShortener;
        $this->assertTrue(!empty($urlShortener->encurtarUrl()));
    }
}
