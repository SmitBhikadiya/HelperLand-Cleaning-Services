# Helperland

### PSD Location
> Tatvasoft-PSD-To_HTML/HTML

### MVC Location
> Tatvasoft-PSD-To_HTML/Helperland

### URLs 
> [Base URL to Run a project](http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/)  
> [Database File Location](https://github.com/SmitBhikadiya/Tatvasoft-PSD-TO-HTML/blob/main/Database/new-helperland.sql)

### SMTP configuration (config.php) (if you want to enable mailing system)
>set const SMTP_EMAIL = "";
>set const SMTP_PASS = ""; 

## ***>>> Submission <<<***
### 1st Submission
  > Set footer, header and modal common for homepage, contactus, faqs, aboutus and prices
  - Validate contact us form at server and client side both
  - User can contact a admin by submitting contact us form via mail services 


### 2nd Submission
> completed sign in, signup, logout and forgot password functionality for customer and servicer
 - Validate All the forms at the server and client-side by showing the proper error message
 - Store Hashing value of the password
 - Forgot password link sent to the user via mail so user can set a new password before the link expired
 - added session tracking : after 60 min of login user will automatically logout (with popup session has been expired)


### 3rd Submission
> completed all the functionality given in srs with all validation
  - Step1: check any sp provide service on entered postal code then and then you can move to next step
  - Step2: user can select the date, time, extra service or specify any comment, or checked it has pets or not 
  - Step3: as per step2 user address and favorite service is displaying information where the user can add the address as well
  - Step4: if all the steps are validated then the user can book a service
  - if service store on the database successfully all the sp's get mail of new service requests arrived
  - if any favorite service provider is available ap per the user input then only that sp gets an email of service is assigned to you 
> restriction
  - Servicer can't book a service
  - service total hours + service time can't be greater than 21 hours because the service booking request is must be completed within 21:00 time
  - once service is booked user can not book a service at the same address on a same date
 
