## Category Api

### `GET` List Categories
```
/api/categories
```
Get list categories

#### Query Param
| Param | Type | Description |
|---|---|---|
| page | Integer | Paninate Category |
| limit | Integer | Limit Category |

```json
"data": [
        {
            "id": 1,
            "name": "Herman Sanford DDS",
            "created_at": "2018-05-24 07:00:16",
            "updated_at": "2018-05-24 07:00:16",
            "delete_at": null
        },
        {
            "id": 2,
            "name": "Mr. Conrad Ryan",
            "created_at": "2018-05-24 07:00:16",
            "updated_at": "2018-05-24 07:00:16",
            "delete_at": null
        },
        {
            "id": 3,
            "name": "Mr. Conrad Ryan",
            "created_at": "2018-05-24 07:00:16",
            "updated_at": "2018-05-24 07:00:16",
            "delete_at": null
        },
        ]
"first_page_url": "http://192.168.10.10/api/categories?page=1",
"from": 1,
"last_page": 1,
"last_page_url": null,
"next_page_url": "null",
"path": "http://192.168.10.10/api/categories",
"per_page": 20,
"prev_page_url": null,
"to": 20,
"total": 20
```
