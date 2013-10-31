<?php
/* popupMutableMenu
 * Developer: Alexandar Tzanov
 * Revised: 2013-08-29
 * Version: 1.0
 * About: http://titanfusion.net/source-code-dna/php/function-popupmutablemenu/
 */
 
function popupMutableMenu($fileName = '', $relevantPath = '', $value = '', $name = '', $id = 'popupMenu', $size = 40)
{
    // Get working directory path.
    $workDir = getcwd();
    $dataFile = "$workDir/$relevantPath/$fileName";
 
    // Make sure the file exist, then read it.
    if (!empty($fileName) && file_exists($dataFile))
    {
        $fileData = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 
        // JavaScript controlls for the Other text field and menu option.
        $otherControlls = '<script>// Add blank option and text field
            function showOtherField(selectedOption)
            {
                var otherFieldPlaceholder = document.getElementById("popupMenuOtherFieldPlaceholder");
                var popupMenu = document.getElementById("' . $id . '");
 
                // Add new text field and option to popup menu.
                if (selectedOption.value === "Other")
                {
                    var otherNew = document.createElement("option");
                    otherNew.text = "";
                    otherNew.id = "otherNew";
                    popupMenu.add(otherNew, null);
                    otherFieldPlaceholder.innerHTML = \'<input type="text" id="popupMenuOtherField" size="' . $size . '" onkeyup="updatePopupMenuOption(this);">\';
                }
                else
                {
                    // Hide other field.
                    otherFieldPlaceholder.innerHTML = "";
                    var otherNew = document.getElementById("otherNew");
                    if (otherNew) popupMenu.removeChild(otherNew);
                }
            }
            // Update new option with user input
            function updatePopupMenuOption(userEntry)
            {
                var newOption = document.getElementById("otherNew");
                newOption.selected = true;
                newOption.value = userEntry.value;
                newOption.text = userEntry.value;
            }
            </script>';
 
        // Popup menu
        $popupMenu = $otherControlls;
        $popupMenu .= "<select name=\"$name\" id=\"$id\" onchange=\"showOtherField(this);\">\n<option></option>\n";
 
        $optionSelectionMatch = false;  // Selected option variables.
 
        // Loop through file data array and build string.
        foreach ($fileData as $menuItem)
        {
            // Check if the preset values matches an item on the list.
            if ($value == trim($menuItem))
            {
                $menuItemSelected = 'selected="yes"';
                $optionSelectionMatch = true;
            }
            else
            {
                $menuItemSelected = '';
            }
 
            $popupMenu .= "<option value=\"$menuItem\" $menuItemSelected>$menuItem</option>\n";
        }
 
        // If value supplied and there is no match, add anoterh option.
        $externalOption = (!$optionSelectionMatch && !empty($value)) ? "\n<option value=\"$value\" selected=\"yes\">$value</option>\n" : '';
 
        // Finalize the popup menu.
        $popupMenu .= "<option value=\"Other\">Other</option>$externalOption</select>\n";
        $popupMenu .= "<div id=\"popupMenuOtherFieldPlaceholder\"></div>\n";
 
        // Return popup menu code.
        return $popupMenu;
    }
    else
    {
        // Return an input field with a value, if any.
        return "<input name=\"$name\" size=\"$size\" id=\"$id\" value=\"$value\">";
    }
}
?>