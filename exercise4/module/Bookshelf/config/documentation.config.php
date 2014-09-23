<?php
return array(
    'Bookshelf\\V1\\Rest\\Users\\Controller' => array(
        'description' => 'Create and retrieve user information.',
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieve paginated lists of users.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/users"
       },
       "first": {
           "href": "/users?page={page}"
       },
       "prev": {
           "href": "/users?page={page}"
       },
       "next": {
           "href": "/users?page={page}"
       },
       "last": {
           "href": "/users?page={page}"
       }
   }
   "_embedded": {
       "users": [
           {
               "_links": {
                   "self": {
                       "href": "/users[/:users_id]"
                   }
               }
              "username": "Username (their email address)",
              "password": "Password to use for this user.",
              "name": "The user\'s full name."
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Create a new user.',
                'request' => '{
   "username": "Username (their email address)",
   "password": "Password to use for this user.",
   "name": "The user\'s full name."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/users[/:users_id]"
       }
   }
   "username": "Username (their email address)",
   "password": "Password to use for this user.",
   "name": "The user\'s full name."
}',
            ),
            'description' => 'Manipulate users.',
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieve a single user.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/users[/:users_id]"
       }
   }
   "username": "Username (their email address)",
   "password": "Password to use for this user.",
   "name": "The user\'s full name."
}',
            ),
            'PATCH' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'description' => 'Get information on individual users.',
        ),
    ),
    'Bookshelf\\V1\\Rest\\Books\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieve paginated lists of books.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/books"
       },
       "first": {
           "href": "/books?page={page}"
       },
       "prev": {
           "href": "/books?page={page}"
       },
       "next": {
           "href": "/books?page={page}"
       },
       "last": {
           "href": "/books?page={page}"
       }
   }
   "_embedded": {
       "books": [
           {
               "_links": {
                   "self": {
                       "href": "/books[/:books_id]"
                   }
               }
              "title": "The title of the book.",
              "author": "The book\'s author",
              "isbn": "The book\'s ISBN number."
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Create a new book.',
                'request' => '{
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/books[/:books_id]"
       }
   }
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
            ),
            'description' => 'Manipulate books.',
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieve a single book.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/books[/:books_id]"
       }
   }
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
            ),
            'PATCH' => array(
                'description' => 'Update a book.',
                'request' => '{
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/books[/:books_id]"
       }
   }
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
            ),
            'PUT' => array(
                'description' => 'Replace a book.',
                'request' => '{
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/books[/:books_id]"
       }
   }
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
            ),
            'DELETE' => array(
                'description' => 'Delete a book.',
                'request' => '{
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/books[/:books_id]"
       }
   }
   "title": "The title of the book.",
   "author": "The book\'s author",
   "isbn": "The book\'s ISBN number."
}',
            ),
            'description' => 'Get information on individual books',
        ),
        'description' => 'Create and retrieve books.',
    ),
);
