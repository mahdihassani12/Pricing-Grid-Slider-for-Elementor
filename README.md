# Benyamin Hope Pricing

Author: Mahdi Hassani  
Version: 1.0.6

A custom Elementor plugin that adds a polished **Benyamin Hope Pricing** widget.

## Features

- Grid and Slider display modes
- RTL support
- Repeater-based pricing plans
- Featured/popular plan badge
- Fully customizable card, typography, colors, spacing, borders, shadows, and button styles
- Responsive controls for grid columns and slider slides per view
- Uses Elementor's widget-level asset loading pattern

## Install

1. Upload `benyamin-hope-pricing.zip` from WordPress Admin > Plugins > Add New > Upload Plugin.
2. Activate the plugin.
3. Make sure Elementor is installed and activated.
4. Edit a page with Elementor.
5. Search for **Benyamin Hope Pricing** under **Benyamin Hope Widgets**.

## Notes

The slider uses Elementor/Swiper frontend assets. Grid mode works without JavaScript.


## 1.0.3
- Slider cards now fill each slide width while respecting the selected gap.
- Slider gap now follows the Elementor Gap control on desktop, tablet, and mobile.
- Added full arrow and pagination style controls.


## 1.0.4

- Fixed slider slide width and gap handling.
- Added Elementor Swiper utility fallback for better compatibility.
- Prevented grid/flex rules from leaking into slider mode.


## 1.0.5
- Fixed live and frontend slider gap syncing with Swiper spaceBetween.
- Added editor gap watcher so responsive gap changes update immediately.


## 1.0.6
- Improved tablet and mobile responsiveness for grid and slider layouts.
- Added safer responsive Swiper gap handling for desktop, tablet, and mobile breakpoints.
- Prevented slide/card overflow on small screens.
- Added mobile-friendly card spacing, typography, price wrapping, and feature wrapping.
