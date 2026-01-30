@include('Frontend.pages.header')
    <style>


        .terms-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 80px 0 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .terms-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="rgba(255,255,255,0.05)"/></svg>');
            opacity: 0.1;
        }

        .terms-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .terms-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .terms-container {
            max-width: 1000px;
            margin: -40px auto 60px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 50px;
            position: relative;
            z-index: 2;
        }

        .last-updated {
            background: #e3f2fd;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 40px;
            border-left: 4px solid #2196f3;
        }

        .last-updated i {
            color: #2196f3;
            margin-right: 10px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-title {
            color: #1e3c72;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2a5298;
            display: inline-block;
        }

        .section-number {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .section p {
            margin-bottom: 15px;
            text-align: justify;
            font-size: 1.05rem;
            color: #555;
        }

        .section ul {
            list-style: none;
            padding-left: 0;
        }

        .section ul li {
            padding: 12px 0 12px 40px;
            position: relative;
            border-bottom: 1px solid #eee;
        }

        .section ul li:last-child {
            border-bottom: none;
        }

        .section ul li::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            color: #2a5298;
            background: #e3f2fd;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        .important-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }

        .important-box i {
            color: #ffc107;
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .contact-box {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            margin-top: 50px;
        }

        .contact-box h3 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .contact-box p {
            font-size: 1.1rem;
            margin-bottom: 25px;
        }

        .contact-box a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.2rem;
            display: inline-block;
            margin: 0 15px;
            padding: 12px 30px;
            background: rgba(255,255,255,0.2);
            border-radius: 50px;
            transition: all 0.3s;
        }

        .contact-box a:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .terms-header h1 {
                font-size: 2rem;
            }

            .terms-container {
                padding: 30px 20px;
                margin: -20px 15px 30px;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .contact-box {
                padding: 30px 20px;
            }

            .contact-box a {
                display: block;
                margin: 10px 0;
            }
        }
    </style>


    <!-- Header -->
    <div class="terms-header">
        <div class="container">
            <h1><i class="fas fa-file-contract"></i> Terms and Conditions</h1>
            <p>Please read these terms carefully before using our services</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="terms-container">

        <div class="last-updated">
            <i class="fas fa-calendar-alt"></i>
            <strong>Last Updated:</strong> January 30, 2026
        </div>

        @foreach ($termscondition as $termscondition)
        <!-- Section 1 -->
        <div class="section">
            <h2 class="section-title">
                <span class="section-number">1</span>
                {{$termscondition->title ?? ''}}
            </h2>
            <p>
                {{$termscondition->description ?? ''}}
            </p>

        </div>
     @endforeach
    </div>
@include('Frontend.pages.footer')

