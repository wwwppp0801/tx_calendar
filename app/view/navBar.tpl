
<a href="/index"><u>首页</u></a>
<{if $user}>
欢迎您：<{$user.name}>  <a href='/login/index/logout'><u>退出登录</u></a>----<a href='/user'><u>修改个人信息</u></a>
<{else}>
<a href='/login'><u><u>登录</u></u></a>
<{/if}>
<{if $user.isAdmin}>
----<a href="/manage"><u>用户管理</u></a>
<{/if}>
