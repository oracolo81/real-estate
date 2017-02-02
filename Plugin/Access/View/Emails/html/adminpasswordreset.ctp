<p>An application has been submit to change your website's Administration password.</p>
<p>If you want to confirm this change click the following link:</p>
<p><a href='http://<?= $_SERVER["HTTP_HOST"]?>/admin/access/password/confirm/c:<?= $code ?>'>Confirm change</a></p>    
<p>If you did not change the password yourself click the following link (this will reset your password for security reasons):</p>
<p><a href='http://<?= $_SERVER["HTTP_HOST"]?>/admin/access/password/decline/c:<?= $code ?>'>Decline the change</a></p>