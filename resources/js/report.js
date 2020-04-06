$(document).ready(function() {

    window.Echo
        .private(`report-channel.` + userId)
        .listen('ReportFormed', (e) => {
            alert(e.reports);
        });

});
