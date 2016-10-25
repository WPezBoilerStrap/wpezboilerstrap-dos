# Org: WPezClasses
### Product: Class_WP_ezClasses_Theme_Add_Theme_Support_1

##### WordPress add_theme_support() an ez makeover. 

In short, this is probably how add_theme_support() should have been all along.  

===============================================================================================

#### Overview

Instead of manually coding line after line of add_theme_support()s , now you simply configure an array and pass that to this class / methods. 

Here's an example of what that array looks like: 

https://github.com/WPezBoilerStrap/wp-ezboilerstrap-uno/blob/master/setup/uno/class-wp-ezboilerstrap-add-theme-support.php

The key point being, you establish your own baseline array for add_theme_support() (that you typically might use) and then given that whole you simply adjust as needed for a given project. 
For example, if you don't needs a given post-formats args then just set the active flag to false. 

The necessary code has been written, all you need to do now is set values and/or reuse an add_theme_support() array that you've used before. 

The other advantage is this becomes a boilerplate reference doc and/or a self-documenting reference for the current state of your theme's add_theme_support()s.