### `GET` List Books
```
/api/books
```
Get list books

#### Query Param
| Param | Type | Description |
|---|---|---|
| sort | string | Sort Books |
| page | number | Paninate Books |
| search | string | Search Books |

```json
"data": [
        {
            "id": 1,
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
            "category": {
                "id": 7,
                "name": "Kobe Mitchell",
                "created_at": "2018-05-24 07:00:16",
                "updated_at": "2018-05-24 07:00:16",
                "deleted_at": null
            },
            "image_books": [
                {
                    "id": 1,
                    "book_id": 2,
                    "image": "27e3383467f7751e535cc257cf616cad.jpg",
                    "created_at": "2018-05-24 07:00:34",
                    "updated_at": "2018-05-24 07:00:34"
                },
                {
                    "id": 5,
                    "book_id": 2,
                    "image": "cdaa5b32ef5af5e7562b987100c098fd.jpg",
                    "created_at": "2018-05-24 07:00:34",
                    "updated_at": "2018-05-24 07:00:34"
                },
                {
                    "id": 9,
                    "book_id": 2,
                    "image": "6ea38209a11e436e7b0df801b8e5a551.jpg",
                    "created_at": "2018-05-24 07:00:34",
                    "updated_at": "2018-05-24 07:00:34"
                }
            ]
        },
        {
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
            "category": {
                "id": 7,
                "name": "Kobe Mitchell",
                "created_at": "2018-05-24 07:00:16",
                "updated_at": "2018-05-24 07:00:16",
                "deleted_at": null
            },
            "image_books": [
                {
                    "id": 1,
                    "book_id": 2,
                    "image": "27e3383467f7751e535cc257cf616cad.jpg",
                    "created_at": "2018-05-24 07:00:34",
                    "updated_at": "2018-05-24 07:00:34"
                },
                {
                    "id": 5,
                    "book_id": 2,
                    "image": "cdaa5b32ef5af5e7562b987100c098fd.jpg",
                    "created_at": "2018-05-24 07:00:34",
                    "updated_at": "2018-05-24 07:00:34"
                },
                {
                    "id": 9,
                    "book_id": 2,
                    "image": "6ea38209a11e436e7b0df801b8e5a551.jpg",
                    "created_at": "2018-05-24 07:00:34",
                    "updated_at": "2018-05-24 07:00:34"
                }
            ]
        },
        ]
"first_page_url": "http://192.168.10.10/api/books?page=1",
"from": 1,
"last_page": 2,
"last_page_url": "http://192.168.10.10/api/books?page=2",
"next_page_url": "http://192.168.10.10/api/books?page=2",
"path": "http://192.168.10.10/api/books",
"per_page": 15,
"prev_page_url": null,
"to": 15,
"total": 30
```
