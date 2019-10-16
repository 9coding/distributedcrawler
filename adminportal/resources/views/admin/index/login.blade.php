<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <!--[if lt IE 9]>
        <script type="text/javascript" src="{{asset('lib/html5shiv.js')}}"></script>
        <script type="text/javascript" src="{{asset('lib/respond.min.js')}}"></script>
        <![endif]-->
        <link href="{{asset('static/h-ui/css/H-ui.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('static/h-ui.admin/css/H-ui.login.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('static/h-ui.admin/css/style.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('lib/Hui-iconfont/1.0.8/iconfont.css')}}" rel="stylesheet" type="text/css" />
        <!--[if IE 6]>
        <script type="text/javascript" src="{{asset('lib/DD_belatedPNG_0.0.8a-min.js')}}" ></script>
        <script>DD_belatedPNG.fix('*');</script>
        <![endif]-->
        <title>@lang('messages.site_title')</title>
    </head>
    <body>
        <div class="loginWraper">
            <div id="loginform" class="loginBox">
                <form class="form form-horizontal" action="{{route('dologin')}}" method="post" id="login_form">
                    {{ csrf_field() }}
                    <div class="row cl">
                        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                        <div class="formControls col-xs-8">
                            <input id="user_email" name="user_email" type="text" placeholder="@lang('messages.user_email')" class="input-text size-L">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                        <div class="formControls col-xs-8">
                            <input id="user_password" name="user_password" type="password" placeholder="@lang('messages.user_password')" class="input-text size-L">
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="formControls col-xs-8 col-xs-offset-3">
                            <input id="captcha_code" name="captcha_code" class="input-text size-L" type="text" placeholder="@lang('messages.captcha_code')" style="width:150px;">
                            <img src=""> <a id="kanbuq" href="javascript:;">@lang('messages.change_pic')</a> </div>
                    </div>
                    <div class="row cl">
                        <div class="formControls col-xs-8 col-xs-offset-3">
                            <label for="remember_me">
                                <input type="checkbox" name="remember_me" id="remember_me" value="1">
                                @lang('messages.remember_me')
                            </label>
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="formControls col-xs-8 col-xs-offset-3">
                            <input type="button" id="login_btn" class="btn btn-success radius size-L" value="@lang('messages.btn_login')">
                            <input type="reset" class="btn btn-default radius size-L" value="@lang('messages.btn_cancel')">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">&copy; ivan820819</div>
        <script type="text/javascript" src="{{asset('lib/jquery/1.9.1/jquery.min.js')}}"></script> 
        <script type="text/javascript" src="{{asset('static/h-ui/js/H-ui.min.js')}}"></script>
        <script type="text/javascript">
            var alert_msg = {
                input_email : "@lang('messages.please_input')@lang('messages.user_email')",
                input_password : "@lang('messages.please_input')@lang('messages.user_password')",
                input_captcha : "@lang('messages.please_input')@lang('messages.captcha_code')"
            };
        </script>
        <script type="text/javascript" src="{{asset('js/login.js')}}"></script>
    </body>
</html>