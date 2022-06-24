@section('script')
    <!-- Library Bundle Script -->
    <script src="{{ asset('resources/js/core/libs.min.js') }}"></script>

    <!-- External Library Bundle Script -->
    <script src="{{ asset('resources/js/core/external.min.js') }}"></script>

    <!-- Widgetchart Script -->
    <script src="{{ asset('resources/js/charts/widgetcharts.js') }}"></script>

    <!-- mapchart Script -->
    <script src="{{ asset('resources/js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('resources/js/charts/dashboard.js') }}" defer></script>

    <!-- fslightbox Script -->
    <script src="{{ asset('resources/js/plugins/fslightbox.js') }}"></script>

    <!-- GSAP Animation -->
    <script src="{{ asset('resources/vendor/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('resources/vendor/gsap/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('resources/js/gsap-init.js') }}"></script>

    <!-- Form Wizard Script -->
    <script src="{{ asset('resources/js/plugins/form-wizard.js') }}"></script>

    <!-- App Script -->
    <script src="{{ asset('resources/js/gigz.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (Session::has('success'))
            Swal.fire({
                title: 'Complete!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Okay'
            })
            /* toastr.success("{{ session('message') }}") */
        @endif
        @if (Session::has('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Okay'
            })
            /* toastr.success("{{ session('message') }}") */
        @endif
        $('.validate-checkbox').click(function() {
            var data = $(this).data('input'),
                check = $(this).prop('checked')
            if (check == false) {
                $('.' + data).prop('disabled', false)
            } else {
                $('.' + data).prop('disabled', true)
            }
            console.log(data)

        })
    </script>
@endsection
