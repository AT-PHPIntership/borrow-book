<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
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

        factory(User::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Category::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Book::class, self::NUMBER_RECORD_CREATE)->create();
        factory(Post::class)->create([
            'id' => 1,
            'book_id' => 1,
            'status' => 1
        ]);
        factory(Post::class, self::NUMBER_RECORD_CREATE)->create();
    }

    /**
     * Receive status code 200 when get list posts success.
     *
     * @return void
     */
    public function testStatusCodeSuccess()
    {
        $response = $this->json('GET', '/api/books/1/posts');
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureListPosts()
    {
        return [
            'data' => [
                [
                    'id',
                    'user_id',
                    'book_id',
                    'post_type',
                    'body',
                    'rate_point',
                    'status',
                    'deleted_at',
                    'created_at',
                    'updated_at',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'identity_number',
                        'avatar',
                        'dob',
                        'address',
                        'role',
                    ],
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
    public function testJsonListPosts()
    {
        $response = $this->json('GET', '/api/books/1/posts');
        $response->assertJsonStructure($this->jsonStructureListPosts());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $response = $this->json('GET', 'api/books/1/posts');
        $data = json_decode($response->getContent())->data;
        foreach ($data as $post) {
            $arrayCompare = [
                'id' => $post->id,
                'body' => $post->body,
            ];
            $this->assertDatabaseHas('posts', $arrayCompare);
        }
    }

}
