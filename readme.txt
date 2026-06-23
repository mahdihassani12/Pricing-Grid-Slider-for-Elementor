=== Pricing Grid & Slider for Elementor ===
Contributors: mahdihassani
Tags: elementor, pricing table, pricing grid, pricing slider, responsive
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create responsive pricing plans in Elementor with grid and slider layouts, customizable cards, feature icons, buttons, badges, arrows, and pagination.

== Description ==

Pricing Grid & Slider for Elementor is a lightweight, free Elementor widget for building responsive pricing plan sections. It lets you present pricing cards in either a classic grid or a Swiper-powered slider while keeping all content and styles editable from Elementor.

The plugin does not make remote requests and uses Elementor's registered Swiper assets for slider behavior.

= Features =

* Elementor pricing plans widget.
* Grid and slider layout switcher.
* Repeater-based pricing cards.
* Customizable titles, subtitles, currency, price, and period text.
* Customizable feature list labels and icons.
* Per-feature icon and label color controls.
* Customizable call-to-action buttons.
* Optional badge/popular label and featured-card styling.
* Slider arrows and pagination controls.
* Responsive controls for grid columns, slider slides per view, spacing, and padding.
* RTL-friendly layout and slider navigation.
* Frontend and Elementor editor preview support.
* Lightweight local CSS and JavaScript loaded only when the widget is used.

== Installation ==

1. Upload the `pricing-grid-slider-for-elementor` folder to `/wp-content/plugins/`, or install the plugin ZIP from Plugins > Add New > Upload Plugin.
2. Activate the plugin through the Plugins screen in WordPress.
3. Make sure Elementor is installed and activated.
4. Edit a page with Elementor.
5. Search for "Pricing Grid & Slider for Elementor" in the "Pricing Widgets" category.
6. Add the widget and choose either Grid or Slider mode.

== Frequently Asked Questions ==

= Does this plugin require Elementor? =

Yes. Elementor must be installed and activated because this plugin adds an Elementor widget.

= Is the plugin free? =

Yes. The plugin is fully free and licensed under GPLv2 or later.

= Does the slider require another slider plugin? =

No. The slider uses the Swiper library bundled and registered by Elementor.

= Does it support responsive layouts? =

Yes. You can set desktop, tablet, and mobile values for grid columns, slider slides per view, gaps, and several style controls.

= Does it support RTL sites? =

Yes. The CSS and slider controls include RTL-aware rules.

= Does the plugin make remote requests? =

No. The plugin uses local assets and Elementor-provided dependencies only.

== Screenshots ==

1. Pricing plans in grid mode.
2. Pricing plans in slider mode with arrows and pagination.
3. Elementor controls for plans, features, and responsive layout.

== Changelog ==

= 1.0.7 =
* Prepared plugin metadata and readme for WordPress.org submission.
* Preserved Elementor widget registration while reviewing current Elementor frontend hook compatibility.
* Hardened button link output with safe URL, target, rel, and custom attribute handling.
* Hardened inline style generation for per-feature colors.
* Improved default strings for translation extraction.
* Confirmed local-only assets and widget-level asset loading.

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

== Upgrade Notice ==

= 1.0.7 =
Recommended release candidate for WordPress.org submission with security, naming, and documentation improvements.

== License ==

Pricing Grid & Slider for Elementor is licensed under the GPLv2 or later.

This plugin uses WordPress and Elementor APIs and relies on Elementor's bundled Swiper dependency. All plugin code is GPL-compatible.
