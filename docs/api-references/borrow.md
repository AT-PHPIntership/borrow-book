## Borrow

### `POST` Borrow

```
/api/borrow
```
Post new borrow

#### Request header
| Key | Value |
|---|---|
|Accept|application\json|
|Authorization|{token_type} {access_token}

#### Response - Success
| Field | Type | Description |
|-------|------|-------------|
| id | Integer | Id of borrow |
| user_id | Integer | Id of user |
| status | Integer | Status of borrow |
| number_book | Integer | Number of book |
| form_date | date | Day borrowes book |
| to_date | date | Day returns book |
| borrow_detail | Object | Object borrow detail |
| id | Integer | Id of borrow detail |
| book_id | Integer | Id of book |
| borrow_id | Integer | Id of borrow |
| user | Object | Object user |
| id | Integer | Id of user |
| name | String | Name of user |
| email | String | Email of user |
| identity_number | Integer | Name of user |
| avatar | Integer | Name of user |
| dob | Date | Birthday of user |
| address | String | Address of user |
| role | Integer | Role of user |

```json
{
    "id": 15,
    "user_id": 2,
    "status": null,
    "number_book": 1,
    "form_date": "2018-06-19",
    "to_date": "1983-06-26",
    "borrow_detail":[ 
        {
            "id": 16,
            "book_id": 1,
            "borrow_id": 15,
        }
    ],
    "user": {
        "id": 2,
        "name": "Prof. Fern Ryan",
        "email": "skertzmann@example.com",
        "identity_number": "378468817",
        "avatar": "http://192.168.33.10/storage/images/default-user.png",
        "dob": "2000-12-10",
        "address": "460 Heidi Mount Apt. 732\nWest Zack, RI 05510-4851",
        "role": 0
    }
}
```
### `GET` List Borrows
```
/api/borrows
```
Get list borrow

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