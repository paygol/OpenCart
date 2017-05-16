# OpenCart
#******* English *******

PayGol module for OpenCart, version 1.0


About PayGol:

- PayGol is an online payment service provider that offers a wide variety of both worldwide and local payment methods.
- Additional information can be found at:
  https://www.paygol.com/en/  
  https://www.paygol.com/en/pricing
    

Requirements:

- Working OpenCart installation (tested with versions: 2.3.0.2, 2.3.0.1, 2.3.0).
- PayGol account, you can register for free at https://secure.paygol.com/register
- "Standard" type PayGol service, which can be created at https://www.paygol.com/en/webapps (you must be logged in).
  
  
Installation:

- Upload file "paygol-for-opencart.1.0.ocmod.zip" via OpenCart, directly from the admin menu (Dashboard -> Extension installer -> Upload(button) -> select file, wait for the progress bar to fill.
- Install the PayGol module in your OpenCart admin panel (Extensions -> Payments -> Search "PayGol" -> Press Install).
- Enter the ID of your PayGol service (can be found at the "My Services" section of your panel, at PayGol's website).
- Activate the module, proceed to the module's setup page (Extensions -> Payments -> Search "PayGol" -> Press "Edit" -> Status -> Enabled).
- Paste the provided IPN URL into the "Background URL (IPN)" field at your service's configuration, which you can access through 
  the "My Services" section of your panel, at PayGol's website.
  

Testing:

- To test the newly installed module you can enable your service's "Test" mode at the "My Services" section of your panel 
  at PayGol's website. Be sure to change it back before going live.


Important Notes:

- While in test mode, an IPN request will be issued immediately after each test.
- Payments are usually notified immediately; however, certain payment methods may take longer to confirm the payment 
  (e.g. methods that take a few minutes to notify the transaction, or voucher-based transactions that require the payer 
  to print it in order to pay by cash at a given place). In these cases the product is shown as pending, and only 
  once it's confirmed by the provider will it show as paid. We strongly recommend that you inform your customers about this 
  beforehand in order to avoid confusions.



#******* Español *******

Módulo de PayGol para OpenCart, versión 1.0


Acerca de PayGol:

- PayGol es un proveedor de servicios de pago en línea que ofrece una amplia variedad de formas de pago tanto a nivel mundial como local.
- Información adicional se encuentra disponible en:
  https://www.paygol.com/es/  
  https://www.paygol.com/es/pricing


Requerimientos:

- Instalación funcional de OpenCart (probado con las versiones: 2.3.0.2, 2.3.0.1, 2.3.0).
- Cuenta en PayGol, puedes registrarte de forma gratuita en https://secure.paygol.com/register
- Servicio tipo "Estándar", el cual puede ser creado en https://www.paygol.com/es/webapps (debes haber ingresado a tu cuenta).
  
  
Instalación:

- Cargar archivo "paygol-for-opencart.1.0.ocmod.zip" via OpenCart, directamente desde el menu del administador (Tablero ->Instalador de extensiones ->Subir (botón) ->seleccionar archivo, esperar que la barra de progreso se llene.
- Instala el módulo de PayGol en tu panel de administración de OpenCart (Extensiones -> Tipos de pagos -> Buscar "PayGol" -> Presionar "Instalar").
- Ingresa el ID de tu servicio de PayGol (puede ser encontrado en la sección "Mis Servicios" de tu panel, en el sitio web de PayGol).
- Activar el modulo, accede a la página de configuración del módulo (Extensiones -> Tipos de pagos -> Buscar "PayGol" -> Presionar "Editar" -> Estado -> Habilitado).
- Copia la IPN URL proporcionada y pégala en el campo "URL de proceso (IPN)" de la configuración de tu servicio, accesible a través de 
  la sección "Mis Servicios" de tu panel, en el sitio web de PayGol.
  
    
Pruebas:

- Para probar el módulo tras su instalación puedes activar el modo de pruebas de tu servicio en la sección "Mis Servicios" 
  de tu panel, en el sitio web de PayGol. Recuerda cambiarlo de vuelta una vez concluídas tus pruebas.


Notas Importantes:

- En modo de pruebas se realizará un llamado a tu archivo IPN inmediatamente después de cada prueba.
- Los pagos usualmente son notificados inmediatamente; ahora bien, algunos métodos de pago podrían tomar más tiempo en notificar 
  la transacción (ej: métodos que toman algunos minutos en realizar la notificación, o métodos basados en boletos que deben ser 
  impresos y pagados en efectivo). En esos casos el producto se mostrará como pendiente, y sólo una vez sea confirmado por el 
  proveedor se mostrará como pagado. Recomendamos que informes a tu clientela sobre esto a modo de evitar confusiones.
  
