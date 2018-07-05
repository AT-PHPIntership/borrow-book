<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use App\Models\User;
use App\Models\Book;
use App\Models\ImageBook;
use App\Models\Category;

class ApiCreateBorrowTest extends TestCase
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
        factory(User::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Book::class, 1)->create();
        factory(ImageBook::class, 1)->create();
        factory(Borrow::class, 1)->create();
        factory(BorrowDetail::class)->create([
            'borrow_id' => 1
        ]);
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureCreateBorrow()
    {
        return [
            "id",
            "user_id",
            "from_date",
            "to_date",
            "updated_at",
            "created_at", 
            "borrow_details" => [ 
                [
                    "id",
                    "book_id",
                    "borrow_id",
                ]
            ],
            "user" => [
                "id",
                "name",
                "email",
                "identity_number",
                "avatar",
                "dob",
                "address",
                "role"
            ]
        ];
    }

    /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonCreateBorrow()
    {
        $body = [
            'from_date' => '2018-04-12',
            'to_date' => '2018-04-19',
            'book' => [
                0 => [
                    'id' => 1,
                    'quantity' => 2,
                ],
            ],
        ];
        $response = $this->jsonUser('POST', 'api/borrow', $body);
        $response->assertJsonStructure($this->jsonStructureCreateBorrow());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $body = [
            'from_date' => '2018-04-12',
            'to_date' => '2018-04-19',
            'book' => [
                0 => [
                    'id' => 1,
                    'quantity' => 2,
                ],
            ],
        ];
        $response = $this->jsonUser('POST', 'api/borrow', $body);
        $data = json_decode($response->getContent())->borrow_details;
        foreach ($data as $borrow_detail) {
            $arrayCompare = [
                'borrow_id' => $borrow_detail->borrow_id,
                'quantity' => $borrow_detail->quantity,
            ];
        }
        $this->assertDatabaseHas('borrow_details', $arrayCompare);
    }

    /**
     * Test message validate.
     *
     * @return void
     */
    public function testValidate()
    {
        $body = [
            'from_date' => '2018-04-12',
            'to_date' => '2018-04-19',
            'book' => [
                0 => [
                    'id' => 1,
                    'quantity' => 100,
                ],
            ],
        ];
        $response = $this->jsonUser('POST', 'api/borrow', $body);
        $response->assertJson([
            "message" => "The given data was invalid.",
        ]);
    }
}
