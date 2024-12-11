## Overview
This module provides enhanced customization options for the checkout process in Magento 2. It displays dynamic messages in the order summary and a configurable popup message to guide customers during checkout.

## Features
- **Dynamic Order Summary Message:**
  - Displays custom messages based on subtotal thresholds.
  - Messages are configurable from the Magento admin panel.
  - Supports free shipping notifications and "Add more for free shipping" prompts.
- **Custom Popup Message:**
  - Configurable option to enable or disable the popup.
  - Displays free shipping or "Add more" messages dynamically.
  - Popup appears only once and respects user interaction.
- **Admin Configuration:**
  - Enable or disable the module.
  - Set custom messages for free shipping and "Add more for free shipping".
  - Control popup visibility.

## Configuration
Navigate to **Stores > Configuration > Custom Note - Checkout Page** in the Magento admin panel:
- **Enable:** Enable or disable the module.
- **Free Shipping Congratulation Message:** Custom message for free shipping notifications.
- **Add More for Free Shipping Message:** Message template for "Add {remaining}$ more for Free Shipping".
- **Enable Popup:** Enable or disable the popup message.

## Installation
1. Download the module code or clone the repository into `app/code/WB/OneStepCheckout`.
2. Run the following commands to set up the module:
   ```bash
   php bin/magento module:enable WB_OneStepCheckout
   php bin/magento setup:upgrade
   php bin/magento setup:di:compile
   php bin/magento setup:static-content:deploy
   ```
3. Clear the cache:
   ```bash
   php bin/magento cache:clean
   php bin/magento cache:flush
   ```

## Usage
1. Configure the module settings in the Magento admin panel under **Stores > Configuration > Custom Note - Checkout Page**.
2. Messages will dynamically update in the checkout process based on subtotal conditions.

## Compatibility
- Magento 2.4.x

## License
This module is licensed under the MIT License.

## Support
For support, please contact [Wajahat Bashir](mailto:wajahatbashir@example.com).