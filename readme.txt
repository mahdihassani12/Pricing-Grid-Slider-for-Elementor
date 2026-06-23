=== Pricing Grid & Slider for Elementor ===
Contributors: mahdihassani
Tags: elementor, pricing table, pricing grid, pricing slider, swiper
Requires at least: 6.0
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A flexible Elementor pricing plans widget with Grid/Slider modes, RTL support, and deep style controls.

== Description ==

Pricing Grid & Slider for Elementor adds a polished pricing plans widget to Elementor. Build responsive pricing cards in a grid or slider layout, customize card styles, and adjust responsive spacing directly from Elementor controls.

= Features =

* Grid and Slider display modes.
* RTL support.
* Repeater-based pricing plans and features.
* Featured/popular plan badge.
* Customizable card, typography, colors, spacing, borders, shadows, and button styles.
* Responsive controls for grid columns and slider slides per view.
* Elementor widget-level asset loading.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/pricing-grid-slider-for-elementor/` or install the ZIP from WordPress Admin > Plugins > Add New > Upload Plugin.
2. Activate the plugin through the Plugins screen in WordPress.
3. Make sure Elementor is installed and activated.
4. Edit a page with Elementor.
5. Search for "Pricing Grid & Slider for Elementor" under "Pricing Widgets".

== Frequently Asked Questions ==

= Does this plugin require Elementor? =

Yes. Elementor must be installed and activated.

= Does the slider work in RTL layouts? =

Yes. The widget includes RTL-aware markup and slider handling.

== Changelog ==

= 1.0.6 =
* Improved tablet and mobile responsiveness for grid and slider layouts.
* Added safer responsive Swiper gap handling for desktop, tablet, and mobile breakpoints.
* Prevented slide/card overflow on small screens.
* Added mobile-friendly card spacing, typography, price wrapping, and feature wrapping.

= 1.0.5 =
* Fixed live and frontend slider gap syncing with Swiper spaceBetween.
* Added editor gap watcher so responsive gap changes update immediately.

= 1.0.4 =
* Fixed slider slide width and gap handling.
* Added Elementor Swiper utility fallback for better compatibility.
* Prevented grid/flex rules from leaking into slider mode.

= 1.0.3 =
* Slider cards now fill each slide width while respecting the selected gap.
* Slider gap now follows the Elementor Gap control on desktop, tablet, and mobile.
* Added full arrow and pagination style controls.
