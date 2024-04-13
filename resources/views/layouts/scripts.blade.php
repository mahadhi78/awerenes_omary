    <!-- Application Basic JS -->
    <script src="{{ URL::asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ URL::asset('js/scripts.bundle.js') }}"></script>
    <script src="{{ URL::asset('js/custom/modals/datepicker.js') }}"></script>
    <script src="{{ URL::asset('js/custom/modals/word-count.js') }}"></script>
    <script src="{{ URL::asset('js/custom/pages/swal/sweetalert.min.js') }}"></script>
    <!-- Specific Component JS -->
    @yield('script')
