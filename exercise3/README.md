# Exercise 3: Validation

Starting with the code in /exercise3, add fields to the Users and Books
REST services.

Bonus points for documenting them too!


## Things to note

* Note that the $data passed into a method in the resource is unfiltered.
  Therefore, once validation & filtering is in place, you can access the
  filtered data in your resource using:

        $inputFilter = $this->getInputFilter();
        $data        = $this->getValues();


## Validation rules

* All fields are required.
* User fields:
    * Username is an email address with a maximum of 255 characters
    * Password is a minimum of 8 characters
    * Name has a maximum of 255 characters
* Book fields:
    * Title has a maximum of 255 characters
    * Author has a maximum of 255 characters and may not contain HTML
    * isbn is a 13 character ISBN
