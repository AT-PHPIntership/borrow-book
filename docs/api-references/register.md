### `POST` Register

```
/api/register
```
Post a register

#### Response - Success
| Field | Type | Description |
|-------|------|-------------|
| data | Object | Object user |
| id | Integer | Id of user |
| email | String | Email of user |
| password | Integer | Password of user  |
| identity_number | Integer | Identity number of user |
| language | String | Language of user |
| avatar | string | Avatar of user |
| dob | date | Birthday of user |
| address | String | Address of user |
| role | Integer | Role of user |
| created_at | datetime | Time create user |
| updated_at | datetime | Time update of user |

```json
{
    "status": 200,
    "data": {
        "id": 15,
        "email": "jhayes@example.com",
        "name": "Mr. Fabian Rippin PhD",
        "identity_number": "375699562",
        "avatar": "default-user.png",
        "dob": "1983-07-27",
        "address": "42587 Patsy Tunnel Suite 472\nD'Amoreport, AL 37783",
        "role": 0,
        "deleted_at": null,
        "created_at": "2018-06-19 07:00:16",
        "updated_at": "2018-06-19 07:00:16"
    }
}
```
