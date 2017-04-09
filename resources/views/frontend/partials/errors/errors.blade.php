@if (count($errors) > 0)
<div class="alert alert-dismissable alert-danger">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
<ul>
  @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
  @endforeach
</ul>
</div>
@endif

@if ( \Session::has('flash_message') ) 
  <div class="alert alert-dismissable {{ Session::get('flash_type') }}">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      {{ \Session::get('flash_message') }}
  </div>  
@endif 