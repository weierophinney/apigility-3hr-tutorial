# Exercise 3: Validation & filtering

Starting with the code in /exercise3, add username, password and name to the Users
service and title & created to the Lists service.

Bonus points for documenting your services!


## Things to note:

* All fields are required.
* User fields:
    * Username is an email address with a maximum of 255 characters
    * Password is a minimum of 8 characters
    * Name has a maximum of 255 characters
* List fields:
    * Title has a maximum of 255 characters and may not contain HTML
    * created is a Unix timestamp
