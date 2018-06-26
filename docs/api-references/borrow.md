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
| status | Integer | Status of borrow  |
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
