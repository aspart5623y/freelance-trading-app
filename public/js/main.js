/* ========================  P R E L O A D E R  ======================= */

if (document.readyState == 'loading') {
    // document.querySelector('#preloader .progress .progress-bar').style.width = width + '%';
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('preloader').classList.add('loaded');
        ready();
    });
}


function ready () {
    var wrapper =  document.getElementById('wrapper');

    // S I D E B A R     T O G G L E     C L I C K     
    // E V E N T     F U N C T I O N     F O R     D E S K T O P
    let toggleBtn = document.querySelectorAll('.sidebar-toggle-btn')
    for(i = 0; i < toggleBtn.length; i++) {
        toggleBtn[i].addEventListener('click', () => {
            wrapper.classList.toggle('open');
        });
    }

    let sidebarOverlay = document.querySelector('.sidebar-overlay')
    sidebarOverlay.addEventListener('click', () => {
        wrapper.classList.toggle('open');
    });
    



}

