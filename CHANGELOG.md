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

## 0.0.8

- /src/meta-box.php

    * Added basic `update_post_meta()` function.

## 0.0.9

- /src/meta-box.php

    * Modified the `update_post_meta()` function so it can store 0 as the field Content.
      
    * Also, modified some of the comments on that section.

## 0.0.10

- /src/meta-box.php

    * Modified the `update_post_meta()` function again to be more clear.

## 0.0.11

- /src/meta-box.php
    
    * Sanitize the `update_post_meta()` function properly.

Sending it out to the Browser, we escape.
Putting it back to the DataBase, we sanitize.

## 0.1.0

- /src/meta-box.php

    * Removed comments from the last Stage, since we move on with other things.

- /src/view.php

    * Removed comments from the last Stage, since we move on with other things.

## 0.1.1

We started adding more custom fields by adding a check field.

## 0.1.2

- /src/meta-box.php

    * Modified the conditionals to update/delete the check custom field that we added.

## 0.1.3

- /src/view.php

    * Modified the names in all the `<input>` so they become Sub-Keys of the 'mbbasics' Key Array.

Since we will be probably using many custom fields for different purposes,
we may have to deal with a lot of redundancies in our code.

We could use a specific Key to be our MetaBox Key, so we can use it for example in our
`if( ! array_key_exists( 'subtitle', $_POST ) ) {....` code in the `save_meta_box()` function
to check for all our custom fields.
All would be then stored in that Key within the super-global $_POST variable.

We then choose 'mbbasics' as our Key.

If we look in /src/view.php, we'll see that the `names="this_is_a_key_name"` are the Keys that will be within $_POST.

So `name="subtitle"` will be `$_POST['subtitle']`, and `name="show_subtitle"` will be `$_POST['show_subtitle']`.

Since we will use one Key for all our custom fields, we need those names/keys to be sub-keys
of the 'mbbasics' Array, so it becomes an Array of Arrays.

It has several advantages:

1.- We are wrapping everything in what is essentially a namespace.

2.- We only have to deal with one Key in the super-global `$_POST` variable when we do our validation.

3.- We are grouping all custom fields of a MetaBox in one element within the `$_POST` Array.

4.- It is easier to merge defaults.

5.- We can loop through all that Meta Data and avoid redundancy.

## 0.1.4

- /src/meta-box.php

    * Since we have our new Key for all of our custom fields,
    we start avoiding redundancies.
    
    * The first step is looping through our custom fields.

## 0.1.5

In our new `foreach()`, how can we make sure that there's always a Key for each custom field
within our Array?

We can merge `$_POST['mbbasics']` with defaults by using PHP's `array_merge()` or
`wp_parse_args()` from WordPress' core. The difference is that with `wp_parse_args()`
we can pass in a string, not only an Array.

Once we've done the merging, our `foreach()` processes the data coming back from the new
`$metadata` variable.

If, for example, our checkbox `'show_subtitle'` custom field is unchecked
so it doesn't exist in the incoming data, then it pulls in the defaults,
and we get a new Array.

We can check this out with the `d()` and `ddd()` functions that are left in the code.

All of this gives us control about what we expect and what we get.

## 0.1.6

- /src/meta-box.php

    * Sanitized the custom fields' values that are returned to the Browser.
    
    * Modified the `foreach()` function.

## 0.1.7

- /src/meta-box.php

    * Modified the `foreach()` function to optimize it.

## 0.2.0

This is how the Meta-Box plugin is at the end of the "WordPress MetaBox Basics" Lab.

## 0.2.1

- Changed the name of the Plugin to "Reusable MetaBox". Then changed the namespace, etc.

- Add directories, meta-box and view files, move and remove some of the existing ones, etc.

- Add a 'portfolio' MetaBox.

- Replace the references to 'mbbasics' and 'subtitle' by the 'portfolio' ones.

## 0.2.2

- Lay out the Arquitecture for our Reusable MetaBox Plugin.

- /reusable-meta-box/src/metadata/defaults/meta-box-config.php

    * It is a good idea to provide a default configuration file.
    This file is going to be used and merged together with each of the `/config/*.php` files.
    It has all the default state, it has the mapping for the keys that it expects.
    We can also copy it for a new `/config/*.php` file and then change what you need.
    It gives us a starting point, like a boilerplate.
    
    * What it is going to return is an array. Not many people know that we can include or
    require a .php file, and if we return an array, it can be assigned to a variable.
    Using this tecnique, we're able to load this file, grap the contents because we are
    going to store it into a configuration variable in the `config-store.php` file.
    
    * We know that, for both our `*-meta-box.php` files, we have an add_metabox,
    a render_metabox with different Post Meta and we have a save_metabox.
    What is unique is the Metabox key ('mbbasics', 'portfolio'), that we use to know
    if this is the right Metabox, and we also use it in our `/views/*.php` files.
    So we will use that Key in our `meta-box-config.php` file, as the `'unique-meta-box-id'` value.
    
## 0.2.3

- /reusable-meta-box/src/metadata/defaults/meta-box-config.php and
  /reusable-meta-box/src/metadata/meta-box.php
  
  Let's imagine we somehow get a unique meta_box_key, `$meta_box_key`.
  Then, we also have a configuration, and what we want from this configuration is
  `'add_meta_box'`, and we get it with `getConfig( $meta_box_key, 'add_meta_box' );`.
  
  So, we somehow find out what is the `'unique-meta-box-id'` Key from `meta-box-config.php`.
  Then, when we go to the `config-store.php`, we pass it this Key which, in the `config-store.php`,
  means that it's going to point to the configuration array. What we want to plug out from there
  and return to us is the `'add_meta_box'` array bit.
  
## 0.2.4

- /reusable-meta-box/src/metadata/defaults/meta-box-config.php and
  /reusable-meta-box/src/metadata/meta-box.php
  
  * To know what goes in the `'add_meta_box'` array, we have to look at that WordPress function
  in `/wp-admin/includes/template.php`, around line 917.
  
    * $id               -> That's our unique $meta_box_key.
    * $title            -> You need to tell me which is the Title, that's a specific implementation.
    * $callback         -> We can use our functions: `render_meta_box()`, `register_meta_boxes()`.
    * $screen           -> We put the default, which is null.
    * $context          -> We put the default, which is 'advanced'.
    * $priority         -> We put the default, which is 'default'.
    * $callback_args    -> We put the default, which is null.
    
  We've now set it up the way that WordPress expects,
  and each implementation fills up what is different.
  If not, we have our defaults in place.

- /reusable-meta-box/src/metadata/meta-box.php

    * Now, if we change our `add_meta_box()` function to what we've set up,
    we turned it into being generic.
    
    * It takes a `$configuration` and we map out the structure of what we expect
    that configuration to be (the defaults), and then we go and map in our `add_meta_box()`.
    
    * For now, we don't have to worry about the `getConfig()` function itself.
    
