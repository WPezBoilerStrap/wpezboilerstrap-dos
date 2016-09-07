# Class_WP_ezClasses_Menu_Walker_Simple_List_1
A product of WPezClasses (https://github.com/WPezClasses)

##### Use wp_nav_menu() to generate a simple list. Adds a handful of custom ez_args because that's The ezWay.


=======================================================================================

#### WPezClasses: Getting Started
- https://github.com/WPezClasses/wp-ezclasses-docs-getting-started

Note: Simple List 1 doesn't extend the standard ez parent class. But the Getting Start is still worth reviewing.

=======================================================================================


#### Overview

What are menus but a list of links, right? And sometimes you just want a simple list (without start_lvl / end_lvl adding anything). If that's what you're looking for, this Walker_Nav_Menu child is for you.

For example, perhaps the client wants to be able to manually curate a (simple) list of Top Tags or Our Favorite Articles to be displayed somewhere in the theme.

In addition, by using the separator you can create lists similar to get_the_category_list (https://codex.wordpress.org/Function_Reference/get_the_category_list). The difference being those lists can be manually curated via Admin > Menus.

Yeah man, The ezWay.


=======================================================================================

#### See Also

https://codex.wordpress.org/Class_Reference/Walker

https://codex.wordpress.org/Class_Reference/Walker_Nav_Menu

=======================================================================================


#### The ez_args

Doin' it...The ezWay.

These are the additional args unique to Walker Nav Menu: Simple List 1. They can be changed by extending this class (see method: ez_args_defaults()) or just pass them in (as an array with key 'ez_args') as part of the standard array of args for your wp_nav_menu().

###### 'item_tag'
 - What HTML tag will rap a given item. See also method: valid_item_tags() for the other values currently allowed.
 - Default: 'li'

###### 'item_id_slug'
 - What slug should be used to create the item id. The actual item (post) id will be append to the end of the slug.
 - Default: 'simple-list-item-'
 - Note: It's '...item-" (item hyphen) and not just '...item' (no hyphen).
 - Note: Setting this to false prevents the item id from being added. That is, there will be no item id="..." at all.
 - Note: If you use Simple List 1 for more than one menu on a given page you'll want to make the item_id_slug unique for each if a menu item can be in multiple menus. The resulting CSS ids should be unique.

###### 'item_class'
 - What class should be assigned to each item
 - Default: 'simple-list-1-item'
 - Note: This is in addition to the item's class(es) as defined via Admin > Menu.

###### 'parent'
 - A given list item can be assigned parent and child CSS classes in case you desire a bit more styling control than uber simple.
 - Default: 'is-parent'

###### 'not_parent'
 - Default: 'not-parent'

###### 'child'
 - Default: 'is-child'

###### 'child_of'
 - Default: 'is-child-of-'
 - Note: It's '...of-" (of hyphen) and not just '...of' (no hyphen).

###### 'not_child'
 - Default: 'not-child'

###### 'separator_active'
 -  On / off switch for using the separator
 - Default: true

###### 'separator_outside'
 - Is the separator within the closing of the a tag or outside?
 - Default: true

###### 'separator_class'
 - Assign a class to the separator so you can be particular about its styling.
 - Default: 'simple-list-1-delimiter-wrap'
 - Note: Setting this to false prevent all classes from being added. That is, there will be no item class="..." at all.

###### 'separator'
 - What is the separator
 - Default: ','

=======================================================================================

#### Example / Sample

```
$arr_menu_args = array(

  'description'     => 'Blog Category List',
  'theme_location'  => 'blog_category',
  'menu'            => 'blog_category',
  'container'       => false,
  // 'container_class' => '',
  // 'container_id' => '',
  'menu_id'         => 'blog-category-list',
  'menu_class'      => 'simple-list-1-ul',
  'items_wrap'      => '<ul id="%1$s" class="%2$s" role="listbox">%3$s</ul>',
  'echo'            => false,
  'fallback_cb'     => false,
  'walker'          => new Class_WP_ezClasses_Menu_Walker_Simple_List_1()

  // Simple List 1 args:
  'ez_args'         => array(
    'item_tag'        => 'li',
    'item_id_slug'    => 'blog-menu-cat-id-',
    'item_class'      => 'blog-menu-item'
  ),


);

```

=======================================================================================

#### Other WPezClasses you might be interested in

 TODO