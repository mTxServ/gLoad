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
    const section = document.getElementById(id);
    const index = section.childElementCount - 1;
    console.log(index);

    const container = document.createElement('div');
    container.className = 'input-group mb-3';
    container.id = id + index;

    const inputBlock = document.createElement('input');
    inputBlock.className = 'form-control config-text';
    inputBlock.setAttribute('type', 'text');
    inputBlock.setAttribute('name', id + '[]');

    container.appendChild(inputBlock);

    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'input-group-append';

    const button = document.createElement('button');
    button.className = 'btn btn-danger';
    button.setAttribute('data-toggle', 'deleteField');
    button.setAttribute('data-target', id + index);
    button.setAttribute('type', 'button');
    button.addEventListener('click', function(){
        removeField(this.dataset.target);
    });

    const icon = document.createElement('i');
    icon.className = 'fas fa-minus';

    button.appendChild(icon);
    buttonContainer.appendChild(button);
    container.appendChild(buttonContainer);

    section.appendChild(container);
}

/**
 * Remove a field from the theme configuration collapse
 * @param id
 */
function removeField(id) {
    const field = document.getElementById(id);
    field.remove();
}

/**
 * Creates every Event Listener used in the Admin dashboard
 */
function eventsCreator() {
    const addFieldButtons = document.querySelectorAll('[data-toggle=configFields]');
    for (let i = 0; i < addFieldButtons.length; i++)
    {
        addFieldButtons[i].addEventListener('click', function(){
            addNewField(this.dataset.target);
        });
    }

    const removeFieldButtons = document.querySelectorAll('[data-toggle=deleteField]');
    for (let i = 0; i < removeFieldButtons.length; i++)
    {
        removeFieldButtons[i].addEventListener('click', function(){
            removeField(this.dataset.target);
        });
    }

    const updateButton = document.getElementById('updateButton');
    updateButton.addEventListener('click', () => document.themeSettings.submit());
}

eventsCreator();