/* Name: SwitchState
 * Developer: Alexandar Tzanov
 * Version: 1.0.0
 * Revised: 2013-09-20
 * About: http://titanfusion.net/source-code-dna/javascript/object-switchstate/
 */
 
function SwitchState()
{
    // Variables
    var switchState = true;
 
    // Methods
    // Return the state of the switch to an external call.
    this.currentSwitchState = function()
    {
        return switchState;
    }
 
    // Update the switch state.
    this.updateSwitchState = function(newState)
    {
        if (typeof newState === "undefined" || newState === '')
        {
            newState = true;
        }
        switchState = newState;
    }
 
    // Perform an action based on the switch state condition.
    this.doThis = function()
    {
        if (switchState)
        {
            alert("Current status is set to true.");
        }
        if (!switchState)
        {
            alert("Current status is set to false.");
        }
    }
}