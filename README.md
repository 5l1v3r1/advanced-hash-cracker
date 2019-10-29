# Advanced Hash Cracker
Usage : <br>
<pre>
{ Advanced Hash Cracker V2 }
Usage : php h_crackv2.php '[hash]' [type] [min] [max] '[charset]'

Type  : -md5
        -bcrypt (CMS Sekolahku) (SLOWER)
        -sha1

Example : 

Background Process : 
php h_crackv2.php '594f803b380a41396ed63dca39503542' md5 5 8 'abcdefghijklmnopqrstuvwxyz' &>/dev/null &

Foreground Process : 
php h_crackv2.php '594f803b380a41396ed63dca39503542' md5 5 8 'abcdefghijklmnopqrstuvwxyz'

</pre>

SMTP Login Credentials :<br>
<pre>
Check at h_crackv2.php line 12 & 13

Gmail account terms and conditions:
   	1. Turn off 2-Step Verification
   	2. Enable less secure apps
   	3. Enable display unlock captcha

Check : https://support.google.com/mail/?p=BadCredentials#cantsignin
I recommend u to use new gmail account (for SMTP creds).
</pre>

How to use it on server?<br>
<pre>
If u have a ssh/shell access on someone's server,
U can use it for ur private hash cracker.

just upload hashcracker.zip,
then run :

www-data@hacked $ unzip hashcracker.zip
www-data@hacked $ php h_crackv2.php 'yourhash' md5 1 15 'abcdefghijklmnopqrstuvwxyz' &>/dev/null &

the script now has been executed as background process,
just wait for notification in your email (Check at line 26)

</pre>
<br><br>
By Muhammad Khidhir Ibrahim - Jogjakarta Hacker Link
