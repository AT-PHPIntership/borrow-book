## Flappy Api - Just sample API

### `GET` List Books
```
/api/birds
```
Get list books with paginate


#### Response - Success
| Field | Type | Description |
|-------|------|-------------|
| status | String | Status result |
| code | Number | HTTP status codes |
| data | Object | Object book |
| id | Number | Id of book |
| title | String | Title of book |
| picture | String | Url for image of the book |
| quantity | Number | Number of book |
| rating | Number | The number of reviews of a book |

```json
"status": 200,
"data": [
        {
            "id": 3,
            "title": "Herman Sanford DDS",
            "picture": "http://192.168.33.10/storage/images/639802f65e69608edf2700e979022e1d.png",
            "quantity": 8,
            "rating": 4.5
        },
        {
            "id": 5,
            "title": "Mr. Conrad Ryan",
            "picture": "http://192.168.33.10/storage/images/639802f65e69608edf2700e979022e1d.png",
            "quantity": 7,
            "rating": 3.5
        },
        ],
"pagination": {
                "total": 20,
                "per_page": 8,
                "count": 8,
                "current_page": 1,
                "total_pages": 3,
                "links": {
                    "prev": null,
                    "next": "http://192.168.33.10/api/books?page=2"
              }
}