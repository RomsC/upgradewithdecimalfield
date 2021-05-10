## Module for exposing issue with autoupgrade and decimal field

### Requirements

1. Composer, see [Composer](https://getcomposer.org/) to learn more

### How to install

1. Download or clone module into `modules` directory of your PrestaShop installation
2. Rename the directory to make sure that module directory is named `upgradewithdecimalfield`*
2. `cd` into module's directory and run following command:
  - `composer install` - to download dependencies into vendor folder
4. Install module:
    - from Back Office in Module Catalog
    - using the command `php ./bin/console prestashop:module install upgradewithdecimalfield`
      
*Because the name of the directory and the name of the main module file must match.*

### How to reproduct the issue

1. Go to 1-Click upgrade
2. Click on "Upgrade Prestashop Now!" button
