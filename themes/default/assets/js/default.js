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


/**
 * Fixes the carousel problem onLoad
 */
let inner;
let elementsList = [];

inner = document.getElementsByClassName('carousel-inner');

for (let i = 0; i < inner.length; i++) {
    elementsList[i] = inner[i];
}
for (let i = 0; i < elementsList.length; i++)
    elementsList[i].children[0].classList.add('active');