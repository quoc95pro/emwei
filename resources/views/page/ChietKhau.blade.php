@extends('master')
@section('content')
	<section id="form" style="margin-top: 0px"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="signup-form"><!--sign up form-->
						<center><h2 style="font-size: xx-large">Bấm Nút Bên Dưới Để Nhận Chiết Khấu May Mắn</h2>
						<form id="commentForm" >
							{{csrf_field()}}
							<h2 id="random-area" style="font-size: -webkit-xxx-large">1</h2>
							<a class="btn btn-primary" onclick="ok()" id="clickButton">Random</a>
							<script language="javascript">

                                function ok() {
                                    random(100);
                                    setTimeout(function() {
                                        $.ajax({
                                            url : "{{route('updateDisCountProduct')}}",
                                            type : "post",
                                            dateType:"text",
                                            data : {
                                                discount : document.getElementById("random-area").innerHTML,
                                            },
                                            success : function (result){
                                                alert('Chúc Mừng Bạn Được Chiết Khấu '+document.getElementById("random-area").innerHTML+' % Trên Mỗi Hóa Đớn Khi Thanh Toán');
                                            }
                                        });
                                    }, 5000);
                                }


                                function random(max_random) {

                                    random_area = document.getElementById("random-area");
                                    document.getElementById("clickButton").style.display='none';
                                    var arr = "0123456789".split('');
                                    if (max_random < 0) {

                                        return;
                                    }

                                    random_area.innerHTML = (Math.random() * (2.00 - 0.50) + 0.50).toFixed(2);

                                        setTimeout(function() {
                                        random(--max_random);
                                    }, 40);
                                }

							</script>
						</form>
						</center>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection

