<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                line-height: 1.6;
                color: #e5e7eb;
                background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
                min-height: 100vh;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
            }

            .navbar {
                position: fixed;
                top: 0;
                right: 0;
                padding: 1.5rem;
                z-index: 10;
            }

            .nav-links {
                display: flex;
                gap: 1rem;
                list-style: none;
            }

            .nav-link {
                color: #9ca3af;
                text-decoration: none;
                font-weight: 500;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                transition: all 0.2s ease;
            }

            .nav-link:hover {
                color: #f9fafb;
                background-color: rgba(255,255,255,0.1);
            }

            .main-content {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 2rem 0;
            }

            .logo {
                text-align: center;
                margin-bottom: 4rem;
            }

            .logo svg {
                height: 4rem;
                width: auto;
                background: rgba(59, 130, 246, 0.1);
                border-radius: 12px;
                padding: 1rem;
                border: 1px solid rgba(59, 130, 246, 0.2);
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                margin-top: 4rem;
            }

            .card {
                background: rgba(31, 41, 55, 0.8);
                backdrop-filter: blur(10px);
                border-radius: 16px;
                padding: 2rem;
                box-shadow: 0 8px 32px rgba(0,0,0,0.3);
                border: 1px solid rgba(59, 130, 246, 0.2);
                transition: all 0.3s ease;
                text-decoration: none;
                color: inherit;
                display: flex;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 40px rgba(0,0,0,0.4);
                border-color: rgba(59, 130, 246, 0.4);
            }

            .card-icon {
                width: 4rem;
                height: 4rem;
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #f9fafb;
                flex-shrink: 0;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .card-content {
                flex: 1;
            }

            .card h2 {
                font-size: 1.25rem;
                font-weight: 600;
                color: #f9fafb;
                margin-bottom: 0.75rem;
            }

            .card p {
                color: #d1d5db;
                font-size: 0.875rem;
                line-height: 1.6;
                margin-bottom: 1rem;
            }

            .card-link {
                color: #3b82f6;
                text-decoration: none;
                font-weight: 500;
                font-size: 0.875rem;
            }

            .card-link:hover {
                text-decoration: underline;
                color: #60a5fa;
            }

            .arrow-icon {
                color: #3b82f6;
                margin-left: auto;
                align-self: center;
            }

            .footer {
                text-align: center;
                padding: 2rem 0;
                color: #9ca3af;
                font-size: 0.875rem;
            }

            .footer-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
            }

            @media (max-width: 768px) {
                .grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }
                
                .card {
                    flex-direction: column;
                    text-align: center;
                }
                
                .arrow-icon {
                    display: none;
                }
                
                .footer-content {
                    flex-direction: column;
                    gap: 1rem;
                }
            }
        </style>
    </head>
    <body>
        @if (Route::has('login'))
            <nav class="navbar">
                <ul class="nav-links">
                    @auth
                        <li><a href="{{ url('/home') }}" class="nav-link">Home</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="nav-link">Log in</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        @endif
                    @endauth
                </ul>
            </nav>
        @endif

        <div class="main-content">
            <div class="container">
                <div class="logo">
                    <svg viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z" fill="#FF2D20"/>
                    </svg>
                </div>

                <div class="grid">
                    <a href="https://laravel.com/docs" class="card">
                        <div class="card-icon">
                            <i class="fas fa-book" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="card-content">
                            <h2>Documentation</h2>
                            <p>Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.</p>
                        </div>
                        <i class="fas fa-arrow-right arrow-icon"></i>
                    </a>

                    <a href="https://laracasts.com" class="card">
                        <div class="card-icon">
                            <i class="fas fa-play" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="card-content">
                            <h2>Laracasts</h2>
                            <p>Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.</p>
                        </div>
                        <i class="fas fa-arrow-right arrow-icon"></i>
                    </a>

                    <a href="https://laravel-news.com" class="card">
                        <div class="card-icon">
                            <i class="fas fa-newspaper" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="card-content">
                            <h2>Laravel News</h2>
                            <p>Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.</p>
                        </div>
                        <i class="fas fa-arrow-right arrow-icon"></i>
                    </a>

                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-cogs" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="card-content">
                            <h2>Vibrant Ecosystem</h2>
                            <p>Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="card-link">Forge</a>, <a href="https://vapor.laravel.com" class="card-link">Vapor</a>, <a href="https://nova.laravel.com" class="card-link">Nova</a>, and <a href="https://envoyer.io" class="card-link">Envoyer</a> help you take your projects to the next level.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-content">
                <div></div>
                <div>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</div>
            </div>
        </footer>
    </body>
</html>
