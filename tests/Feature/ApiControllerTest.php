<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Entity,Category};

class ApiControllerTest extends TestCase
{
    /**
     * Check api public fetch data, and their saved entries when data is more than one
     */
    public function test_fetchPublicApi(): void
    {
        Entity::whereIn('category_id',[1,2])->delete();

        $response = $this->get('/api/fetchPublicApi')->json();

        $this->assertTrue(count($response["data"])>0);
    }

    /**
     * Api categories, if exist category
     */
    public function test_apiCategoryOk(): void
    {
        $this->get('/api/Animals')->assertOk();
    }

    /**
     * Api categories, if the response is in correct format
     */
    public function test_apiCategoryFormatResponse(): void
    {
        $response = $this->get('/api/Animals')->json();

        $this->assertTrue($response["success"]);
        $this->assertTrue(is_array($response["data"]));
    }

    /**
     * Api categories, if not exist category
     */
    public function test_apiCategoryError(): void
    {
        $this->get('/api/Test')->assertStatus(404);
    }
}
