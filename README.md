# OpenCart
## PayGol module for OpenCart, version 1.0 <br>

[About PayGol](#about-paygol) <br>
[Requirements](#requirements) <br>
[Installation](#installation) <br>
[Testing](#testing) <br>
[Important Notes](#important-notes) <br>

### About PayGol:

- PayGol is an online payment service provider that offers a wide variety of both worldwide and local payment methods.
- Additional information can be found at:
  https://www.paygol.com/en/  
  https://www.paygol.com/en/pricing
    

### Requirements:

- Working OpenCart installation (tested with versions: 2.3.0.2, 2.3.0.1, 2.3.0).
- PayGol account, you can register for free at https://secure.paygol.com/register
- "Standard" type PayGol service, which can be created at https://www.paygol.com/en/webapps (you must be logged in).
  
  
### Installation:

- Upload file "paygol-for-opencart.1.0.ocmod.zip" via OpenCart, directly from the admin menu (Dashboard -> Extension installer -> Upload(button) -> select file, wait for the progress bar to fill.
- Install the PayGol module in your OpenCart admin panel (Extensions -> Payments -> Search "PayGol" -> Press Install).
- Enter the ID of your PayGol service (can be found at the "My Services" section of your panel, at PayGol's website).
- Activate the module, proceed to the module's setup page (Extensions -> Payments -> Search "PayGol" -> Press "Edit" -> Status -> Enabled).
- Paste the provided IPN URL into the "Background URL (IPN)" field at your service's configuration, which you can access through 
  the "My Services" section of your panel, at PayGol's website.
  

### Testing:

- To test the newly installed module you can enable your service's "Test" mode at the "My Services" section of your panel 
  at PayGol's website. Be sure to change it back before going live.


### Important Notes:

- While in test mode, an IPN request will be issued immediately after each test.
- Payments are usually notified immediately; however, certain payment methods may take longer to confirm the payment 
  (e.g. methods that take a few minutes to notify the transaction, or voucher-based transactions that require the payer 
  to print it in order to pay by cash at a given place). In these cases the product is shown as pending, and only 
  once it's confirmed by the provider will it show as paid. We strongly recommend that you inform your customers about this 
  beforehand in order to avoid confusions.


