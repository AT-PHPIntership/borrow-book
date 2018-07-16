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
|Authorization|{token_type} {access_token}|

#### Response - Success
| Field | Type | Description |
|-------|------|-------------|
| id | Integer | Id of borrow |
| user_id | Integer | Id of user |
| status | Integer | Status of borrow |
| number_book | Integer | Number of book |
| from_date | date | Day borrowes book |
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
    "from_date": "2018-06-19",
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
### `GET` List borrow following user
```
/api/users/borrow
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
| page | number | Paninate Borrow Book Of User|
| sort | string | Sort Borrow Book Of User |
| limit | number | Limit Borrow Book Of User |

```json
{
    "data": [
        {
            "id": 5,
            "user_id": 9,
            "status": 1,
            "number_book": 2,
            "to_date": "2018-05-14",
            "from_date": "2018-06-20",
            "created_at": "2018-05-24 07:00:16",
            "updated_at": "2018-05-24 07:00:16",
            "borrow_details": {
                "id": 3,
                "book_id": 2,
                "borrow_id": 5,
                "created_at": "2018-05-24 07:00:16",
                "updated_at": "2018-05-24 07:00:16"
            },
            "books": {
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
            "id": 9,
            "user_id": 9,
            "status": 0,
            "number_book": 3,
            "to_date": "2018-03-14",
            "from_date": "2018-02-20",
            "created_at": "2018-05-24 07:00:16",
            "updated_at": "2018-05-24 07:00:16",
            "borrow_details": {
                "id": 5,
                "book_id": 3,
                "borrow_id": 9,
                "created_at": "2018-05-24 07:00:16",
                "updated_at": "2018-05-24 07:00:16"
            },
            "books": {
                "id": 3,
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
        }
    ],
    "first_page_url": "http://192.168.33.10/api/users/borrow?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://192.168.33.10/api/users/borrow?page=1",
    "next_page_url": null,
    "path": "http://192.168.33.10/api/users/borrow",
    "per_page": 20,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
```
### `UPDATE` Borrow

```
/api/borrow/{borrow}
```
Cancel borrow

#### Request header
| Key | Value |
|---|---|
|Accept|application\json|
|Authorization|{token_type} {access_token}|

#### Parameters
| Key | Value | Required | Description |
|---|---|---|---|
| content | String | required | reason of cancel borrow |

```json
{
    "id": 15,
    "user_id": 2,
    "status": 3,
    "number_book": 1,
    "from_date": "2018-06-19",
    "to_date": "1983-06-26",
    "created_at": "2018-06-06 08:45:01",
    "updated_at": "2018-06-06 08:45:01",
    "borrow_detail":[ 
        {
            "id": 16,
            "book_id": 1,
            "borrow_id": 15,
            "quantity": 1,
            "created_at": "2018-06-06 08:45:01",
            "updated_at": "2018-06-06 08:45:01",
        }
    ],
    "note":[
        {
            "id": 1,
            "borrow_id": 15,
            "user_id": 1,
            "content": "Eos facilis doloribus consequatur minus velit dolor.",
            "created_at": "2018-06-06 08:45:01",
            "updated_at": "2018-06-06 08:45:01",
        }
    ],
}
```
