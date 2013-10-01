<?php
/* HTTP to HTTPS Redirect
 * Author: Alexandar Tzanov
 * Revised: 2013-08-14
 * Version: 01.00.00
 * Type: B
 * About: http://titanfusion.net/source-code-dna/php/function-http-https-redirect/
 */
 
function http_https_redirect()
{
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "")
    {
        $HTTPURI = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
 
        header("HTTP/1.1 301 Moved Permanently");   // Optional.
        header("Location: $HTTPURI");
 
        exit(0);    // Ensure that no other code is parsed.
    }
}
?>