var scripts = document.getElementsByTagName("script");
var libraryBaseDirectory = scripts[scripts.length-1].src.replace('/dynload.lib.js','');

function DynLoadScalar()
{
    // Retrieving data
    var e = arguments[0];
    var outputElementID = arguments[1];
    var sqlQuery = arguments[2];

    var elementValue;

    // Add custom value to SQL-Statement
    switch(e.tagName)
    {
        case "SELECT" :
            elementValue = e.options[e.selectedIndex].value;
            break;
        default:
            elementValue = e.value;
            break;
    }

    sqlQuery = sqlQuery.replace("??", "'" + elementValue + "'");

    // Prepare SQL-Statement
    for(var i = 3; i < arguments.length; i++) sqlQuery = sqlQuery.replace("?", "'" + arguments[i] + "'");

    // Setup iframe
    var iframe = document.getElementById("dynloadFrame").contentWindow;
    iframe.document.getElementById("loadCompleted").value = 0;
    document.getElementById("dynloadFrame").src = libraryBaseDirectory + "/dynloadFrame.php?action=scalar&query=" + sqlQuery;

    // Wait until data from iframe is recieved
    $("#dynloadFrame").on("load", function () {
        document.getElementById(outputElementID).value = iframe.document.getElementById("dynloadOutput").value;
    });
}

function DynLoadCount()
{
    // Retrieving data
    var e = arguments[0];
    var outputElementID = arguments[1];
    var sqlQuery = arguments[2];

    var elementValue;

    // Add custom value to SQL-Statement
    switch(e.tagName)
    {
        case "SELECT" :
            elementValue = e.options[e.selectedIndex].value;
            break;
        default:
            elementValue = e.value;
            break;
    }

    sqlQuery = sqlQuery.replace("??", "'" + elementValue + "'");

    // Prepare SQL-Statement
    for(var i = 3; i < arguments.length; i++) sqlQuery = sqlQuery.replace("?", "'" + arguments[i] + "'");

    // Setup iframe
    var iframe = document.getElementById("dynloadFrame").contentWindow;
    iframe.document.getElementById("loadCompleted").value = 0;
    document.getElementById("dynloadFrame").src = libraryBaseDirectory + "/dynloadFrame.php?action=count&query=" + sqlQuery;

    // Wait until data from iframe is recieved
    $("#dynloadFrame").on("load", function () {
        document.getElementById(outputElementID).value = iframe.document.getElementById("dynloadOutput").value;
    });
}

function DynLoadExist()
{
    // Retrieving data
    var e = arguments[0];
    var outputElementID = arguments[1];
    var sqlQuery = arguments[2];

    var elementValue;

    // Add custom value to SQL-Statement
    switch(e.tagName)
    {
        case "SELECT" :
            elementValue = e.options[e.selectedIndex].value;
            break;
        default:
            elementValue = e.value;
            break;
    }

    sqlQuery = sqlQuery.replace("??", "'" + elementValue + "'");

    // Prepare SQL-Statement
    for(var i = 3; i < arguments.length; i++) sqlQuery = sqlQuery.replace("?", "'" + arguments[i] + "'");

    // Setup iframe
    var iframe = document.getElementById("dynloadFrame").contentWindow;
    iframe.document.getElementById("loadCompleted").value = 0;
    document.getElementById("dynloadFrame").src = libraryBaseDirectory + "/dynloadFrame.php?action=exist&query=" + sqlQuery;

    // Wait until data from iframe is recieved
    $("#dynloadFrame").on("load", function () {
        document.getElementById(outputElementID).value = iframe.document.getElementById("dynloadOutput").value;
    });
}

function DynLoadList()
{
    // Retrieving data
    var e = arguments[0];
    var outputElementID = arguments[1];
    var sqlQuery = arguments[2];

    var elementValue;

    // Add custom value to SQL-Statement
    switch(e.tagName)
    {
        case "SELECT" :
            elementValue = e.options[e.selectedIndex].value;
            break;
        default:
            elementValue = e.value;
            break;
    }

    sqlQuery = sqlQuery.replace("??", "'" + elementValue + "'");

    // Prepare SQL-Statement
    for(var i = 3; i < arguments.length; i++) sqlQuery = sqlQuery.replace("?", "'" + arguments[i] + "'");

    // Setup iframe
    var iframe = document.getElementById("dynloadFrame").contentWindow;
    iframe.document.getElementById("loadCompleted").value = 0;
    document.getElementById("dynloadFrame").src = libraryBaseDirectory + "/dynloadFrame.php?action=list&query=" + sqlQuery;

    // Wait until data from iframe is recieved
    $("#dynloadFrame").on("load", function () {
        // Clearing old List
        document.getElementById(outputElementID).innerHTML = "";

        // Filling new List
        var sqlResult = iframe.document.getElementById("dynloadOutput").value;

        var sqlResultArray =  sqlResult.split("|==|");
        var sqlCellArray;
        var option;

        for(var j = 0; j < sqlResultArray.length; j++)
        {
            if(sqlResultArray[j] != "")
            {
                sqlCellArray = sqlResultArray[j].split("|=|");

                option = document.createElement("option");
                option.text = sqlCellArray[1];
                option.value = sqlCellArray[0];
                document.getElementById(outputElementID).add(option);
            }
        }
    });
}