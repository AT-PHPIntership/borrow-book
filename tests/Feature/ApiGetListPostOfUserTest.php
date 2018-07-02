<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Book;

class ApiGetListPostOfUserTest extends TestCase
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
        factory(Post::class, 21)->create();
    }

     /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureListPosts()
    {
        return [
            "current_page",
            "data" => [
                [
                    "id",
                    "user_id",
                    "book_id",
                    "post_type",
                    "body",
                    "rate_point",
                    "status",
                    "deleted_at",
                    "created_at",
                    "updated_at",
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
     * Return json structure is not post of user
     *
     * @return array
     */
    public function jsonStructureNotPostsOfUser()
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
    public function testJsonListPosts()
    {
        $response = $this->jsonUser('GET', '/api/users/posts');
        $response->assertJsonStructure($this->jsonStructureListPosts());
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test structure of json response if user is not post.
     *
     * @return void
     */
    public function testJsonNotPostsOfUser()
    {
        $response = $this->jsonUser('GET', '/api/users/posts');
        $response->assertJsonStructure($this->jsonStructureNotPostsOfUser());
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test result pagination and limit.
     *
     * @return void
     */
    public function testWithPaginationLimitListPosts()
    {
        $response = $this->jsonUser('GET', '/api/users/posts?limit=8&page=2');
        $response->assertJson([
            'current_page' => 2,
            'per_page' => 8,
            'from' => 9,
            'to' => 16,
            'last_page' => 3,
            'total' => 21,
        ]);
    }

     /**
     * Make cases for test.
     *
     * @return array
     */
    public function dataForTestSort()
    {
        return [
            ['id', 'posts.id'],
            ['body', 'posts.body'],
        ];
    }

     /**
     * Test Sort List Posts.
     *
     * @dataProvider dataForTestSort
     *
     * @return void
     */
    public function testWithSortListPost($name, $order)
    {
        $response = $this->jsonUser('GET', '/api/users/posts?sort='.$name);
        $data = json_decode($response->getContent());
        $arrayDesc = Post::orderBy($order, 'desc')->pluck($name)->toArray();
        for ($i = 1; $i <= 20; $i++) {
            $this->assertEquals($data->data[$i - 1]->$name, $arrayDesc[$i - 1]) ;
        }
    }

    /**
     * Test json reponse.
     *
     * @return void
     */
    public function testJsonReponse()
    {
        $book = Book::find(1);
        $post = Post:: find(1);
        $response = $this->jsonUser('GET', '/api/users/posts');
        $response->assertJsonFragment([
            'id' => $post->id,
            'user_id' => $post->user_id,
            'book_id' => $post->book_id,
            'post_type' => $post->post_type,
            'body' => $post->body,
            'rate_point' => $post->rate_point,
            'status' => $post->status,
            'id' => $book->id,
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
     * Test get post of user when unauthorized
     *
     * @return void
     */
    public function testUnauthorized()
    {
        factory(User::class)->create();        
        $response = $this->json('GET', '/api/users/posts');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
