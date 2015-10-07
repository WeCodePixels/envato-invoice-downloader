# Script for automatically downloading Envato invoices as PDF files

This script will automatically download all CodeCanyon/ThemeForest/Envato invoices for a chosen month, and convert them to PDF files. We use this everytime we need to forward our invoices to our accountant, and works pretty well. :) You will need to have PHP installed to run the script. 

We release this script under the MIT License.

## Step 0. Download the script.

The only file you need is **download-invoices.php**.

## Step 1. Install wkhtmltopdf

Be sure to have wkhtmltopdf installed. 

### Why?

This is used to save HTML pages as PDF files.

## Step 2. Download CSV statement

Go to your Statement page in your CodeCanyon account. Click on the month you are interested in. Click on "Download your statement in CSV format" from the bottom of the page. Save this file as **input.csv** in the same folder as the script file.

### Why?

The script will download all invoices found in this CSV statement.

## Step 3. Copy your session cookie.

If you are using **Firefox**, right click on the current page and select "View Page Info". Click on the Security tab, and then the "View Cookies" button. Find the "_fd_session" cookie and copy its contents.

If you are using **Chrome** or **Chromium**, right click on the current page and select "View page info", and then on "Show cookies and site data". Copy the contents of the "codecanyon.net > Cookies > _fd_session" cookie.

Be sure to copy the cookie's **complete** content. You can click on the text, press Ctrl+A (or Cmd+A) to select the entire text, and then Ctrl+C (or Cmd+C) to copy. The code should be a long string of letters, numbers, and other characters. Paste this code inside **session.ini** in the same folder as the script file.

### Why?

The script needs your session cookie to authenticate on CodeCanyon/Envato pages.

## Step 4. Run the script.

Run the **download-invoices.php** script from the terminal/console:

```php
php -f download-invoices.php
```

This will create an "IVIP" folder for sales, and an "IVSF" folder for fees.

Note that a "IVSF - Fees" folder will be created as well, but will be left empty. You have to print-to-file the invoice on your own from the Statement page. There is a dropdown in the upper part of the page.

Cheers,
The [WeCodePixels](https://wecodepixels.com) team.