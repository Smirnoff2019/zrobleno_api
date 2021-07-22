@stack('script_top')

{{-- Laravel clockwork --}}
<script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>
{{-- end Laravel clockwork --}}

<script src="{{ asset('admin/js/jquery-3.5.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{ asset('admin/js/scripts.js') }}"></script>

<script src="{{ asset('js/libs/slugify.min.js') }}"></script>
<script src="{{ asset('js/libs/speakingurl.min.js') }}"></script>
<script src="{{ asset('js/libs/ckeditor-full/ckeditor.js') }}"></script> 

@stack('script_midle')

<script src="{{ asset('js/app.js') }}?v={{ time() }}"></script>

@stack('script_bootom')


@stack('foot')
