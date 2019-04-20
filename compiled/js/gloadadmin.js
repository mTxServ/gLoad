/**
 * gLoad
 * gloadAdmin.js
 * Javascript script (lol) for the admin dashboard of gLoad
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache-2.0
 */

/**
 * Add a new field in the theme configuration collapse
 * @param id
 */
function addNewField(id) {
    let section = document.getElementById(id);
    let inputBlock = '<input type="text" class="form-control config-text" aria-label="Large" aria-describedby="inputGroup-sizing-sm">';

    section.innerHTML += inputBlock;
}

/**
 * Creates every Event Listener used in the Admin dashboard
 */
function eventsCreator() {
    let buttons = document.querySelectorAll('[data-toggle=configFields]');
    for (let i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener('click', function(){
            addNewField(this.dataset.target);
        });
    }
}


eventsCreator();