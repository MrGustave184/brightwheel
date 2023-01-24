# Brightwheel test project

The own-shop theme (which is included in the repository) is just for quick setup. All the test code is in the own-shop-child theme

## How to run the project
1. In a fresh wordpress installation, install the woocommerce plugin and the own shop theme
2. Install and activate the own-shop-child theme
3. In your terminal, navigate to the own-shop-child theme and do a composer install
4. Go to Woocommerce > settings > accounts & privacy and check "Allow customers to place orders without an account" 
5. Create a dummy wordpress product
6. Reproduce the workflow from the test

## Priorities

My top priority was to complete all I could from the functionality. I managed to add some quick UI elements but not all of them. 
Due to time restriction, I missed some internationalization, validation and sanitization although some was added.
Discount is being applied in cart session but didnt had the time to show the fee in UI 