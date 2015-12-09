<?php

return [
    /*
    * Blog Location
    * =============
    * Allows you to choose where the blog should be located on your site
    *
    * Valid Options :-
    *  "home": example.com - This will be your blog url.
    *  "blog": example.com/blog - Blog will start at /blog routes.
    *  "news": example.com/news - Blog will start at /news routes.
    */

    "location" => "home",

    /*
    * Framework
    * =========
    *
    * Provides the ability to chose which css classes are added to elements, full
    * documentation can be found in the README
    *
    * Valid Options :-
    * "bootstrap-3", "bootstrap-4", "foundation-5", "none", null
    */

    "framework" => "bootstrap-4",

    /*
     * Blog Post Layout
     * ================
     * This setting allows you to choose how blog posts will be laid out on the site.
     *
     * Valid Options :-
     *   "card" - All posts will be displayed as rows of cards - useful if you use featured images (nice for bootstrap 4).
     *   "list" - All posts will go down the page in a list.
     *   "none" - Your posts will be output as is, you can use this if you plan to implement your own options.
     */

    "post-layout" => "list",
];
