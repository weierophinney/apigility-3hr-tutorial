# Exercise 2: Books service

Starting with the code in /exercise2, REST service in the Bookshelf API on the
endpoint /books that can list all books, list a single book and create a new book.

Bonus points for updating and deleting a book.

## Things to note:

* Your Entity is `Bibliotheque\Book\BookEntity` & Collection is `Bibliotheque\Book\BookCollection`
* Inject `Bibliotheque\Book\BookMapper` into the `BooksResource` class (via the `UserResourceFactory`)
