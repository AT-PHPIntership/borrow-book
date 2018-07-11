## Send Mail Resetpassword Api

### `POST` Send Mail Resetpassword
```
/api/password/reset
```
Post email
#### Request Headers
| Key | Value | 
|---|---|
| Accept | application/json

#### Request Body
| Key | Value | Description |
|---|---|---|
| email | string | email registered in database |

#### Response

* _Success_
``` json
{
    "message": "We have e-mailed your password reset link!"
}
```

* _Error_
``` json
{
   "error": {
        "message": "We can't find a user with that e-mail address.",
        "request": {
            "email": "abc@gmail.com"
        }
    },
    "code": 404
}
```

* _Error Validation_
``` json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email must be a valid email address."
        ]
    }
}
```

### `PUT` Resetpassword
```
/api/password/reset
```
Put password new
#### Request Headers
| Key | Value | 
|---|---|
| Accept | application/json

#### Request Body
| Key | Value | Description |
|---|---|---|
|token | string | confirm token |
|email | string | confirm email |
|password | string | password new |
|password_confirmation| string | confirm password new |

#### Response

* _Success_
``` json
{
        "message": "Your password has been reset!"
}
```

* _Error_
``` json
{
    "error": {
        "message": "We can't find a user with that e-mail address.",
        "request": {
            "email": "abc@gmail.com",
            "token": "$2y$10$XiUV45Zvwl6ftyDStNz9vexS2FTsg7u4TfjFq9ebfYtTikWchcwoa",
            "password": "abcabc",
            "password_confirmation": "abcabc"
        }
    },
    "code": 404
}
```

* _Error Validation_
``` json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email must be a valid email address."
        ]
    }
}
```