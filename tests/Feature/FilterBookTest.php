<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Book;
use App\Models\Category;
use App\Models\ImageBook;

class FilterBookTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * This function is called before testcase
     */
    public function setUp()
    {
        parent::setUp(); 
        factory(Category::class)->create();
        factory(Book::class)->create([
            'category_id' => 1,
            'language' => 'Vietnamese',
            'number_of_page' =>'20000',
        ]);
        factory(ImageBook::class)->create();
    }

     /**
     *  Test case
     * 
     * @return array
     */
    public function transferFilterURL() {
        return [
            [['1', '2'], 'category'],
            [['Vietnamese', 'abc'], 'language'],
            [['10000,30000', '30000,40000'], 'number_of_page'],
        ];
    }

    /**
     * Return json structure of list books if keywords exist
     *
     * @return array
     */
    public function jsonStructureListBooksExists()
    {
        return [
            "current_page",
            "data" => [
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
                    "image_books"=> []
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
     * Return json structure of list books if keywords not exist
     *
     * @return array
     */
    public function jsonStructureListBooksNotExists()
    {
        return [
            "data" => []
        ];
    }

    /**
     * Test filter follow one param
     * 
     * @dataProvider transferFilterURL
     *
     * @return void
     */
    public function testFilterFollowOneParam($param, $key)
    {
        $uriExist = $key . '=' . $param[0];
        $uriNotExist = $key . '=' . $param[1];
        // exist param
        $response = $this->get('/api/books?'. $uriExist)
            ->assertJsonStructure($this->jsonStructureListBooksExists());
        // not exist param  
        $response = $this->get('/api/books?'. $uriNotExist)
            ->assertJsonStructure($this->jsonStructureListBooksNotExists());
    }

    /**
     * Test filter following many params
     *
     * @return void
     */
    public function testFilterFollowManyParams()
    {
        // test exit
        $response = $this->get('/api/books?category=1&language=Vietnamese&number_of_page=10000,30000')
            ->assertJsonStructure($this->jsonStructureListBooksExists());
        // test not exit
        $response = $this->get('/api/books?category=2&language=abc&number_of_page=30000,40000')
            ->assertJsonStructure($this->jsonStructureListBooksNotExists());
    }

    /**
     * Test filter if not exit column
     *
     * @return void
     */
    public function testFilterNotExitColumn()
    {
        $response = $this->get('/api/books?abc=abc')
            ->assertJsonStructure($this->jsonStructureListBooksExists());
    }
}
