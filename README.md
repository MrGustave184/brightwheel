# Brightwheel test project

The own-shop theme (which is included in the repository) is just for quick setup. All the test code is in the own-shop-child theme

## How to run the project
1. In a fresh wordpress installation, install and activate the woocommerce plugin and the own shop theme (provided as own-shop.zip in the root folder)
2. Install and activate the own-shop-child theme (provided as own-shop-child.zip in the root folder in case you are downloading instead of cloning)
3. In your terminal, navigate to the own-shop-child theme and do a composer install
4. Go to Woocommerce > settings > accounts & privacy and check "Allow customers to place orders without an account"
5. Go to Woocommerce > settings > Payments and enable "Cash on delivery" so checkout proccess can be tested
5. Create a dummy woocommerce product
6. Reproduce the workflow from the test

## Priorities

My top priority was to complete all I could from the functionality. I managed to add some quick UI elements but not all of them. 
Due to time restriction, I missed some internationalization, validation and sanitization although some was added.
Discount is being applied in cart session but didnt had the time to show the fee in UI
Discount is being shown in UI in checkout review

## Project Structure

Project was created as a child theme for easier and faster setup.

Folder structure:
* assets: js, images, css
* src: custom classes, hooks, api endpoints
* templates: template parts, partials and such
