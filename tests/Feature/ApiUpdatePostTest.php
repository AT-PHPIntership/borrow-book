<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Book;

class ApiUpdatePostTest extends TestCase
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
        factory(User::class,2)->create(); 
        factory(Post::class)->create([
            'user_id' => 1,
        ]);    
    }

    /**
     * test status return when connect api update comment success.
     *
     * @return void
     */
    public function testStatusUpdateCommentReturn()
    { 
        $user1 = User::find(1);
        $response = $this->put('/api/posts/1', ['body' => 'abc', 'post_type' => 0], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$user1->createToken('access_token')->accessToken]);
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * test status return when connect api update review success.
     *
     * @return void
     */
    public function testStatusUpdateReviewReturn()
    { 
        $user1 = User::find(1);
        $response = $this->put('/api/posts/1', ['body' => 'abc', 'post_type' => 0, 'rate_point' => 3], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$user1->createToken('access_token')->accessToken]);
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Return structure of json when update post success.
     *
     * @return void
     */
    public function testStructureWhenUpdatePost()
    { 
        $user1 = User::find(1);
        $response = $this->put('/api/posts/1', ['body' => 'abc', 'post_type' => 0], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$user1->createToken('access_token')->accessToken]);
        $response->assertJsonStructure([
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
        ]);
    }

    /**
     * test when update comment with content is empty.
     *
     * @return void
     */
    public function testUpdateCommentWhenContentEmpty()
    {
        $user1 = User::find(1);
        $response = $this->put('/api/posts/1', ['body' => '', 'post_type' => 0], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$user1->createToken('access_token')->accessToken]);
        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "body" => [
                    "The body field is required."
                ]
            ]
        ]);
    }

    /**
     * Test when update review with content and rate is empty.
     *
     * @return void
     */
    public function testUpdateReviewWhenContentAndRateEmpty()
    {
        $user1 = User::find(1);
        $response = $this->put('/api/posts/1', ['body' => '', 'post_type' => 1, 'rate_point' =>null], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$user1->createToken('access_token')->accessToken]);
        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "rate_point" => [
                    "The rate point field is required."
                ],
                "body" => [
                    "The body field is required."
                ]
            ]
        ]);
    }

     /**
     * Test status update post when is not login
     *
     * @return void
     */
    public function testUpdatePostWhenNotLogin()
    {
        $response = $this->put('/api/posts/1', ['body' => 'abc', 'post_type' => 0], ['Accept' => 'application/json']);
        $response->assertJson([
            "message" => "Unauthenticated."
        ]);
    }

    /**
     * Test edit post which is not belong to self.
     *
     * @return void
     */
    public function testUpdatePostNotBelongToSelf()
    { 
        $user2 = User::find(2);
        $response = $this->put('/api/posts/1', ['body' => 'abc', 'post_type' => 0], ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$user2->createToken('access_token')->accessToken]);
        $response->assertJson([
            "error" => "Update Post Fail!",
            "code" => 200
        ]);
    }

}



