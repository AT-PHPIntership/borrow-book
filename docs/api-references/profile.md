## Profile User Api

### `GET` Profile User
```
/api/users/profile
```
Get profile user
#### Request Headers
| Key | Value |
|---|---|
|Accept|application\json
|Authorization|{token_type} {access_token}|

##### Example
| URL | Description |
|---|---|
| /api/users/profile | Get profile of user |

```json
{
    "data": {
        "id": 1,
        "email": "jhayes@example.com",
        "name": "Mr. Fabian Rippin PhD",
        "identity_number": "375699562",
        "avatar": "http://192.168.10.10/storage/images/default-user.png",
        "dob": "1983-07-27",
        "address": "42587 Patsy Tunnel Suite 472\nD'Amoreport, AL 37783",
        "role": 0,
        "deleted_at": null,
        "created_at": "2018-05-24 07:00:16",
        "updated_at": "2018-05-24 07:00:16"
    }
}
```