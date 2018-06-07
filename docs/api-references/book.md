## Book Api - Just sample API

### `GET` List Books
```
/api/books
```
Get list books

#### Query Param
| Param | Type | Description |
|---|---|---|
| sort | string | Sort Books |
| new | string | New Books |
| rate | string | Rate Books |
| limit | string | Top Books |
| category | string | Get Product By Category |
| page | string | Panigate Books |

```json
"status": 200,
"data": [
        {
            "id": 1,
            "title": "Herman Sanford DDS",
            "picture": "http://192.168.33.10/storage/images/639802f65e69608edf2700e979022e1d.png",
            "quantity": 8,
            "rating": 4.5,
            "category": {
                "id": 1,
                "name": "food",
            }
        },
        {
            "id": 2,
            "title": "Mr. Conrad Ryan",
            "picture": "http://192.168.33.10/storage/images/639802f65e69608edf2700e979022e1d.png",
            "quantity": 7,
            "rating": 3.5,
            "category": {
                "id": 2,
                "name": "food"
            }
        },
        {
            "id": 3,
            "title": "Mr. Conrad Ryan",
            "picture": "http://192.168.33.10/storage/images/639802f65e69608edf2700e979022e1d.png",
            "quantity": 7,
            "rating": 3.5,
            "category": {
                "id": 3,
                "name": "food"
            }
        },
        {
            "id": 4,
            "title": "Mr. Conrad Ryan",
            "picture": "http://192.168.33.10/storage/images/639802f65e69608edf2700e979022e1d.png",
            "quantity": 7,
            "rating": 3.5,
            "category": {
                "id": 4,
                "name": "food"
            }
        },
        {
            "id": 5,
            "title": "Mr. Conrad Ryan",
            "picture": "http://192.168.33.10/storage/images/639802f65e69608edf2700e979022e1d.png",
            "quantity": 7,
            "rating": 3.5,
            "category": {
                "id": 2,
                "name": "food"
            }
        },
        ]
}
