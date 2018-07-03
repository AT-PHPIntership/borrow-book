<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;
use App\Models\Book;
use App\Models\User;

class ApiShowDetailBook extends TestCase
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
        factory(Category::class)->create();
        factory(Book::class)->create();
        factory(User::class)->create();
    }
    
    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureShowDetailBook()
    {
        return [
            "id",
            "category_id",
            "title",
            "description",
            "number_of_page",
            "author",
            "publishing_year",
            "language",
            "quantity",
            "count_rate",
            "deleted_at",
            "created_at",
            "updated_at",
            "total_rate",
            "category" => [
                "id",
                "name",
                "created_at",
                "updated_at",
                "deleted_at"
            ],
            "image_books" => []
        ];
    }

    /**
     * Test status code
     *
     * @return void
     */
    public function testStatusCodeForDetailBook()
    {
        $response = $this->json('GET', '/api/books/1');
        $response->assertStatus(200);
    }

    /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonStructure()
    {
        $response = $this->json('GET', '/api/books/1');
        $response->assertJsonStructure($this->jsonStructureShowDetailBook());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $response = $this->json('GET', 'api/books/1');
        $data = json_decode($response->getContent());
        $arrayCompare = [
            'id' => $data->id,
            'title' => $data->title,
            'category_id' => $data->category_id
        ];
        $this->assertDatabaseHas('books', $arrayCompare);
        foreach ($data->image_books as $image_book) {
            $arrayImage = [
                'id' => $image_book->id,
                'book_id' => $image_book->book_id
            ];
            $this->assertDatabaseHas('image_books', $arrayImage);
        }
    }
}
