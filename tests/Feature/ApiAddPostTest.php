<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Category;
use App\Models\Book;
use App\Models\User;
use App\Models\Post;

class ApiAddPostTest extends TestCase
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
        factory(Post::class)->create();
    }

    /**
     * Return structure of json.
     *
     * @return array
     */
    public function jsonStructureAddPost()
    {
        return [
            "id",
            "user_id",
            "book_id",
            "post_type",
            "body",
            "rate_point",
            "status",
            "created_at",
            "updated_at",
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
    public function testJsonAddPost()
    {
        $body = [
            'body' => 'great',
            'post_type' => 1,
            'rate_point' => 4,
        ];
        $response = $this->jsonUser('POST', 'api/books/1/posts', $body);
        $response->assertJsonStructure($this->jsonStructureAddPost());
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $body = [
            'body' => 'great',
            'post_type' => 1,
            'rate_point' => 4,
        ];
        $response = $this->jsonUser('POST', 'api/books/1/posts', $body);
        $data = json_decode($response->getContent());
        $arrayCompare = [
            'body' => $data->body,
            'rate_point' => $data->rate_point,
        ];
        $this->assertDatabaseHas('posts', $arrayCompare);
    }
}
