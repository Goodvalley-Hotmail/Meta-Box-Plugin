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
    
    * Added `ddd( $_POST );` just to check, as explained below.

- If we inspect the Edit Post Page in WordPress, we will see it's just a big Form:
 `<form name="post" action="post.php" method="post" id="post"...>....</form>`
 So we have a "post.php" action where it will be processed at, and a "post" method so that
 all those Form Fields (`<input>....`) will be posted back. WordPress handles that action and
 fires the `add_action( 'save_post'.... );` event, which calls our `save_meta_box()` function.
 
 Now with `ddd( $_POST );` we can take a look of what's been posted back because PHP
 stores it all in the $_POST super-global variable.

## 0.0.7

- /src/meta-box.php
    * Moved the `if( ! array_key_exists().... )` check above the nonce, a more logical place.

When we render out the HTML for our MetaBox, the very first line is to create a nonce field.
Then WordPress gives us two `<input>` fields that appear before our `<p>` HTML element.

The `<input name="">` of the first field is, in this case, 'mbbasics_nonce'.

The other `<input name="">` if for who is doing the referral, in case we want to use that.

In the process of saving or updating, `name="mbbasics_nonce"` in the hidden `<input>` is the
Key that will be stored in the `$_POST` super-global variable. So `$_POST['mbbasics_nonce']` is
the Key that references the `value="yadayadayada"` value.

So, when 'save' or 'update' is pressed, the information goes through the Internet to the Server,
then PHP stores it in the `$_POST` super-global variable. The name is the Key for that nonce
which is the Value.

So the 'mbbasics_nonce' Key is used by `wp_nonce_field()` and `wp_verify_nonce()` to grab the Content
and pass it to WordPress, so it can verify that nonce.

More information in the Comments of the `render_meta_box()` and `save_meta_box()` functions.

