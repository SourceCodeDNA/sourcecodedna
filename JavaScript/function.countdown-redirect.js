/* Countdown to auto-redirect
 * Author: Alexandar Tzanov
 * Revised: 2013-05-31
 * Version: 02.00.00
 * Description: The function will display a countdown before redirecting
 *  the user to a new address.
 * Input: Page element ID ; Seconds before redirect; Target URI.
 * About: http://titanfusion.net/source-code-dna/javascript/function-countdown-redirect/
 */
 
function countdown_redirect(targetURI, optVars)
{
    // Check if the optional variable is integer or a string
    function value_type(varType)
    {
        for (i = 0; i < optVars.length; i++) {
            if (typeof(optVars[i]) === varType)
            {
                return optVars[i];
            }
        }
        return false;
    }
 
    // Default values
    var timeToRedirect = (typeof(optVars) !== 'undefined' && value_type('number')) ? value_type('number') : 8;
    var pageBlockID = (typeof(optVars) !== 'undefined' && value_type('string')) ? value_type('string') : 'redirect-message';
 
    // Display the message on the page.
    var viewMessage = '<p>The page you are looking for has been moved <a href="' + targetURI + '">' + targetURI + '</a>.</p><p>Please update your bookmarks.</p>' + '<p>Redirect in <span id="viewCounter" style="color: black;">' + timeToRedirect + '</span>.</p>';
    document.getElementById(pageBlockID).innerHTML = viewMessage;
 
    var viewCounter = document.getElementById('viewCounter');
 
    // Countdown
    function countdown()
    {
        timeToRedirect--;
 
        // If the remaining seconds are 5 or less then change view to red.
        if (timeToRedirect <= 5)
        {
            viewCounter.style.color = 'red';
            viewCounter.style.fontWeight = 'bold';
        }
 
        // Update counter on the page view.
        viewCounter.innerHTML = timeToRedirect;
 
        // Sleep and update the view.
        if (timeToRedirect > 0)
        {
            setTimeout(countdown, 1000);
        }
        else
        {
            // Redirect the visitor to the target page.
            window.location = targetURI;
        }
    }
 
    setTimeout(countdown, 1000);
}