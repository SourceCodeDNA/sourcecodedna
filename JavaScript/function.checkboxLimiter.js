/* Checkbox Limiter
 * Author: Alexandar Tzanov
 * Revised: 2015-08-20
 * Version: 01.00.00
 * Description: The function fill limit enabled checkbox fields based on a
 *              common "name" attribute, and a preset "allowed" checkbox count.
 * Input: object keyword 'this', numAllowedChecked (set in function)
 * About: http://titanfusion.net/source-code-dna/javascript/function-checkboxlimiter/
 */
 
// Pass the checkbox name to the function
function checkboxLimiter(checkboxField) {
    var checkboxField = checkboxField || null;
    
    if (checkboxField)
    {
        var checkboxNameValue = checkboxField.name;
        var numAllowedChecked = 2;  // Number of allowd checked checkbox.
        var checkboxesChecked = [];
        var checkboxes = document.getElementsByName(checkboxNameValue); // Get list of matching checkboxe elements.
        
        // Check for checked checkboxes.
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                // Add to list of checked checkboxes.
                checkboxesChecked.push(checkboxes[i]);
            }
        }
        
        // Test and control enabled checkboxes.
        if (checkboxesChecked.length == numAllowedChecked)
        {
            // Disable all un-checked checkboxes.
            for (var i = 0; i < checkboxes.length; i++)
            {
                if (!checkboxes[i].checked)
                {
                    checkboxes[i].disabled = true;
                }
            }
        } else {
            // Enable all disabled checkboxes.
            for (var i = 0; i < checkboxes.length; i++)
            {
                if (checkboxes[i].disabled)
                {
                    checkboxes[i].disabled = false;
                }
            }
        }
    }
}