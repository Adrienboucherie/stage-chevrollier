$('#navbar li').click(function() {
    $(this).addClass('active').siblings('li').removeClass('active');
});
