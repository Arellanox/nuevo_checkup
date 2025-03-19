let delay = 100, setTimeoutConst = false;
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

$(document).on({
    mouseenter: function(e) {
        let tool = this;
        setTimeoutConst = setTimeout(function() {
            let tooltip = new bootstrap.Tooltip(tool);
            tooltip.show();
        }, delay)
    },
    mouseleave: function(e) {
        clearTimeout(setTimeoutConst)
        $('[role="tooltip"]').fadeOut(100, function() {
            $(this).remove();
        });
    },
}, '[data-bs-toggle="tooltip"]');