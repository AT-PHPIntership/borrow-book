## Posts API

### `GET` List Posts Following Book
```
/api/books/{book}/posts
```
Get list posts following book

#### Query Param
| Param | Type | Description |
|---|---|---|
| post_type | number | Type Of Posts |
| page | number | Paninate Posts |
| sort | string | Sort Posts Follow Name |

```json
"data": [
        {
            "id": 2,
            "user_id": 9,
            "book_id": 9,
            "post_type": 1,
            "body": "Quod sapiente magnam expedita dignissimos. Qui ea iusto et odio. Quidem aut eos sunt nisi ut aliquid ex.",
            "rate_point": 1.2,
            "status": 1,
            "deleted_at": null,
            "created_at": "2018-06-06 08:44:39",
            "updated_at": "2018-06-06 08:44:39",
            "user": {
                "id": 9,
                "name": "Prof. Fern Ryan",
                "email": "skertzmann@example.com",
                "identity_number": "378468817",
                "avatar": "http://192.168.33.10/storage/images/default-user.png",
                "dob": "2000-12-10",
                "address": "460 Heidi Mount Apt. 732\nWest Zack, RI 05510-4851",
                "role": 1
            }
        },
        {
            "id": 5,
            "user_id": 6,
            "book_id": 9,
            "post_type": 1,
            "body": "Voluptatem pariatur autem error et inventore omnis. Odio sit odit assumenda voluptas aspernatur. Ea qui dolore optio modi autem recusandae dicta.",
            "rate_point": 4,
            "status": 1,
            "deleted_at": null,
            "created_at": "2018-06-06 08:44:39",
            "updated_at": "2018-06-06 08:44:39",
            "user": {
                "id": 6,
                "name": "Edwina O'Conner",
                "email": "alana85@example.net",
                "identity_number": "138504949",
                "avatar": "http://192.168.33.10/storage/images/default-user.png",
                "dob": "1990-06-17",
                "address": "1360 Cora Pine\nKrajcikshire, NC 89059-3201",
                "role": 1
            }
        },
        {
            "id": 14,
            "user_id": 9,
            "book_id": 9,
            "post_type": 1,
            "body": "Et veniam in nemo commodi molestiae. Voluptas quibusdam perferendis beatae molestias. Qui deserunt cumque veniam commodi et debitis recusandae.",
            "rate_point": 3.1,
            "status": 0,
            "deleted_at": null,
            "created_at": "2018-06-06 08:45:01",
            "updated_at": "2018-06-06 08:45:01",
            "user": {
                "id": 9,
                "name": "Prof. Fern Ryan",
                "email": "skertzmann@example.com",
                "identity_number": "378468817",
                "avatar": "http://192.168.33.10/storage/images/default-user.png",
                "dob": "2000-12-10",
                "address": "460 Heidi Mount Apt. 732\nWest Zack, RI 05510-4851",
                "role": 1
            }
        }
        ]
"first_page_url": "http://192.168.33.10/api/books/9/posts?page=1",
"from": 1,
"last_page": 1,
"last_page_url": "http://192.168.33.10/api/books/9/posts?page=1",
"next_page_url": null,
"path": "http://192.168.33.10/api/books/9/posts",
"per_page": 20,
"prev_page_url": null,
"to": 3,
"total": 3
```
### `POST` Create New Post
```
/api/books/{book}/posts
```
Create new post

#### Request header
| Key | Value |
|---|---|
|Accept|application\json|
|Authorization|{token_type} {access_token}

#### Parameters
| Key | Value | Required | Description |
|---|---|---|---|
| status | Number | required | Post type (status,find book,review) |
| content | String | required | Content of post |
| book_id | Number | optional | Id book review (required when status is review) |
| rating | Number | optional | Rating for book (required when status is review) |

#### Response - Success
```json
{
    "data": {
        "id": 14,
        "user_id": 9,
        "book_id": 9,
        "post_type": 1,
        "body": "Et veniam in nemo commodi molestiae. Voluptas quibusdam perferendis beatae molestias. Qui deserunt cumque veniam commodi et debitis recusandae.",
        "rate_point": 3.1,
        "status": 0,
        "deleted_at": null,
        "created_at": "2018-06-06 08:45:01",
        "updated_at": "2018-06-06 08:45:01",
        "user": {
            "id": 9,
            "name": "Prof. Fern Ryan",
            "email": "skertzmann@example.com",
            "identity_number": "378468817",
            "avatar": "http://192.168.33.10/storage/images/default-user.png",
            "dob": "2000-12-10",
            "address": "460 Heidi Mount Apt. 732\nWest Zack, RI 05510-4851",
            "role": 1
        }
    }
}
```
### `DELETE` Delete Post
```
/api/posts/{post}
```
Delete the post
#### Request header
| Key | Value |
|---|---|
|Accept|application\json|
|Authorization|{token_type} {access_token}
#### Parameters
| Field | Type | Description |
| --- | --- | --- |
| id | Number | Id of post |
#### Response success

