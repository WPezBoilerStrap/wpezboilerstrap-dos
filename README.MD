# WPezBoilerStrap: Dos - v0.0.0.4 
#### A modern WordPress theme architecture, with a MVC state of mind, and empowered by WPezClasses.



Note: This README needs to fleshed out, properly structured, etc.

---
## Important
### This demo is to showcase the WPezBoilerStrap architecture, as well as WPezClasses.
### The presumtion is, you'll be looking at code in your IDE or editor and not getting destracted by the neglectful afterthought of this particular design. 

This sample theme uses Bootstrap 3.x, but the architecture is frontend (framework) agnostic.

You'll probably have to add some pages, add some posts, setup some menus, etc. 

--
## Disclaimer

This approach is not for everyone, nor is it intended to be. That's okay.

- It is **not** for you if: 
    * someone says, "DRY" and you say "cleaning" or "martini."
    * someone says, "OOP" and you say, "90's Hip Hop? I love Naughty By Nature."
    * someone says, "MVC" and you say, "Is that like QVC? I love to shop."
    * someone says, "WordPress" and you say, "I drink the Kool Aid."
    
- It could be for you if: 
    * you've ever worked with a WP theme and thought "Why TF did they do THAT?!!"
    * you've read "...copy and paste into your functions.php..." and you get an anxiety attack.
    * you've ever fell into a codex time suck and swore up a storm like you're the Wolf of Wall Street.
    * you're an agency/studio/solo dev building and maintaining at least 3 to 6 custom/semi-custom client themes per year.

---

## Benefits
In no particular order.

1) Increased productivity. Less really is more. 
1) More knowns. Less unknowns. 
2) It scales - both as a team-centric tool, as well as a technology.
4) Control, and the level of detail there of.
5) Freedom, to think outside the traditional WP box.
6) Reuseability, modularity and exchangeability. 

---
## Need to Knows
In no particular order.

- While the crux of the concepts feel relatively solid, this is still considered experimental and a proof of concept. 
- Yes, JavaScript and the WP REST API is the future. But perhaps not for everyone, at least not yet. 
- You'll see plenty of influences, inspirations and ideas borrowed from other languages, frameworks, products, etc.  
 
---
## "Mission Statement"

A 20% improvement in 80% of a given project is significant. That "saving" can be used to focus on the new and truly custom work. 

---
## Goals / Objectives
In no particular order.

1) Embrace structure and modularity.
2) Stop reinventing the wheel and reuse more code as much as possible.
3) Enable less able / experienced devs (and designers?) to do better work with less effort and less stress of "am I doing this right?"
4) Increase developer productivity and effectiveness by building on thier current WP experience.
5) Follow patterns but be practical.
6) Strive for KISS but don't lose sight of flexibility (if that means slightly less KISS.)
7) Code less and configure more.
8) Think outside the WordPress box. 
9) Allow WPezClasses and WPezBoilerStrap to be used independently. However, that use case is not the sweet spot.
10) Establish standards and guidelines that make the sharing code between WP devs/projects feel less awkward and more natural.   

The point is, context matters. It's easy to look at Product X and say, "Well, they didn't do this..." or "They should have done that..." Perhaps, but really it depends on the desired result(s).

In other words, an effort this audacious is based on priorities, acceptable compromises, and yes a slight "margin for error" if you will. 

In short, it's not perfect - just perfect enough to accomplish the mission.


---

## Overview
Super fast and at 50,000 ft.

- Loaders! They're everywhere. For example, scripts and style are defined as arrays (of objects) and then run through that loader. That is, you "configure" your sheets and styles, you don't code them.
- The standard WP function get_temple_part() (https://developer.wordpress.org/reference/functions/get_template_part/) also plays a key role. Because a child theme should have as much control as possible.
- If it helps, imagine WPezClasses as an extention of WP core. Via mu-plugins and an autoloader they are always there, ready, and waiting - just like core.
- Concerns are separated. So much so even an HTML's global attributes and such are **not** hardcoded into the views. 
- Views should be a dumb as possible.
- Views should also be as small and as modular as possible. But of course there will be exceptions.
- The Controller runs the show. A Controller provides its View with objects for: Language, Model, Partials and View Args.
- Language replaces the more traditional l10n localization. See FAQ section below. 
- As a general rule, anything that comes from WP / the DB or an external API is the Model.
- Partials are really just other Views that are "pre-rendered" and then inserted into the current parent view.
- Note: Some might say the Views here are Partials. Perhaps, but for the sake of conversation and how the architecture thinks it helps to differentiate.
- View Args is the markup "stuff" that is abstacted out of the View and inserted on the fly (by the Controller). In theory, you could switch from Bootstrap to Foundation (or your own frontend framework) simply by changing the View Args.

Bascially...

1) The View is simply a structure. It does X. Its been tested. It is a known.  You don't necessarily have to know how exactly. You just have to know what it needs to do its job, and what you'll get back from it.
2) You use The Controller to collect (i.e., "configure") what the View needs, and then inject those objects into the View to fill in the View's blanks.
3) There are a handful of helpers and such in the WPezBoilerStrap toolbox that faciliate its thought process and magic.
4) Anything else - when possible and as much as possible - goes into WPezClasses.
 
