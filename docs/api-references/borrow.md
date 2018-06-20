## Borrow

### `POST` Borrow

```
/api/borrow/user/{user}/book/{book}
```
Post a register

#### Response - Success
| Field | Type | Description |
|-------|------|-------------|
| id | Integer | Id of borrow |
| user_id | Integer | Id of user |
| status | Integer | Status of borrow  |
| number_book | Integer | Number of book |
| form_date | date | Day borrowes book |
| to_date | date | Day returns book |
| borrow_detail | Object | Object borrow detail |
| id | Integer | Id of borrow detail |
| book_id | Integer | Id of book |
| borrow_id | Integer | Id of borrow |

```json
{
    "data": {
        "id": 15,
        "user_id": 2,
        "status": null,
        "number_book": 1,
        "form_date": "2018-06-19",
        "to_date": "1983-06-26",
        "borrow_detail": {
            "id": 16,
            "book_id": 1,
            "borrow_id": 15;
        },
    }
}
```
