### `POST` User Login
```
/api/login
```
Login api
#### Parameters
| Key | Type | Required | Description |
|---|---|---|---|
| email | String | required | Email to login |
| password | String | required | Password |

#### Response - Success
```json
{
    "status": 200,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImIxNDQ0ODI5MDdlYTM0YmViNTIzNmE3M2IzZTJkZDQ0NmQzNWFlM2NjZjhmMzc2YjU5MDdiNjA4MmY3MmE1NTk0OTY2NzYxNGQ0YTA4OTVhIn0.eyJhdWQiOiIxIiwianRpIjoiYjE0NDQ4MjkwN2VhMzRiZWI1MjM2YTczYjNlMmRkNDQ2ZDM1YWUzY2NmOGYzNzZiNTkwN2I2MDgyZjcyYTU1OTQ5NjY3NjE0ZDRhMDg5NWEiLCJpYXQiOjE1MjgyNzIzNDgsIm5iZiI6MTUyODI3MjM0OCwiZXhwIjoxNTU5ODA4MzQ4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.NCjLa5DH-p0CKmIUs-FxLXNYDS_Lc-5pieD9MXNidsBCUUsFGn83GudXrGhRVm6WGXQGuZgKn3FPkgd_p4s43SOwJDYCqWQqUNIgW10UoNaEJAOIDyPz9p_pw5UTtH9aCUGRDUYdKuJ1DlK69RdUJcco5kkV5F7lHdJuAYO4LXVezLP-jnAEEdTnU60Lr_IOo8RuzMDWakkVCmwU4x4qqqqyx3OI6yN5u0T8WLnrOBNqBpmQ4ovYcpoe7bFNtY74dTxBTTLnf9yhl2-6dEn3SdXjDRNNp9zG8YLbPVK01sMnrwXF1ybTZus7SVe2Cx6yMPxGkVzG1xzehBvAd-rgCRPKhH9AD2VlqJXIfnErScDak6DJpwn5BHyi0FJ8DxfT6x970m3vgf8xusM8PZc-MWK_tWp_OoyH0WVCisyDkNsnFT_6jWJhQEBM4edd6B8txvLmtkq8c7WOdMlGfgxPF_NsCYfkLnwmDNMTqdQtO0Qo3C4X_xKAADCXKxlXT28fXzMvxymCMdEbdM5i595t6XOwvrcyPxs8nCWPjs18Dy0_JY_ATR8_-bYaBSGAERBLMMpJ7UhRU0O1j3lEv-NB4ezlGFamgKO6mAiRVZw9mwzoRQLaW9RsNjeYcp_vHKq3N3b2sKKHlqSJpywXs62nhmzXWfqh3nJ5Zsm596h_fyY",
    "data": {
        "id": 1,
        "email": "jhayes@example.com",
        "name": "Mr. Fabian Rippin PhD",
        "identity_number": "375699562",
        "avatar": "default-user.png",
        "dob": "1983-07-27",
        "address": "42587 Patsy Tunnel Suite 472\nD'Amoreport, AL 37783",
        "role": 0,
        "deleted_at": null,
        "created_at": "2018-05-24 07:00:16",
        "updated_at": "2018-05-24 07:00:16"
    }
}
```

#### Response - Fail
```json
{
    "message": "Unauthenticated.",
    "status": 401
}
```