/**
 * gLoad
 * gload.js
 * Base Javascript script helper. Add basics functions that can be used in every theme.
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 */

/**
 * GameDetails
 * Returns every game details in an array
*/
function GameDetails(servername, serverurl, mapname, maxplayers, steamid, gamemode)
{
    return arguments;
}
/**
 * SetFilesTotal
 * Returns the total number of files to download
 */
function SetFilesTotal(total)
{
    return total;
}
/**
 * DownloadingFile
 * Called when the user start to download a specific file
 * @param callback function the function that will be called when DownloadingFile is called
 * @param fileName string the filename
 */
function DownloadingFile(callback, fileName)
{
    callback(fileName);
}

/**
 * SetStatusChanged
 * Called when the user downloading status has changed
 * @param callback function the function that will be called when OnStatusChanged is called
 * @param status string the name of the current status
 */
function SetStatusChanged(callback, status)
{
    callback(status);
}

/**
 * OnStatusChanged
 * Called when the number of remaining file to download changed
 * @param callback function the function that will be called when SetNeededChanged is called
 * @param needed string the number of file remaining
 */
function SetNeededChanged(callback, needed)
{
    callback(needed);
}