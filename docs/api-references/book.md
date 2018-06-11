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
| page | string | Paninate Books |

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
"pagination": {
                "total": 30,
                "per_page": 20,
                "count": 20,
                "current_page": 1,
                "total_pages": 2,
                "links": {
                    "prev": null,
                    "next": "http://192.168.33.10/api/books?page=2"
              }
```
### `GET` Book

```
/api/books/{id}
```
Get a detail book
#### Parameter
| Field | Type | Description |
|-------|------|-------------|
| id | Integer | Id of book |


#### Response - Success
| Field | Type | Description |
|-------|------|-------------|
| data | Object | Object book |
| id | Integer | Id of book |
| title | String | Title of book |
| category_id | Integer | Book's category id |
| description | String | Description of book |
| language | String | Language of book |
| number_of_page | Integer | Number page of book |
| quantity | Integer | Number quantity of book |
| publishing_year | Date | Publishing year of book |
| count_rate | Integer | Count total rate of book |
| category | string | Get book By Category |
| image_books | string | Get Image of Book |

```json
{
   "data":{
      "id":1,
      "title":"Herman Sanford DDS",
      "category_id":1,
      "description":"LLLLLLLLLL",
      "language":"VietNamese",
      "number_of_page":20,
      "quantity":8,
      "publishing_year":"2018-05-24 07:00:16",
      "count_rate":12,
      "category":{
         "id":1,
         "name":"food"
      },
      "image_books":[
         {
            "id":14,
            "image":"08e4923ca7b229dae7efed65674b8116.jpg"
         }
      ]
   }
}
```