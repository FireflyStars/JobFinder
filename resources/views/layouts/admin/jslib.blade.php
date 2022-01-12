<!-- basic scripts -->

<!--[if !IE]> -->
<script src="{{ asset('admin_assets/js/jquery-2.1.4.min.js') }}"></script>

<!-- <![endif]-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<!--[if IE]>
<script src="{{ asset('admin_assets/js/jquery-1.11.3.min.js') }}"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('admin_assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
</script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="{{ asset('admin_assets/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/ace.min.js') }}"></script>

@section('scripts')
@show

<script src="{{ asset('admin_assets/js/my_js.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/fv0cjaerby30gy8ehna7c8m50obvur51olgjyp3ensfx7kp9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('assets/js/custom-script.js') }}"></script>