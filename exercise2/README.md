# Exercise 2: Books service

Starting with the code in /exercise2, add an API called Bookshelf containing a REST
service on the endpoint /books that can list all books & a single book.

Bonus points for creating, updating & deleting a book.

## Things to note:

* The Entity Identifier Name for is user_id.
* The Entity is `Bibliotheque\Book\BookEntity`
* The Collection is `Bibliotheque\Book\BookCollection`.
* Inject `Bibliotheque\Book\BookMapper` into the `BooksResource` class (via the `BookResourceFactory`).
* The `Bibliotheque\Book\BookMapperInterface` shows you what you can do with the mapper.
