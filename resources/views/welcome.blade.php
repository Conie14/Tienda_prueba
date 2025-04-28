<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PetShop - Tienda de Mascotas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Estilos -->
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f7fa;
                color: #333;
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
            
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 0;
            }
            
            .logo {
                font-size: 24px;
                font-weight: 600;
                color: #3366cc;
            }
            
            .auth-nav {
                display: flex;
                align-items: center;
                gap: 15px;
            }
            
            .hero {
                text-align: center;
                padding: 100px 0;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                margin: 40px 0;
            }
            
            .hero h1 {
                color: #3366cc;
                margin-bottom: 20px;
            }
            
            .btn {
                display: inline-block;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                transition: all 0.3s ease;
            }
            
            .btn-login {
                color: #3366cc;
                border: 1px solid #3366cc;
                background-color: transparent;
            }
            
            .btn-login:hover {
                background-color: #e6f0ff;
            }
            
            .btn-register {
                color: #fff;
                background-color: #3366cc;
                border: 1px solid #3366cc;
            }
            
            .btn-register:hover {
                background-color: #2250b0;
            }
            
            .btn-dashboard {
                color: #fff;
                background-color: #22a45d;
                border: 1px solid #22a45d;
            }
            
            .btn-dashboard:hover {
                background-color: #1c874c;
            }
            
            .footer {
                text-align: center;
                padding: 20px;
                margin-top: 40px;
                color: #666;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header class="header">
                <div class="logo">PetShop</div>
                
                @if (Route::has('login'))
                    <nav class="auth-nav">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-dashboard">Mi Cuenta</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-login">Iniciar Sesión</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-register">Registrarse</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main>
                <section class="hero">
                    <h1>Bienvenido a PetShop</h1>
                    <p>La mejor tienda para tus mascotas</p>
                </section>
            </main>

            <footer class="footer">
                <p>&copy; {{ date('Y') }} PetShop. Todos los derechos reservados.</p>
            </footer>
        </div>
    </body>
</html>