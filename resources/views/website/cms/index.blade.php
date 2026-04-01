@extends('website.layout.app')
@section('content')

<div class="main-container">	
	<main class="site-main">
		<div class="container-fluid no-left-padding no-right-padding page-content">
			<div class="container">
				<div class="row">
					<div class="col-md-12 content-area">	
						<div class="aboute-block">
							<div class="block-title">
								<h3>{{$row->title}}</h3>
							</div>
							<p><?php echo $row->description;?></p>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</main>		
</div>

@endsection