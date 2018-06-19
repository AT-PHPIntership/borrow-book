### `POST` Register

```
/api/register
```
Post a register

#### Response - Success
| Field | Type | Description |
|-------|------|-------------|
| user | Object | Object user |
| id | Integer | Id of user |
| email | String | Email of user |
| password | Integer | Password of user  |
| identity_number | Integer | Identity number of user |
| avatar | string | Avatar of user |
| dob | date | Birthday of user |
| address | String | Address of user |
| role | Integer | Role of user |
| token | String | Token |

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImIxNDQ0ODI5MDdlYTM0YmViNTIzNmE3M2IzZTJkZDQ0NmQzNWFlM2NjZjhmMzc2YjU5MDdiNjA4MmY3MmE1NTk0OTY2NzYxNGQ0YTA4OTVhIn0.eyJhdWQiOiIxIiwianRpIjoiYjE0NDQ4MjkwN2VhMzRiZWI1MjM2YTczYjNlMmRkNDQ2ZDM1YWUzY2NmOGYzNzZiNTkwN2I2MDgyZj",
    "user": {
        "id": 15,
        "email": "jhayes@example.com",
        "name": "Mr. Fabian Rippin PhD",
        "identity_number": "375699562",
        "avatar": "default-user.png",
        "dob": "1983-07-27",
        "address": "42587 Patsy Tunnel Suite 472\nD'Amoreport, AL 37783",
        "role": null,
    }
}
```
