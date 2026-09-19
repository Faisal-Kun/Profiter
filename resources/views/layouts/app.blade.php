<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ProfitKu</title>


    {{-- BOOTSTRAP --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- BOOTSTRAP ICON --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #0b0d12;
            color: #f5f5f5;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 250px;
            height: 100vh;

            position: fixed;
            left: 0;
            top: 0;

            background: #11141b;

            border-right: 1px solid #242832;

            overflow-y: auto;

            z-index: 1000;

            padding-top: 10px;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            color: #ffffff;

            font-size: 25px;
            font-weight: 700;

            border-bottom: 1px solid #242832;

            margin-bottom: 18px;
        }


        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .sidebar a {

            position: relative;

            display: flex;
            align-items: center;

            gap: 12px;

            margin: 6px 12px;

            padding: 13px 15px;

            border-radius: 10px;

            color: #858994;

            text-decoration: none;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        /* ICON */

        .sidebar a i {

            width: 22px;

            font-size: 18px;

            text-align: center;

            transition: color .2s ease;
        }


        /* =====================================================
           HOVER
        ===================================================== */

        .sidebar a:hover {

            background: rgba(34, 211, 238, .10);

            color: #22d3ee;

            transform: translateX(3px);
        }

        .sidebar a:hover i {
            color: #22d3ee;
        }


        /* =====================================================
           ACTIVE
        ===================================================== */

        .sidebar a.active {

            background: rgba(34, 211, 238, .14);

            color: #22d3ee;

            font-weight: 600;
        }

        .sidebar a.active i {
            color: #22d3ee;
        }


        /* GARIS CYAN */

        .sidebar a.active::before {

            content: "";

            position: absolute;

            left: 0;

            top: 7px;
            bottom: 7px;

            width: 3px;

            border-radius: 0 5px 5px 0;

            background: #22d3ee;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            margin-left: 250px;

            min-height: 100vh;

            background: #0b0d12;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            height: 70px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 30px;

            background: #11141b;

            border-bottom: 1px solid #242832;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .card-dashboard {

            background: #17191f;

            border: 1px solid #272a33;

            border-radius: 15px;

            box-shadow: none;
        }


        /* =====================================================
           PRODUCT CARD
        ===================================================== */

        .product-card {

            background: #17191f;

            border: 1px solid #272a33;

            border-radius: 15px;

            overflow: hidden;

            box-shadow: none;

            transition: .2s ease;
        }

        .product-card:hover {

            transform: translateY(-3px);

            border-color: #22d3ee;

            box-shadow: 0 10px 30px rgba(0,0,0,.25);
        }

        .product-card img {

            width: 100%;

            height: 180px;

            object-fit: cover;
        }


        /* =====================================================
           BUTTON CYAN
        ===================================================== */

        .btn-warning {

            background: #22d3ee !important;

            border-color: #22d3ee !important;

            color: #061014 !important;

            font-weight: 600;

            transition: .2s ease;
        }

        .btn-warning:hover {

            background: #67e8f9 !important;

            border-color: #67e8f9 !important;

            color: #061014 !important;

            transform: translateY(-1px);

            box-shadow: 0 5px 15px rgba(34,211,238,.2);
        }


        /* =====================================================
           OUTLINE BUTTON
        ===================================================== */

        .btn-outline-light {

            border-color: #353945;

            color: #b8bdc8;

            transition: .2s ease;
        }

        .btn-outline-light:hover {

            background: rgba(34, 211, 238, .10);

            border-color: #22d3ee;

            color: #22d3ee;
        }


        /* =====================================================
           TEXT CYAN
        ===================================================== */

        .text-warning {
            color: #22d3ee !important;
        }


        /* =====================================================
           BADGE
        ===================================================== */

        .badge.bg-warning {

            background: #22d3ee !important;

            color: #061014 !important;
        }


        /* =====================================================
           SCROLLBAR
        ===================================================== */

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #11141b;
        }

        .sidebar::-webkit-scrollbar-thumb {

            background: #292e38;

            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {

            background: #22d3ee;
        }


        /* =====================================================
           RESPONSIVE TABLET
        ===================================================== */

        @media (max-width: 768px) {

            .sidebar {

                width: 70px;

                padding-top: 10px;
            }


            .logo {

                font-size: 20px;

                height: 70px;
            }


            .logo span:last-child {
                display: none;
            }


            .sidebar a {

                justify-content: center;

                padding: 13px 10px;

                margin: 6px;
            }


            .sidebar a span {
                display: none;
            }


            .sidebar a i {
                margin: 0;
            }


            .content {

                margin-left: 70px;
            }

        }


        /* =====================================================
           RESPONSIVE HP
        ===================================================== */

        @media (max-width: 576px) {

            .content {

                margin-left: 0;
            }


            .sidebar {

                display: none;
            }

        }

    </style>

</head>


<body>


    {{-- SIDEBAR --}}

    @include('partials.sidebar')


    {{-- CONTENT --}}

    <div class="content">


        {{-- NAVBAR --}}

        @include('partials.navbar')


        {{-- HALAMAN --}}

        <div class="container-fluid p-4">

            @yield('content')

        </div>


    </div>


</body>

</html>