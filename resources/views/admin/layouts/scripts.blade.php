<script>
    var hostUrl = "assets/";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
{{-- <script src="{{ asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}
{{-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script> --}}
{{-- <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script> --}}
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
<script src="{{ asset('admin/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('admin/js/custom/widgets.js') }}"></script>
{{-- <script src="{{ asset('admin/js/custom/apps/chat/chat.js') }}"></script> --}}
<script src="{{ asset('admin/js/custom/utilities/modals/users-search.js') }}"></script>
{{-- <script src="{{ asset('admin/js/intlTelInput.min.js') }}"></script> --}}
<!--end::Custom Javascript-->
<script src="{{ asset('admin/js/axios.min.js') }}"></script>
<script src="{{ asset('admin/js/summernote-lite.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
</script>
<script>
    let delete_item = '{{__('admin.form.delete_item')}}';
    let cancel = '{{__('admin.form.cancel')}}';
    let do_you_want_to_delete_this_address = '{{__('admin.form.do_you_want_to_delete_this_address')}}';
    let delete_confirm = '{{__('admin.form.delete')}}';
    let exit = '{{__('admin.form.exit')}}';
    let delete_proccessing = '{{__('admin.form.delete_proccessing')}}';
    let do_you_want_activate = '{{__('admin.form.do_you_want_activate')}}';
    let do_you_want_deactivate = '{{__('admin.form.do_you_want_deactivate')}}';
    let deactivate = '{{__('admin.form.deactivate')}}';
    let activate = '{{__('admin.form.activate')}}';
    let it_is_not_deleted = '{{__('admin.form.it_is_not_deleted')}}';
    let deleted_successfully = '{{__('admin.form.deleted_successfully')}}';
    let done = '{{__('admin.form.done')}}';
    let please_wait = '{{__('admin.form.please_wait')}}';
    let ok_go_it = '{{__('admin.form.ok_go_it')}}';
    let no_data_available_in_table = '{{__('admin.form.no_data_available_in_table')}}';
    let showing_no_records = '{{__('admin.form.showing_no_records')}}';
    let are_you_sure_to_delete_these_records = '{{__('admin.form.are_you_sure_to_delete_these_records')}}';
    let some_errors  = '{{__('admin.form.some_errors ')}}';
    let are_you_sure_you_want_to_delete  = '{{ __('admin.global.are_you_sure_you_want_to_delete') }}';
</script>
@stack('scripts')
