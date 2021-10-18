# simple user model

This is a simple model supporting the most basic authorization with email & password. It's desigend to hit the ground running when developing applications. 

## Installation

Within a neoan3 directory (min version 3.0.1), run the cli-command `neoan3 add model user https://neoan3/email-password-auth.git` 

Afer installation, make sure the files are in the folder "model/User", then run `neoan3 migrate models up`

## Prerequisites

I know it seems obvious, but just to be clear:

- you need to have a working database & db-provider setup
- instead of the cli you can also run neoan3's migrate-tool within safe-space mode
- you should not overwrite an existing model (if you started a user model, delete it first)

## Usage within a controller

```php

// create/register

$inputExample = [
  'email'=>'some@mail.com',
  'password' => '123123123'
]

$user = UserModel::create($inputExample);

// login

$authenticatedUser = UserModel::login($inputExample);


```

Full example at https://gist.github.com/sroehrl/0bc1858d33141531fcf0d5741b53fd2d
