<?php
return array(
    'Todo\\V1\\Rest\\Users\\Controller' => array(
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
            'description' => 'Get information on individual users.',
        ),
        'description' => 'Create and retrieve user information.',
    ),
);
