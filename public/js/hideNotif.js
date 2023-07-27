setTimeout(hideNotif, 4000);

function hideNotif() {
    $(document).ready(function () {
        $("#notif").slideUp();
        $(".notif").slideUp();
    });
}
