<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;
use App\Models\Book;
use App\Models\Category;
use App\Models\ImageBook;
use Illuminate\Http\Response;
use DB;

class ApiGetListPostsOfBookTest extends TestCase
{
    use DatabaseMigrations;
    const NUMBER_RECORD_CREATE = 5;

    /**
    * Set up database
    *
    * @return void
    */
    public function setUp()
    {
        parent::setUp();

        factory(Category::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Book::class, self::NUMBER_RECORD_CREATE)->create();
        factory(ImageBook::class, self::NUMBER_RECORD_CREATE)->create();
    }

    /**
     * Receive status code 200 when get list books success.
     *
     * @return void
     */
    public function testStatusCodeSuccess()
    {
        $response = $this->json('GET', '/api/books');
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureListBooks()
    {
        return [
            'data' => [
                [
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
                    "category" => [
                        "id",
                        "name",
                        "created_at",
                        "updated_at",
                        "deleted_at"
                    ],
                    "image_books" => []
                ]
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
    public function testJsonListBooks()
    {
        $response = $this->json('GET', '/api/books');
        $response->assertJsonStructure($this->jsonStructureListBooks());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $response = $this->json('GET', 'api/books');
        $data = json_decode($response->getContent())->data;
        foreach ($data as $book) {
            $arrayCompare = [
                'id' => $book->id,
                'title' => $book->title,
            ];
            $this->assertDatabaseHas('books', $arrayCompare);
        }
    }
}
