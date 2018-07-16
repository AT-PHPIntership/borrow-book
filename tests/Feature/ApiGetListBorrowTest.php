<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use App\Models\Category;
use App\Models\Book;
use Faker\Factory as Faker;
use DB;

class ApiGetListBorrowTest extends TestCase
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
        $faker = Faker::create();
        factory(Category::class)->create();
        factory(User::class)->create();
        factory(Book::class)->create();
        factory(Borrow::class, 9)->create();
        $borrowIds = DB::table('borrowes')->pluck('id')->toArray();
        foreach ($borrowIds as $borrowId) {
            factory(BorrowDetail::class, 9)->create([
                'borrow_id' => $borrowId,
            ]);
        }
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureListBorrow()
    {
        return [
            "current_page",
            "data" => [
                [
                    "id",
                    "user_id",
                    "status",
                    "number_book",
                    "to_date",
                    "from_date",
                    "deleted_at",
                    "created_at",
                    "updated_at",
                    "borrow_details" => [
                        [   
                            "id",
                            "book_id",
                            "borrow_id",
                            "created_at",
                            "updated_at",
                            "quantity",
                            "deleted_at",
                            "book" => [
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
                                "total_rate"
                            ]
                        ]
                    ]
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
     * Return json structure is not borrow of user
     *
     * @return array
     */
    public function jsonStructureNotBorrowOfUser()
    {
        return [
            "data" => []
        ];
    }

    /**
     * Test structure of json response.
     *
     * @return void
     */
    public function testJsonListBorrows()
    {
        $book = Book::find(1);
        $borrow = Borrow::find(1);
        $borrowDetail = BorrowDetail::with('book', 'borrow')->get();
        $response = $this->jsonUser('GET', '/api/users/borrow');
        $response->assertJsonStructure($this->jsonStructureListBorrow());
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test structure of json response if user is not borrow.
     *
     * @return void
     */
    public function testJsonNotBorrowOfUser()
    {
        $response = $this->jsonUser('GET', '/api/users/borrow');
        $response->assertJsonStructure($this->jsonStructureNotBorrowOfUser());
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test json reponse.
     *
     * @return void
     */
    public function testJsonReponse()
    {
        $borrow = Borrow::find(1);
        $borrowDetail = BorrowDetail::find(1);
        $book = Book::find(1);
        $response = $this->jsonUser('GET', '/api/users/borrow');
        $response->assertJsonFragment([
            'id' => $borrow->id,
            'number_book' => $borrow->number_book,
            'book_id' => $borrowDetail->book_id,
            'borrow_id' => $borrowDetail->borrow_id,
            'quantity' => $borrowDetail->quantity,
            'title' => $book->title,
            'category_id' => $book->category_id,
            'description' => $book->description,
            'author' => $book->author,
            'number_of_page' => $book->number_of_page,
            'language' => $book->language,
            'quantity' => $book->quantity,
            'count_rate' => $book->count_rate
        ]);
    }

    /**
     * Test get borrow of user when unauthorized
     *
     * @return void
     */
    public function testUnauthorized()
    {
        factory(User::class)->create();        
        $response = $this->json('GET', '/api/users/borrow');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
