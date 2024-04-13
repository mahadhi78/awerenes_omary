<script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('assets/js/inspinia.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>

<!-- Chosen -->
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>


<script>

    $(document).ready(function() {
        function setActiveClass(container, route) {
            var $activeChildLink = $(container + ' ul.nav-second-level li a[data-route="' + route + '"]');
            if ($activeChildLink.length > 0) {
                $(container + ' > a').click();
                $activeChildLink.closest('li').addClass('active');
            }
        }
        var currentRoute = "{{ Route::currentRouteName() }}";

        setActiveClass('#system-settings', currentRoute);
        setActiveClass('#student', currentRoute);
        setActiveClass('#staffs', currentRoute);
        setActiveClass('#driver', currentRoute);
        setActiveClass('#approval', currentRoute);
        setActiveClass('#academic', currentRoute);
        setActiveClass('#uniform', currentRoute);
    });
</script>

@stack('scripts')