```json
{
    "data": {
        "id": 14,
        "user_id": 9,
        "book_id": 9,
        "post_type": 1,
        "body": "Et veniam in nemo commodi molestiae. Voluptas quibusdam perferendis beatae molestias. Qui deserunt cumque veniam commodi et debitis recusandae.",
        "rate_point": 3.1,
        "status": 0,
        "deleted_at": "2018-06-06 08:45:01",
        "created_at": "2018-06-06 08:45:01",
        "updated_at": "2018-06-06 08:45:01",
        "user": {
            "id": 9,
            "name": "Prof. Fern Ryan",
            "email": "skertzmann@example.com",
            "identity_number": "378468817",
            "avatar": "http://192.168.33.10/storage/images/default-user.png",
            "dob": "2000-12-10",
            "address": "460 Heidi Mount Apt. 732\nWest Zack, RI 05510-4851",
            "role": 1
        }
    }
}
```

### `GET` List posts following user
```
/api/users/posts
```
Get list posts following user
#### Request header
| Key | Value |
|---|---|
|Accept|application\json|
|Authorization|{token_type} {access_token}|
#### Query Param
| Param | Type | Description | 
|---|---|---|
| page | number | Paninate Posts |
| sort | string | Sort Posts Follow Name |
| limit | number | Limit Posts |

##### Example
| URL | Description |
|---|---|
| /api/user/posts?page=1&sort=id | Get post in page 1 sort by id   |
| /api/user/posts?limit=3&sort=id | Get 10 post and sort by id |

```json
{
    "data": [
        {
            "id": 2,
            "user_id": 9,
            "book_id": 2,
            "post_type": 1,
            "body": "Quod sapiente magnam expedita dignissimos. Qui ea iusto et odio. Quidem aut eos sunt nisi ut aliquid ex.",
            "rate_point": 1.2,
            "status": 1,
            "deleted_at": null,
            "created_at": "2018-06-06 08:44:39",
            "updated_at": "2018-06-06 08:44:39",
            "book": {
                "id": 2,
                "category_id": 7,
                "title": "Sydnie Dickens PhD",
                "description": "Eos facilis doloribus consequatur minus velit dolor. Fugit itaque corrupti et ab. Atque eum hic ipsam esse rerum. Est mollitia aliquid facilis sit.",
                "number_of_page": 871030395,
                "author": "Prof. Elian Auer",
                "publishing_year": "1990-04-28",
                "language": "English",
                "quantity": 9,
                "count_rate": 0,
                "deleted_at": null,
                "created_at": "2018-05-24 07:00:16",
                "updated_at": "2018-05-24 07:00:16",
            }
        },
        {
            "id": 5,
            "user_id": 9,
            "book_id": 3,
            "post_type": 1,
            "body": "Voluptatem pariatur autem error et inventore omnis. Odio sit odit assumenda voluptas aspernatur. Ea qui dolore optio modi autem recusandae dicta.",
            "rate_point": 4,
            "status": 1,
            "deleted_at": null,
            "created_at": "2018-06-06 08:44:39",
            "updated_at": "2018-06-06 08:44:39",
            "book": {
                "id": 3,
                "category_id": 10,
                "title": "Mr. Conor Bechtelar DVM",
                "description": "Accusantium tenetur libero delectus. Assumenda veniam omnis ex quis quaerat. At voluptate quaerat cumque consequuntur. Quia voluptas deleniti voluptatem. Illo et quos eius laudantium aspernatur.",
                "number_of_page": 1107013744,
                "author": "Delores Weimann",
                "publishing_year": "1999-11-02",
                "language": "VietNamese",
                "quantity": 10,
                "count_rate": 0,
                "deleted_at": null,
                "created_at": "2018-05-24 07:00:16",
                "updated_at": "2018-05-24 07:00:16",
            }
        },
        {
            "id": 14,
            "user_id": 9,
            "book_id": 6,
            "post_type": 1,
            "body": "Et veniam in nemo commodi molestiae. Voluptas quibusdam perferendis beatae molestias. Qui deserunt cumque veniam commodi et debitis recusandae.",
            "rate_point": 3.1,
            "status": 0,
            "deleted_at": null,
            "created_at": "2018-06-06 08:45:01",
            "updated_at": "2018-06-06 08:45:01",
            "book": {
                "id": 6,
                "category_id": 10,
                "title": "Cyrus Bogan",
                "description": "In expedita voluptatem molestias ullam amet magnam. Odit et id quae reprehenderit eum culpa sunt. Laudantium explicabo tenetur est cupiditate magnam vel.",
                "number_of_page": 2127046338,
                "author": "Mr. Elmore Franecki IV",
                "publishing_year": "2017-05-15",
                "language": "English",
                "quantity": 5,
                "count_rate": 0,
                "deleted_at": null,
                "created_at": "2018-05-24 07:00:16",
                "updated_at": "2018-05-24 07:00:16",
            }
        }
    ],
    "first_page_url": "http://192.168.33.10/api/users/posts?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://192.168.33.10/api/users/posts?page=1",
    "next_page_url": null,
    "path": "http://192.168.33.10/api/users/posts",
    "per_page": 20,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
```

### `PUT` Update post
```
/api/posts/{id}
```
Update post

#### Request headers
| Key | Value |
|---|---|
|Accept|application\json
|Authorization|{token_type} {access_token}|

#### Request body
| Key | Type | Description |
|---|---|---|
| body | Text | Content of post |

#### Response
```json
{
     "data": {
        "id": 14,
        "user_id": 9,
        "book_id": 9,
        "post_type": 1,
        "body": "new content",
        "rate_point": 3.1,
        "status": 0,
        "deleted_at": null,
        "created_at": "2018-06-06 08:45:01",
        "updated_at": "2018-06-06 08:45:01"
    }
}
```