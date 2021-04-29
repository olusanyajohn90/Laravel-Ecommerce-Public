@extends('layouts.app')

@section('content')
@include('layouts.menubar')

 @foreach($posts as $row)
<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">
                        <h3>
                    @if(Session()->get('lang') == 'french')
								{{ $row->post_title_fr }}
								@else
								{{ $row->post_title_en }}
                                @endif
                            </h3>
					 </div>


					<div class="single_post_text">
						<p> @if(Session()->get('lang') == 'fr')
								{!! $row->details_fr !!}
								@else
								{!! $row->details_en !!}
								@endif </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endforeach




@endsection
