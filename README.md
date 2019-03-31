[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

MP Studio Starter Theme
===

Hi! I'm the starter theme for all new MP Studio WordPress Themes. I include a lot things to get you started with WordPress Premium Theme development. I'm built with modern development tools, like sass, gulp and a mobile-first approach in mind.


Installation
---------------

To get started, clone this repo and use it as a starter theme. You have to install all dependencies with npm:

<code>npm install</code>

Then run gulp to make sure sass and js files get compiled properly:

<code>gulp</code>

To build a production folder that can be zipped and uploaded to WordPress:

<code>gulp build</code>


Components/Modules
--------------------

### Navigation

- [x] Top Sticky Navigation (Desktop/Mobile - animated)
- [ ] Sticky Navigation (Desktop/Mobile - animated)
- [ ] Normal "un-sticky" Navigation
- [ ] Navigation w/ header Image


### Pagination

- [x] Numbered Page Navigation
- [x] Older/Newer Post on Single Post Page
- [x] Ajax Loading/Pagination


### Social

- [x] Social Media Icons (w/ Customizer)
- [x] Social Share Icons


### Layout Elements

- [x] Header w/ Image Support
- [x] 3 Column Footer (mobile ready)


### Custom Queries

- [x] Popular Posts (carousel/normal)
- [x] Latest Posts (carousel)
- [ ] Featured Posts by Category/Stickyness (carousel)
- [x] Related Posts (normal) 


### Nice-to-haves

- [x] Custom Icon Set (Fontastic)



Getting Started
---------------

The default text-domain is 'parlez'. It is recommended to use this domain for all MP Studio WordPress themes. Still, if you want to change it, follow these steps:

1. Search for: `'parlez'` and replace with: `'your-text-domain'`
2. Search for: `parlez_` and replace with: `your_text_domain_`
3. Search for: `Text Domain: parlez` and replace with: `Text Domain: Your_text_domain` in style.css.
4. Search for: <code>&nbsp;parlez</code> and replace with: <code>&nbsp;Your_text_domain</code>
5. Search for: `parlez-` and replace with: `your-text-domain-`s


Now you're ready to go! Make an awesome new MP Studio Theme.


License
--------
Licensed under GPLv2 or later