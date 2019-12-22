@if(session()->has('success-message'))
    <div id="alert" class="alert alert-success alert-dismissible">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i>موفق</h4>
        {{session('success-message')}}
    </div>
@endif

@if(session()->has('error-message'))
    <div id="alert" class="alert alert-danger alert-dismissible">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-trash"></i>اخطار</h4>
        {{session('error-message')}}
    </div>
@endif

@if(session()->has('info-message'))
    <div id="alert" class="alert alert-info alert-dismissible">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i>توجه</h4>
        {{session('info-message')}}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" dir="rtl">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<script>
    $('#alert').hide(5000);
</script>
