function getStateCheckbox(ctrl)
{
    var myCheckBox = document.getElementById(ctrl);
    if (myCheckBox.checked)
        myCheckBox.value = "true";
    else
        myCheckBox.value = "false";

    return myCheckBox.value;
}
