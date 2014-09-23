# Exercise 4: Authentication

Starting with the code in /exercise4, add OAuth2 to Users and allow logging in.
Do not allow access to /books without a valid token

For bonus points, add a new endpoint /books/borrowed, that lists just that
user's borrowed books.

## Things to note:

* The database already has the relevant tables to support OAuth2 and the
  required adapter is setup for you.
* [Relevant docs](https://apigility.org/documentation/auth/authentication-oauth2#username-and-password-access)
  (we are a Confidential client).
* A successful log in gives back a token.
    * The grant_type is "password"
    * The client_id is "bookshelfapp"
    * The client_secret is blank as we are using password grant type.
* The resource has a `getIdentity()` method - you can check its type to see
  if the user is logged in.
* `Bibliotheque\BookMapper` has a `fetchBorrowed($userId)` method.
