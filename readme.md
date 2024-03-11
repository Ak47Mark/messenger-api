
# Messenger API
## Indítás

    cd app
    composer update
    cd ..
    docker-compose up

## API Végpontok

### Users
#### Bejelentkezés
**POST** `/api/login`

Email cím és jelszó párossal bejelentkezteti a felhasználót majd visszaadja a tokenét.

|  |  |
|----|----|
| email | Email cím |
| password | Jelszo |
 ```json
{	
	"access_token":  "eyJ0eXAiOiJKV1...",
	"token_type":  "bearer",
	"expires_in":  3600
}
```
---
#### Regisztrálás
**POST** `/api/user`

Felhasználó regisztrálása.

|  |  | |
|----|----|----|
| username| Felhasználónév | Egyedi, min:3
| email| Email cím | Egyedi, min: 3, email formátum
| password | Jelszó | min: 3
 ```json
{
	"username":"test",
	"email":"test@mail.hu",
	"status":"active",
	"updated_at":"2024-03-10T11:27:16.000000Z",
	"created_at":"2024-03-10T11:27:16.000000Z",
	"id":5
}
```
---
### Messages
#### Üzenet küldés
**POST** `/api/message`
**Authentikálás szükséges.**

Üzenet és címzett küldése. A feladó megálapítása a tokenből történik.

|  |  | |
|----|----|----|
| message| Üzenet tartalma |
| receiver_id| Fogadó fél id-ja|
 ```json
{
  "message": "szia",
  "sender_id": 1,
  "receiver_id": 5,
  "updated_at": "2024-03-11T10:43:46.000000Z",
  "created_at": "2024-03-11T10:43:46.000000Z",
  "id": 4
}
```
---
#### Összes üzenet
**GET** `/api/message`

Összes üzenet megtekintése. Nincs szükség authentikálásra.


 ```json
[
	{
		"id":  1,
		"sender_id":  1,
		"receiver_id":  4,
		"message":  "szia",
		"created_at":  "2024-03-10T22:08:33.000000Z",
		"updated_at":  "2024-03-10T22:08:33.000000Z",
		"sender":  {
			"id":  1,
			"username":  "admin",
			"email":  "admin@mail.hu",
			"status":  "active",
			"created_at":  "2024-03-10T22:02:19.000000Z",
			"updated_at":  "2024-03-10T22:02:19.000000Z"
		}
	},
	...
]
```
---
#### Felhasználónkénti üzenet
**GET** `/api/message/{id}`

A megadott és a belépett felhasználó közötti üzeneteket adja vissza.

 ```json
[
	{
		"id":  1,
		"sender_id":  1,
		"receiver_id":  4,
		"message":  "szia",
		"created_at":  "2024-03-10T22:08:33.000000Z",
		"updated_at":  "2024-03-10T22:08:33.000000Z",
		"sender":  {
			"id":  1,
			"username":  "admin",
			"email":  "admin@mail.hu",
			"status":  "active",
			"created_at":  "2024-03-10T22:02:19.000000Z",
			"updated_at":  "2024-03-10T22:02:19.000000Z"
		}
	},
	...
]
```
### Hibakezelés

Hibás kérés esetés a kérés **400**-as státuszkóddal tér vissza és a hibaüzenet tartalmával.

 ```json
{
  "receiver_id": [
    "The selected receiver id is invalid."
  ]
  ...
}
```
