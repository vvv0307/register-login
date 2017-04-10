html文件里的login.html是登录的表单，账号密码和验证码，验证码由/php/yzm.php产生，存入session，checkForm方法判断输入框是否为空，为空返回false
表单不提交，成功提交到login.php验证，验证账号密码和是否激活  md5加密由前端完成。

html文件夹中的register.html是注册页面，需要输入账号 密码 邮箱，账号和邮箱由失去焦点触发时间，分别提交到Confirm.php和checkEmail.php验证账号和
邮箱是否存在，register.html按照返回值显示已经输入的邮箱和账号是否可用，两次输入的密码是否相同和输入框是否为空由前端的checkForm验证，不相同弹出弹框
成功提交表单后由register.php将存入数据库和邮箱验证，导入smtp.class.php，调用发送邮件方法（使用了开通了smtp功能的网易邮箱）,发送激活码到邮箱，点击链接
提交给active.php处理，验证是否超时，验证token是否相同，相同未超时则修改status为1，已经激活状态可登陆

js文件夹中是调用的一些插件和jquery
大部分js代码都不是单独的js文件，图方便多担待
