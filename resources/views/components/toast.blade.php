<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="/js/toastr.min.js"></script>
@if(session("success"))
    <script type="application/javascript">
        $(function () {
            toastr.options.positionClass = 'toast-bottom-full-width';
            toastr.options.timeOut = '10000';
            toastr.success('{{ session("success") }}')
        })
    </script>
@endif
@if(session("info"))
    <script type="application/javascript">
        $(function () {
            toastr.options.positionClass = 'toast-bottom-full-width';
            toastr.options.timeOut = '10000';
            toastr.info('{{ session("info") }}')
        })
    </script>
@endif
@if(count($errors))
    <script type="application/javascript">
        $(function () {
            toastr.options.positionClass = 'toast-bottom-full-width';
            toastr.options.timeOut = '10000';
            toastr.error('Please, make sure all fields are filled correctly!')
        })
    </script>
@endif

