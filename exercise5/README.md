# Exercise 4: Authentication

Starting with the code in /exercise4, add OAuth2 to Users and allow logging in.
Do not allow access to /books without a valid token

For bonus points, add a new endpoint /books/borrowed, that lists just that
user's borrowed books.

## Things to note:

* The database already has the relevant tables to support OAuth2 and the
  required adapter is setup for you.
* A successful log in gives back a token.
* The resource has a `getIdentity()` method.
