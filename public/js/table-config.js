const myDropdown = document.querySelectorAll('.dropdown-btn')
const table = document.querySelector('.table-responsive')
for (i = 0; i < myDropdown.length; i++) {
    myDropdown[i].addEventListener('show.bs.dropdown', event => {
        table.style.overflow = 'inherit'
    })
    
    myDropdown[i].addEventListener('hide.bs.dropdown', event => {
        table.style.overflow = 'auto'
    })
}


