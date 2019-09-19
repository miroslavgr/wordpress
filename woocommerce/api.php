RewriteCond %{HTTP:Authorization} ^(.)
RewriteRule ^(.) - [E=HTTP_AUTHORIZATION:%1]

SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1   in htacces of wordpress
for not allowed to create error

permalin set to postname initially
