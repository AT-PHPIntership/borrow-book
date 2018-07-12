<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Book;
use App\Models\ImageBook;
use App\Models\Category;
use App\Models\Borrow;
use App\Models\BorrowDetail;

class ApiCancelBorrow extends TestCase
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
        
        factory(User::class)->create();
        factory(Category::class)->create();
        factory(Book::class)->create();
        factory(ImageBook::class)->create();
        factory(Borrow::class)->create([
            'user_id' => $this->user->id,
            'status' => 2,
        ]); 
        factory(BorrowDetail::class)->create([
            'borrow_id' => 1,
        ]); 
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureCancelBorrow()
    {
        return [
            "id",
            "user_id",
            "status",
            "number_book",
            "to_date",
            "from_date",
            "deleted_at",
            "created_at",
            "updated_at",
            "date_send_mail",
            "borrow_details" => [
                [
                    "id",
                    "book_id",
                    "borrow_id",
                    "created_at",
                    "updated_at",
                    "quantity",
                    "deleted_at"
                ]
            ],
            "note" => [
                "id",
                "user_id",
                "borrow_id",
                "content",
                "created_at",
                "updated_at"
            ]
        ];
    }

    /**
     * Test status code
     *
     * @return void
     */
    public function testStatusCode()
    {
        $body = [
            "content" => "hahaha"
        ];
        $this->jsonUser('PUT', 'api/borrow/1', $body)
            ->assertStatus(200);
    }

    /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonCancelBorrow()
    {
        $body = [
            "content" => "hahaha"
        ];
        $response = $this->jsonUser('PUT', 'api/borrow/1', $body);
        $response->assertJsonStructure($this->jsonStructureCancelBorrow());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $body = [
            "content" => "hahaha"
        ];
        $response = $this->jsonUser('PUT', 'api/borrow/1', $body);
        $data = json_decode($response->getContent())->note;
        $arrayNote = [
            'content' => $data->content,
        ];
        $this->assertDatabaseHas('notes', $arrayNote);
    }
}
