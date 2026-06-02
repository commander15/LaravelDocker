<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Docker Environment Setup</title>
    <style>
        :root {
            --laravel-red: #FF2D20;
            --dark-bg: #111827;
            --card-bg: #1F2937;
            --text-main: #F9FAFB;
            --text-muted: #9CA3AF;
        }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-main);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header {
            background: linear-gradient(135deg, #1f2937, #111827);
            border-bottom: 2px solid var(--laravel-red);
            text-align: center;
            padding: 4rem 2rem;
        }
        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 1rem;
        }
        h1 {
            font-size: 2.5rem;
            margin: 0 0 0.5rem 0;
        }
        .badge {
            background-color: var(--laravel-red);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: bold;
            display: inline-block;
        }
        main {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }
        @media (min-width: 768px) {
            .grid { grid-template-columns: 2fr 1fr; }
        }
        section {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            margin-bottom: 2rem;
        }
        h2 {
            color: var(--laravel-red);
            border-bottom: 1px solid #374151;
            padding-bottom: 0.5rem;
            margin-top: 0;
        }
        ul {
            padding-left: 1.25rem;
        }
        li {
            margin-bottom: 0.5rem;
        }
        pre {
            background-color: #111827;
            padding: 1rem;
            border-radius: 6px;
            overflow-x: auto;
            border: 1px solid #374151;
        }
        code {
            font-family: monospace;
            color: #34D399;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 8px;
            margin-top: 1rem;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .btn {
            display: inline-block;
            background-color: var(--laravel-red);
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.2s;
            margin-right: 0.5rem;
            margin-top: 0.5rem;
        }
        .btn:hover {
            background-color: #E02424;
        }
        .btn-secondary {
            background-color: #4B5563;
        }
        .btn-secondary:hover {
            background-color: #374151;
        }
        .environment-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .environment-table th, .environment-table td {
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid #374151;
        }
        .environment-table th {
            color: var(--text-muted);
        }
        footer {
            text-align: center;
            padding: 2rem;
            color: var(--text-muted);
            font-size: 0.9rem;
            border-top: 1px solid #1F2937;
            margin-top: 4rem;
        }
    </style>
</head>
<body>

    <header>
        <!-- SVG Laravel Logo -->
        <svg class="logo" viewBox="0 0 62 65" fill="none" xmlns="http://w3.org">
            <path d="M22.511 62.441c-2.457 0-4.664-1.241-5.918-3.327L1.83 34.629c-2.44-4.068-2.44-9.141 0-13.209L16.593 6.935C17.847 4.85 20.054 3.608 22.511 3.608h29.526c2.457 0 4.664 1.242 5.918 3.327l14.763 24.485c2.44 4.068 2.44 9.141 0 13.209L57.955 59.114c-1.254 2.086-3.461 3.327-5.918 3.327H22.511z" fill="#FF2D20"/>
            <path d="M51.192 15.698H28.243l-9.873 16.39 9.873 16.39h22.949l9.874-16.39-9.874-16.39z" fill="#FFF"/>
        </svg>
        <h1>Laravel Framework</h1>
        <div class="badge">Docker Environment Active</div>
    </header>

    <main>
        <div class="grid">
            
            <!-- Left Column: Content -->
            <div>
                <section>
                    <h2>What is Laravel?</h2>
                    <p>Laravel is a web application framework with expressive, elegant syntax. It provides an amazing developer experience while offering powerful features like thorough dependency injection, an expressive database abstraction layer, queues and scheduled jobs, unit and integration testing, and more.</p>
                    <p>Whether you are new to web frameworks or have years of experience, Laravel is a framework that can grow with you.</p>
                    
                    <a href="https://laravel.com" target="_blank" class="btn">Read Laravel Docs</a>
                    <a href="https://github.com" target="_blank" class="btn btn-secondary">GitHub Repository</a>
                </section>

                <section>
                    <h2>Learn Laravel Development</h2>
                    <p>Watch this introductory video to understand why Laravel is the choice framework for professional PHP developers.</p>
                    <div class="video-container">
                        <!-- Embedded standard placeholder video for Laravel Introduction -->
                        <iframe src="https://youtube.com" title="Laravel Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </section>

                <section>
                    <h2>Your Custom Docker Stack</h2>
                    <p>This page is being served from a highly optimized, custom production-ready Docker container designed specifically for Laravel applications.</p>
                    <h3>Pre-configured Components:</h3>
                    <ul>
                        <li><strong>Nginx:</strong> Serving as the front-end web server optimized for performance.</li>
                        <li><strong>PHP-FPM:</strong> Executing your PHP code with optimal fastCGI parameters.</li>
                        <li><strong>Supervisor:</strong> Keeping both Nginx and PHP-FPM processes alive and monitoring background queue workers.</li>
                        <li><strong>Composer:</strong> Built-in dependency manager for PHP packages.</li>
                        <li><strong>docker-php-extension-installer:</strong> Included for quick installations of extension dependencies (such as redis, pdo_mysql, gd, etc.).</li>
                    </ul>
                </section>
            </div>

            <!-- Right Column: System Info Sidebar -->
            <div>
                <section>
                    <h2>Environment Info</h2>
                    <table class="environment-table">
                        <tr>
                            <th>PHP Version</th>
                            <td><code><?php echo phpversion(); ?></code></td>
                        </tr>
                        <tr>
                            <th>Server Engine</th>
                            <td><code><?php echo $_SERVER['SERVER_SOFTWARE']; ?></code></td>
                        </tr>
                        <tr>
                            <th>Composer</th>
                            <td><code>Installed</code></td>
                        </tr>
                        <tr>
                            <th>Supervisor</th>
                            <td><code>Running</code></td>
                        </tr>
                    </table>
                </section>

                <section>
                    <h2>Next Steps</h2>
                    <p>To drop your Laravel project into this image, mount or copy your code directory into the application root directory:</p>
                    <pre><code>/var/www/html</code></pre>
                    <p>Ensure permissions are correctly mapped for the web server user:</p>
                    <pre><code>chown -R www-data:www-data storage bootstrap/cache</code></pre>
                </section>

                <section>
                    <h2>Useful Links</h2>
                    <ul>
                        <li><a href="https://laracasts.com" target="_blank" style="color: #60A5FA;">Laracasts Tutorials</a></li>
                        <li><a href="https://laravel-news.com" target="_blank" style="color: #60A5FA;">Laravel News</a></li>
                        <li><a href="https://laravel.com" target="_blank" style="color: #60A5FA;">Laravel Forge</a></li>
                    </ul>
                </section>
            </div>

        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> - Laravel Custom Docker Stack Init Engine.</p>
    </footer>

</body>
</html>

