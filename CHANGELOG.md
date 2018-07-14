## 1.0.0 (21.Sept.2017)

Initial release.

## 0.0.0

Original as cloned from KnowtheCode Repo.

## 0.0.2

* /src/meta-box.php
    * Added comments for clarification.

## 0.0.3

Fixed typos.

## 0.0.4

- /src/view.php
    * Added input and label to start building the MetaBox HTML.

## 0.0.5

- /src/view.php
    * Allow for internationalization.
    * Make the value dynamic by assigning a $subtitle variable.
    * Sanitize the Content that we are sending to the Browser by escaping it.

- /src/meta-box.php
    * Define our $subtitle variable as the Post Meta that we pull from the DataBase.

## 0.0.6

- /src/meta-box.php
    * Changed the Key value and replaced `isset()` by `array_key_exists()`.
    All is explained in the Comments and below.

- If we inspect the Edit Post Page in WordPress, we will see it's just a big Form:
 `<form name="post" action="post.php" method="post" id="post"...>....</form>`
 So we have a "post.php" action where it will be processed at, and a "post" method so that
 all those Form Fields (`<input>....`) will be posted back. WordPress handles that action and
 fires the `add_action( 'save_post'.... );` event, which calls our `save_meta_box()` function.
 
 Now with `ddd( $_POST );` we can take a look of what's been posted back because PHP
 stores it all in the $_POST super-global variable.

