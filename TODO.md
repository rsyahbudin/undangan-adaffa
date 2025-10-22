# Background Music and Preloading Optimization

## Overview
Added background music with autoplay and optimized loading by preloading all images to eliminate lag during page flips.

## Steps
- [x] Step 1: Edit resources/views/invitation/show.blade.php - Add HTML5 <audio> element, play/pause toggle button, and loading overlay.
- [x] Step 2: Edit resources/views/invitation/pages/script.blade.php - Add JavaScript for audio controls, image preloader, and loading screen.
- [x] Step 3: Test the implementation (run php artisan serve, verify audio and preloading work without lag).
- [x] Step 4: Ensure storage link exists (php artisan storage:link if needed) and music file is accessible.
- [x] Step 5: Update music autoplay handling to fall back to user interaction if blocked by browser.
- [x] Step 6: Improve image preloading with better error handling and ensure all images are cached.
- [x] Step 7: Test the updated implementation to confirm no image reloading on page flips and music plays.
