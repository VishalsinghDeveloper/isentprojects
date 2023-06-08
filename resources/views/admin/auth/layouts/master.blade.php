<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Isent</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href={{ asset('newad/vendors/feather/feather.css')}}>
    <link rel="stylesheet" href={{ asset('newad/vendors/ti-icons/css/themify-icons.css')}}>
    <link rel="stylesheet" href={{ asset('newad/vendors/css/vendor.bundle.base.css')}}>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href={{ asset('nead/wvendors/datatables.net-bs4/dataTables.bootstrap4.css')}}>
    <link rel="stylesheet" href={{ asset('newad/vendors/ti-icons/css/themify-icons.css')}}>
    <link rel="stylesheet" type="text/css" href={{ asset('newad/js/select.dataTables.min.css')}}>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href={{ asset('newad/css/vertical-layout-light/style.css')}}>
    <link rel="stylesheet" href={{ asset('newad/css/vertical-layout-light/offer.css')}}>

    <!-- endinject -->
    @yield('css')

</head>

<body>

    @yield('content')


    <script src={{ asset('newad/vendors/js/vendor.bundle.base.js') }}></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src={{ asset('newad/vendors/chart.js/Chart.min.js') }}></script>
    <script src={{ asset('newad/vendors/datatables.net/jquery.dataTables.js') }}></script>
    <script src={{ asset('newad/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}></script>
    <script src={{ asset('newad/js/dataTables.select.min.js') }}></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src={{ asset('newad/js/off-canvas.js') }}></script>
    <script src={{ asset('newad/js/hoverable-collapse.js') }}></script>
    <script src={{ asset('newad/js/template.js') }}></script>
    <script src={{ asset('newad/js/file-upload.js') }}></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src={{ asset('newad/js/dashboard.js') }}></script>
    <script src={{ asset('newad/js/Chart.roundedBarCharts.js') }}></script>
    <!-- End custom js for this page-->
    @yield('js')
</body>

</html>

