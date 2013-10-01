<?php
/* HTTP to HTTPS Redirect
 * Author: Alexandar Tzanov
 * Revised: 2013-08-14
 * Version: 01.00.00
 * Type: A
 * About: http://titanfusion.net/source-code-dna/php/function-http-https-redirect/
 */
 
function http_https_redirect()
{
    if ($_SERVER["HTTPS"] != "on")
    {
       header("HTTP/1.1 301 Moved Permanently");    // Optional.
       header("Location: https://{$_SERVER["SERVER_NAME"]}{$_SERVER["REQUEST_URI"]}");
 
       exit(0); // Ensure that no other code is parsed.
    }
}
?>