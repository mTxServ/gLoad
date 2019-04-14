/**
 * gLoad
 * default.js
 * Default theme Javascript code
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 */

let filesTotal;
let percentages;

/**
 * Gets total number of files to download
 * @param total
 */
function SetFilesTotal(total)
{
    filesTotal = total;
}
document.getElementById('#downloading').innerHTML(filesTotal);