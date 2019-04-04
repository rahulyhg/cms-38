=== User Post Gallery - UPG ===
Contributors: odude
Tags: image gallery, youtube gallery,vimeo gallery, user submit, community, user profile, content gallery, photo album, frontend post, buddypress, user post gallery, Ultimate Member
Donate link: http://www.odude.com
Requires at least: 3.8
Tested up to: 4.9.1
Requires PHP: 5.5
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Visitors submitted image, content & Youtube, Vimeo Gallery.

== Description ==
= UPG - User Post Gallery =

User Post Gallery (UPG) is the easy way to allow visitors to post images, article, YouTube, Vimeo videos without registration from the frontend.

UPG adds a frontend form via shortcode that enables your visitors to submit posts and upload images. 

That\'s all there is to it! Your site now can accept user generated content. Everything is super easy to customize via Plugin Settings page.

The pages like submission form, gallery page are auto created as soon as plugin is activated. 

= Features =

* Responsive article/image/YouTube/Vimeo gallery for mobile & tablets.
* Registered & Visitors can upload images/article from the front end.
* Loggedin users can delete own uploaded post with ajax system.
* My Gallery page for loggedin users.
* Automatically display all submitted content on the frontend
* Content & images can also be posted from the backend with additional options.
* Administrator can show or hide particular categories/albums from the frontend.
* Options to set as approval of post/images before it is displayed at the frontend.
* Filter UPG post by particular users, category,tags by using shortcode.
* Clean search engine friendly.
* External plugins shortcodes can be added near UPG post.
* Options for both lightbox and static page (Preview Page).
* Set number of images to be displayed per page.
* Multiple layout options available. You can create own layout from scratch using personal layout.
* Controls over custom fields to be displayed at backend & frontend.
* Options to include posts into archive pages
* Built-in widgets to list categories
* Multisite compatible
* Bulk Image Upload
* Integrated with Ultimate-Member profile plugin 
* Send images as e-card. Make powerful ecard sites in few clicks.
* Redirect to selected page after form is submitted. 


Basic installation video
[youtube https://youtu.be/vl3xMHij1JE]



= Support =

For further questions feel free to drop a line at navneet@odude.com.
or
Go to our site to read full updated documentations and features at UPG FAQ. 

= Live Demo =

Used WP-UPG Plugin : <a href="http://odude.com/demo/photo/users-post-gallery/" target="_blank">Built for Photographers</a>

Used WP-UPG Plugin (Personal Layout): <a href="http://odude.com/demo/faq/" target="_blank">FAQ System</a>

Used WP-UPG Plugin (Ecard Layout: <a href="http://maxecard.com" target="_blank">MaxEcard.com</a>

== Installation ==
= Automatic Installation =

* Go to your Plugins page inside your Wordpress installation and search `odude` by keyword. Then choose User Photo Gallery and click install. It will be installed in a few seconds.
* Activate the plugin from `Plugins` menu after installation

= Manual Installation =

* Download the latest version and extract the folder to the `/wp-content/plugins/` directory
* The plugin will appear as inactive in your Dashboard `Plugins` menu
* Activate the plugin through the Dashboard `Plugins` menu in WordPress

== Frequently Asked Questions ==
= 1. What type of images does WP-UPG support? =

UPG supports the following types of image files: JPG, JPEG, PNG, GIF, YouTube URL

= 2. How thumbnails are created? =

Thumbnails and previews are based on the main default settings of Wordpress media manager.

= 3. Create page to post/upload image =
Create a page and giveit the as you wish. Insert the shortcode [upg-post type=image] in the description area. Link this page at your menu.

= 4. Show images from specific album/category =

 Insert this shortcode in the textarea for a page and link that page to your menu.

[upg-list album="test"]


test  is a album or category slug name.
Leave it blank to show all images. 

album="test"  specifies a particular album or category slug name. Leave this parameter out to show all images.
   

== Screenshots ==
1. Responsive Image Gallery
2. Frontend Post Form for visitors
3. Admin Setting Options
4. Admin Side Image List
5. Lightbox Video
6. Gallery Flat Layout

== Changelog ==
=1.48=
* Vimeo video can be posted by user and admin
* upg-youtube shortcode is relaced with upg-video
* Removed insert button at editor
* function to get album name and link

=1.47=
* Updated UPG-PRO. Now can redirect to selected page after form submission.

=1.45=
* Now supports UPG Tags. 

=1.44=
* Send images as ecard with help of ODude Ecard plugin

=1.43=
* Added link refrence to layout at layout editor

== Upgrade Notice ==
Safe to update