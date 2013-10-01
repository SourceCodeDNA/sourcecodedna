<?php
/* get_dnr_hostmaster
 * Developer: Alexandar Tzanov
 * Revised: 2013-08-05
 * Version: 1.0
 * About: http://titanfusion.net/source-code-dna/php/function-get-dnr-hostmaster/
 */
 
function get_dnr_hostmaster($domain = '')
{
    // Ensure that a value was provided.
    if (!empty($domain))
    {
        // Prepare the CLI string and execute it.
        $digup = "dig $domain SOA";
        exec($digup, $NSResult);
 
        /* We are only interested in lien 11 of the output. It is the line with
         * the answer to our question. We will split the line using tabs and
         * then spaces, since those are the delimiters for the line.
         *
         * After the first split we need to remove any empty elements of the
         * array. We also need to check if the $answerSection array has 4
         * or 3 keys. This variation appear based on the domain name lenght.
         */
        $answerSection = explode("\t",$NSResult[11]);
        $answerSection = array_values(array_filter($answerSection));
        $answerSectionArrayKey = (array_key_exists(4, $answerSection)) ? 4 : 3;
        $answerSection = explode(' ', $answerSection[$answerSectionArrayKey], 3);
 
        // Remove the trailing period
        $unformatedEmailAddress = rtrim($answerSection[1], '.');
 
        /* Since there is no way to know the username convention, e.g. there is
         * a period in it, we will assume that there isn't one. We will replace
         * the first period in the string with an @ sign.
         */
        $emailAddress = preg_replace('/\./', '@', $unformatedEmailAddress, 1);
 
        return $emailAddress;
    }
    else
    {
        return 'WARNING: Missing domain name!';
    }
}
?>