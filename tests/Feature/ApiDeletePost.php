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

class ApiDeletePost extends TestCase
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
        factory(Post::class)->create([
            'book_id' => 1,
            'user_id' => $this->user->id
        ]);
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
     * Test status code
     *
     * @return void
     */
    public function testStatusCode()
    {
        $this->jsonUser('DELETE', 'api/posts/1')
            ->assertStatus(200);
    }

    /**
     * Test check some object compare database.
     *
     * @return void
     */
    public function testCompareDatabase()
    {
        $response = $this->jsonUser('DELETE', 'api/posts/1');
        $data = json_decode($response->getContent());
        $arrayPost = [
            'id' => $data->id,
            'book_id' => $data->book_id,
            'user_id' => $data->user_id,
            'deleted_at' => $data->deleted_at,
            
        ];
        $this->assertDatabaseHas('posts', $arrayPost);
    }

    /**
     * Test status code 401
     *
     * @return void
     */
    public function testStatusCodeUnauthenticate()
    {
        $this->json('DELETE', 'api/posts/1')
            ->assertStatus(401);
    }
}
