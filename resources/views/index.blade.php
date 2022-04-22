<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>All In One Music</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
           footer{
               background-color: #2E282A;
               color: white;
           }

            .logotipo h1{
                font-size: 10em;
            }

            h1,h2{
                color: #E3D924;
            }

            .logotipo{
                text-align: center;
                width: 100%;
            }

            .portada{
                height: 100vh;
                padding-top: 20vh;
            }

            .btn-primary{
                background-color: #E3D924;
                color: #2E282A;
                border: none;
            }

            .login{
                height: 30vh;
                background-color:#2E282A;

            }

            .portada {
  /* The image used */  
  /* background-image: url('/img/prueba_backgrn.png'); */
  background-color: #8EB8E5;

  /* Full height */
  height: 100vh; 

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}


        </style>
    </head>
    <body>
        <div class="parallax"></div>
        <div class="portada">
            <div class="logotipo">
                <h1>AIOM</h1>
                <h2>All In One Music</h2>
                <input type="text" placeholder="Busca música">
                <button class="btn btn-primary">Buscar</button>
                <div>
                    <button class="btn btn-primary">Hazte una cuenta</button>
                    <button class="btn btn-primary">Entra en tu cuenta</button>
                </div>
            </div>

        </div>

        <div class="login">
            <h1>Login</h1>
            <form>
                <label for="email">Email:</label>
                <input name="email" type="text">
                <label for="password">Contraseña:</label>
                <input name="password" type="password">
                <input type="submit">
            </form>

        </div>

        <div class="registro">
            <h1>Register</h1>
            <form>
                <label for="email">Email:</label>
                <input name="email" type="text">
                <label for="password">Contraseña:</label>
                <input name="password" type="password">
                <label for="password2">Repite la contraseña:</label>
                <input name="password2" type="password">
                <input type="submit">
            </form>
        </div>

        <div class="canciones">

        </div>
        <footer>
            <p>Copyleft 2022</p>
        </footer>

    </body>
</html>