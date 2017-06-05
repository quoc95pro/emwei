@extends('master')
@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng Nhập</h2>
						<form action="{{'post-login'}}" method="post">
							{{csrf_field()}}
							@if(isset($_COOKIE['mail']))
							<input type="text" placeholder="Email" value="{{$_COOKIE['mail']}}" name="mail"/>
							<input type="password" placeholder="Mật Khẩu" value="{{$_COOKIE['pass']}}" name="pass"/>
							<span>
								<input type="checkbox" name="save" checked class="checkbox">
								Lưu Mật Khẩu ?
							</span>
							@else
								<input type="text" placeholder="Email"  name="mail"/>
								<input type="password" placeholder="Mật Khẩu"  name="pass"/>
								<span>
								<input type="checkbox" name="save"  class="checkbox">
								Lưu Mật Khẩu ?
							</span>
							@endif
							<button type="submit" class="btn btn-default">Đăng Nhập</button>
						</form>
						@if(count($errors)>0)
							<div class="alert alert-danger">
								@foreach($errors->all() as $err)
									{{$err}}<br/>
								@endforeach
							</div>
						@endif
						@if(Session::has('flag'))
							<div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
						@endif
					</div><!--/login form-->
				</div>


			</div>
		</div>
	</section><!--/form-->
@endsection

