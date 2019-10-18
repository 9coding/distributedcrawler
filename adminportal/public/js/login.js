
$(function () {
    $("#login_btn").click(function () {
        let email = $.trim($("#admin_email").val());
        if (!email) {
            alert(alert_msg.input_email);
            return false;
        }
        let password = $.trim($("#password").val());
        if (!password) {
            alert(alert_msg.input_password);
            return false;
        }
        let captcha = $.trim($("#captcha_code").val());
        if (!captcha) {
            alert(alert_msg.input_captcha);
            return false;
        }
        $("#login_form").submit();
    });
});
