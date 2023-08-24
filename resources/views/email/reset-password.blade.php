<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    *{
        margin: 0;padding: 0;box-sizing: border-box;
    }
    html{
        font-size: 62.5%;
    }
    body{
        font-family: Poppins;
    }
    main{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .box a{
        color: #fff !important;
        font-weight: bolder !important;
    }
    .box{
        background-color: #0969C3;
        padding: 2rem;
        color: #fff;
        min-height: 30vh;
        margin-top: 7%;
        box-shadow: 0 0 8px rgba(0,0,0,0.8);
        border-radius: 8px;
        /* display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column; */
    }
    .box h4{
        font-size: 25px;
        text-align: center
    }
    .box h5{
        font-size: 20px;
    }
    .box p{
        font-size: 16px;
        margin:10px 0;
        line-height:2rem;
    }
    .box hr{
        height: 2px;
        width: 40%;
        margin: auto;
        background-color: #fff;
        margin-bottom: 20px;
       
    }
    .box .hr-2{
        outline: 1px solid #fff;
        outline-offset: 5px;
        margin-top: 20px;
        border-radius: 10px;
    }
    .box .btn{
        text-decoration: none;
        background-color: #fff;
        color: #0969c3 !important;
        padding: 0.5rem 1.5rem;
        font-size: 15px;
        margin-top: 15px;
        border-radius: 30px;
        outline: 2px solid #fff;
        outline-offset: 2px;
        transition: all 0.2s ease-in;  
        margin-bottom: 20px;
    }
    .box .btn:hover{
        outline-offset: 5px;
    }

</style>
</head>
<body>
    <main>
        <div class="box">
            <h4>Forgot your password?</h4>
             <hr>
            <h5>Don't worry we're here to help you.</h5>
            <p>Click the below button to reset your passsword</p>
            <br>
            <a href="https://study.key2success.info/reset-password/{{$link}}" class="btn">Reset</a>
        </div>
    </main>
</body>
</html>