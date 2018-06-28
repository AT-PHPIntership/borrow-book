<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;

class ApiCategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * Set up database
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();
        factory(Category::class,2)->create();
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureCategory()
    {
        return [
            "current_page",
            "data" => [
                [
                    "id",
                    "name",
                    "created_at",
                    "updated_at",
                    "deleted_at"
                ],
            ],
            "first_page_url",
            "from",
            "last_page",
            "last_page_url",
            "next_page_url",
            "path",
            "per_page",
            "prev_page_url",
            "to",
            "total"    
        ];
    }

    /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonListCategories()
    {
        $response = $this->json('GET', 'api/categories');
        $response->assertJsonStructure($this->jsonStructureCategory());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $response = $this->json('GET', 'api/categories');
        $data = json_decode($response->getContent())->data;
        foreach ($data as $category) {
            $arrayCompare = [
                'id' => $category->id,
                'name' => $category->name,
            ];
            $this->assertDatabaseHas('categories', $arrayCompare);
        }
    }
}
