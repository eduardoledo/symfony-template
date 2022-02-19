document.addEventListener("DOMContentLoaded", function (event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                nav.classList.toggle('show')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
            })
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }

    linkColor.forEach(l => l.addEventListener('click', colorLink))

    // Your code to run since DOM is loaded and ready
    updateForms();
});

window.updateForms = function () {
    $('form').first()
        .children()
        .first()
        .addClass('d-grid')
        .addClass('gap-3');
    $('div[data-prototype]').each(function () {
        const btnAdd = $('<div class="col-1"><a class="btn btn-outline-success ">Add</a></div>');
        const btnDelete = $('<div class="col-1"><a class="btn btn-warning ">Remove</a></div>');
        btnAdd.click(addFormToCollection);
        btnDelete.click(removeFromCollection);

        $(this).children()
            .children()
            .addClass('row')
            .addClass('border')
            .addClass('p-3')
            .append(btnDelete)
            .children()
            .addClass('col');

        $(this).append(btnAdd)
            .addClass('d-grid')
            .addClass('gap-3');
    });

    $('select').chosen();
}

function addFormToCollection() {
    const btnDelete = $('<div class="col-1"><a class="btn btn-warning ">Remove</a></div>');
    btnDelete.click(removeFromCollection);
    const siblings = $(this).siblings();
    const prototype = $(this).parent().data('prototype').replaceAll('__name__', siblings.length);
    const item = $(prototype);
    item.children()
        .addClass('row')
        .addClass('border')
        .append(btnDelete)
        .children()
        .addClass('col');
    $(this).before(item);
    $('select').chosen({'width': 100});
}

function removeFromCollection() {
    $(this).parent().remove();
}

