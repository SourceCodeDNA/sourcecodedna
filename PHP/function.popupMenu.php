<?php
/* popupMenu
 * Developer: Alexandar Tzanov
 * Revised: 2013-08-28
 * Version: 1.0
 * About: http://titanfusion.net/source-code-dna/php/function-popupmenu/
 */
 
function popupMenu($fileName = '', $relevantPath = '', $value = '', $name = 'popupMenu', $id = 'popupMenu', $size = 40)
{
    // Get working directory path.
    $workDir = getcwd();
    $dataFile = "$workDir/$relevantPath/$fileName";
 
    // Make sure the file exist, then read it.
    if (!empty($fileName) && file_exists($dataFile))
    {
        $popupMenu = "<select name=\"$name\" id=\"$id\">\n<option></option>\n";
        $fileData = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 
        // Loop through file data array and build string.
        foreach ($fileData as $menuItem)
        {
            $menuItemSelected = ($value == trim($menuItem)) ? 'selected="yes"' : '';
            $popupMenu .= "<option value=\"$menuItem\" $menuItemSelected>$menuItem</option>\n";
        }
 
        $popupMenu .= '</select>';
 
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