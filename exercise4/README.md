# Exercise 4: Authentication

Starting with the code in /exercise4, add OAuth2 to Users and allow logging in.
Do not allow access to /books without a valid token

For bonus points, add a new endpoint /books/borrowed, that lists just that
user's borrowed books.

## Things to note:

* The database is in /data/bookshelf.db. The PDO DSN is sqlite:full/path/to/filename
* You'll need to inform zf-oauth2 to use our users table. After creating the OAuth2 adapter, edit the `config/autoload/global.php` file and:
  - Add a "zf-oauth2" top-level key
  - Under it, add a "storage_settings" key
  - with a "user_table" subkey, pointing at "user".
* [Relevant docs](https://apigility.org/documentation/auth/authentication-oauth2#username-and-password-access)
  (we are a Confidential client).
* A successful log in gives back a token.
    * The grant_type is "password"
    * The client_id is "bookshelfapp"
    * The client_secret is blank as we are using password grant type.
* The resource has a `getIdentity()` method - you can check its type to see
  if the user is logged in.
* Controllers can fetch the identity using `$this->getEvent()->getParam('ZF\MvcAuth\Identity')`
* `Bibliotheque\Book\BookMapper` has a `fetchBorrowed($userId)` method.
