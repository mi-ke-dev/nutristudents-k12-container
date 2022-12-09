<!DOCTYPE html>
<html>    
    <body>
        <p>Hello {{ $user }},</br></br>
        Someone has just created an account for you on Nutristudents K-12.</br></br>
        You can login at:</br>
        {{ $login_url }}</p>
        <p>Account Details:
        </br>Username : {{ $email }}<br>Password : {{ $password }}</p> 
        <p>Click [<a href="{{ $login_url }}">here</a>] to login.</p>
    </body>
</html>