It's really that simple. The biggest problem is getting past your more traditional WP (bad?) habits.

---
## Getting Started

This repo is the wp-content folder of a standard WP install. This is temporary and strictly for the sake of making the demo easy to setup and explore. 

**functions.php** - This will take you on a path that explores the Scaffolding. The Scaffolding is standard WP theme "stuff" as as image sizes, styles, scripts, etc. Note the structure, and embrace the modularity and reusability. 
  
**index.php** - Controller, Views, Models and Partials. This is WPezBoilerStrap's flavor of MVC and WP in action. For this demo, all the Views are in the WPezBoilerStrap library but you could have local Views specific to your theme. 

**mu-plugins** - Look in the folder: wpez. Here you'll find the WPezClass and WPezBoilerStrap libraries. Also have a peep at the autoloader that manages them.

---
## FAQ

**1) Why a Language class/object and not l10n localization?**
Three reasons: Flexibility, control, as well as the fact that simply translating a word/phrase from one language to another could lead to a less than appropriate UX.
 
  Furthermore, the Language file gets (array) merge'd with the view's args (aka vargs). That is, language-centric properties are treated as arguments injected into the view, just like the CSS properties, and not something else. Language remains part of your normal workflow, and not some special, odd, case.
  
  Also, this approach allows the Language file to be manipulated programmatically. That is, the view doesn't care how you do it, as long as the view gets what it wants, when it wants. 

**2) What happened to page.php, single.php, etc.?**
They've been dismissed :) WPezBoilerStrap isn't a traditional whole-pages-at-a-time model. Instead, it's a series of nested views where you have complete control of what happens where and when. For example, you might have two different 404 "pages." One for loggin in users and another for those who are not. True, such things are possible via traditional WP, but it's not as clean and DRY.

**3) Can I use WPezBoilerStrap without WPezClasses, or the other way around?**
Yes. Do wotchagottado. But it's not the ideal scenario. 
 
**4) Can I use the WPezBoilerStrap architecture to develop themes for ThemeForest, the WP.org theme repo, and the like?**
At this time, no. In theory it's (probably) possible to jam everything under the hood of a single theme, but that kinda defeats the ideals.

**5) Can I added my own ezClasses, ezBoilerStrap views, etc.?** Yes, of course. And if you want to use the same autoloader, just put them under the folder mu-plugins/wpez/, and use the naming pattern that has been established. The autoloader looks for the WPez "prefix" and then works down from there. For example, you have a folder called XYZezClasess and/or XYZezBoilerStrap for your own "stuff" outside those two (eventual) repos. And as long as the naming is unique, you can trade such collections with other devs. That said, please consider contributing to the core product(s).

**6) How can I contribute?** Pull requests, posting your issues (i.e., bugs, requests, etc.), the usual OSS + GitHub stuff.

**7) I've got questions and comments.** Use the repo's issues, please. Thanks.
 
**8) Why is this a single repo?** Again, this is a proof of concept / demo - for now. It's a bit easier to manage as a whole, than to worry about dependencies, etc. The intention here is to simply say, "Here! Have a look at this" and mitigate any additional overhead.


---
## TODO

In no particular order.

- Deeper dive on HTML5 semantics, accessibility and schema.org tagging *
- Separate WPezClasses and WPezBoilerStrap into their own repos.
- Refactor older WPezClasses 
- Improved documentation *
- Investigate using a templating language (e.g., Twig.)
- WPezClasses: XML common scripts, a la Aspect Ratios. 
- Router/routing - See: https://carlalexander.ca/designing-system-wordpress-routing/ *
- https://www.quora.com/How-do-you-enable-new-features-for-selected-users-in-a-web-application *
- Caching at the view (not page) level
- Ongoing clean-up and such

\* = Higher priority


## Special Thanks 
For the inspiration, etc.

Carl Alexander, Steve Bruner, Mark Dappollone, Jake Goldman, Andrew Killen, Josh Pollock, Ruben Reyes, Mike Schinkel, Roy Sivan, Scott Taylor, Devin Walker, Chris White. 


