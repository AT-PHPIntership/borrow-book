### `POST` Favorite

```
/api/favorites
```
Post new favorite

#### Request header
| Key | Value |
| --- | --- |
| Accept | application\json |
| Authorization | {token_type} {access_token} |

#### Parameters
| Param | Type | Description |
| --- | --- | ---|
| book_id | Number | Id of book favorite|

```json
{
    "id": 15,
    "user_id": 2,
    "book_id": 3,
    "created_at": "2018-06-06 08:44:39",
    "updated_at": "2018-06-06 08:44:39",
    "status": 0
}
```
### `GET` List favorite following user
```
/api/users/favorites
```
Get list favorites following user

#### Request header
| Key | Value |
| --- | --- | 
| Accept | application\json |
| Authorization | {token_type} {access_token} |

#### Query Param
| Param | Type | Description | 
|---|---|---|
| page | number | Paninate Favorites 
| limit | number | Limit Favorites |

```json
{
    "data": [
        {
            "id": 1,
            "user_id": 2,
            "book_id": 2,
            "created_at": "2018-06-06 08:44:39",
            "updated_at": "2018-06-06 08:44:39",
            "status": 0,
            "book" : {
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
                "updated_at": "2018-05-24 07:00:16"
            }
        },
        {
            "id": 2,
            "user_id": 2,
            "book_id": 3,
            "created_at": "2018-06-06 08:44:39",
            "updated_at": "2018-06-06 08:44:39",
            "status": 0,
            "book" : {
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
                "updated_at": "2018-05-24 07:00:16"
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
    "to": 2,
    "total": 2
}
```

### `PUT` Update status of favorites
```
/api/favorites/{id}
```
Update status of favorites

#### Request headers
| Key | Value |
| --- | --- |
| Accept | application\json |
| Authorization | {token_type} {access_token} |

#### Request body
| Key | Type | Description |
| --- | --- | --- |
| status | Number | Status of favorite (0: unread, 1: read) |

#### Response
```json
{
     "data": {
        "id": 2,
        "user_id": 2,
        "book_id": 3,
        "created_at": "2018-06-06 08:44:39",
        "updated_at": "2018-06-06 08:44:39",
        "status": 1
    }
}
```
