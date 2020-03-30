document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// -------------------Portfolio filter---------------
jQuery(document).ready(function($) {
    var $grid = $('.works-list').isotope({
        itemSelector: '.work-item',
        layoutMode: 'fitRows',
        getSortData: {
        name: function (element) {
            return $(element).text();
        }
        }
    });
    $('.category-btn button').on("click", function () {
        var value = $(this).attr('data-name');
        $grid.isotope({
            filter: value
        });
        $('.category-btn button').removeClass('active');
        $(this).addClass('active');
    })
});