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

- `/reusable-meta-box/src/metadata/defaults/meta-box-config.php` and
  `/reusable-meta-box/src/metadata/meta-box.php`
  
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

- `/reusable-meta-box/src/metadata/meta-box.php`

    * Now, if we change our `add_meta_box()` function to what we've set up,
    we turned it into being generic.
    
    * It takes a `$configuration` and we map out the structure of what we expect
    that configuration to be (the defaults), and then we go and map in our `add_meta_box()`.
    
    * For now, we don't have to worry about the `getConfig()` function itself.
    
## 0.2.5

* This is just to test: edit the Post.

  When `$config` included `/meta-box-config.php`, it loaded the `'unique-meta-box-id'` array
  with all our defaults.
  
## 0.2.6

- `/reusable-meta-box/src/metadata/defaults/meta-box-config.php` and
  `/reusable-meta-box/src/metadata/meta-box.php`
  
  We are going to set up the Render Parameters (video #09)
  
  * In the $meta_box_args array, we have the Meta Box ID, which is the `'unique-meta-box-id'` value.
  
  * Then, we need the configuration, which we get with the `getConfig()` function.
  
  * As for the `wp_nonce_field()`, `'mbbasics_save'` is an action and `'mbbasics_nonce'` is the name.
  
  * Regarding Custom Fields, we have to add their information in the `'custom_fields'` defaults array:
  
    - 'meta_key' -> We also need to know more about the meta_key, so it's an array:
    
        * `'is_single'` -> true or false (true as default).
        * default value -> empty string as default.
        
  * We need to know what's our 'view' file.
    This has to be an absolute path to our Meta Box's View file.
    When this element of the array is populated, we can use that information in the
    `include`, so that it will include the `'view'` element.
    
    We no longer need the `'add_meta_box'` bit, since we need the whole `'unique-meta-box-id'` thing.
    Even though we may not use the `'add_meta_box'` part of the array, we can go ahead and
    get the `'custom_fields'` and/or the `'view'` and use it where we need them.

## 0.2.7

- `/reusable-meta-box/src/metadata/defaults/meta-box-config.php` and
  `/reusable-meta-box/src/metadata/meta-box.php`
  
  We are going to address the "Get the MetaData" part.
  
  We would need `$config`, so we can do a `foreach( $config['custom_fields'] )`,
  since we have an array of Custom Fields. What we can get out of that `foreach()`
  is a Meta Key and a Custom Field Configuration for that Meta Key.
  
  Now we can process the `get_post_meta()` information of `$subtitle`, `$show_subtitle` or
  any other Custom Field that we may have.
  
## 0.2.8

- `/reusable-meta-box/src/metadata/defaults/meta-box-config.php` and
  `/reusable-meta-box/src/metadata/meta-box.php`
  
  We now need to assign every bit of the `get_post_meta()` function into something.
  
  Let's create a `$custom_fields` variable that we will use, and it will be an array.
  
  We will use the 
  
  We will populate this array with the `get_post_meta()` function.
  
  We will use the `$custom_fields` with the `$meta_key` to go and extract what the actual
  value is.
  
  * `$meta_key` is our Meta Key, so it goes in place of `'subtitle'`
  (or `'show_subtitle'`, or whatever)
  
  * The `'meta_key'` array in `meta-box-config.php` is the `$custom_field_config`,
  so the `true` boolean is the `is_single` element.
  
  Now we are able to pull out the required information, put in on the `$custom_fields`
  array, so we don't need any of the `get_post_meta()` lines below anymore.

## 0.2.9

Now it's time to change our View files.

- `/reusable-meta-box/src/views/subtitle.php`
  
  We no longer use the `$subtitle` variable. Instead, we can have `$custom_fields`
  and the Key. Same goes for `$show_subtitle` and the other ones in `portfolio.php`.
  
If we didn't get anything back, we should load up the default values.

## 0.2.10

We will do now the first part of the Save Meta Box.

- `/reusable-meta-box/src/metadata/defaults/meta-box-config.php` and
  `/reusable-meta-box/src/metadata/meta-box.php`
  
  * First, we need the Meta Key.
  
  * Then, we also need the Configuration, except that we don't need the `'view'` or the `'add_meta_box'`
  parts of the array. We just need the `'custom_fields'` bit, so we can say
  "just give me the `'custom_fields'` part".
  
  * The `array_key_exists()` part is checking if this is our Meta Box or not,
  so it no longer has to be hardcoded. Instead, we use our `$meta_box_key` Key.
  Later on, we will figure out how to get those Keys.
  
  * For the nonce line, first we will change the `wp_nonce_field()` line in the
  Render part of our code so that the `_action` and `_name` can be more specific
  to the nonce. Then we will use the same line in the Save part of our code.
  Just as we did before (I think in v007), this maps by crossing: the `_nonce_action`
  goes in place of `'mbbasics_save'` and `_nonce_name` goes in place of `'mbbasics_nonce'`.
  
## 0.2.11

- Now we can delete the `wp_nonce_field()` line.

- `$_POST['mbbasics']` is our `$meta_box_key` Key, so we put it there.

- As for the array below, we know that we need to do something with defaults,
but we will do that later on.

## 0.2.12

- `/reusable-meta-box/src/metadata/defaults/meta-box-config.php`

  * As for the delete, we need to know a `'state'` to do the Delete. So, in the
  `'meta_key'` array we will state what is a valid state for a Delete. in this case,
  if we find an empty string, we do the Delete.
  
  * We also need a sanitizing function. This will be a callable function that we can
  run in order to do the sanitizing.

## 0.2.13

NOTE: if we are building a larger Plugin that has more than a Meta Box, then in our
`config` folder we should create another folder called `metabox` and put our Meta Box
Configuration files in it.

We are going to implement our Configuration files. We'll have one for Subtitle and
one for Portfolio, so we make two copies of `meta-box-config.php` and paste them into
`/config/subtitle.php` and `/config/portfolio.php`.

- `/config/portfolio.php` and `/config/portfolio-meta-box.php`

  * Our `'unique-meta-box-id'` is `'portfolio'`.
  * Our `'title'` is `__( 'Portfolio Details', 'portfolio' )`.
  * The `'screen'` is `array( 'post' )`.
  * There is nothing for the rest of parameters. We have two choices:
  we want the defaults, so we can leave those in; or we can delete them,
  and when we merge them together, those parameters that we haven't configured
  will be merged in when we do the Config Store.
  
  * We make a copy of the Custom Fields because we have two of them,
  `'client_name'` and `'client_url'`.
  * `'client_name'` Custom Field
  
    - The `'meta_key'` is the `'client_name'`.
    - Yes, it's a single.
    - The `'default'` is an empty string.
    - The `'default state'` is an empty string.
    - The `'sanitize'` is a `'sanitize_text_field'`.
  
  * `'client_url'` Custom Field
    
      - The `'meta_key'` is the `'client_url'`.
      - Yes, it's a single.
      - The `'default'` is an empty string.
      - The `'default state'` is an empty string.
      - The `'sanitize'` is a `'sanitize_text_field'`.
    
  * The `'view'` file is `METABOX_DIR . 'src/views/portfolio.php'`.
  
  * Now the only thing that's left is to change the opening commentaries for our file.

- `/config/subtitle.php` and `/config/subtitle-meta-box.php`

  * Our `'unique-meta-box-id'` is `'mbbasics_subtitle'`.
    * Our `'title'` is `__( 'Subtitle', 'mbbasics' )`.
    * The `'screen'` is `array( 'post' )`.
    * Again, we get rid of the unchanged default parameters.
    
    * Again, we make a copy of the Custom Fields because we have two of them,
    `'subtitle'` and `'show_subtitle'`.
    * `'subtitle'` Custom Field
    
      - The `'meta_key'` is the `'subtitle'`.
      - Yes, it's a single.
      - The `'default'` is an empty string.
      - The `'default state'` is an empty string.
      - The `'sanitize'` is a `'sanitize_text_field'`.
    
    * `'show_subtitle'` Custom Field
      
        - The `'meta_key'` is the `'show_subtitle'`.
        - Yes, it's a single.
        - The `'default'` is `0`.
        - In the case of a Checkbox, when it's not checked it's not in the Post (in $_POST).
        Therefore, in the `foreach( $metadata as $meta_key => $value )` $metadata,
        when the loop gets to `'show_subtitle'`, the value will be 0.
        The `'default state'` is an empty string.
        Therefore, our delete state should be `0`.
        - The `'sanitize'` is a `'intval'`, since the values can be `1` or `0`.
      
  * The `'view'` file is `METABOX_DIR . 'src/views/subtitle.php'`.
    
  * Now the only thing that's left is to change the opening commentaries for our file.

## 0.2.14

- In `/src/views/subtitle.php`, we have the name as `mbbasics`,
so let's change it in our View file so they match.

- We also move `portfolio-meta-box.php` and `subtitle-meta-box.php` to a new `/_save`
folder, just in case we need to have a look at them again.

- FIXED closing parenthesis bad placed all along since the beginning in the
Parameters Array, in `/config/subtitle.php`, `/config/portfolio.php` and
`/src/metadata/defaults/meta-box-config.php`.

## 0.2.15

We've separated the Configuration Store from the MetaData and placed into its own module.
Our projects could have different types of elements, such as Shortcodes, Widgets, CPT's,
Taxonomies, Templates, etc., and each of these could have a Configuration file with
runtime parameters that make them unique.

Therefore, following our modular configuration design pattern means that we need a store
that has an expected structure of what's coming into it, but doesn't care if it's a
configuration for this or that type of element.

`/src/config-store/config-store.php`

We need a way to get a Configuration. That is part of our API. Think of it as a
black box, and we give ways to work within that black box. We give a Get (`getConfig()`,
a way to get something out of the Store), we give a Load (a way to load something into
the Store), a Clear (to remove something from the Store), etc. We're going to handle the
Get and Load processes. So the intent of a Store like ours is:

1.- Load a file from the filesystem, but just once. In our implementation of the
    Metabox, we had three functions: Register, Render and Save. All need to access
    each of the Config files. So, to optimize this, we create a storage -which is a
    container- such that it only has to load the file one time.

2.- Load it into the store (a cache in memory).

3.- Retain the information so it can be used more times.

4.- Get a Configuration out of the Store or a specific parameter of that Configuration.

There are multiple ways to design and implement our Configuration Store. We could do it
with a class structure where we have static functions, and that would be called a
Class Wrapper. Another would be to create an OOP and retain that information in memory
with an Object. We could even do it in procedural and use a static variable as a Store.
We will do it in procedural.

- Besides the Get, we need a way to Load a Configuration with a path to the file.
  This path is absolute.

- We can leave our `getConfig()` as is, but we can also build a `getConfigParameter()`
function that lets us get just a Parameter. The `$subkey` in the `getConfig()` would
become a `$parameter_key` that we would go and get.

Now we have two getter and one setter functions we can use to work with the API.

## 0.2.16

Let's create our Black Box, the internal system of our Store.

In OOP, we would just set that to private or protected. In procedural,
begin with an underscore. That underscore means it's intended to be private, not to
be used externally.

- We need one `_the_store()` function with the `$store_key` and the `$config` configuration
itself that we want to store, set to a default array. So the Store has now two functions:
we can store and we can get.

- We then need a static memory, and we will call it `$config_store`, set to an empty array.

- Next, we need to load a file, with the path to that file. It needs to take
`$path_to_the_file`, go to our file system (`/config/portfolio.php`, `/config/subtitle.php`)
and load that information into memory, extract the Key and then send it back to our
`//Store` to be stored away.

  So, when we load a Configuration (`loadConfig()`), we go to `_load_a_file()`,
  get that file and then call our Store (`_the_store()`) and store that away.
  
- Since the `config-store.php` file is becoming too long, we will take our functions
  to an `api.php` file. The remaining code is all our private, internal Config Store,
  so to make this more clear we rename this file to `internals.php`.

- We also copy `/src/metadata/module.php` to `/src/config-store/module.php`,
  so we can use this file to handle loading the `api.php` and `internals.php` files.

- We include the internals and change the Comments on `/src/config-store/module.php`.

- We also correct the lines in `/bootstrap.php`.

## 0.2.17

We are going to do some refactoring in our code in `/src/config-store/api.php`

- We get rid of `$subkey = ''` since we can use `getConfigParameter()` to get a
  specific parameter.

- We then add/change the comments and some of the code for the functions in `api.php`
and `internals.php`.

## 0.2.18

`/bootstrap.php`

- If we comment `launch()` out and require `/config/portfolio.php`, and then do a `ddd()`,
  we will see what it takes to actually load a file from the filesystem using the
  architecture that we've set up.
  
  We obtain the `'portfolio'` and all its array of Configuration Parameters within
  that file.
  
  So, as we see, all matches and we can put the same `require` in our `internals.php`.

`/src/config-store/internals.php`

- Our `require` gives us a `$config` configuration for `'portfolio'`.

  But, if we look at our ddd() that contains our `'portfolio'` example, we see our
  `'portfolio'` Key, so there's our `$store_key`. But the actual Configuration itself
  is the value of that first element. How can we get that out so that we can return it?
  
  Because we say that we want to load it, but we also want to return it (`return array()`),
  so we need to extract the Key and the Configuration.
  
  One way to do it would be with a `foreach()`:
  
  `foreach( $config as $store_key => $parameters ) {`
    
        return array(      
            $store_key,
            $parameters
        );
  `}`
  
  Another way is to use some PHP functions that work within an array:
  
  `return array(`
  
        key( $config ), // We want the Key.
        current( $config ) // We want the current value.
  `);`
  
  In the next version 0.2.19, we'll try both.

## 0.2.19

`/bootstrap.php`

- We try the `foreach()` and PHP array functions, and both work the same.

  Tonya chooses the array functions.

`/src/config-store/internals.php`

- We also want to make sure that the Configuration returned is an array by type casting it.

- We can test it in the next 0.2.20 Version.

## 0.2.20

- We test our `/src/config-store/internals.php` code in `/bootstrap.php`.

- NOTE - Notice that `_load_config_from_filesystem()` is in a different namespace,
  so we need the full qualified name of that function, and includes the entire namespace.

- We also make sure that we don't have anything left colliding.

## 0.2.21

`/bootstrap.php`

- In v0.2.20, we got back two elements: the `'portfolio'` Storage Key and the
  array of Configuration Parameters. How can we get them as separate `$store_key` and
  `$config`?
  
  Theres a PHP function called `list()`. We saw that what was returned was an array
  of two elements. So we can use `list()` and when we call our `_load_config_from_filesystem()`
  function, we can separate the elements.

## 0.2.22

`/src/config-store/api.php`

- We use `list()` to load the elements.

- Let's test it.

## 0.2.23

`/src/config-store/api.php`

- rename `loadConfig()` to `loadConfigFromFilesystem()` to be specific.

- Add a `loadConfig()` function that already has the Parameters.

`/src/config-store/internals.php`

- Once we have the `$store_key` and the `$config` elements from `api.php`,
  we need to load them into the Store.
  
  In `internals.php`, the `_load_config_from_filesystem()` function does its work
  by requiring, getting it from the filesystem, and then in the `_the_store()`
  function, what we need to do is: when we're passing in a `$store_key` and a
  `$config_to_store` configuration, then we need to store that.
  
  So let's say that `$config_store[ $store_key ] = $config_to_store;`.
  
  To check that it works, let's return `$config_store`, the whole thing.
  
- Let's test it.
  
## 0.2.24

- When we refresh the Post, we get the `$store` back and, for the Portfolio,
  we stored away those three Parameters.
  
- We need to run this a couple of times to see how it works.

  `/src/config-store/api.php`
  
  We return `_the_store()`, so we can load a couple of these: portfolio and subtitle.
    
  With the first `d();`, the first instance of the store gives us one thing: portfolio.
  With the second instance, we now have two: portfolio and subtitle.
    
  Now we know how the `static` in `/src/config-store/internals.php` works:
  we called it the first time with the `loadConfigFromFilesystem()` function in
  `/src/config-store/api.php`, it ran with `_the_store()`, came over to
  the `_the_store()` function, which stored the configuration away with
  `$config_store[ $store_key ] = $config_to_store` and then it returned it back.
    
  Then we did another one, and this time it adds it as a second element,
  because the `static` variable allows us to keep a pointer to that part in memory.
    
- To sum it up:
  
  `/src/config-store/internals.php`
    * We're pulling something off of the filesystem and storing it into a
    `$config` variable.
    
    * Then we're extracting the Key and the Value out of that, and returning it back
    as an array.
    
  `/src/config-store/api.php`
    * We use `list()` to capture that and stick them in individual variables:
    `$store_key` and `$config`.
    
      In this part, instead of `list()`, we could have done:
      `$config = _load_config_from_filesystem( $path_to_the_file );`
      `return _the_store( $config[0], $config[1] );`
      
      Tonya thinks that her choice is much easier to read, because having two
      or more `$config[]` is confusing as to what is which one.

## 0.2.25

The next thing is getting the Configuration out of the Store.

`/src/config-store/api.php`

We have two different functions:

- `getConfig( $store_key )`, which gets the whole Configuration by the Store Key.
- `getConfigParameter( $store_key, $parameter_key )`, which gets a specific Parameter.

How do we do this? If we look at our Store (`/src/config-store/internals.php`),
there's the `_the_store()` function and then we return the whole thing with
`return $config_store;`. But we also have to deal with getting something out of
the Store.

- First, we can just return `true` when we're done storing, just to tell whomever
  is asking that we've finished storing away.

- So we delete the `return $config_store;` and that Key. But there is one problem:
  what happens if that key doesn't exist in the Store? Let's first assume that
  the Key does exist.
  
- `/src/config-store/api.php`
  
  * For `getConfig( $store_key )`: if we assume the Key exists,
    we can just return the Store and then pass in that Key.
  
  * For `getConfigParameter( $store_key, $parameter_key )`: if we look at our Store
    (`/src/config-store/internals.php`), we don't have a way to go and get that Key.
    So let's build it right here in this function.
    
    For now, we'll assume that the Parameter Key exist. We'll deal with that later.

Let's test this.

To do the testing, we need the Key before we can call 'Get', so in `/src/config-store/api.php`,
in the `loadConfigFromFilesystem( $path_to_file )` function,
we'll change `return _the_store( $store_key, $config );` with
`_the_store( $store_key, $config );` and then `return $store_key`.

## 0.2.26

Now we are able to get out a particular Configuration. But what if we need to
get a specific Key out of that though? What if We just want the View?

We did `d( \KnowTheCode\ConfigStore\getConfig( $key ) );`, but now we need
something like `d( \KnowTheCode\ConfigStore\getConfig( $key, 'view' ) );`

If we come back over to `/src/config-store/api.php`, we see that we need
`getConfigParameter()` for that, so that would be
`d( \KnowTheCode\ConfigStore\getConfigParameter( $key, 'view' ) );`.

We'll do the same for Subtitle, but with the Custom Fields.