<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Majoo Test - Register</title>
    <style>
        .login {
        background-color: #efefef;
        height: 100vh;
        width: 100vw;
        display: grid;
        place-items: center;
        }
        .login__container {
        padding: 100px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 1 1px 3px rgba(0, 0, 0, 0.12), 0 1px;
        }
        
        .login__container> .loginImage{
        border:1 px solid black;
        text-align: center;
        }
       button {
        text-align: center;
        width: 100%;
        margin-top: 50px;
        padding: 14px 20px;
        text-transform: inherit !important;
        background-color: #F05340 !important;
        color: white;
        cursor: pointer;
        }
      
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        
      a{
        color: #F05340
      }

    </style>
</head>
<body>
    <div class='login'>
        <div class="login__container">
            <div class="loginImage">
              <img cla src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/120px-Laravel.svg.png" alt=""/>
            </div>

            <br>
           <form action="{{ route('auth.register') }}" method='post'>
           @csrf

           @error('email')
               {{$message}}
           @enderror
            <label for="uname"><b>Nama</b></label>
            <input type="text" placeholder="Enter Username" name="name" required>
            <label for="uname"><b>Email</b></label>
            <input type="text" placeholder="Enter Username" name="email" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <button type='submit' >
               Register
            </button>
           </form>
           <br>
           <br>
           <div style="text-align: center">Sudah mempunyai akun? <a href="{{ route('login') }}">Login di sini!!</a></div>
        </div>
     </div>
</body>
</html>